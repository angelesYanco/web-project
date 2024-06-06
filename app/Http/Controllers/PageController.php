<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request){

        dd(
            $request->user()->friendsFrom()->get(),
            $request->user()->friendsTo()->get()
        );

        if($request->get('for-my')){
            $posts = $request->user()->posts()->latest()->get();
        }else{
            $posts = Post::latest()->get();
        }

        return view('dashboard', compact('posts'));
    }
}
