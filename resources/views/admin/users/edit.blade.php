@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/iCheck/polaris/polaris.css') }}">
<link rel="stylesheet" href="{{ asset('backstage/plugins/webuploader/css/webuploader.css') }}">
<link rel="stylesheet" href="{{ asset('backstage/plugins/webuploader/image-upload/style.css') }}">

@endsection

@section('content-header')

<h1>
    用户管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.user.index') }}">用户管理</a></li>
    <li class="active">编辑用户</li>
</ol>

@endsection

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">编辑用户 - {{ $user->username }}</h3>
	</div>
	@include('admin.users.form', ['model' => $user])
</div>

@endsection

@section('script')

<!-- iCheck 1.0.1 -->
<script src="{{ asset('backstage/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('backstage/plugins/webuploader/dist/webuploader.js') }}"></script>
<script src="{{ asset('backstage/plugins/webuploader/image-upload/upload.js') }}"></script>

<script type="text/javascript">
	$(function () {
		$('input[type="radio"]').iCheck({
			radioClass: 'iradio_polaris',
			increaseArea: '-10'
		});

		$('label.control-label').parent('div.form-group').addClass('has-error');
	});
</script>

@endsection