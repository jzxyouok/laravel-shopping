@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/iCheck/line/_all.css') }}">

@endsection

@section('content-header')

<h1>
    栏目管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.channel.index') }}">栏目管理</a></li>
    <li class="active">添加栏目</li>
</ol>

@endsection

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">新增栏目</h3>
	</div>
	@include('admin.channels.form')
</div>

@endsection

@section('script')

<!-- iCheck 1.0.1 -->
<script src="{{ asset('backstage/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript">
	$(function () {
		// $('input[type="radio"].flat-red').iCheck({
		// 	radioClass: 'iradio_flat-green',
		// 	increaseArea: '20%'
		// });
		
		$('input[type="radio"].flat-red').each(function () {
			var self       = $(this),
			    label      = self.next(),
			    label_text = label.text();

		    label.remove();
		    self.iCheck({
		    	radioClass: 'iradio_line-purple',
		    	insert:     '<div class="icheck_line-icon"></div>'+label_text
		    });
		});

		$('label.control-label').parent('div.form-group').addClass('has-error');
	});
</script>

@endsection