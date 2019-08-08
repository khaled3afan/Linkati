@extends('layouts.app')
@section('subtitle', $title ?? 'null')
@section('description', str_limit(strip_tags($content), 300))
@section('content')
	<section class="section">
		<div class="container">
			<div class="row">
				@include('pages.sidebar')
				<div class="col-sm-9">
					<div class="page-content">{!! $content !!}</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.section -->
@stop
