<?php
namespace App\Repository\Student;
use App\Interfaces\Student\StudentpromotionRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\Grade;
 use App\Models\Student;
 use App\Models\promotion;

use Illuminate\Support\Facades\DB;
class StudentpromotionRepository implements StudentpromotionRepositoryInterface
{
   
   
   public function index(){
    $Grades=Grade::all();
    
    return view('dashboard.pages.Students.promotion.index',compact('Grades'));

   }
   

   public function store($request)
   {
     
      DB::beginTransaction();
      try 
  {
   $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)
   ->where('academic_year',$request->academic_year)->get();
      if($students->count() < 1)
      {
         return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في المرحلة الدراسية القديمة المختارة للترقية'));
      }
   
      // update in table student
   //begin foreach
  foreach ($students as $student)
  {
//   
   //update in  student table
   Student::where('id', $student->id)
   ->update([
       'Grade_id'=>$request->Grade_id_new,
       'Classroom_id'=>$request->Classroom_id_new,
       'section_id'=>$request->section_id_new,
       'academic_year'=>$request->academic_year_new,
   ]);
//هنا بنتاكد لو طالب تم ترقيته قبل كده للمرحلة دي هيطلعه رساله انه اترقي قبل كده فمينفعش
    $promotion=promotion::where('student_id',$student->id)->where('to_gradeid',$request->Grade_id_new)->where('to_Classroomid',$request->Classroom_id_new)
                        ->where('to_sectionid',$request->section_id_new)->where('academic_year_new',$request->academic_year_new)->get();
     if($promotion->count() < 1)
       {
        
         promotion::Create([
               'student_id'=>$student->id,
               'from_gradeid'=>$request->Grade_id,
               'from_Classroomid'=>$request->Classroom_id,
               'from_sectionid'=>$request->section_id,
               'academic_year'=>$request->academic_year,
               'to_gradeid'=>$request->Grade_id_new,
               'to_Classroomid'=>$request->Classroom_id_new,
               'to_sectionid'=>$request->section_id_new,
               'academic_year_new'=>$request->academic_year_new,
                                  ]);
         
        }
      else{
         return redirect()->back()->with('error_promotions', __('فشل عملية الترقية لانها مسجلة مسبقا'));
      }

   
   //save in promotion table

   // promotion::updateOrCreate([
   //    'student_id'=>$student->id,
   //    'from_gradeid'=>$request->Grade_id,
   //    'from_Classroomid'=>$request->Classroom_id,
   //    'from_sectionid'=>$request->section_id,
   //    'to_gradeid'=>$request->Grade_id_new,
   //    'to_Classroomid'=>$request->Classroom_id_new,
   //    'to_sectionid'=>$request->section_id_new,
   //                       ]);
  }
 //End foreach

  DB::commit();
  toastr()->success(trans('messages.success'));
  return redirect()->back();
  } 
//End Try
 catch (\Exception $e) 
   {
   DB::rollback();
   return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
//End Catch

//مشكلة كود ده انه لو هعمل مثلا تريقة علي نفس المرحلة والصف والفصل هيعمل دبلكيت للداتا في جدول ترقية
//   $promotion=new promotion();
//   $promotion->student_id=$student->id;
//   $promotion->from_gradeid=$request->Grade_id;
//   $promotion->from_Classroomid=$request->Classroom_id;
//   $promotion->from_sectionid=$request->section_id;
//   $promotion->to_gradeid=$request->Grade_id_new;
//   $promotion->to_Classroomid=$request->Classroom_id_new;
//   $promotion->to_sectionid=$request->section_id_new;
//   $promotion->save();

//كود صحيح للحفظ في جدول الطلاب
   // $ids = explode(',',$students->id);
   // Student::whereIn('id', $ids)
   // ->update([
   //     'Grade_id'=>$request->Grade_id_new,
   //     'Classroom_id'=>$request->Classroom_id_new,
   //     'section_id'=>$request->section_id_new,
   // ]);
  
     
   }
  //end store method

  
  public function create()
  {
     $promotions=promotion::all();
     return view('dashboard.pages.Students.promotion.ManagmentPromotions',compact('promotions'));
  }

  public function destroy($request){
   DB::beginTransaction();
   try{

//begin If
if($request->page_id==1){
      //تحديث جدول الطلاب بترقيه السابقة وحذف جميع بيانات جدول الترقية
    $promotions=promotion::all();
    foreach($promotions as $promotion)
   //begin foreach
    {
        //update in  student table
    Student::where('id', $promotion->student_id)
   ->update([
       'Grade_id'=>$promotion->from_gradeid,
       'Classroom_id'=>$promotion->from_Classroomid,
       'section_id'=>$promotion->from_sectionid,
       'academic_year'=>$promotion->academic_year,
      ]);
    }
   //End foreach
    //حذف جدول الترقيات
    Promotion::truncate();
    DB::commit();
    toastr()->success(trans('messages.success'));
     return redirect()->back();
    }
 //End If

   else
   {
      // return $request->promotionid;
      $promotion1=Promotion::findorfail($request->promotionid);
      // return $promotion;
              //update in  student table
    Student::where('id', $promotion1->student_id)
    ->update([
        'Grade_id'=>$promotion1->from_gradeid,
        'Classroom_id'=>$promotion1->from_Classroomid,
        'section_id'=>$promotion1->from_sectionid,
        'academic_year'=>$promotion1->academic_year,
       ]);
      //تراجع عن تريقة طالب واحد
      Promotion::destroy($request->promotionid);
      DB::commit();
      toastr()->success(trans('messages.success'));
       return redirect()->back();
    }
  //end else
   }
//End Try
  catch (\Exception $e) 
   {
   DB::rollback();
   return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }


  }
  public function edit($id){

  }

  public function show(){

  }

  
}