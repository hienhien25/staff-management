<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <base href="{{asset('/')}}">
    <title>@yield("title")</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include("css")
    @yield('pagecss')
    <!-- bootstrap 3.0.2 -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    @include("header")
    <div class="wrapper row-offcanvas row-offcanvas-left">
        @include("layout.sidebar")
        <aside class="right-side">
        @yield("content")
      </aside>
    </div><!-- ./wrapper -->
    @include("js")
    @yield("pagejs")
</body>
</html>