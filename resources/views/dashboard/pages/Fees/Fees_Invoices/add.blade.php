@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Fees_Invoices _trans.Add_Invoices')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Fees_Invoices _trans.Add_Invoices')}}
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

                        <form class=" row mb-30" action="{{ route('Fees_Invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Fees">
                                        <div data-repeater-item>
                                            <div class="row">
                                              <div class="col">
                                                    <label for="description" class="mr-sm-2">{{trans('Fees_Invoices _trans.Student_Name')}}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" value="{{$student->name }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{trans('Fees_Invoices _trans.Fees_Type')}}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="fee_id" required>
                                                            <option value="">-- اختار من القائمة --</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->id }}">
                                                                  {{ $fee->FeesType->Name }} ({{ $fee->amount }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="col">
                                                    <label for="description" class="mr-sm-2">{{trans('Fees_Invoices _trans.Notes')}}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" name="description">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{trans('Fees_Invoices _trans.Process')}}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{trans('Fees_Invoices _trans.Delete_Row')}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                        </div>
                                    </div><br>
                                    <input type="hidden" name="Grade_id" value="{{$student->Grade_id}}">
                                    <input type="hidden" name="Classroom_id" value="{{$student->Classroom_id}}">
                                    <input type="hidden" name="studentid" class="form-control" value="{{$student->id }}" readonly>

                                    <button type="submit" style="width:100%" class="btn btn-primary">تاكيد البيانات</button>
                                </div>
                            </div>
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