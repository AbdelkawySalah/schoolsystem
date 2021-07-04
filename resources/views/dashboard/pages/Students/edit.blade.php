@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Student_trans.Edit_student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('Student_trans.Edit_student')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"  action="{{ route('Student.update','test') }}" autocomplete="off">
                {{method_field('patch')}}
                             @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Student_trans.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Student_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    
                                    <input  type="text" name="name_ar" value="{{$student->getTranslation('name', 'ar')}}"  class="form-control">
                                {{--hideen input--}}
                                    <input  type="text" name="studentid" value="{{$student->id}}"  class="form-control">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Student_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" value="{{$student->getTranslation('name', 'en')}}" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Student_trans.email')}} : </label>
                                    <input type="email"  name="email" class="form-control" value="{{$student->email}}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('Student_trans.password')}} :</label>
                                    <input  type="password" name="password" class="form-control"
                                            value="{{$student->password}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('Student_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                       <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($Genders as $Gender)
                                                <option value="{{$Gender->id}}" {{$Gender->id == $student->gender_id ? 'selected' : ""}}>{{ $Gender->Name }}</option>
                                            @endforeach
                                      </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('Student_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id">
                                        <option selected disabled>{{trans('Student_trans.Choose')}}...</option>
                                        @foreach($nationals as $nal)
                                            <option  value="{{ $nal->id }}" {{$nal->id == $student->nationalitie_id ? 'selected' : ""}}>{{ $nal->Name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('Student_trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{trans('Student_trans.Choose')}}...</option>
                                        @foreach($bloods as $bg)
                                            <option value="{{ $bg->id }}" {{$bg->id == $student->blood_id ? 'selected' : ""}}>{{ $bg->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('Student_trans.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text" value="{{$student->Date_Birth}}" id="datepicker-action" name="Date_Birth" 
                                           data-date-format="yyyy-mm-dd">>
                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Student_trans.Student_information')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{trans('Student_trans.Grade')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{trans('Student_trans.Choose')}}...</option>
                                        @foreach($Grades as $c)
                                            <option  value="{{ $c->id }}" {{$c->id == $student->Grade_id ? 'selected' : ""}}>{{ $c->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('Student_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$student->Classroom_id}}">{{$student->classroom->Name_Class}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('Student_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                    <option value="{{$student->section_id}}"> {{$student->section->Name_Section}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('Student_trans.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('Student_trans.Choose')}}...</option>
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}"  {{$parent->id == $student->parent_id ? 'selected' : ""}}>{{ $parent->Name_Father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('Student_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('Student_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $student->academic_year ? 'selected' : ""}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        </div><br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Student_trans.submit')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
  
@endsection