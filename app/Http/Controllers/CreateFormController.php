<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CreateFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        // $Posts=post::where("status","published")->latest()->get();
        // $Posts=post::where("category","travel")->latest()->get();
        // $Posts=post::all();

        // $searchTerm = $request->input('search');

        // $Posts = post::where(function ($query) use ($searchTerm) {
        //     $query->where('title', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('description', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('category', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('status', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('id', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('tags', 'like', '%' . $searchTerm . '%');
        // })->get();


        $searchTerm = $request->input('search');

        $Posts = post::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->orWhere('category', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('id', 'like', '%' . $searchTerm . '%')
                ->orWhere('tags', 'like', '%' . $searchTerm . '%');
        })->latest()->paginate(4);
        
        return view("ListItem.list", compact("Posts"));
        
        
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Form.FormCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    // dd($request->all());
       $request->validate([
        "title"=>"required|string|max:200",
        "description"=>"required|string",
        "category"=>"required|string",
        "tags"=>"nullable|array",
        "status"=>"required|string",
        "featured_image"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"

       ]);

       if ($request->hasFile("featured_image")) {
        $img = $request->file("featured_image");
        $fileNameStore = "featured_image" . md5(uniqid()) . time() . "." . $img->getClientOriginalExtension();
        $img->move(public_path("/image"), $fileNameStore);
        // $img->storeAs(("/image"), $fileNameStore);
    }
    

      post::create([
        "title"=>$request->title,
        "description"=>$request->description,
        "category"=>$request->category,
        "tags"=>$request->tags,
        "status"=>$request->status,
        "featured_image"=>$fileNameStore


      ]);
      return redirect()->back()->with("success","Post create successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("Form.formShow",compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post=post::findOrFail($id);
        return view("Form.formEdit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'tags' => 'nullable|array',
            'status' => 'required|string',
            "featured_image"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        //Image Upload
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $fileNameToStore = 'post_image_'.md5((uniqid())).time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'), $fileNameToStore);
        }

        //Post Save
        $post = post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'tags' => $request->tags,
            'status' => $request->status,
            'featured_image' =>  $request->hasFile('featured_image') ,
        ]);

        return redirect()->back()->with('success', 'Post updated Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $post=post::findOrFail($id);
        // $post->delete();
        // return redirect()->back()->with('delete', 'Post Deleted Successfully');
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->back()->with('delete', 'Post Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to delete the post');
        }
    }
}
