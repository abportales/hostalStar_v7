<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;

/**
 * Class RentController
 * @package App\Http\Controllers
 */
class RentController extends Controller
{
    protected static $pay_time = ['semanas' => 'semanas', 'quincenas' => 'quincenas', 'meses' => 'meses'];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::paginate();
        return view('rent.index', compact('rents'))
            ->with('i', (request()->input('page', 1) - 1) * $rents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rent = new Rent();
        $available_rooms = Room::getAvailableRoomsForCreate();
        $pay_time = self::$pay_time;
        return view('rent.create', compact('rent', 'available_rooms', 'pay_time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Rent::$rules);

        if (Rent::createModel($request)) {
            return redirect()->route('rents.index')->with('success', 'Renta creada');
        } else {
            return redirect()->route('rents.index')->with('danger', 'Ocurrio un error con las fechas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Rent $rent)
    {
        $balance = $rent->getBalance();
        if (is_null($balance)) {
            return redirect()->route('rents.index')->with('danger', 'Ocurrio un error obteniendo el balance');
        }
        return view('rent.show', compact('rent', 'balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit(Rent $rent)
    {
        // $rent = Rent::find($id);
        $available_rooms = Room::getAvailableRooms($rent->room->name);
        $pay_time = self::$pay_time;

        return view('rent.edit', compact('rent', 'available_rooms', 'pay_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        request()->validate(Rent::$rules);

        if($rent->updateModel($request)){
            return redirect()->route('rents.index')->with('success', 'Renta modificada');
        }else{
            return redirect()->route('rents.index')->with('danger', 'Renta no modificada');
        }

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Rent $rent)
    {
        $rent->destroyModel();
        return redirect()->route('rents.index')->with('success', 'Renta borrada');
    }
}
