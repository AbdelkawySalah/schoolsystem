<?php
namespace App\Repository\Fees;
use App\Interfaces\Fees\FeesRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\Grade;
 use App\Models\Fee;
 use App\Models\FeesType;

use Illuminate\Support\Facades\DB;

class FeesRepository implements FeesRepositoryInterface
{
   
   
   public function index()
   {
    $Fee=Fee::all();
     return view('dashboard.pages.Fees.index',compact('Fee'));
   }
   
   public function create()
   {
     $Grades=Grade::all();
     $FeesType=FeesType::all();
     return view('dashboard.pages.Fees.add',compact('Grades','FeesType'));

   }
   public function edit($id)
   {
    //  return $id;
    $fees=Fee::findorfail($id);
    $FeesType=FeesType::all();
    $Grades=Grade::all();
    return view('dashboard.pages.Fees.edit',compact('fees','Grades','FeesType'));
   }

   public function store($request){
    //  return $request;
    $fees=new Fee();
    $fees->Fees_Type=$request->Fees_Type;
    // $fees->title=["en"=>$request->title_en,"ar"=>$request->title_ar];
    $fees->amount=$request->amount;
    $fees->Grade_id=$request->Grade_id;
    $fees->Classroom_id=$request->Classroom_id;
    $fees->decsription=$request->description;
    $fees->year=$request->year;
    $fees->save();
    toastr()->success(trans('messages.success'));
    return redirect()->route('Fees.index');

   }

   public function update($request)
   {
    //  return $request;
    $fees=Fee::findorfail($request->id);
    $fees->Fees_Type=$request->Fees_Type;
    // $fees->title=["en"=>$request->title_en,"ar"=>$request->title_ar];
    $fees->amount=$request->amount;
    $fees->Grade_id=$request->Grade_id;
    $fees->Classroom_id=$request->Classroom_id;
    $fees->decsription=$request->description;
    $fees->year=$request->year;
    
    $fees->save();
    toastr()->success(trans('messages.success'));
    return redirect()->route('Fees.index');
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



  public function FeesAmount($id)
    {
      $Amount = Fee::where('id',$id)->pluck("amount","id");
      return $Amount;
    }

  
}