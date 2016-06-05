@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/datepicker/datepicker3.css') }}">

@endsection

@section('content-header')

<h1>
	新增文章
</h1>
<ol class='breadcrumb'>
	<li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
	@foreach(array_reverse($target_parents) as $target_parent)
		<li>{{ $target_parent->title }}</li>
	@endforeach
</ol>

@endsection

@section('content')

<div class='box box-primary'>
	<div class='box-header with-border'>
		<h3 class='box-title'>{{ $target_parents[0]['title'] }}</h3>
	</div>
	@include('admin.articles.form')
</div>

@endsection

@section('script')

<script src="{{ asset('backstage/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backstage/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backstage/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js') }}"></script>

<script type="text/javascript">
	$(function () {
		CKEDITOR.replace('content');
		$('#publish_at').datepicker({
			format: "yyyy-mm-dd",
			language: "zh-CN"
		});

		$('label.control-label').parent('div.form-group').addClass('has-error');
	});
</script>

@endsection