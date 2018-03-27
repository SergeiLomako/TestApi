<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<!-- Хедер Меню -->
<header class="main-header">
    <!-- Логотип -->
    <a href="/" target="home" class="logo">
        <!-- Мини Версия -->
        <span class="logo-mini"><i class="fa fa-home"></i></span>
        <!-- Регулярная версия -->
        <span class="logo-lg">Zoo Misto</span>
        
         
      <!-- mini logo for sidebar mini 50x50 pixels -->
     
      <!-- logo for regular state and mobile devices -->
    
    
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Кнопка Меню Навигации-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"></span>
      </a>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Заказы<i class="fa fa-bell-o"></i>
                <span class="label label-info">0</span>
            </a>
                <ul class="dropdown-menu">
                    <li>
                        <ul class="menu">
                    <?php if ($admin_call_center): ?>
                        <li><a  href="/admin/orders">Список заказов</a></li>
                        <li><a  href="/admin/orders/new_order_form">Новый заказ</a></li>
                    <?php endif ?>
                <!--<li><a id="orders_link" href="/admin/orders/check_status_pay_orders">Список оплаченных заказов через Wayforpay</a></li>-->
                    <?php if ($admin_call_center): ?>
                        <li><a  href="/admin/orders/show_orders_processing">Проверка наличия товара у поставщика</a></li>
                        <li><a href="/admin/orders/show_paid_order_product">Список товара на заказ поставщику</a></li>
                        <li class="hidden"><a id="orders_link" href="/admin/orders/list_of_orders_for_otkas_product">Список заказов с товаром - <strong>отказ</strong></a></li>
                    <?php endif ?>
                    <?php if ($storekeeper): ?>
                        <li><a  href="/admin/orders/list_of_arrival_of_the_goods_at_the_warehouse">Список прихода товара на склад</a></li>
                        <li><a  href="/admin/orders/list_of_orders_for_shipment">Отправка заказа клиенту</a></li>
                        <li><a  href="/admin/orders/list_of_orders_for_shipment_finished">Отправленные заказы клиенту</a></li>
                    <?php endif ?>
                    <?php if ($admin_call_center): ?>
                        <li><a id="orders_link" href="/admin/orders/re_order_the_goods">Повторный заказ товара поставщику</a></li>
                    <?php endif ?>
                        </ul>
                  </li>
              </ul>
        </li>
        <!-- Акк --> 
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Сообщения <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
           
          </li>
          <!-- User Account: style can be found in dropdown.less -->
         
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
    <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="/sklad"><i class="fa fa-th text-yellow"></i><span>Склад</span></a></li>
            <li><a href="/admin"><i class="fa fa-shopping-cart text-aqua"></i><span>Магазин</span></a></li>
            <li><a href="/admininfo"><i class="fa fa-warning text-red"></i><span>Инфо</span></a></li>
        <?php if ($super): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                        <span>Отчеты</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                    <ul class="treeview-menu">           
                        <li class="treeview">
                            <a href="#">
                                По дате получения заказа
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="/admin/report/piechart_events">Общий отчет по заказам</a></li>
                                    <li><a href="/admin/orders/3table">Общий отчет - таблицы</a></li>
                                    <li><a href="/admin/orders/report_payments_debit">Приход денег</a></li>
                                    <!--<li><a href="/admin/orders/report_otkaz_tovar_order">Отказ - заказы и Отказ - товар</a></li>-->
                                    <li role="separator" class="divider"></li>
                                </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                По снимкам статусов
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="/admin/report/piechart">Общий отчет по заказам </a></li>
                                    <li><a href="/admin/report/line_charts">Завершенные заказы</a></li>
                                    <li><a href="/admin/report">Общие отчеты</a></li>
                                    <li><a href="/admin/report/annotationchart">Все в одном (График)</a></li>
                                    <li><a href="/admin/report/map_orders">Карта заказов</a></li>
                                </ul>
                        </li>        
                    </ul>   
            </li>
        <?php endif ?>
        <?php if ($operator): ?>
            <li>
                <a href="/admin/callme"><i class="fa fa-phone"></i><span> Звонки от посетителей</span></a>
            </li>
        <?php endif ?>
        <?php if ($operator or $admin_seo or $seo or $designer or $translator): ?>
            <li><a href="/admin/products"><i class="fa fa-list-ol"></i> <span> Список товара</span></a></li>
        <?php endif ?>
        <?php if ($admin_call_center): ?>
            <li><a href="/admin/products/add"><i class="fa fa-plus-circle"></i><span> Добавить товар</span></a></li>
        <?php endif ?>
        <?php if ($admin_call_center): ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i>
                    <span>Пользователи</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>              
                    <ul class="treeview-menu">
                        <?php if ($super): ?>
                            <li><a href="/admin/users/user_admin">Администраторы</a></li>
                        <?php endif ?>
                        <?php if ($super): ?>
                            <li><a href="/admin/users/user_login">Покупатели (Зарегистр.)</a></li>
                        <?php endif ?>
                        <?php if ($super): ?>
                            <li><a href="/admin/users/user_comment">Создатели комментарий</a></li>
                        <?php endif ?>
                        <?php if ($admin_call_center): ?>
                            <!--<li><a href="/admin/users/user_call">Покупатели по звонку</a></li>-->
                            <li role="separator" class="divider"></li>
                            <li><a class="reminder_link" href="/admin/baseuser">Покупатели - наша база</a></li>
                        <?php endif ?>
                        <?php if ($super): ?>
                            <!--<li><a href="/admin/baseuser/import_users">2 Импортировать новых клиентов и найти изменения</a></li>
                            <li><a href="/admin/baseuser/fixed_field_pets">3 Исправить поле с животными</a></li>-->
                            <li><a href="/admin/baseuser/search_brands_categories_for_baseuser">Обновить связи</a></li>
                        <?php endif ?>
                    </ul>
            </li>
        <?php endif ?>
        <?php if ($operator or $admin_seo or $seo): ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-comments-o"></i>
                    <span>Отзывы</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/comments/comment1">Список комментарий</a></li>
                        <li><a href="/admin/comments/comment12">Наши комментарии</a></li>
                    </ul>
            </li>
        <?php endif ?>
        <?php if ($admin_seo or $translator): ?>
            <li class="treeview">
                <a href="#"> <i class="fa fa-paperclip"></i>
                    <span>Категории</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                    <ul class="treeview-menu">
                        <?php if ($admin_seo or $translator): ?>
                            <li><a href="/admin/categorybrand">Категория-производитель</a></li>
                        <?php endif ?>
                        <?php if ($super or $admin_seo or $translator): ?>
                            <li><a href="/admin/category">Список категорий</a></li>
                        <?php endif ?>
                        <?php if ($super or $admin_seo or $translator): ?>
                            <li><a href="/admin/brand">Производители</a></li>
                        <?php endif ?>
                    </ul>
            </li>
        <?php endif ?>    
        <?php if ($admin_designer): ?>
            <li class="treeview">
                <a href="#"> <i class="fa fa-edit"></i>
                    <span>Публикации</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                    <ul class="treeview-menu">
                        <?php if ($super): ?>
                            <li><a href="/admin/article">Статьи</a></li>
                                <?php endif ?>
                                <?php if ($super): ?>
                                    <li><a href="/admin/article/add">Новая статья</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/admin/razdel">Разделы</a></li>
                                    <li><a href="/admin/razdel/add">Добавить раздел</a></li>
                                    <li role="separator" class="divider"></li>
                                <?php endif ?>
                                <?php if ($admin_designer): ?>
                                    <li><a href="/admin/stock">Акции</a></li>
                                    <li><a href="/admin/stock/add">Добавить страницу акций</a></li>
                                <?php endif ?>
                                <?php if ($super): ?>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/admin/rating/">Опросы</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/admin/Landingpage/">Лендинги</a></li>
                                    <li role="separator" class="divider"></li>
                                <?php endif ?>
                    </ul>
            </li>
        <?php endif ?>
        <?php if ($admin_call_center): ?>
            <li class="treeview">
                <a href="#"> <i class="fa fa-money"></i>
                    <span>Прайсы</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                    <ul class="treeview-menu">
                        <?php if ($admin_call_center): ?>
                            <li><?= HTML::anchor('admin/importprices/index', 'Импорт прайсов') ?></li>
                            <li><?php // echo  HTML::anchor('admin/importprices/multy_brands', 'Импорт прайсов (несколько производителей)')     ?></li>
                            <li><?php echo HTML::anchor('admin/importprices/price_comparison', 'Сравнение процента наценки с конкурентами') ?></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/admin/importprices/set_brand_supplier_by_product">Связать поставщиков и производителей с комплектами</a></li>
                        <?php endif ?>
                    </ul>
            </li>
        <li><a href="/admin/adminchat"><i class="fa fa-question"></i><span>Консультант</span></a></li>
        <?php endif ?>    
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
    <aside class="control-sidebar control-sidebar-dark">
      
            <li><a href="#">Основные настройки</a></li>
        
       
  </aside>
</body>
    
<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
asdasdasd




