<?php

namespace App\Http\Controllers;

use App\Olympiad;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
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
        return view('student.index', ['students' => Student::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('student.create');
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('student.create');

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'school' => 'required|exists:schools,id',
            'grade' => 'required|numeric|min:3|max:6',
            'olympiad_id' => 'nullable|exists:olympiads,id'
        ]);

        $student = new Student($request->only(['name', 'surname']));
        $student->school()->associate($request['school'])->save();
        if ($request->olympiad_id) {
            $student->olympiads()->attach($request->olympiad_id, ['grade' => $request->grade]);
        }
        return redirect()->route('students.index');
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
     * CSV header: "Skola","Uzvārds","Vārds","Klase","Matemātikas skolotājs"
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request) {
        $this->authorize('student.create');

        $this->validate($request, [
            'olympiad_id' => 'required|exists:olympiads,id',
            'student_list' => 'required|mimes:csv,txt|max:1000'
        ]);

        $file = $request->file('student_list')->openFile();

        $failed = [];
        $row = $file->fgetcsv(); // Get headers

        while ($row = $file->fgetcsv()) {
            if ($row[0] == "") continue;

            $data = [
                'school' => $row[0],
                'surname' => $row[1],
                'name' => $row[2],
                'grade' => $row[3],
            ];

            $data['grade'] = in_array($data['grade'], ['3', '4', '5']) ? '5' : '6';

            $validator = Validator::make($data, [
                'name' => 'required',
                'surname' => 'required',
                'grade' => 'required',
                'school' => 'required|exists:schools,name',
            ]);

            if ($validator->fails()) {
                $failed[] = $data;
                continue;
            }

            $student = new Student(['name' => $data['name'], 'surname' => $data['surname']]);
            $student->school()
                ->associate(School::where('name', $data['school'])->first())
                ->save();
            $student->olympiads()->attach($request->olympiad_id, ['grade' => $data['grade']]);
        }
        //dd($failed);
        return redirect()->route('students.index');
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
