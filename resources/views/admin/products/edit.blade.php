@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/iCheck/square/_all.css') }}">

@endsection

@section('content-header')

<h1>
    商品管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.product.index') }}">商品管理</a></li>
    <li class="active">编辑商品</li>
</ol>

@endsection

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">编辑商品 - {{ $product->title }}</h3>
	</div>
	@include('admin.products.form', ['model' => $product])
</div>

@endsection

@section('script')

<!-- iCheck 1.0.1 -->
<script src="{{ asset('backstage/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript">
	$(function () {
		$('input[type="radio"]').iCheck({
			radioClass: 'iradio_square-green',
			increaseArea: '20%'
		});

		$('label.control-label').parent('div.form-group').addClass('has-error');
	});
</script>

@endsection