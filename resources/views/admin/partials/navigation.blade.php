<!-- 左侧导航栏 -->
<aside class="main-sidebar">
    <!-- 导航栏: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- 用户信息 -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(\Auth::user()->avatar_url) }}" class="img-circle" alt="用户信息">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- 搜索 -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.搜索 -->
        <!-- 导航菜单: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="header">导航栏</li>
            <li class="treeview">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard"></i> <span>概览</span></i>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('admin.channel.index') }}">
                    <i class="fa fa-th-list"></i>
                    <span>栏目管理</span>
                    <span class="label label-primary pull-right">2</span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="{{ route('admin.channel.index') }}"><i class="fa fa-circle-o"></i> 所有栏目</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.channel.create') }}"><i class="fa fa-circle-o"></i> 添加栏目</a>
                    </li>
                </ul>
            </li>

            @foreach($left_parent_channels as $left_parent_channel)
                <li class="treeview">
                    @if($left_parent_channel->is_sys == 1)
                    @if(empty($left_parent_channel->route))
                        <a href="{{ route('admin.home') }}">
                    @else
                        <a href='{{ route("admin.$left_parent_channel->route") }}'>
                    @endif
                    @elseif($left_parent_channel->is_sys == 2)
                    @if($left_parent_channel->type == 1)
                        <a href='#'>
                    @elseif($left_parent_channel->type == 2)
                        <a href='{{ route("admin.article.index", ["type" => $article_normal, "id" => $left_parent_channel->id]) }}'>
                    @elseif($left_parent_channel->type == 3)
                        <a href='{{ route("admin.article.create", ["type" => $article_normal, "id" => $left_parent_channel->id]) }}'>
                    @endif
                    @endif
                        <i class="fa {{ $left_parent_channel->style }}"></i>
                        <span>{{ $left_parent_channel->title }}</span>
                        <span class="label label-primary pull-right">{{ $left_parent_channel->child }}</span>
                    </a>
                    @if(count($left_parent_channel->subs) > 0)
                        <ul class="treeview-menu">

                            @foreach($left_parent_channel->subs as $sub)
                            @if($sub->level == 1)
                                <li>
                                    @if($sub->is_sys == 1)
                                    @if(empty($sub->route))
                                        <a href="{{ route('admin.home') }}">
                                    @else
                                        <a href='{{ route("admin.$sub->route") }}'>
                                    @endif
                                    @elseif($sub->is_sys == 2)
                                    @if($sub->type == 1)
                                        <a href='#'>
                                    @elseif($sub->type == 2)
                                        <a href='{{ route("admin.article.index", ["type" => $article_normal, "id" => $sub->id]) }}'>
                                    @elseif($sub->type == 3)
                                        <a href='{{ route("admin.article.create", ["type" => $article_normal, "id" => $sub->id]) }}'>
                                    @endif
                                    @endif
                                        <i class="fa fa-circle-o"></i> {{ $sub->title }}
                                        @if($sub->child > 0)
                                            <i class="fa fa-angle-left pull-right"></i>
                                        @endif
                                    </a>
                                    
                                    @if($sub->child > 0)
                                    @foreach($left_parent_channel->subs as $sub_second)
                                        <ul class="treeview-menu">
                                            @if($sub_second->level == 2)
                                                <li>
                                                    @if($sub_second->is_sys == 1)
                                                    @if(empty($sub_second))
                                                        <a href="{{ route('admin.home') }}">
                                                    @else
                                                        <a href='{{ route("admin.$sub_second->route") }}'>
                                                    @endif
                                                    @elseif($sub_second->is_sys == 2)
                                                    @if($sub_second->type == 1)
                                                        <a href='#'>
                                                    @elseif($sub_second->type == 2)
                                                        <a href='{{ route("admin.article.index", ["type" => $article_normal, "id" => $sub_second->id]) }}'>
                                                    @elseif($sub_second->type == 3)
                                                        <a href='{{ route("admin.article.create", ["type" => $article_normal, "id" => $sub_second->id]) }}'>
                                                    @endif
                                                    @endif
                                                        <i class="fa fa-circle-o"></i> {{ $sub_second->title }}
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endforeach
                                    @endif

                                </li>
                            @endif
                            @endforeach

                        </ul>
                    @endif
                </li>
            @endforeach

            <li class="header">标签</li>
            <!-- <li>
                <a href="#">
                    <i class="fa fa-circle-o text-red"></i> 
                    <span>Important</span>
                </a>
            </li> -->
        </ul>
        <!-- /.导航菜单 -->
    </section>
    <!-- /.导航栏 -->
</aside>