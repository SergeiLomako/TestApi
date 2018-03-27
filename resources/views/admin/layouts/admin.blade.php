<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TestAPI | Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset('assets/admin/favicon.ico')}}" rel="shortcut icon" type="image/vnd.microsoft.icon"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('assets/admin/AdminLTE-master/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('assets/admin/AdminLTE-master/dist/css/AdminLTE.min.css')}}">
        <!--<link rel="stylesheet" href="{{asset('assets/admin/AdminLTE-master/dist/css/fix.css')}}">-->
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('assets/admin/AdminLTE-master/dist/css/skins/_all-skins.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{asset('assets/admin/scripts/all.js')}}"></script>

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .sidebar-menu, .main-sidebar, .sidebar-menu>li.header {
                white-space: normal;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="/" target="_blank" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>DS</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>TestAPI</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Навигация</li>
                        @role('super_admin|admin')
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa fa-list"></i> <span>Пользователи</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('user')}}"><i class="fa fa-circle-o"></i> Список</a></li>
                                @role('super_admin')
                                <li><a href="{{route('add_user')}}"><i class="fa fa-circle-o"></i> Добавить</a></li>
                                @endrole
                            </ul>
                        </li>
                        @endrole
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa fa-list"></i> <span>Заказы</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('order')}}"><i class="fa fa-circle-o"></i> Список</a></li>
                                @role('super_admin')
                                <li><a href="{{route('add_order')}}"><i class="fa fa-circle-o"></i> Добавить</a></li>
                                @endrole
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{$title}}
                        <small></small>
                    </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            @if(isset($title_page))
                            <h3 class="box-title">{{$title_page}}</h3>
                            @endif
                            @if(session('status'))
                            <p class="alert alert-warning" style="padding: 5px; margin-bottom: 5px;">{{session('status')}}</p>
                            @endif
                            @if(count($errors)>0)
                            <ul>
                                @foreach($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="box-body">
                            @yield('content')
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <!--Footer-->
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <!-- AdminLTE App -->
        <script src="{{asset('assets/admin/AdminLTE-master/dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('assets/admin/AdminLTE-master/dist/js/demo.js')}}"></script>
        <script src="{{asset('assets/admin/scripts/vue.min.js')}}"></script>
        <script src="{{asset('assets/admin/scripts/manifest.js')}}"></script>
        <script src="{{asset('assets/admin/scripts/vendor.js')}}"></script>
        <script src="{{asset('assets/admin/scripts/admin_scripts.js')}}"></script>
        <script src="{{asset('assets/admin/scripts/maskinput.js')}}"></script>
    </body>
</html>
