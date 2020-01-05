@extends('admin.app')
@section('title', the($texts['plural']) . ' - '. trans('admin.trash'))
@section('content')
    <div class="col-md-12">
        @include('admin.partials.breadcrumb')
    </div>

    <div class="col-md-12">
        <div class="card-box">
            <header class="header-title m-t-0 m-b-30">@lang('admin.trash')</header>
            @include ('errors.list')
            @if ($items->count())
                {!! Form::open(['route' => $texts['route'].'.action']) !!}
                <div class="row">
                    <div class="box-tools form-group form-action m-b-30">
                        <div class="col-sm-4">
                            {!! Form::select('action', [null => trans('admin.execute'), 'restore' => trans('admin.restore'), 'delete' => trans('admin.delete-permanent')], null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit(trans('admin.apply'), ['class' => 'btn btn-default delete-btn']) !!}
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">
                            <input id="CbSelectAll" type="checkbox" data-toggle="tooltip" data-placement="top"
                                   title="@lang('admin.select-all')">
                        </th>
                        <th>#</th>
                        @yield('thead')
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @yield('tbody')
                    </tbody>
                </table>
                {!! Form::close() !!}
            @else
                <h4 class="text-center">@lang('admin.no-more') {{ $texts['plural'] }}</h4>
            @endif

            @if ($items->render())
                <div class="text-center">{!! $items->appends($_GET)->render() !!}</div>
            @endif
        </div><!-- /.card-box -->
    </div>
@stop
