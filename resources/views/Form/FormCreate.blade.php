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


<div class="row el-element-overlay">
  @if (session("success"))
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> <!-- Include the SweetAlert library -->
  <script>
      swal({
          title: "Success!",
          text: "{{ session("success") }}",
          icon: "success",
          button: "Okay",
      });
  </script>
 @endif

 
<div class="container-fluid">
    <div class="d-flex justify-content-center">
<form class="w-50 h-25 mt-4" method="POST" action="{{route("post.store")}}" enctype="multipart/form-data">
  @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="exampleInputEmail1" value="{{old("text")}}">
      @error("title")
      <p class="text-danger">{{$message}}</p>
        
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old("text")}}</textarea>
      @error("description")
      <p class="text-danger">{{$message}}</p>
        
      @enderror
    </div>
    <div class="mb-3">
      <div class="">Category</div>
        <select  required name="category" id="Category" class="form-select  mt-2">
          
          <option value="technology" {{ old('category') == 'technology' ? 'selected' : '' }}>Technology</option>
          <option value="lifestyle" {{ old('category') == 'lifestyle' ? 'selected' : '' }}>LifeStyle</option>
          <option value="travel" {{ old('category') == 'travel' ? 'selected' : '' }} >Travel</option>
          <option value="fashion" {{ old('category') == 'fashion' ? 'selected' : '' }} >Fashion</option>
      </select>
      @error("category")
      <p class="text-danger">{{$message}}</p>
        
      @enderror
    </div>
    <div class="row ">
      <div class="">Tags</div>
    <div class="mb-3 form-check col-1">
      <input name="tags[]" type="checkbox" class="form-check-input" id="exampleCheck1" value="php"{{in_array("php",old("tags",[])) ? "checked" :""}}>
      <label class="form-check-label" for="exampleCheck1">Php</label>
    </div>
    <div class="mb-3 form-check col-1">
      <input name="tags[]" type="checkbox" class="form-check-input" id="exampleCheck1" value= " JS" {{in_array("JS",old("tags",[])) ? "checked" :""}}>
      <label class="form-check-label" for="exampleCheck1">Js</label>
    </div>
    <div class="mb-3 form-check col-1">
      <input name="tags[]" type="checkbox" class="form-check-input" id="exampleCheck1" value= "Python"{{in_array("Python",old("tags",[])) ? "checked" :""}}>
      <label class="form-check-label" for="exampleCheck1">Python</label>
    </div>
    @error("tags[]")
    <p class="text-danger">{{$message}}</p>
      
    @enderror
  </div>
  <div class="row my-2">
    <div class="my-2">Status</div>
      <div class="form-check col-2" >
        <input name="status" class="form-check-input" type="radio"  id="gridRadios2" value="published" {{old("status") == "published" ? "checked" : ""}}>
        <label class="form-check-label" for="gridRadios2">
          Published
        </label>
      </div>
      <div class="form-check col-2">
        <input name="status" class="form-check-input" type="radio" id="gridRadios2" value="draft" {{ old('status') == 'draft' ? 'checked' : '' }}">
        <label class="form-check-label" for="gridRadios2">
          Draft
        </label>
      </div>
      @error("status")
      <p class="text-danger">{{$message}}</p>
        
      @enderror
  </div>
  <div class="mt-3">
  <div>Featured image</div>
  <input name="featured_image" type="file" class="mt-1" >
  {{-- @error("featured_image")
  <p class="text-danger">{{$message}}</p>
    
  @enderror --}}
</div>
    <button type="submit" class="btn btn-primary mt-3">Create Post</button>
  </form>
</div>
</div>


@endsection
