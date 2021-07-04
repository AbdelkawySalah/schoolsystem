<?php 

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sections;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Teacher;

use CodeZero\UniqueTranslation\UniqueTranslationRule;

class SectionsController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::with(['Sections'])->get();
    $Teachers=Teacher::all();

    //  return $Teachers;

    $list_Grades=Grade::all();
    return view('dashboard.pages.Sections.Sections',compact('list_Grades','Grades','Teachers'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      //end check data before save
      // return $request->teacher_id;
      $val=$request->validate([
        'Name_Section_Ar'=>'required',
        'Name_Section_En'=>'required',
        'Grade_id'=>'required',
        'Name_Section_Ar.required'=>trans('validation.required'),
        'Name_Section_En.required'=>trans('validation.required'),
        'Grade_id.required'=>trans('validation.required')

    ]);
         
       try{ 
 
           $Sections=new Sections();
           $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
           $Sections->Status=1;
           $Sections->Grade_Id=$request->Grade_id;
           $Sections->Class_Id=$request->Class_id;
           $Sections->save();

          //كود الحفظ بجدول teacher_section
  //attch>>داله دي مسئولة انها بتاخد بضفلي في قاعدة البيانات التالي 
	   //section id اللي اتحفظ
	   //teacher_id اللي اخترتهم        
      $Sections->teachers()->attach($request->teacher_id);
           toastr()->success(trans('messages_trans.success'));
            return redirect()->route('Sections.index');
         
         }
         
      
       catch (\Exception $e){
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
            
       
         
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    // return $request;
    try {
     
      $Sections = Sections::findOrFail($request->idupdate);
     // return $Sections;
      $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_Id = $request->Grade_id;
      $Sections->Class_Id  = $request->Class_id;

      if(isset($request->Status)) {
        $Sections->Status = 1;
      } else {
        $Sections->Status = 2;
      }

      $Sections->save();

        // update pivot tABLE
        $Sections->teachers()->sync($request->teachers);
      toastr()->success(trans('messages.Update'));

      return redirect()->route('Sections.index');
  }
  catch
  (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    // return $request;
    try{
     Sections::findorFail($request->iddelete)->delete();
     toastr()->error(trans('messages_trans.Delete'));
     return redirect()->route('Sections.index');
 }
catch (\Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

  }

  public function getclasses($id){
   
    $List_Classes=Classroom::where('Grade_Id',$id)->pluck("Name_Class","id");
    
    //  print_r($List_Classes);die;
    return $List_Classes;
  }
  
}

?>