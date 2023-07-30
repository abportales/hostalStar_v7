<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

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
        $rents = Rent::allByEndDate();
        // $rents = Rent::all();
        return view('general.index', compact('rents'));
        // ->with('i', (request()->input('page', 1) - 1) * $rents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $rent = new Rent();
        // $available_rooms = Room::getAvailableRoomsForCreate();
        // return view('rent.create', compact('rent', 'available_rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate(Rent::$rules);
        // // $rent = Rent::create($request->all());
        // $rent = Rent::createModel($request);

        // return redirect()->route('rents.index')
        //     ->with('success', 'Inquilina creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total = 0.0;
        $rents = Rent::EarningsSummary($total);

        return view('general.show', compact('rents', 'total'));
    }

    public function charged($id, $balance)
    {
        if ($balance == 0) {
            Rent::chargedModel($id);
            return redirect()->route('general.index')
                ->with('success', 'Renta cobrada y almacenada.');
        } else {
            return redirect()->route('rents.edit', $id)
                ->with('danger', 'El saldo es: $' . $balance . ' y debe estar en cero para cobrar.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $rent = Rent::find($id);
        // $available_rooms = Room::getAvailableRooms($rent->room->name);

        // return view('rent.edit', compact('rent','available_rooms'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // $rent = Rent::find($id);
        // Room::changeRentedStatus($rent->room_id,false);
        // $rent->delete();

        // return redirect()->route('rents.index')
        //     ->with('success', 'Inquilina borrada');
    }
}
