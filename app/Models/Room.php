<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Room
 *
 * @property $id
 * @property $name
 * @property $floor
 * @property $price
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Rent[] $rents
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Room extends Model
{
    use SoftDeletes;

    static $rules = [
        'name' => 'required|string',
        'floor' => 'required|integer',
        'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'floor', 'price', 'rented'];

    public static function createModel($request)
    {
        $room = new Room([
            'name' => $request->name,
            'floor' => $request->floor,
            'price' => $request->price,
            'rented' => false
        ]);

        $room->save();
    }

    public static function getAvailableRoomsForCreate()
    {
        return Room::where('rented', false)
            ->pluck('name', 'id')
            ->toArray();
    }

    public static function getAvailableRooms($actual)
    {
        return Room::where('rented', false)
            ->orWhere('name', $actual)
            ->select('name', 'id')
            ->get();
    }

    /**
     * Cambia el status del cuarto, true:ocupado, false:libre
     */
    public static function changeRentedStatus($id, $status)
    {
        $room = Room::findOrFail($id);
        $room->rented = $status;
        $room->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rent()
    {
        return $this->hasOne(Rent::class);
    }
}
