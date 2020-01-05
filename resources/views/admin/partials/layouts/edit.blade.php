@extends('admin.app')
@section('title', the($texts['plural']) . ' - ' . trans('admin.edit'))
@section('content')
    <div class="col-md-12">
        @include('admin.partials.breadcrumb')
    </div>

    <div class="col-md-12">
        <div class="card-box">
            <header class="header-title m-t-0 m-b-30">@lang('admin.edit')
                : {{ $item->username ?? $item->title ?? $item->name ?? $item->subject }}</header>
            @include ('errors.list')

            {!! Form::model($item, ['method' => 'PATCH', 'route' => [$texts['route'].'.update', $item], 'files' => true]) !!}
            @if(file_exists(resource_path('views/'. str_replace('.', '/', $texts['route']) .'/editForm.blade.php')))
                @include ($texts['route'].'.editForm')
            @else
                @include ($texts['route'].'.form')
            @endif

            <div class="text-right">
                <hr>
                {!! Form::submit(trans('admin.edit') .' '. the($texts['singular']), ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.card-box -->
    </div>
@stop
