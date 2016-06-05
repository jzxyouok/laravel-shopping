<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>后台管理 | 登录</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('backstage/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="{{ asset('backstage/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('backstage/dist/css/AdminLTE.min.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .kelvin-header{
                padding: 20px 10px;
                text-align: center;
                font-size: 26px;
                background: #3d9970;
                box-shadow: inset 0 -3px 0 rgba(0 ,0 ,0 ,0.2);
                border-radius: 4px 4px 0 0;
            }
            .kelvin-body{
                padding: 30px 20px 1px 20px;
                background: #fff;
                color: #444;
            }
            .kelvin-footer{
                padding:10px 20px;
                background: #fff;
                color: #444;
                border-radius: 0 0 4px 4px;
            }
        </style>
    </head>
    <!-- <body class="hold-transition login-page"> -->
    <body class="bg-black">
        <div class="login-box">
            <div class="login-logo">
                <b>开启不一样的生活</b>
            </div>
            <!-- <div class="login-box-body"> -->
            <div class="form-box">
                <!-- <p class="login-box-msg">登录</p> -->
                <div class="kelvin-header">后台管理</div>
                <!-- <form action="{{ route('admin.login.store') }}" method="post"> -->
                {{ Form::open(['route' => 'admin.login.store']) }}
                    <div class="kelvin-body bg-gray">
                        <!-- <div class="form-group has-feedback">
                            <input type="text" name="username" class="form-control" placeholder="用户名">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="密码">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck kelvin-remember">
                                <label>
                                    <input type="checkbox" name="remember" value="1"> 记住我
                                </label>
                            </div>
                        </div> -->
                        <div class="input-group">
                            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => '用户']) }}
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <br/>
                        <div class="input-group">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '密码']) }}
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <br/>
                        <div class="form-group">
                            {{ Form::checkbox('remember', 1, false) }} 记住我
                        </div>
                    </div>
                    <div class="kelvin-footer">
                        <button type="submit" class="btn btn-success btn-block">登录</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('backstage/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('backstage/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>