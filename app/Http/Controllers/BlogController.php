<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
class BlogController extends Controller
{
    public function showList()
    {
        $blogs = Blog::all();
        return view('blog.list',['blogs' => $blogs]);
    }

    /*
     * ブログの登録画面を表示する
     * param void
     * return view
     */
    public function showCreate()
    {
        return view('blog.form');
    }

    /*
     * ブログを登録する
     * param $request
     * return view
     */
    public function exeStore(BlogRequest $request)
    {
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            Blog::create($inputs);
            \DB::commit();
        }catch (\Throwable $e)
        {
            abort(500);
            \DB::rollback();
        }

        \Session::flash('err_msg','データが登録されました');
        return redirect(route('blogs'));
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

    /*
     * param int $id
     * return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog))
        {
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.edit',['blog' => $blog]);
    }

    /*
 * ブログを登録する
 * param $request
 * return view
 */
    public function exeUpdate(BlogRequest $request)
    {
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            $blog = Blog::find($inputs['id']);
            $blog->fill([
               'title' =>  $inputs['title'],
                'content' =>$inputs['content']
            ]);
            $blog->save();
            \DB::commit();

        }catch (\Throwable $e)
        {
            abort(500);
            \DB::rollback();
        }

        \Session::flash('err_msg','データが更新されました');
        return redirect(route('blogs'));
    }
}
