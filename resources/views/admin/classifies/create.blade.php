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
    <li class="active">新增分类</li>
</ol>

@endsection

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">新增分类</h3>
	</div>
	@include('admin.classifies.form')
</div>

@endsection

@section('script')
@endsection