<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;
class Teacher extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected  $guarded=[];
    protected $table='teachers';

    //علاقيه بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations(){
        return $this->belongsTo('App\Models\Specializations','Specialization_id');
    }

      //علاقيه بين المعلمين والنوع   
      public function genders(){
        return $this->belongsTo('App\Models\Gender','Gender_id');
    }

     //علاقيه بين المعلمين والصفوف    
    //  public function Sections(){
    //     return $this->belongsToMany('App\Models\Sections','teacher_section');
    // }

    // علاقة المعلمين مع الاقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section','teacher_section','section_id','teacher_id');
    }
}
