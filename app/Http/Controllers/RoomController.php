<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class RoomController extends Controller
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
        $rooms = Room::paginate();

        return view('room.index', compact('rooms'))
            ->with('i', (request()->input('page', 1) - 1) * $rooms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room = new Room();
        return view('room.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Room::$rules);

        $room = Room::createModel($request);

        return redirect()->route('rooms.index')
            ->with('success', 'Cuarto creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);

        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        request()->validate(Room::$rules);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Cuarto modificado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->rent()->delete();
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Cuarto borrado');
    }
}
