<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>@yield('title', '后台管理')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- 公共样式 -->
        @include('admin.partials.style')
        <!-- 自定义样式 -->
        @yield('style')
	</head>
    <body class="hold-transition skin-blue sidebar-mini">
    	<div class="wrapper">
    		<!-- 头部 -->
    		@include('admin.partials.header')
    		<!-- 左侧导航栏 -->
    		@include('admin.partials.navigation')
    		<!-- 内容 -->
    		<div class="content-wrapper">
	    		<!-- 内容头部 -->
	    		<section class="content-header">
	    			@yield('content-header')
	    		</section>
	    		<!-- 内容主体 -->
	    		<section class="content">
		    		@include('admin.partials.flashes')
	    			@yield('content')
	    		</section>
    		</div>
    		<!-- 尾部 -->
    		@include('admin.partials.footer')
    		<!-- 工具栏 -->
    		<!-- include('admin.partials.sidebar') -->
    	</div>

    	<!-- 公共JS -->
    	@include('admin.partials.script')
    	<!-- 自定义JS -->
    	@yield('script')

        <!-- 左侧导航栏 -->
        <script type="text/javascript">
            var page_url_simplify = location.protocol + '//' + location.host + location.pathname;
            var page_url_full     = location.protocol + '//' + location.host + location.pathname + location.search;

            $('#sidebar-menu a').each(function() {
                if($(this).attr('href') == page_url_simplify) {
                    $(this).parents('li.treeview').addClass('active');
                }

                if($(this).attr('href') == page_url_full) {
                    $(this).parents('li').addClass('active');
                }
            });
        </script>

    </body>
</html>