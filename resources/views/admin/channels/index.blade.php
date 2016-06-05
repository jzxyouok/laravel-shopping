@extends('admin.layouts.master')

@section('stype')
@endsection

@section('content-header')

<h1>
    栏目管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.channel.index') }}">栏目管理</a></li>
    <li class="active">所有栏目</li>
</ol>

@endsection

@section('content')

<ul>
	
	@foreach($left_parent_channels as $left_parent_channel)
		<li>
			<i class="fa fa-object-group"></i> {{ $left_parent_channel->title }}
			<a href="{{ route('admin.channel.create', ['parent_id' => $left_parent_channel->id, 'level' => $left_parent_channel->level + 1]) }}">添加</a>
			<a href="{{ route('admin.channel.edit', $left_parent_channel->id) }}">编辑</a>
			@if(count($left_parent_channel->subs) > 0)
				<ul>

					@foreach($left_parent_channel->subs as $sub)
					@if($sub->level == 1)
					    <li>
						    @if($sub->type == 1)
							    <i class="fa fa-object-group"></i> {{ $sub->title }}
							    <a href="{{ route('admin.channel.create', ['parent_id' => $sub->id, 'level' => $sub->level + 1]) }}">添加</a>
							    <a href="{{ route('admin.channel.edit', $sub->id) }}">编辑</a>
						    @elseif($sub->type == 2)
						        <i class="fa fa-list-ul"></i> {{ $sub->title }}
							    <a href="{{ route('admin.channel.create', ['parent_id' => $sub->id, 'level' => $sub->level + 1]) }}">添加</a>
							    <a href="{{ route('admin.channel.edit', $sub->id) }}">编辑</a>
						    @elseif($sub->type == 3)
							    <i class="fa fa-sticky-note"></i> {{ $sub->title }}
							    <a href="{{ route('admin.channel.edit', $sub->id) }}">编辑</a>
						    @endif
					    </li>

					    @if($sub->child > 0)
						    <ul>
							    @foreach($left_parent_channel->subs as $sub_second)
							    @if($sub_second->level == 2)
								    <li>
								    	@if($sub_second->type == 1)
										    <i class="fa fa-object-group"></i> {{ $sub_second->title }}
										    <a href="{{ route('admin.channel.create', ['parent_id' => $sub_second->id, 'level' => $sub_second->level + 1]) }}">添加</a>
										    <a href="{{ route('admin.channel.edit', $sub_second->id) }}">编辑</a>
									    @elseif($sub_second->type == 2)
									        <i class="fa fa-list-ul"></i> {{ $sub_second->title }}
										    <a href="{{ route('admin.channel.create', ['parent_id' => $sub_second->id, 'level' => $sub_second->level + 1]) }}">添加</a>
										    <a href="{{ route('admin.channel.edit', $sub_second->id) }}">编辑</a>
									    @elseif($sub_second->type == 3)
										    <i class="fa fa-sticky-note"></i> {{ $sub_second->title }}
										    <a href="{{ route('admin.channel.edit', $sub_second->id) }}">编辑</a>
									    @endif
								    </li>
							    @endif
							    @endforeach
						    </ul>
					    @endif

				    @endif
					@endforeach

				</ul>
			@endif 
		</li>
	@endforeach

</ul>

@endsection

@section('script')
@endsection