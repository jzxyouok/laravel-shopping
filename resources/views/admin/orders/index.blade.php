@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/datatables/dataTables.bootstrap.css') }}">

@endsection

@section('content-header')

<h1>
	订单管理
</h1>
<ol class="breadcrumb">
	<li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 概览</a></li>
	<li>订单管理</li>
</ol>

@endsection

@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">所有订单</h3>
	</div>
	<div class="box-body">
		<table id="mytable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>订单编号</th>
					<th>订单类型</th>
					<th>购买商品</th>
					<th>购买人</th>
					<th>金额(元)</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr>
						<td>{{ $order->id }}</td>
						<td>{{ $order->order_no }}</td>
						<td>{{ $order->type }}</td>
						<td>{{ $order->product_id }}</td>
						<td>{{ $order->user_id }}</td>
						<td>{{ $order->amount }}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>订单编号</th>
					<th>订单类型</th>
					<th>购买商品</th>
					<th>购买人</th>
					<th>金额(元)</th>
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