<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Staffing Africa</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}">
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-green.min.css") }}">
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/boostrap/css/style.css") }}">
  <link rel="stylesheet" href="{{ asset("/sweetalert/dist/sweetalert.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
@if(Auth::user())
<body class="hold-transition skin-green fixed">
@else
<body class="hold-transition skin-green sidebar-collapse">
@endif
<div class="wrapper">
    @include('header')
    @if(Auth::user())
    @include('sidebar')
    @endif
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('footer')
  <div class="control-sidebar-bg"></div>
</div>
<script src="{{ asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>

<script src="{{ asset("/bower_components/AdminLTE/dist/js/app.min.js") }}"></script>
<script src="{{ asset("/sweetalert/dist/sweetalert-dev.js") }}"></script>
@include('flash')
@yield('scripts.footer')
</body>
</html>
