<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * Class Rent
 *
 * @property $id
 * @property $room_id
 * @property $renters_name
 * @property $renters_ine_ocr
 * @property $money_deposit
 * @property $paid_weeks
 * @property $created_at
 * @property $updated_at
 * @property $end_date
 * @property $deleted_at
 *
 * @property Room $room
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Rent extends Model
{
    use SoftDeletes;

    static $rules = [
        'room_id' => 'required',
        'renters_name' => 'required|string',
        'renters_ine_ocr' => 'nullable|string',
        'money_deposit' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'paid_weeks'  => 'required|integer',
        'pay_type'  => 'required|string',
        'start_date'  => 'nullable|date_format:d-m-Y',
    ];

    protected $perPage = 20;

    protected $casts = [
        'start_date' => 'date:d-m-Y',
        'end_date' => 'date:d-m-Y',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'renters_name',
        'renters_ine_ocr',
        'money_deposit',
        'paid_weeks',
        'pay_type',
        'start_date',
        'end_date'
    ];

    public static function createModel($request)
    {
        DB::beginTransaction();
        $start_date = isset($request->start_date) ? Carbon::parse(date_create($request->start_date))->locale('es') : Carbon::now();

        $rent = new Rent([
            'room_id' => $request->room_id,
            'renters_name' => $request->renters_name,
            'renters_ine_ocr' => $request->renters_ine_ocr,
            'money_deposit' => $request->money_deposit,
            'pay_type' => $request->pay_type,
            'paid_weeks' => $request->paid_weeks,
            'start_date' =>  $start_date,
        ]);

        $rent->end_date = self::calculateEndDate($request, $start_date);
        if (is_null($rent->end_date)) {
            DB::rollBack();
            return null;
        } else {
            Room::changeRentedStatus($rent->room_id, 1);
            $rent->save();
            DB::commit();
            return true;
        }
    }

    public function updateModel($request)
    {
        DB::beginTransaction();

        $start_date = isset($request->start_date) ? Carbon::parse(date_create($request->start_date))->locale('es') : Carbon::now();

        if ($request->room_id != $this->room_id) {
            //se cambio de cuarto
            Room::changeRentedStatus($this->room_id, 0);
            Room::changeRentedStatus($request->room_id, 1);
        }

        $this->room_id = $request->room_id;
        $this->renters_name = $request->renters_name;
        $this->renters_ine_ocr = $request->renters_ine_ocr ?? '';
        $this->money_deposit = $request->money_deposit;
        $this->pay_type = $request->pay_type;
        $this->paid_weeks = $request->paid_weeks;
        $this->start_date =  $start_date;
        $this->end_date = self::calculateEndDate($request, $start_date);
        if (is_null($this->end_date)) {
            DB::rollBack();
            return null;
        } else {
            $this->save();
            DB::commit();
            return true;
        }
    }

    public function destroyModel()
    {
        Room::changeRentedStatus($this->room_id, false);
        $this->delete();
    }

    public static function chargedModel($id)
    {
        $rent = Rent::find($id);
        $rent->paid = true;
        $rent->save();
        Room::changeRentedStatus($rent->room_id, false);
        $rent->delete();
    }

    public static function allByEndDate()
    {
        $the_date = Carbon::today()->addDays(3);
        return Rent::whereDate('end_date', '<=', $the_date)
            ->orderBy('end_date', 'asc')
            ->get();
    }

    public static function EarningsSummary(&$total)
    {
        $summary = [];
        //suma la columna money ponle el nombre earnings, cuentame la columa room y ponle rented_times, agrupar siempre el count
        $rents = Rent::onlyTrashed()
            ->select(DB::raw('sum(money_deposit) as earnings, room_id, COUNT(*) AS rented_times'))
            ->where('paid', true)
            ->groupBy('room_id')
            ->get();

        foreach ($rents as $rent) {
            $summary[] = [
                'name' => $rent->room->name,
                'rented_times' => $rent->rented_times,
                'earnings' => $rent->earnings,
            ];
            $total += $rent->earnings;
        }

        return $summary;
    }

    private static function calculateEndDate(Request $request, Carbon $start_date): ?Carbon
    {
        //se separa para poder modificar bien el addweek, si se hace antes modifica el valor del start_date
        switch ($request->pay_type) {
            case 'semanas': //'Semanas':
                return $start_date->copy()->addWeek((int)$request->paid_weeks);
                break;
            case 'quincenas': //'Quincenas':
                return $start_date->copy()->addDays((int)$request->paid_weeks * 15);
                break;
            case 'meses': //'Meses':
                return $start_date->copy()->addMonths((int)$request->paid_weeks);
                break;
            default:
                return null;
                break;
        }
    }

    public function getBalance(): ?float
    {
        switch ($this->pay_type) {
            case 'semanas': //'Semanas':
                return $this->room->price * $this->paid_weeks - $this->money_deposit;
                break;
            case 'quincenas': //'Quincenas':
                return $this->room->price * $this->paid_weeks * 2 - $this->money_deposit;
                break;
            case 'meses': //'Meses':
                return $this->room->price * $this->paid_weeks * 4 - $this->money_deposit;
                break;
            default:
                return null;
                break;
        }
    }

    public function getStartDate()
    {
        return $this->start_date->format('d-m-Y');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
