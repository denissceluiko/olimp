<?php

namespace App\Http\Controllers;

use App\Olympiad;
use App\Room;
use Illuminate\Http\Request;
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
        //$res = null;

        //if (session('active.olimp')) {
            //$res = Olympiad::findOrFail(1)->rooms();
            $res = Room::all();
            //$res = [["id" => 3, "seats" => 12]];
        //}
        return view('room.index', ['rooms' => $res, 'olympiad' => Olympiad::findOrFail(2)]);
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
        $rules = array(
            'room'        => 'required',
            'olympiad'    => 'required|integer',
            'seats'       => 'required|integer',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/rooms/create')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            $room = new Room;
            $room->room   = $request->get('room');
            $room->olympiad()->associate(Olympiad::find($request->get('olympiad')));
            $room->seats  = $request->get('seats');
            $room->save();

            return Redirect::to('/rooms/');
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
