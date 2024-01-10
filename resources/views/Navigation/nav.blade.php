
<style>
ul{

}
ul li {
list-style: none;

}
ul li a{
  text-decoration: none;
  color: black;
  font-weight: 600;
}
ul li a:hover{
  color: #ffff;
  font-weight: 700;
  letter-spacing: 1.5px;
  transition: all .3s ease-in-out;
}

button:hover{
  color: #ffff;
  font-weight: 700;
  letter-spacing: 1.5px;
  transition: all .3s ease-in-out;

}
</style>

<div class="container-fluid">
  <div class="row p-2 mt-2 bg-info">
    <div class="col-7 list">
      @auth
        
      <ul>
        <li><button type="submit" class="btn  button"><a href="{{route("list_item")}}">DashBoard</a></button></li>
      </ul>
      @endauth
    </div>
    <div class="col-5 ">
     
      <ul class="row">
        @auth
        <li  class="col-2"><button type="submit" class="btn   button"><a href="" class="bg-light p-2 ">{{auth()->user()->name}}</a></button></li>
        <li class="col-2"><button type="submit" class="btn   button"><a href="{{route("forget")}}">Update</a></button></li>
        <li class="col">
        <form action="{{route("logout")}}" method="POST">
          @csrf
          <button type="submit" class="btn   button">Logout</button>
          </form>
        </li>
          @csrf
        @endauth
        @guest
          
        <li  class="col-3"><button  type="submit" class="btn   button"><a href="{{route("registration")}}">Registration</a></button></li>
        <li class="col-1"><button type="submit" class="btn   button"><a href="{{route("login")}}">login</a></button></li>
        @endguest
      </ul>

    </div>

  </div>
</div>

