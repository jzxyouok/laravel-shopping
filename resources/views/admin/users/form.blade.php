@if(isset($model))
	{{ Form::model($model, ['route' => ['admin.user.update', $model->id], 'method' => 'PUT']) }}
@else
	{{ Form::open(['route' => 'admin.user.store']) }}
@endif

<div class="box-body">
    <div class='form-group'>
    	{{ Form::label('username', '用户名:') }}
    	{{ Form::text('username', null, ['class' => 'form-control']) }}
    	{!! $errors->first('username', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
    </div>
    @if(!isset($model))
	    <div class='form-group'>
	    	{{ Form::label('password', '密码:') }}
	    	{{ Form::password('password', ['class' => 'form-control']) }}
            {!! $errors->first('password', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	    </div>
	    <div class='form-group'>
	    	{{ Form::label('password_confirmation', '确认密码:') }}
	    	{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
            {!! $errors->first('password_confirmation', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	    </div>
    @endif
    <div class='form-group'>
    	{{ Form::label('email', '邮箱:') }}
    	{{ Form::email('email', null, ['class' => 'form-control']) }}
    	{!! $errors->first('email', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
    </div>
    @if(isset($model))
    @if($model->type == \Auth::user()->type)
    @endif
    @if(\Auth::user()->type == $user_super_admin)
	    <div class='form-group'>
	    	{{ Form::label('type', '用户类别:') }}
	    	{{ Form::select('type', [
			    \App\Models\BaseModel::TYPE_USER_ADMIN  => '管理员',
			    \App\Models\BaseModel::TYPE_USER_FAKER  => '马甲用户',
                \App\Models\BaseModel::TYPE_USER_NORMAL => '普通用户'
	    	], null, ['class' => 'form-control']) }}
	    	{!! $errors->first('type', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
	    </div>
    @endif
    @else
    @if(\Auth::user()->type == $user_super_admin)
        <div class='form-group'>
            {{ Form::label('type', '用户类别:') }}
            {{ Form::select('type', [
                \App\Models\BaseModel::TYPE_USER_ADMIN  => '管理员',
                \App\Models\BaseModel::TYPE_USER_FAKER  => '马甲用户'
            ], null, ['class' => 'form-control']) }}
            {!! $errors->first('type', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
        </div>
    @elseif(\Auth::user()->type == $user_admin)
        <div class='form-group'>
            {{ Form::label('type', '用户类别:') }}
            {{ Form::select('type', [
                \App\Models\BaseModel::TYPE_USER_FAKER  => '马甲用户'
            ], null, ['class' => 'form-control']) }}
            {!! $errors->first('type', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
        </div>
    @endif
    @endif
    <div class='form-group'>
    	{{ Form::label('sex', '性别:') }}
    	<br/>
    	{{ Form::radio('sex', 1, null) }} 男
    	{{ Form::radio('sex', 0, null) }} 女
    	{{ Form::radio('sex', 2, null) }} 保密
        {!! $errors->first('sex', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
    </div>
    <div class='form-group'>
        {{ Form::label('image', '个人头像:') }}
        @if(isset($model))
        @if(!empty($model->avatar_url))
            <br/>
            <img src="{{ asset($model->avatar_url) }}" class="kelvin-img-circle" alt="个人头像">
        @endif
        @endif
        <div id="upload_token" style="display: none;">{{ csrf_token() }}</div>
        <div id="upload_swf" style="display: none;">{{ asset('backstage/plugins/webuploader/dist/Uploader.swf') }}</div>
        <div id="upload_server" style="display: none;">{{ route('admin.image.upload') }}</div>
        <div id="wrapper">
            <div id="container">
                <!--头部，相册选择和格式选择-->
                <div id="uploader">
                    <div class="queueList">
                        <div id="dndArea" class="placeholder">
                            <div id="filePicker"></div>
                            <p>或将照片拖到这里，快为你的头像挑一张帅图吧！</p>
                        </div>
                    </div>
                    <div class="statusBar" style="display:none;">
                        <div class="progress">
                            <span class="text">0%</span>
                            <span class="percentage"></span>
                        </div><div class="info"></div>
                        <!-- <div class="btns"> -->
                            <!-- <div id="filePicker2"></div><div class="uploadBtn">开始上传</div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <div class='form-group'>
    	{{ Form::submit(isset($model) ? '编辑' : '新增', ['class' => 'btn btn-primary']) }}
    </div>
</div>

{{ Form::close() }}