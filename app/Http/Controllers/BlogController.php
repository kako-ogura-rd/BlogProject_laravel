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

    /*
     * param $id
     * return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog))
        {
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.detail',['blog' => $blog]);
    }
}
