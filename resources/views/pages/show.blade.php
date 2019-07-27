@extends('layouts.app')
@section('subtitle', $page->title)
@section('description', str_limit(strip_tags($page->content), 300))
@section('content')
	<section class="section">
		<div class="container">
			<div class="row">
				@include('pages.sidebar')
				<div class="col-sm-9">
					<h1 class="page-title">{{ $page->title }}</h1>
					<div class="page-content">{!! $page->content !!}</div>
					<span class="timestamp">@lang('strings.last-update') {{ $page->updated_at->format('M dS, Y') }}</span>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.section -->
@stop
