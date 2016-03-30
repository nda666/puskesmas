<!DOCTYPE html>
<html>
    <head>
        <title>404 Not Found.</title>
        <link rel="stylesheet" href="{{ asset('assets/semantic-ui/semantic.min.css')}}">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                background: #00AAFF;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            p {
                font-size: 1em;
                color: #222;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .description {
              padding: 30px;
            }
            .content {
              text-align: center;
              display: inline-block;
              padding: 14px;
              width: 350px;
            }
            .title {
              font-size: 8em;
  margin-bottom: 45px;
  color: rgb(255, 241, 241);
  text-shadow: 1px 1px rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
              <div class="description">
                <div class="title">404!</div>
                <p>Maaf content ini tidak tersedia. Silahkan klik button Kembali untuk kembali ke Halaman Muka</p>
                <a class="ui button primary" href="{{ url('/') }}">Kembali</a>
              </div>
            </div>
        </div>
    </body>
</html>
