<?php
namespace App\Interfaces\Student;
interface StudentRepositoryInterface
{
   public function index();
   public function create();
   public function Get_classrooms($id);
   public function Get_Sections($id);

   public function store($request);
   public function edit($id);
   public function update($request);
   public function destroy($request);
   public function show_StudentData($id);
   public function Upload_attachment($request);
   public function Download_attachment($studentsname, $filename);
   public function view_attachment($studentsname, $filename);
   public function Delete_attachment($request);
   // public function softDelete($request);


 
}