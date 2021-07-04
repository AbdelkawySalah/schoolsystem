<?php
namespace App\Repository\Fees;
use App\Interfaces\Fees\FeeinvoicesRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\Grade;
 use App\Models\Fee;
 use App\Models\FeesType;
 use App\Models\Student;
 use App\Models\Fee_invoice;
 use App\Models\StudentAccount;

 
use Illuminate\Support\Facades\DB;

class FeeinvoicesRepository implements FeeinvoicesRepositoryInterface
{
   
   
   public function index()
   {
    // $student=Student::all();
    $Fee_invoices=Fee_invoice::all();
    return view('dashboard.pages.Fees.Fees_Invoices.index',compact('Fee_invoices'));
   }
   
   public function show($id)
   {
    //جبت الطالب
    $student=Student::findorfail($id);
    //  return $student;

    //جبت الرسوم اللي علي الصف التابع ليه طالب
     $fees=Fee::where('Classroom_id',$student->Classroom_id)->get();
     
     return view('dashboard.pages.Fees.Fees_Invoices.add',compact('student','fees'));

   }

   public function edit($id)
   {
    
   }

   public function store($request){
     $List_Fees=$request->List_Fees;
     DB::beginTransaction();
     try 
    {
        foreach($List_Fees as $List_Fee)
        {
          //حفظ في جدول فواتير الرسوم الدراسية
           $feeInvoices=new Fee_invoice();
           $feeInvoices->invoice_date=date('Y-m-d');
           $feeInvoices->student_id=$request->studentid;
           $feeInvoices->Grade_id=$request->Grade_id;
           $feeInvoices->Classroom_id=$request->Classroom_id;
           $feeInvoices->fee_id=$List_Fee['fee_id'];
           $feeInvoices->description=$List_Fee['description'];
           $feeInvoices->amount= DB::table('fees')->where('id', $List_Fee['fee_id'])->first()->amount;
           $feeInvoices->save();

           //حفظ بجدول حسابات الطالب
            $StudentAccount=new StudentAccount();
            $StudentAccount->student_id=$request->studentid;
            $StudentAccount->Grade_id=$request->Grade_id;
            $StudentAccount->Classroom_id=$request->Classroom_id;
            $StudentAccount->Debit=DB::table('fees')->where('id', $List_Fee['fee_id'])->first()->amount;            ;
            $StudentAccount->credit=0.00;
            $StudentAccount->description=$List_Fee['description'];;
            $StudentAccount->save();

          }
         DB::commit();
         toastr()->success(trans('messages.success'));
         return redirect()->route('Fees_Invoices.index');
    }

     catch (\Exception $e) 
   {
   DB::rollback();
   return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }  
   }

   public function update($request)
   {
   
    }
  public function destroy($request)
  {
    try {
      Fee::destroy($request->id);
      toastr()->error(trans('messages.Delete'));
      return redirect()->back();
  }

  catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }



  

  
}