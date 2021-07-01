<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

//$name = request('name', 'Guest');
//        return "Hello, {$name}!";
//        $name = request('name');
//        return view('index', ['name' => $name]);
//$post = Post::query()
//    ->create([
//        'title' => 'First post',
//        'content' => 'Some content'
//    ]);
//dd($post);

class HomeController extends Controller
{
//    function index(){
//        if(!session()->has('name'))
//            return redirect()->route('form');
//        return view('index', ['name' => session('name')]);
//    }
//
//    function form(){
//        if(session()->has('name'))
//            return redirect()->route('index');
//        return view('form');
//    }
//
//    function handle(){
//        request()->validate([
//            'name' => 'required'
//        ]);
//        session()->put('name', request('name'));
//        return redirect()->route('index');
//    }
    function index(){

        return view('index');
    }
}
