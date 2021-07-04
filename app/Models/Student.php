<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    // علاقة بين الطلاب الاقسام الدراسية لجلب اسم القسم  في جدول الطلاب

    public function section()
    {
        return $this->belongsTo(Sections::class);
        // return $this->belongsTo(Sections::class, 'section_id');

    }


//العلاقة بين الطلاب والجنسيات
     public function Nationality()
     {
         return $this->belongsTo(Nationalitie::class,'gender_id');
 
     }

     //العلاقة بين الطلاب وولي الامر
     public function myparent()
     {
         return $this->belongsTo(parents::class,'parent_id');
 
     }

// علاقه بين جدول الصور والطلاب لجلب الصور الخاصه بطالب
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        // return $this->hasMany('App\Models\StudentAccount','student_id');
        return $this->hasMany('App\Models\StudentAccount');


    }

}
