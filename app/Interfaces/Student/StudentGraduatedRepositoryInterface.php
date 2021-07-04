<?php
namespace App\Interfaces\Student;
interface StudentGraduatedRepositoryInterface
{
   public function index();
   public function create();
   public function SoftDelete($request);
   public function ReturnStudentData($request);
  public function destroy($request);
 


 
}