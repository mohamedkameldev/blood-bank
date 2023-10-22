<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function categories()
    {
        $categories = Category::all();
        return apiResponse(200, 'succes', $categories);
    }

    public function posts(Request $request)
    {
        // $posts = Post::with('category')->paginate(10);

        $posts = Post::where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        })->with('category')->paginate(10);

        return apiResponse(200, 'succes', $posts);
    }

    public function post($id)
    {
        $post = Post::with('category')->find($id);
        return apiResponse(1, 'this is the post required', $post);
    }

    public function search(Request $request)
    {
        $posts = Post::query();
        $posts= $posts->where(function($query) use($request){
            if($request->has('word')){
                $query->where('title', 'Like', "%$request->word%")
                    ->orwhere('content', 'Like', "%$request->word%");
            }
        })->get();


        // $posts = Post::query();

        // if($request->word){
        //     $posts = $posts->where(function($query) use ($request){
        //         $query->orwhere('title', 'Like' , "%$request->word%");
        //         $query->orwhere('content', 'Like' , "%$request->word%");
        //     });
        // }

        // $posts = $posts->paginate(10);
        
        return apiResponse(1, 'posts that is needed', $posts);

    }
    
    public function favourites()
    {
        // $client = Auth::user();
        // $client = auth()->guard('api')->user();
        $client = auth()->user();
        // $client = $request->user();

        return apiResponse(1, 'all favourites', $client->favourites); // Attribute not an operation...
        // return apiResponse(1, 'all favourites', $client->favourites()->get());
    }

    public function toggleFav(Request $request)
    {
        $rules = [
            'post_id' => 'required'
        ];

        $validator = validator($request->all(), $rules);

        if ($validator->fails())
            return apiResponse(0, $validator->errors()->first(), $validator->errors());

        $user = auth()->user();

        $user->favourites()->toggle($request->post_id);
        return apiResponse(1, 'تمت العمليه بنجاح');
    }
}
