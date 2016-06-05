@if(isset($model))
	{{ Form::model($model, ['route' => ['admin.article.update', $model->id], 'method' => 'PUT']) }}
@else
	{{ Form::open(['route' => 'admin.article.store', 'file' => true]) }}
	{{ Form::hidden('target_id', $target_parents[0]['id']) }}
	{{ Form::hidden('type', $type) }}
@endif

<div class='box-body'>
	<div class='form-group'>
		{{ Form::label('title', '文章标题:') }}
		{{ Form::text('title', null, ['class' => 'form-control']) }}
		{!! $errors->first('title', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class='form-group'>
		{{ Form::label('description', '文章摘要:') }}
		{{ Form::text('description', null, ['class' => 'form-control']) }}
		{!! $errors->first('description', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class='form-group'>
		{{ Form::label('author', '文章作者:') }}
		{{ Form::text('author', null, ['class' => 'form-control']) }}
		{!! $errors->first('author', '<label class="control-label has-error"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
	<div class='form-group'>
		{{ Form::label('publish_at', '发布时间:') }}
		<div class='input-group'>
			<div class='input-group-addon'><i class='fa fa-calendar'></i></div>
			{{ Form::text('publish_at', null, ['class' => 'form-control pull-right']) }}
		</div>
		{!! $errors->first('publish_at', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	</div>
    <div class='form-group'>
    	{{ Form::label('content', '文章内容:') }}
    	{{ Form::textarea('content', null, ['class' => 'form-control']) }}
    	{!! $errors->first('content', '<label class="control-label"><i class="fa fa-times-circle-o"></i>:message</label>') !!}
    </div>
</div>
<div class='box-footer'>
	<div class='form-group'>
    	{{ Form::submit(isset($model) ? '编辑' : '新增', ['class' => 'btn btn-primary']) }}
    </div>
</div>

{{ Form::close() }}