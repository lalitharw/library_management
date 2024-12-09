<form action="{{route("site.auth.register")}}" method="post">
    @csrf
    <input type="text" name="password" placeholder="password" id="">
    <input type="text" name="name" placeholder="name" id="">
    <input type="text" name="email" placeholder="email" id="">
    <button>Submit</button>
</form>
