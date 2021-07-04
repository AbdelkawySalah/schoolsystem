<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function students(){
        return $this->belongsTo('App\Models\Student','student_id');
    }

    public function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','Classroom_id');
    }

    public function Fees(){
        return $this->belongsTo('App\Models\Fee','fee_id');
    }
}
