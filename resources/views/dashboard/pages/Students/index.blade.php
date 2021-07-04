@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Student_trans.students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('Student_trans.add_student')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('Student.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('Student_trans.add_student')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Student_trans.name')}}</th>
                                            <th>{{trans('Student_trans.email')}}</th>
                                            <th>{{trans('Student_trans.gender')}}</th>
                                            <th>{{trans('Student_trans.Grade')}}</th>
                                            <th>{{trans('Student_trans.classrooms')}}</th>
                                            <th>{{trans('Student_trans.section')}}</th>
                                            <th>{{trans('Student_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->Name}}</td>
                                            <td>{{$student->grade->Name}}</td>
                                            <td>{{$student->classroom->Name_Class}}</td>
                                            <td>{{$student->section->Name_Section}}</td>
                                                <td>
                                                   
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('Student.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                                                            <a class="dropdown-item" href="{{route('Student.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="#Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                            <a class="dropdown-item" data-target="#GraduatedStudent{{ $student->id }}" data-toggle="modal" href="#GraduatedStudent{{ $student->id }}"><i style="color: black" class="fa fa-user-graduate"></i>&nbsp; تخريج الطالب</a>
                                                            <!-- <div class="dropdown-divider"></div> -->
                                                            <a class="dropdown-item" href="{{route('Fees_Invoices.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                                            <a class="dropdown-item" href="{{route('receipt_students.show',$student->id)}}"><i style="color: #0000cc" class="fas fa-money-bill-alt"></i>&nbspاضافة سند قبض &nbsp;</a>
                                                            <a class="dropdown-item" href="{{route('ProcessingFee.show',$student->id)}}"><i style="color: red" class="fas fa-hand-holding-usd"></i>&nbspاستبعاد رسوم &nbsp;</a>
                                                        </div>
                                                    </div>




                                                </td>
                                            </tr>
                                         @include('dashboard.pages.Students.Delete')
                                         @include('dashboard.pages.Students.Graduated_Student')

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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