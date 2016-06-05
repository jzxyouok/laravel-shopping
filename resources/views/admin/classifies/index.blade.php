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
    <li class="active">所有分类</li>
</ol>

@endsection

@section('content')

<ul>
	
	@foreach($parent_classifies as $parent_classify)
		<li>
			{{ $parent_classify->title }}
			<a href="{{ route('admin.classify.create', ['parent_id' => $parent_classify->id, 'level' => ($parent_classify->level + 1)]) }}">添加</a>
			<a href="{{ route('admin.classify.edit', $parent_classify->id) }}">编辑</a>

			@if($classify->child > 0)
				<ul>
					@foreach($all_classifies as $all_classify)
					@if($all_classify->parent_id == $parent_classify->id)
						<li>
							{{ $all_classify->title }}
							<a href="{{ route('admin.classify.create', ['parent_id' => $all_classify->id, 'level' => ($all_classify->level + 1)]) }}">添加</a>
							<a href="{{ route('admin.classify.edit', $all_classify->id) }}">编辑</a>

						    @if($all_classify->child > 0)
							    <ul>
							    	@foreach($all_classifies as $second_all_classify)
							    	@if($second_all_classify->parent_id == $all_classify->id)
								    	<li>
								    		{{ $second_all_classify->title }}
								    		<a href="{{ route('admin.classify.create', ['parent_id' => $second_all_classify->id, 'level' => ($second_all_classify->level + 1)]) }}">添加</a>
								    		<a href="{{ route('admin.classify.edit', $second_all_classify->id) }}">编辑</a>
								    	</li>
							    	@endif
							    	@endforeach
							    </ul>
						    @endif
						</li>
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