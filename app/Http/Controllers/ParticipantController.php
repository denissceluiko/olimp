<?php

namespace App\Http\Controllers;

use App\Olympiad;
use App\Participant;
use App\Room;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
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
        return view('participants.index', ['students' => []]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Search for a participant
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        if (!$request->has('query_str')) return abort(400);

        $res = Olympiad::find(auth()->user()->activeOlympiad)
            ->participants()
            ->search($request->query_str)
            ->get();

        if($request->wantsJson()) return $res;
        return view('snippets.participantList', ['students' => $res]);
    }

    /**
     * Assign participant to a room
     *
     * TBI: different assignment methods
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function assignRoom(Request $request, $student) {
        $this->authorize('participant.assign');

        $data = [
            'student_id' => $student,
            'olympiad_id' => $request->olympiad_id ?: Auth::user()->activeOlympiad->id,
        ];

        $validator = Validator::make($data, [
            'student_id' => 'required|integer',
            'olympiad_id' => 'required|integer',
        ]);

        if($validator->fails()) return abort(400);

        $res = Student::findOrFail($student);
        $olympiad = $res->olympiads()->find($data['olympiad_id']);

        if($olympiad->pivot->room_id) return response()->make(trans('labels.room.already_assigned'), 400);

        $room = Room::getRoom($olympiad->pivot->grade);
        if (!$room) return response()->make('labels.room.none_available', 500);
        $res->olympiads()->updateExistingPivot($data['olympiad_id'], ['room_id' => $room]);
        return response()->make('');
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
