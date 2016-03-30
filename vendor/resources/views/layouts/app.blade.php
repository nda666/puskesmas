<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
  <title>Login - Sistem Rawat Jalan</title>
  <link rel="stylesheet" href="{{ asset('assets/semantic-ui/semantic.min.css') }}">
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body,
    html {
      position: relative;
      height: 100%;
    }
    body > .grid {
      height: 100%;
    }
    #master .ui.middle.aligned.center.aligned.grid {
      min-height: 500px;
    }
    #master .column.row{
      margin-top: 8rem;
    }
    .login-header{
      text-shadow: 1px 1px white;
      color: #949494;
      padding: 0;
      height: 0;
      position: absolute;
      top: -1rem;
      width: 100%;
    }
    .image {
      margin-top: -100px;
    }

    .column {
      max-width: 450px;
    }

    .footer-login {
      padding: 5px 10px;
      width: 100%;
    }

    .footer-login .copyright {
      text-align: right;
      font-style: italic;
      font-size: 12px;
      text-shadow: 1px 1px white;
      color: #808080;
    }

  </style>
  <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>

</head>

<body id="master">
  @yield('content')
  <script src="{{ asset('assets/semantic-ui/semantic.min.js') }}" type="text/javascript" charset="utf-8"></script>
  @yield('javascript')
  <div class="footer-login">
    <div class="copyright" style="width: 100%; text-align: right;">
      <p>
        Copyright © 2016 Puskesmas Patrang
      </p>
    </div>
  </div>

</body>

</html>
