<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

 use  App\Models\Teacher;
 use  App\Models\Specializations;
 use  App\Models\Gender;

use App\Repository\TeacherRepositoryInterface;
class TeacherController extends Controller
{
     protected $Teach;
     public function __construct(TeacherRepositoryInterface $Teacher1)
     {
         $this->Teach=$Teacher1;
     }

    public function index()
    {
        $Teachers=$this->Teach->getAllTeachers();
     // $Teachers=Teacher::all();
      return view('dashboard.pages.Teachers.Teachers',compact('Teachers'));
    }

    public function create()
    {
        //
     //  $specializations=Specializations::all();
     //  $genders=Gender::all();
     $specializations=$this->Teach->GetSpecializations();
     $genders=$this->Teach->GetGender();
     return view('dashboard.pages.Teachers.AddTeacher',compact('specializations','genders'));
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
        return $this->Teach->AddTeacher($request);
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
        //return $id;
        $Teacher=$this->Teach->EditTeacher($id);
        $specializations=$this->Teach->GetSpecializations();
        $genders=$this->Teach->GetGender();
        return view('dashboard.pages.Teachers.editTeacher',compact('Teacher','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->Teach->UpdateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        return $this->Teach->DeleteTeacher($request);
    }
}
