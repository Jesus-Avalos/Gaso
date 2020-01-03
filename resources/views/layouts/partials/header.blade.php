
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{ Html::style('css/app.css') }}
  {{ Html::style('css/adminlte.min.css') }}
  {{ Html::style('css/box.css') }}
  {{ Html::style('css/datatables.min.css') }}
  

  <style>
    .borin textarea, .borin input, .borin select{
        border: 1px solid #999;
    }

    .table td, .table th{
        text-align: center;
    }
  </style>

  <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
  </script>

  <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
  </script>
</head>

  