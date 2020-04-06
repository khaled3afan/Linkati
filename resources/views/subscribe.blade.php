@extends('layouts.app')
@section('subtitle', '')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="#!" id="buy">Buy now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <script src="https://cdn.paddle.com/paddle/paddle.js"></script>
@endpush
