
@extends("layouts.app")
@section("content")



<div class="container w-75 mt-4 mb-4  card p-2">
  <div class="row" >
    <div class="col-10">
      <span>Go back to your home</span>
    </div>
    <div class="col-2 ">
      <a href="{{route("list_item")}}" class="btn btn-success ">Go back</a>
    </div>
  </div>
</div>


<div class="container card p-5">
    <div class="card" style="width: 18rem;">
        <img src="{{asset('image/' . $post->featured_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ucwords($post->title)}}</h5>
          <p class="card-text">{{$post->description}}</p>
        </div>
      </div>
</div>

@endsection