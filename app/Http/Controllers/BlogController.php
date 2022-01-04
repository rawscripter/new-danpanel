<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Http\Resources\BlogResource;
use App\SubCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Webpatser\Uuid\Uuid;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        $products = Blog::query();
        $products->where('status', 1);



        if ($request['query']) {
            $products->where('title', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }
        $products->orderBy('id', 'DESC');

        $products = $products->paginate($request->limit ? $request->limit : 20);


        $res['total'] = $products->total();
        $res['blogs'] = BlogResource::collection($products);
        return response()->json($res);
    }

    public function getBlogCategories()
    {
        $subCategories = SubCategory::has('blogs')->withCount('blogs')->get();

        $res['success'] = true;
        $res['data'] = $subCategories;
        return response()->json($res);
    }

    public function getBlogs()
    {
        if (Cache::has('blogs')) {
            $blogs = Cache::get('blogs');
        } else {
            $blogs = $this->blogQuery();
        }
        $res['success'] = true;
        $res['blogs'] = BlogResource::collection($blogs);
        return response()->json($res);
    }

    public function blogQuery()
    {
        $blogs = Blog::whereStatus(1)->orderBy('created_at', 'desc')->get();
        Cache::put('blogs', $blogs, 30);
        return $blogs;
    }

    public function getBlogDetails($blogSlug)
    {
        $blog = Blog::where('slug', $blogSlug)->first();
        $res['success'] = true;
        $res['blog'] = new BlogResource($blog);
        return response()->json($res);
    }

    public function archiveBlogs()
    {
        $blogs = Blog::whereStatus(0)->orderBy('created_at', 'asc')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function toggleBlogActiveStatus(Blog $blog)
    {
        if ($blog->status) {
            $blog->status = 0;
        } else {
            $blog->status = 1;
        };
        $blog->save();
        return redirect()->back()->withSuccess("Blog Status Changed");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 1;

        if ($request->image)
            $data['image'] = ImageController::uploadImage($request->image, "/blog/images");

        $blog =  Blog::create($data);
        if ($blog) {
            $res['success'] = true;
            $res['message'] = 'Blog Created Successfully';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return void
     */
    public function show(Blog $blog)
    {
        $res['success'] = true;
        $res['blog'] = new BlogResource($blog);
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     * @return Factory|View
     */
    public function edit(Blog $blog)
    {

        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Blog $blog
     * @return Response
     */
    public function update(Request $request, Blog $blog)
    {

        $data = $request->all();

        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 1;

        if ($request->blog_image)
            $data['image'] = ImageController::uploadImage($request->blog_image, "/blog/images");

        $blog->update($data);
        if ($blog) {
            $res['success'] = true;
            $res['message'] = 'Blog Updated Successfully';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return void
     */
    public function destroy(Blog $blog)
    {
        if ($blog->delete()) {
            $res['success'] = true;
            $res['message'] = 'Blog Deleted';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }

    public function uploadImage($image)
    {
        $name = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();;
        // uploading images to folder
        $image->move('blog/images', $name);
        return $name;
    }
}
