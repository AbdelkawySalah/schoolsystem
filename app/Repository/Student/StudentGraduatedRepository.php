<?php
namespace App\Repository\Student;
use App\Interfaces\Student\StudentGraduatedRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\Grade;
 use App\Models\Student;

use Illuminate\Support\Facades\DB;
class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
   
   
   public function index()
   {

      $students=Student::onlyTrashed()->get();
      return view('dashboard.pages.Students.Graduated.index',compact('students'));
   }
   
   public function create()
   {
     $Grades=Grade::all();
     return view('dashboard.pages.Students.Graduated.create',compact('Grades'));
   }
   public function SoftDelete($request)
   {
   //  return $request;
      $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)
                ->where('section_id',$request->section_id)->get();
      // return $students;
      if($students->count() < 1){
         return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
       }
      foreach($students as $student)
      {
         $ids = explode(',',$student->id);//$ids=[1,2,3]
         Student::wherein('id',$ids)->Delete();
         //كده هيعمل سوفت دليت بناء علي اللي مكتوب في موديل
      }
      toastr()->success(trans('messages.success'));
      return redirect()->route('Graduated.index');
      // return redirect()->back();

   }

   public function ReturnStudentData($request){
      // return $request;
      Student::onlyTrashed()->where('id',$request->id)->first()->restore();
      toastr()->success(trans('messages.success'));
      return redirect()->back();
   }
  public function destroy($request)
  {
   Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
   toastr()->error(trans('messages.Delete'));
   return redirect()->back();
  }



  

  
}