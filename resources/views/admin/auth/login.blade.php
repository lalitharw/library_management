<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session("message"))
    <div class="alert">{{ session('message') }}</div>
    @endif
        <form action="" method="post">
        {{-- @csrf --}}
        <input type="text" name="email" placeholder="Enter Email" id="">
        <input type="text" name="password" placeholder="Enter Password" id="">
        <button class="btn-submit">Submit</button>
    </form>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $(".btn-submit").click(function(event){
                event.preventDefault()
                $.ajax({
                    method:"POST",
                    url: "{{route('admin.auth.login')}}",
                    data:{
                        _token: "{{csrf_token()}}",
                        email: $('[name="email"]').val(),
                        password: $('[name="password"]').val()
                    },
                    success:function(){
                        window.location.href = "{{route('admin.index')}}"
                    },
                    error:function(err){
                        console.log(err)
                        alert("Not Okay")
                    }
                })
            })
        })
    </script>
</body>
</html>
