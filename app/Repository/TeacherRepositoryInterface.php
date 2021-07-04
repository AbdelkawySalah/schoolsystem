<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

    //get all teachers
    public function getAllTeachers();
    public function GetSpecializations();
    public function GetGender();

    public function AddTeacher($request);
    public function EditTeacher($id);
    public function UpdateTeacher($request);
    public function DeleteTeacher($request);


}

















?>