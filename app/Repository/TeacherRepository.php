<?php
namespace App\Repository;
use  App\Models\Teacher;

use  App\Models\Specializations;
use  App\Models\Gender;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{
    public function getAllTeachers(){
        return Teacher::all();
    }

    public function GetSpecializations(){
        return Specializations::all();
    }

    public function GetGender(){
        return Gender::all();
    }

    public function AddTeacher($request){
        $val=$request->validate([
            'Email' => 'required|unique:teachers,Email',
            'Password'=>'required',
            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Specialization_id'=>'required',
            'Gender_id'=>'required',
            'Joining_Date'=>'required',
            'Address'=>'required',
        ]);

        try{
        $Teachers = new Teacher();
           $Teachers->Email = $request->Email;
           $Teachers->Password =  Hash::make($request->Password);
           $Teachers->Name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
           $Teachers->Specialization_id=$request->Specialization_id;
           $Teachers->Gender_id=$request->Gender_id;
           $Teachers->Joining_Date=$request->Joining_Date;
           $Teachers->Address=$request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teacheers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function EditTeacher($id){
      return Teacher::findOrFail($id);
    }

    public function UpdateTeacher($request){
       
        try{
            $Teachers=Teacher::findOrFail($request->idTeacher);
               $Teachers->Email = $request->Email;
               $Teachers->Password =  Hash::make($request->Password);
               $Teachers->Name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
               $Teachers->Specialization_id=$request->Specialization_id;
               $Teachers->Gender_id=$request->Gender_id;
               $Teachers->Joining_Date=$request->Joining_Date;
               $Teachers->Address=$request->Address;
                $Teachers->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Teacheers.index');
            }
            catch (Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }

    }

    public function DeleteTeacher($request){
        Teacher::findOrFail($request->idTeachDel)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Teacheers.index');
    }
   
}