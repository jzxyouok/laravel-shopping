<a data-toggle='modal' href='#modal-change-{{ $data->id }}'>权限管理</a>
	<div id='modal-change-{{ $data->id }}' class='modal modal-primary text-left fade'>
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            {{ Form::model($data, ['route' => ["admin.$name.update", $data->id], 'method' => 'PUT']) }}
		            <div class='modal-header'>
		            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title">权限管理</h4>
		            </div>
		            <div class='modal-body'>
		            	<div class='form-group'>
		            		{{ Form::label('roles', '权限:', ['class' => 'control-label']) }}
		            		{{ Form::select('roles[]', $roles, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => '请选择', 'style' => 'width:100%;']) }}
		            	</div>
		            </div>
		            <div class='modal-footer'>
		            	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">关闭</button>
	                    <button type="submit" class="btn btn-outline">编辑</button>
		            </div>
	            {{ Form::close() }}
	        </div>
	    </div>
	</div>
