@extends("layouts.app")
@section("content")
{{-- <style>
  .mlt{
    margin-left: 170px;
  }
  wid{
    width: 59px;
  }
</style> --}}


<div class=" w-75 mt-5 container-fluid  card p-2">
  
  <div class="row" >
    <div class="col-10">
      <span>Create the Post</span>
    </div>
    <div class="col-2 ">
      <a href="{{route("post.create")}}" class="btn btn-success col-lg-9">Create</a>
    </div>
  </div>
</div>

<div class="container-fluid ">
  <div class="row mt-5  mlt">
    <form method="GET" action="{{route("list_item")}}" class="d-flex col-lg-3">
      <input name="search" class="form-control me-2 justify-content-center" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</div>



{{-- <div class="row el-element-overlay">
  @if (session("delete"))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <i class="mdi mdi-check-all me-2"></i>
   {{session("delete")}}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   @endif
  </div>
  </div> --}}
  <div class="container-fluid ">
    <div class="mt-5">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="">
                  <th >Serial Number</th>
                    <th >Post Number</th>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody >
                @if($Posts->isNotEmpty())
                    @foreach ($Posts as $key => $post)
                        <tr class="wid">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ ucwords($post->category) }}</td>
                            <td>{{ ucwords(implode(', ', $post->tags)) }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td class="row">
                                <a href="{{ route("show_item", $post->id) }}" class="btn btn-info col-lg-2 mx-1">View</a>
                                <a href="{{ route("edit_item", $post->id) }}" class="btn btn-warning col-lg-2 mx-1">Edit</a>
                                <form id="deletePost" class="col-sm-2" action="{{ route('post_destroy', $post->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger confirm-delete" data-post-id="{{ $post->id }}">Delete</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">
                            <p class="alert alert-danger">No posts found</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $Posts->onEachSide(5)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>


@endsection
