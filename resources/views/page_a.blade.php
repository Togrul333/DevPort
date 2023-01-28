<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
{{--@dd($key,$user)--}}
<h1 >Welcome</h1>

<div class="container">
    <div class="m-2">
        <span>1)</span>
        <a href="{{route('createKey',['user'=>$user->id])}}" class="btn btn-success">Создать новый ключь</a>
    </div>
  <div class="m-2">
      <span>2)</span>
      <a href="{{route('deleteKey',['key'=>$key])}}" type="button" class="btn btn-danger">Деактивировать данный ключь</a>
      ключь: <span>{{$key}}</span>
  </div>
    <div class="m-2">
        <span>3)</span>
        <a href="{{route('Imfeelinglucky',['user'=>$user->id])}}" class="btn btn-warning">Imfeelinglucky</a>
    </div>
    <div class="m-2">
        <span>4)</span>
        <a href="{{route('ImfeelingluckyInfo',['user'=>$user->id])}}" type="button" class="btn btn-info">History</a>
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if(\Illuminate\Support\Facades\Session::has('success'))
    <script>
        toastr.success("{!! \Illuminate\Support\Facades\Session::get('success') !!}")
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        toastr.error("{!! \Illuminate\Support\Facades\Session::get('error') !!}")
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('info'))
    <script>
        toastr.info("{!! \Illuminate\Support\Facades\Session::get('info') !!}")
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('warning'))
    <script>
        toastr.warning("{!! \Illuminate\Support\Facades\Session::get('warning') !!}")
    </script>
@endif

</html>
