<?php
namespace App\Repository\Fees;
use App\Interfaces\Fees\ProcessingFeeRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   


use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\ProcessingFee;
use App\Models\StudentAccount;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
   
   
   public function index()
   {
    $ProcessingFee=ProcessingFee::all();
    return view('dashboard.pages.Fees.ProcessingFee.index',compact('ProcessingFee'));
   }
   public function show($id)
   {
      $Student=Student::findorfail($id);
      return view('dashboard.pages.Fees.ProcessingFee.add',compact('Student'));
   }
   public function edit($id)
   {
    $ProcessingFee=ProcessingFee::findorfail($id);
    // return $ProcessingFee;
    return view('dashboard.pages.Fees.ProcessingFee.edit',compact('ProcessingFee'));

   }

   public function store($request)
   {
    DB::beginTransaction();
    try 
    {
    //  return $request;
    $ProcessingFee=new ProcessingFee();
    $ProcessingFee->date=date('Y-m-d');
    $ProcessingFee->student_id=$request->student_id;
    $ProcessingFee->amount=$request->Debit;
    $ProcessingFee->description=$request->description;
    $ProcessingFee->save();


    $StudentAccount=new StudentAccount();
    $StudentAccount->student_id=$request->student_id;
    $StudentAccount->move_date=date('Y-m-d');
    $StudentAccount->type="ProcessingFee";
    $StudentAccount->processing_id=$ProcessingFee->id;
    $StudentAccount->Debit=0.00;
    $StudentAccount->credit=$request->Debit;
    $StudentAccount->description=$request->description;
    $StudentAccount->save();
    DB::commit(); // insert data
    toastr()->success(trans('messages.success'));
    return redirect()->route('ProcessingFee.index');
     }
    
     catch (\Exception $e)
     {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
     
   }

   public function update($request)
   {
//تعديل بجدول معالجة الرسوم الدراسية
    DB::beginTransaction();
    try 
    {
    //  return $request;
    $ProcessingFee=ProcessingFee::findorfail($request->ProcessingFeeid);
    $ProcessingFee->date=date('Y-m-d');
    $ProcessingFee->student_id=$request->student_id;
    $ProcessingFee->amount=$request->Debit;
    $ProcessingFee->description=$request->description;
    $ProcessingFee->save();


    $StudentAccount=StudentAccount::where('processing_id',$request->ProcessingFeeid)->first();
    $StudentAccount->student_id=$request->student_id;
    $StudentAccount->move_date=date('Y-m-d');
    $StudentAccount->type="ProcessingFee";
    $StudentAccount->processing_id=$ProcessingFee->id;
    $StudentAccount->Debit=0.00;
    $StudentAccount->credit=$request->Debit;
    $StudentAccount->description=$request->description;
    $StudentAccount->save();
    DB::commit(); // insert data
    toastr()->success(trans('messages.success'));
    return redirect()->route('ProcessingFee.index');
     }
    
     catch (\Exception $e)
     {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
  
   }

   public function destroy($request)
   {
    try {
        ProcessingFee::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
  
    catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
   }
  

  
}