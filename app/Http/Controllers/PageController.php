<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        $pages = Page::query();

        if ($request['query']) {
            $pages->where('title', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }
        $pages->orderBy('id', 'DESC');

        $pages = $pages->paginate($request->limit ? $request->limit : 20);


        $res['total'] = $pages->total();
        $res['pages'] = PageResource::collection($pages);
        return response()->json($res);
    }
    public function getPages(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        $pages = Page::query();

        if (isset($request['bottom'])) {
            $pages->where('show_at_bottom_menu', 1);
        }

        if (isset($request['top'])) {
            $pages->where('show_at_top_menu', 1);
        }
        $pages->orderBy('title', 'asc');
        $res['pages'] = PageResource::collection($pages->get());
        return response()->json($res);
    }


    public function getPageDetails($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $res['success'] = true;
        $res['page'] = new PageResource($page);
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if ($request->image)
            $data['image'] = ImageController::uploadImage($request->image, "/images");
        $blog =  Page::create($data);
        if ($blog) {
            $res['success'] = true;
            $res['message'] = 'Page Created Successfully';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }
    public function show(Page $page)
    {
        $res['success'] = true;
        $res['page'] = new PageResource($page);
        return response()->json($res);
    }


    public function update(Request $request, Page $page)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if ($request->page_image)
            $data['image'] = ImageController::uploadImage($request->page_image, "/images");

        $page->update($data);

        if ($page) {
            $res['success'] = true;
            $res['message'] = 'Page Updated Successfully';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }

    public function destroy(Page $page)
    {
        if ($page->delete()) {
            $res['success'] = true;
            $res['message'] = 'Page Deleted';
        } else {
            $res['success'] = false;
            $res['message'] = 'Something went wrong';
        }
        return response()->json($res);
    }
}
