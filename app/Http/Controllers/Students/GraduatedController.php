<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Student\StudentGraduatedRepositoryInterface; 

class GraduatedController extends Controller
{
    private $Graduated;
    public function __construct(StudentGraduatedRepositoryInterface $Graduated)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->Graduated=$Graduated;
    }

    public function index()
    {
        return $this->Graduated->index();
    }

   
    public function create()
    {
        return $this->Graduated->create();

    }

    
    public function store(Request $request)
    {
        return $this->Graduated->SoftDelete($request);

    }

  
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

   
    public function update(Request $request)
    {
        return $this->Graduated->ReturnStudentData($request);

    }

  
    public function destroy(Request $request)
    {
        return $this->Graduated->destroy($request);

    }
}
