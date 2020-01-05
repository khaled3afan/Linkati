@extends('admin.app')
@section('title', the($texts['plural']) . ' - ' . trans('admin.add-new'))
@section('content')
    <div class="col-md-12">
        @include('admin.partials.breadcrumb')
    </div>

    <div class="col-md-12">
        <div class="card-box">
            <header class="header-title m-t-0 m-b-30">@lang('admin.add-new')</header>
            @include ('errors.list')

            {!! Form::open(['route' => $texts['route'].'.store', 'files' => true]) !!}
            @include ($texts['route'].'.form')

            <div class="text-right">
                <hr>
                {!! Form::submit(trans('admin.add').' '. $texts['singular'], ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.card-box -->
    </div>
@stop
