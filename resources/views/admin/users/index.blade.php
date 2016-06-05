@extends('admin.layouts.master')

@section('style')

<link rel="stylesheet" href="{{ asset('backstage/plugins/select2/select2.min.css') }}">

@endsection

@section('content-header')

<h1>
    用户管理
</h1>
<ol class='breadcrumb'>
    <li><a href="{{ route('admin.home') }}"><i class='fa fa-dashboard'></i> 概览</a></li>
    <li><a href="{{ route('admin.user.index') }}">用户管理</a></li>
    <li class="active">所有用户</li>
</ol>

@endsection

@section('content')
    
<div class="box">
    <div class="box-header">
        <h3 class="box-title">所有用户 ({{ $users->total() }})</h3>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>用户</th>
                <th>邮箱</th>
                <th>类型</th>
                <th>操作</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ \App\Models\User::$user_column[$user->type] }}
                        </td>
                        @if(\Auth::user()->type == $user_super_admin && $user->type != $user_super_admin)
                            <td>
                                @if($user->type == $user_admin)
                                    @include('admin.users.role', ['data' => $user, 'name' => 'userRole'])
                                @endif
                                <a href="{{ route('admin.user.edit', $user->id) }}">编辑</a>
                            </td>
                        @elseif(\Auth::user()->type == $user_admin && $user->type != $user_admin)
                            <td>
                                @if($user->type == \App\Models\BaseModel::TYPE_USER_FAKER)
                                    <a href="{{ route('admin.user.edit', $user->id) }}">编辑</a>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{ $users->render() }}
    </div>
</div>

@endsection

@section('script')

<!-- Select2 -->
<script src="{{ asset('backstage/plugins/select2/select2.full.min.js') }}"></script>

<script type='text/javascript'>
    $(function () {
        $('.select2').select2();
    });
</script>

@endsection