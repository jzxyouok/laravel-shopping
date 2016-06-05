@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/datatables/dataTables.bootstrap.css') }}">

@endsection

@section('content-header')

<h1>
    商品管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.product.index') }}">商品管理</a></li>
    <li class="active">所有商品</li>
</ol>

@endsection

@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">所有商品</h3>
	</div>
	<div class="box-body">
		<table id="mytable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>商品名称</th>
					<th>商品价格</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<td>{{ $product->id }}</td>
						<td>{{ $product->title }}</td>
						<td>{{ $product->price }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>商品名称</th>
					<th>商品价格</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

@endsection

@section('script')

<script src="{{ asset('backstage/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backstage/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('backstage/plugins/slimScroll/jquery.slimScroll.min.js') }}"></script>
<script src="{{ asset('backstage/plugins/fastclick/fastclick.min.js') }}"></script>

<script type="text/javascript">
	$(function () {
		$('#mytable').DataTable({
			'paging': true,
			'lengthChange': true,
			'searching': true,
			'ordering': true,
			'info': true,
			'autowidth': false,
			'processing': true
		});
	});
</script>

@endsection