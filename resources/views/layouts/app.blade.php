<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | OrginFood Application</title>
    <!-- Favicon-->
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets') }}/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets') }}/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body>
    <div id="app">

       @auth
       @include('components.nav')
       @include('components.sidebar')
       @endauth


        <section class="content">
            @yield('content')
        </section>


    </div>

      <!-- Jquery Core Js -->
      <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>

      <!-- Bootstrap Core Js -->
      <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.js"></script>
      <!-- Select Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
      <!-- Slimscroll Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
      <!-- Waves Effect Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/node-waves/waves.js"></script>
     <!-- Jquery CountTo Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-countto/jquery.countTo.js"></script>
      <!-- Validation Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-validation/jquery.validate.js"></script>

      <!-- Custom Js -->
      <script src="{{ asset('assets') }}/js/admin.js"></script>
      <script src="{{ asset('assets') }}/js/pages/examples/sign-in.js"></script>

      <script src="{{ asset('assets') }}/js/demo.js"></script>


</body>
</html>
