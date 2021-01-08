<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;
use App\Models\Blog;

class BlogController extends Controller
{
    public function showList()
    {
        $blogs = Blog::all();
        return view('blog.list',['blogs' => $blogs]);
    }
}
