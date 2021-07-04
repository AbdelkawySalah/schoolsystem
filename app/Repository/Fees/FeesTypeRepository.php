<?php
namespace App\Repository\Fees;
use App\Interfaces\Fees\FeesTypeRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\FeesType;

use Illuminate\Support\Facades\DB;

class FeesTypeRepository implements FeesTypeRepositoryInterface
{
   
   
   public function index()
   {
      $FeesType=FeesType::all();
      return view('dashboard.pages.Fees.FeesType.index',compact('FeesType'));
   }
   
   public function store($request)
   {
   
    $fees=new FeesType();
    $fees->Name=["en"=>$request->Name_en,"ar"=>$request->Name_ar];
    $fees->description=$request->Decsription;
    $fees->save();
    toastr()->success(trans('messages.success'));
    return redirect()->route('FeesType.index');
    }

    public function update($request)
    {
      //  return $request;
      $fees=FeesType::findorfail($request->Feesid);
      $fees->Name=["en"=>$request->Name_en,"ar"=>$request->Name_ar];
      $fees->description=$request->Notes;
      $fees->save();
      toastr()->success(trans('messages.success'));
      return redirect()->route('FeesType.index');
     }

     public function destroy($request)
     {
      // return $request; 
      try {
        FeesType::destroy($request->id);
         toastr()->error(trans('messages.Delete'));
         return redirect()->back();
     }
   
     catch (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
   
     }
   

   public function create()
   {
    
   }
   public function edit($id)
   {
    
   }

  

  
  


  

  
}