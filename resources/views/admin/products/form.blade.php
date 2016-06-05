@if(isset($model))
	{{ Form::model($model, ['route' => ['admin.product.update', $model->id], 'method' => 'PUT']) }}
@else
	{{ Form::open(['route' => 'admin.product.store']) }}
@endif

<div class="box-body">
	<div class="form-group">
		{{ Form::label('title', '商品名称:') }}
		{{ Form::text('title', null, ['class' => 'form-control']) }}
		{!! $errors->first('title', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class="form-group">
		{{ Form::label('description', '商品描述:') }}
		{{ Form::text('description', null, ['class' => 'form-control']) }}
		{!! $errors->first('description', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class="form-group">
		{{ Form::label('price', '商品价格:') }}
		{{ Form::text('price', null, ['class' => 'form-control']) }}
		{!! $errors->first('price', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class="form-group">
		{{ Form::label('discount', '商品折扣:') }}
		{{ Form::text('discount', null, ['class' => 'form-control']) }}
		{!! $errors->first('discount', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class="form-group">
		{{ Form::radio('is_new', 1) }}  新品&nbsp;&nbsp;&nbsp;
		{{ Form::radio('is_hot', 1) }}  热销&nbsp;&nbsp;&nbsp;
		{{ Form::radio('is_sale', 1) }}  上架
	</div>
</div>
<div class="box-footer">
	<div class="form-group">
		{{ Form::submit(isset($model) ? '编辑' : '新增', ['class' => 'btn btn-primary']) }}
	</div>
</div>