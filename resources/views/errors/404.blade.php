@extends('errors::minimal')

@section('title', __('الصفحة المطلوبة غير موجودة'))
@section('code', '404')
@section('message')
    {{__('الصفحة المطلوبة غير موجودة')}}
    <div>
        <a href="/">عودة الى الرئيسية</a>
    </div>
@stop
