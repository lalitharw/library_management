<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

    <div class="d-flex justify-content-center align-self-center vh-100">

        <form action="{{route("site.auth.login")}}" method="post" class="shadow-lg p-4 align-self-center">
        @csrf
        <h4 class="fw-bold">Login</h4>
        <div class="alert alert-danger d-none" role="alert">
            A simple danger alert—check it out!
          </div>
        <div class="row">
            <div class="col-12 mb-4">
                <input class="form-control" type="text" name="email" placeholder="Enter email" id="">
                <p class="email-error error text-danger d-none"></p>
            </div>
        <div class="col-12">
        <input class="form-control" type="text" name="password" placeholder="Enter password" id="">
        <p class="password-error error text-danger d-none"></p>
    </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary mt-4 text-center" id="login-btn">Login</button>
    </div>
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $("#login-btn").click(function(event){
            event.preventDefault()
            $.ajax({
                method:"POST",
                url:"{{route('site.auth.login')}}",
                data:{
                    _token:"{{csrf_token()}}",
                    password: $('[name="password"]').val(),
                    email: $('[name="email"]').val()
                },
                beforeSend:function(){
                    $(".alert").addClass("d-none")
                    $(".error").addClass("d-none")
                    $(".form-control").removeClass("is-invalid")

                    $("#login-btn").html(`
<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                    `)
                },
                success:function(data){
                    console.log(data)

                    if(data.success == false){

                        $(".alert").removeClass('d-none').html(`
                        ${data.message}
                        `)
                    }

                    if(data.success == true){
                        $("#login-btn").html(`
Login
                    `)
                        window.location.href = "{{route('site.index')}}"
                    }
                },

                error:function(err,xhr){
                    const response = JSON.parse(err.responseText)
                    if (response.errors && response.errors.password && response.errors.password[0]){
                        $("[name='password']").addClass('is-invalid')
                        $(".password-error").removeClass("d-none")
                        $(".password-error").html(`${response.errors.password[0]}`)

                    }

                    if (response.errors && response.errors.email && response.errors.email[0]){
                        $("[name='email']").addClass('is-invalid')
                        $(".email-error").html(`${response.errors.email[0]}`)
                        $(".email-error").removeClass("d-none")
                    }
                    if(response.success == false){
                        $('.form-control').val("")

                        $(".alert").removeClass('d-none').html(`
                        ${response.message}
                        `)


                    }
                    $("#login-btn").html(`
Login
                    `)




                }

            })
        })
    })
</script>
</body>
</html>

