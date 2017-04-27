<?php

namespace App\Http\Controllers;

use App\Olympiad;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $this->authorize('room.index');

        return view('room.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('room.create');
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('room.create');
        $this->validate($request, [
            'room'        => 'required',
            'olympiad'    => 'required|integer|exists:olympiads,id',
            'seats'       => 'required|integer',
        ]);

        $room = new Room($request->only(['room', 'seats']));
        $room->olympiad()
            ->associate($request->olympiad)
            ->save();

        return Redirect::route('rooms.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('room.edit');

        $rules = array(
            'room'        => 'required|integer',
            'seats'       => 'required|integer',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/rooms'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $room = Room::find($id);
            $room->room   = $request->get('room');
            $room->seats  = $request->get('seats');
            $room->save();

            return Redirect::to('rooms/');
        }
    }

    public function import(Request $request) {
        $this->authorize('room.create');
        $this->validate($request, [
            'olympiad' => 'required|exists:olympiads,id',
            'room_list' => 'required|mimes:csv,txt|max:1000'
        ]);

        $file = $request->file('room_list')->openFile();

        $failed = [];
        $row = $file->fgetcsv(); // Get headers

        while ($row = $file->fgetcsv()) {
            if ($row[0] == "") continue;

            $data = [
                'room' => $row[0],
                'seats' => $row[1],
            ];

            $room = new Room($data);
            $room->olympiad()->associate($request->olympiad)->save();
        }

        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::destroy($id);
        return back();
    }
}
