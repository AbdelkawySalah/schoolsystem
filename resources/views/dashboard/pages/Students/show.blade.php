@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Student_trans.Student_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.Student_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('Student_trans.Student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('Student_trans.Attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('Student_trans.name')}}</th>
                                            <td>{{ $student->name }}</td>
                                            <th scope="row">{{trans('Student_trans.email')}}</th>
                                            <td>{{$student->email}}</td>
                                            <th scope="row">{{trans('Student_trans.gender')}}</th>
                                            <td>{{$student->gender->Name}}</td>
                                            <th scope="row">{{trans('Student_trans.Nationality')}}</th>
                                            <td>{{$student->Nationality->Name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Student_trans.Grade')}}</th>
                                            <td>{{ $student->grade->Name }}</td>
                                            <th scope="row">{{trans('Student_trans.classrooms')}}</th>
                                            <td>{{$student->classroom->Name_Class}}</td>
                                            <th scope="row">{{trans('Student_trans.section')}}</th>
                                            <td>{{$student->section->Name_Section}}</td>
                                            <th scope="row">{{trans('Student_trans.Date_of_Birth')}}</th>
                                            <td>{{ $student->Date_Birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Student_trans.parent')}}</th>
                                            <td>{{ $student->myparent->Name_Father}}</td>
                                            <th scope="row">{{trans('Student_trans.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('Student_trans.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="text" name="student_name" value="{{$student->name}}">
                                                        <input type="text" name="student_id" value="{{$student->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                {{trans('Student_trans.Save_Attachments')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Student_trans.FileName')}}</th>
                                                <th scope="col">{{trans('Student_trans.created_at')}}</th>
                                                <th scope="col">{{trans('Student_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- $student->images دي خاصه بالعلاقه اللي معاه -->
                                            @foreach($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->filename}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('view_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp; {{trans('Student_trans.View')}}</a>
                                                         
                                                          <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('Download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp; {{trans('Student_trans.Download')}}</a>
                                         
                                                           
                                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#Delete_img{{ $attachment->id }}"
                                                                    title="{{ trans('Student_trans.Delete') }}">{{trans('Student_trans.Delete')}}
                                                            </button>

                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.Students.Delete_img')
                                            @endforeach
                                            </tbody>
                                        </table>

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