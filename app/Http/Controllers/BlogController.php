<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class BlogController extends Controller
{
    public function showList()
    {
        return view('blog.list');
    }
}
