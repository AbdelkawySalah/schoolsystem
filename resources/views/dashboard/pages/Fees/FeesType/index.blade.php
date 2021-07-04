@extends('dashboard.layouts.master')
@section('css')
@toastr_css
@section('title')
    {{trans('Fees_Types _trans.Title')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('Fees_Types _trans.Title')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('Fees_Types _trans.Title')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">   

<div class="col-xl-12 mb-30">
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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#AddFeesTypeModal">
                    {{trans('Fees_Types _trans.Add_FeesType')}}
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Fees_Types _trans.Name')}}</th>
                                <th>{{trans('Fees_Types _trans.Decription')}}</th>
                                <th>{{trans('Fees_Types _trans.Proccess')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($FeesType as $FeesType)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $FeesType->Name }}</td>
                                    <td>{{ $FeesType->description }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $FeesType->id }}"
                                                title="{{ trans('Fees_Types _trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $FeesType->id }}"
                                                title="{{ trans('Fees_Types _trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                              @include('dashboard.pages.Fees.FeesType.Delete')
                              @include('dashboard.pages.Fees.FeesType.edit')

                            @endforeach
                            @include('dashboard.pages.Fees.FeesType.add')

                            </tbody>
                        </table>
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
