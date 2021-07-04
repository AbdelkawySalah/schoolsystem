<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;


use App\Interfaces\Student\StudentRepositoryInterface; 

class StudentController extends Controller
{
    private $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
	       //Sections1 اصبح فيها كل اللي في ريبروستري 

        $this->Student=$Student;
    }
    public function index()
    {
        return $this->Student->index();
    }

   
    public function create()
    {
        return $this->Student->create();
    }

    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

   
    public function store(StudentRequest $request)
    {
        return $this->Student->store($request);

    }

    // public function softDelete(Request $request)
    // {
    //     return $this->Student->softDelete($request);

    // }

    public function edit($id)
    {
        return $this->Student->edit($id);
    }

    public function update(StudentRequest $request)
    {
        
        return $this->Student->update($request);

    }

    
    public function destroy(Request $request)
    {
        return $this->Student->destroy($request);

    }

    public function show($id){
        return $this->Student->show_StudentData($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }

    public function Download_attachment($studentsname, $filename){
        return $this->Student->Download_attachment($studentsname,$filename);
    }

    public function view_attachment($studentsname, $filename){
        return $this->Student->view_attachment($studentsname,$filename);

    }
    public function Delete_attachment(Request $request){
        return $this->Student->Delete_attachment($request);
    }

}
