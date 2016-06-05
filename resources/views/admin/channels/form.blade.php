@if(isset($model))
	{{ Form::model($model, ['route' => ['admin.channel.update', $model->id], 'method' => 'PUT']) }}
@else
	{{ Form::open(['route' => ['admin.channel.store']]) }}
	{{ Form::hidden('parent_id', $parent_id) }}
	{{ Form::hidden('level', $level) }}
@endif

<div class="box-body">    
	<div class='form-group'>
		{{ Form::label('title', '栏目名称:') }}
		{{ Form::text('title', null, ['class' => 'form-control']) }}
		{!! $errors->first('title', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class='form-group'>
		{{ Form::label('description', '栏目描述:') }}
		{{ Form::text('description', null, ['class' => 'form-control']) }}
		{!! $errors->first('description', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class='form-group'>
		{{ Form::label('type', '栏目类型:') }}
		<br/>
		@if(!is_null($parent_channel))
		@if($parent_channel->type == 1)
			{{ Form::radio('type', 1, null,['class' => 'flat-red']) }}
			<label>组织</label>
		@endif
		@else(is_null($parent_channel))
			{{ Form::radio('type', 1, null, ['class' => 'flat-red']) }}
			<label>组织</label>
		@endif
		{{ Form::radio('type', 2, null, ['class' => 'flat-red']) }}
		<label>列表</label>
		{{ Form::radio('type', 3, null, ['class' => 'flat-red']) }}
		<label>文章</label>
		{!! $errors->first('type', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	@if(\Auth::user()->type == $user_super_admin)
		<div class='form-group'>
			{{ Form::label('is_sys', '是否为系统:') }}
			<br/>
			{{ Form::radio('is_sys', 1, null, ['class' => 'flat-red']) }}
			<label>是</label>
			{{ Form::radio('is_sys', 2, null, ['class' => 'flat-red']) }}
			<label>否</label>
		</div>
		<div class='form-group'>
			{{ Form::label('route', '栏目路由:') }}
			{{ Form::text('route', null, ['class' => 'form-control']) }}
			{!! $errors->first('route', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
		</div>
	@endif
</div>
<div class="box-footer">
	<div class='form-group'>
		{{ Form::submit(isset($model) ? '编辑' : '新增', ['class' => 'btn btn-primary']) }}
	</div>
</div>

{{ Form::close() }}