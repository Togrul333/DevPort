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
<h1 class="m-4">Register</h1>

<div class="container mt-4" >
    <form id="save-form" action="{{route('register')}}" method="POST" >
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control username" required name="username" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Number</label>
            <input type="text" class="form-control number" required name="number">
        </div>
        <button type="submit" id="register_btn" class="btn btn-primary">Register</button>
    </form>
</div>

<div class="modal fade" id="link_modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Ваш уникальный линк на страницу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p >Данный линк будет доступен в течение 7 дней</p>
                <a class="ml-2" href="#" >перейти по линку</a>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {
        $(document).on('click', '#register_btn', function (e) {
            e.preventDefault();
            let form = $('#save-form');
            let url = form.attr('action');
            let data = {};

            data['username'] = $('.username').val();
            data['number'] = $('.number').val();
            if(data['username']=='' || data['number']==''){
                toastr["warning"]("Заполните поля !!", "Внимание!")
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: url,
                data: data,
                success: (response) => {
                    $('#link_modal').modal('show');
                    $("#link_modal a").attr("href", `${response.link}`)

                },
                error: function (response) {
                    toastr["warning"]("Срок вашего уникального ключа истек!", "Внимание!")
                }
            });

        });
    });
</script>
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
