@extends('admin.layouts.master')

@section('style')
@endsection

@section('content-header')

<h1>
    分类管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.classify.index') }}">分类管理</a></li>
    <li class="active">编辑分类</li>
</ol>

@endsection

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">编辑分类 - {{ $classify->title }}</h3>
	</div>
	@include('admin.classifies.form', ['model' => $classify])
</div>

@endsection

@section('script')
@endsection