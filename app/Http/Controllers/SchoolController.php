<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
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
        $this->authorize('school.list');
        
        return view('school.index', ['schools' => School::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('school.create');
        return view('school.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('school.create');

        $this->validate($request, [
            'name' => 'required'
        ]);

        School::create($request->only(['name']));
        return back();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Import schools from .csv
     *
     * 0 => "Kods"
     * 1 => "Reģ. nr."
     * 2 => "Izglītības iestādes nosaukums"
     * 3 => "Adrese"
     * 4 => "Epasts"
     * 5 => "Tālrunis"
     * 6 => ""
     * 7 => "Direktors"
     * 8 => "Visas plūsmas"
     * 9 => "Izglītojamo skaits pamata un vidējās vispārējās izglītības programmās"
     *
     */
    public function import(Request $request) {
        $this->authorize('school.create');

        $this->validate($request, [
            'school_list' => 'required|mimes:csv,txt|max:1000'
        ]);

        $file = $request->file('school_list')->openFile();

        $failed = [];
        $row = $file->fgetcsv(); // Get headers

        while ($row = $file->fgetcsv()) {
            if ($row[0] == "") continue;

            $location = explode(', ', $row[3]);
            $data = [
                'name' => $row[2],
                'code' => $row[0],
                'reg_no' => $row[1],
                'address' => $location[0],
                'city' => $location[1],
                'post' => $location[2],
                'email' => $row[4],
                'phone' => $row[5],
                'principal' => $row[6] . " " . $row[7],
                'language' => $row[8],
                'students' => $row[9],
            ];

            $validator = Validator::make($data, [
                'name' => 'required|unique:schools',
            ]);

            if ($validator->fails()) {
                $failed[] = $data;
                continue;
            }

            School::create($data);
        }

        return redirect()->route('schools.index');
    }
}
