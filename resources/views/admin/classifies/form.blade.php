@if(isset($model))
	{{ Form::model($model, ['route' => ['admin.classify.update', $model->id], 'method' => 'PUT']) }}
@else
	{{ Form::open(['route' => 'admin.classify.store']) }}
	{{ Form::hidden('parent_id', $parent_id) }}
	{{ Form::hidden('level', $level) }}
@endif

<div class="box-body">
	<div class="form-group">
		{{ Form::label('title', '分类名称:') }}
		{{ Form::text('title', null, ['class' => 'form-control']) }}
		{!! $errors->first('title', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class="form-group">
		{{ Form::label('description', '分类描述:') }}
		{{ Form::text('description', null, ['class' => 'form-control']) }}
		{!! $errors->first('description', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
</div>
<div class="box-footer">
	<div class="form-group">
		{{ Form::submit(isset($model) ? '编辑' : '新增', ['class' => 'btn btn-primary']) }}
	</div>
</div>
