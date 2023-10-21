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

    public function posts()
    {
        $posts = Post::with('category')->paginate(10);
        return apiResponse(200, 'succes', $posts);
    }
    
    public function favourites()
    {
        // $client = Auth::user();
        $client = auth()->user();
        // $client = $request->user();

        return apiResponse(1, 'all favourites', $client->favourites);
        // return apiResponse(1, 'all favourites', $client->favourites()->get());
    }

    public function toggleFav(Request $request)
    {
        $rules = [
            'post_id' => 'required'
        ];

        $validator = validator($request->all(), $rules);

        if($validator->fails())
            return apiResponse(0, $validator->errors()->first(), $validator->errors());

        $user = auth()->user();

        $user->favourites()->toggle($request->post_id);
        return apiResponse(1, 'تمت العمليه بنجاح');

    }
}
