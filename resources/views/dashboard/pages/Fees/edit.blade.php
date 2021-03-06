@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Fees_trans.Edit_Fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Fees_trans.Edit_Fees')}}
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

                    <form method="post" action="{{ route('Fees.update','test') }}" autocomplete="off">
                    {{method_field('patch')}}
                             @csrf
                        <div class="form-row">
                           

                        <div class="form-group col">
                            <label for="inputEmail4">{{trans('Fees_trans.Fees_Type')}}</label>
                                <select class="custom-select mr-sm-2" name="Fees_Type">
                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                  @foreach($FeesType as $FeesType)
                                    <option value={{$FeesType->id}} {{$FeesType->id==$fees->Fees_Type?'selected':""}}>{{$FeesType->Name}}</option>
                                  @endforeach
                                </select>
                                <input type="hidden" value="{{ $fees->id }}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Fees_trans.amount')}}</label>
                                <input type="number" value="{{ $fees->amount }}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans('Fees_trans.GradeName')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                    <option value="{{$Grade->id}}" {{$Grade->id == $fees->Grade_id?'selected':""}}>{{ $Grade->Name }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('Fees_trans.ClassRoom')}}</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" required>
                                   <option value="{{$fees->Classroom_id}}">{{$fees->classroom->Name_Class}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('Fees_trans.Year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fees->year?'selected':''}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('Fees_trans.Notes')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fees->decsription}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('Fees_trans.submit')}}</button>

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