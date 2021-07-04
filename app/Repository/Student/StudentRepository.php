<?php
namespace App\Repository\Student;
use App\Interfaces\Student\StudentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Sections;
use App\Models\Religion;
use App\Models\Nationalitie;
use App\Models\Gender;
use App\Models\parents;
use App\Models\Type_Blood;
use App\Models\Image;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{
   
   
   public function index(){
     $students=Student::all();
    //  return $students;
    return view('dashboard.pages.Students.index',compact('students'));
   }
   
   public function Get_classrooms($id){

    $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
    return $list_classes;

}

//Get Sections
public function Get_Sections($id){

    $list_sections = Sections::where("Class_id", $id)->pluck("Name_Section", "id");
    return $list_sections;
}

   public function create()
   {
    
    // $Gender=Gender::all();
    // $Nationalitie=Nationalitie::all();
    // $Type_Blood=Type_Blood::all();
    // $Grade=Grade::all();
    // $Classroom=Classroom::all();
    // $Sections=Sections::all();
    // $parents=parents::all();
    // $Religion=Religion::all();
    // return view('dashboard.pages.Students.create',compact('Gender','Nationalitie'
    //             ,'Type_Blood','Grade','Classroom','Sections','parents','Religion'));

    $data['Grades'] = Grade::all();
    $data['parents'] = parents::all();
    $data['Genders'] = Gender::all();
    $data['nationals'] = Nationalitie::all();
    $data['bloods'] = Type_Blood::all();
    return view('dashboard.pages.Students.create',$data);
   }
   public function store($request){
    DB::beginTransaction();
    try {
   
      $students = new Student();
      $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
      $students->email = $request->email;
      $students->password = Hash::make($request->password);
      $students->gender_id = $request->gender_id;
      $students->nationalitie_id = $request->nationalitie_id;
      $students->blood_id = $request->blood_id;
      $students->Date_Birth = $request->Date_Birth;
      $students->Grade_id = $request->Grade_id;
      $students->Classroom_id = $request->Classroom_id;
      $students->section_id = $request->section_id;
      $students->parent_id = $request->parent_id;
      $students->academic_year = $request->academic_year;
      $students->save();

      // insert img
      if($request->hasfile('photos'))
      {
          foreach($request->file('photos') as $file)
          {
              $name = $file->getClientOriginalName();
              //هنا بقوله هتروح علي ديسك اللي انت عملته upload_attachments
              //اللي اصلن بيروح علي مجلد public
              //وهتنشئلي جواه مجلد اسمه attachments
              //وجواه تنشئلي مجلد اخر اسمهstudents
              // وجواه تنشئلي مجلد باسم الطالب اللي بضيفه وتحطيله جواه الصور
              $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

              // insert in image_table
              $images= new Image();
              $images->filename=$name;
              $images->imageable_id= $students->id;
              $images->imageable_type = 'App\Models\Student';
              $images->save();
          }
      }

      DB::commit(); // insert data
      toastr()->success(trans('messages.success'));
      return redirect()->route('Student.index');
  }

  catch (\Exception $e){
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

   }

   public function update($request){
    //    return $request;

      try {
        $students = Student::findorfail($request->studentid);
        $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $students->email = $request->email;
        $students->password = Hash::make($request->password);
        $students->gender_id = $request->gender_id;
        $students->nationalitie_id = $request->nationalitie_id;
        $students->blood_id = $request->blood_id;
        $students->Date_Birth = $request->Date_Birth;
        $students->Grade_id = $request->Grade_id;
        $students->Classroom_id = $request->Classroom_id;
        $students->section_id = $request->section_id;
        $students->parent_id = $request->parent_id;
        $students->academic_year = $request->academic_year;
        $students->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Student.create');
    }
  
    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
   }

   public function destroy($request)
   {
   
    if($request->pagedelete_id==1)
    //يبقي انت كده هتحذف طالب
    {
    // Student::destroy($request->deletedid)->forceDelete();
    Student::where('id',$request->deletedid)->first()->forceDelete();


    toastr()->error(trans('messages.Delete'));
     return redirect()->route('Student.index');
    }

    else{
        //يبقي انت هتعمل تخريج لطالب يعني هعمل سوفت دليت
        Student::where('id',$request->studentid)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Student.index');
    }
  
  }
   public function edit($id)
   {
   
    $data['Grades'] = Grade::all();
    $data['parents'] = parents::all();
    $data['Genders'] = Gender::all();
    $data['nationals'] = Nationalitie::all();
    $data['bloods'] = Type_Blood::all();
    $data['student'] = Student::findorfail($id);
    // $student=Student::findorfail($id);
    //  return $data['student'];
     return view('dashboard.pages.Students.edit',$data);

   }

   public function show_StudentData($id){
    //   return $id;
    // $data['Grades'] = Grade::all();
    // $data['parents'] = parents::all();
    // $data['Genders'] = Gender::all();
    // $data['nationals'] = Nationalitie::all();
    // $data['bloods'] = Type_Blood::all();
    $student= Student::findorfail($id);
    // return $student;
    return view('dashboard.pages.Students.show',compact('student'));
   }

   public function Upload_attachment($request)
   {
    // return $request;   
    foreach($request->file('photos') as $file)
       {
           $name = $file->getClientOriginalName();
           $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

           // insert in image_table
           $images= new image();
           $images->filename=$name;
           $images->imageable_id = $request->student_id;
           $images->imageable_type = 'App\Models\Student';
           $images->save();
       }
       toastr()->success(trans('messages.success'));
       return redirect()->route('Student.show',$request->student_id);
   }

   public function Download_attachment($studentsname, $filename)
   {
       return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
   }

   public function view_attachment($studentsname, $filename){
    return response()->file(public_path('attachments/students/'.$studentsname.'/'.$filename));

   }


   public function Delete_attachment($request)
   {
       // Delete img in server disk
       Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

       // Delete in data
       image::where('id',$request->id)->where('filename',$request->filename)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->route('Student.show',$request->student_id);
   }



//    public function softDelete($request){
//        return $request;
//    }

  
}