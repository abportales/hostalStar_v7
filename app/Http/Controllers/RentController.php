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
        // $rents = Rent::all();
        // dd($rents->toArray());
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
        return view('rent.create', compact('rent', 'available_rooms'));
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
        // $rent = Rent::create($request->all());
        $rent = Rent::createModel($request);

        return redirect()->route('rents.index')
            ->with('success', 'Renta creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = Rent::find($id);

        return view('rent.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rent = Rent::find($id);
        $available_rooms = Room::getAvailableRooms($rent->room->name);

        return view('rent.edit', compact('rent','available_rooms'));
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

        $rent->updateModel($request);

        return redirect()->route('rents.index')
            ->with('success', 'Renta modificada');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Rent::destroyModel($id);

        return redirect()->route('rents.index')
            ->with('success', 'Renta borrada');
    }
}
