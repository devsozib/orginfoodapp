<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>OrginFood Application</title>
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
      @vite(['resources/js/app.js'])
     {{-- <script src="{{ asset('js/app.25fef93c.js')}}" defer></script> --}}

     <style>
        .custom-select{
    display: block;
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    -moz-padding-start: calc(0.75rem - 3px);
    font-size: 1.5rem;
    color: #767676;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;

        }
     </style>

</head>
<body>
    <div id="app">


       @include('components.nav')
       @include('components.sidebar')



        <section class="content">
            @yield('content')
        </section>


    </div>

      <!-- Jquery Core Js -->

      <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
      {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}

      <!-- Bootstrap Core Js -->
      <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.js"></script>
      <!-- Select Plugin Js -->
      {{-- <script src="{{ asset('assets') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script> --}}
      <!-- Slimscroll Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
      <!-- Waves Effect Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/node-waves/waves.js"></script>
     <!-- Jquery CountTo Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-countto/jquery.countTo.js"></script>
      <!-- Validation Plugin Js -->
      <script src="{{ asset('assets') }}/plugins/jquery-validation/jquery.validate.js"></script>
      <!--Sweet Alert -->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://unpkg.com/vue@3"></script>
      <!-- Custom Js -->
      <script src="{{ asset('assets') }}/js/admin.js"></script>
      <script src="{{ asset('assets') }}/js/pages/examples/sign-in.js"></script>

      <script src="{{ asset('assets') }}/js/demo.js"></script>

      @if (session('success'))
      <script>
          const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
          })
          Toast.fire({
              icon: 'success',
              title: '{{ session('success') }}'
          })
      </script>
  @endif


  @if (session('qty'))
  <script>
     Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '{{ session('qty') }}',

    })
  </script>

@endif
</body>
</html>
