<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Category;
use App\CategoryRank;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        view()->share('active', ['0' => 'categories']);

        $data['categories'] = Category::orderBy('created_at', 'desc')->paginate(100);
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        view()->share('active', ['0' => 'categories']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Categories')];
        $breadcrumbs[] = ['text' => __('Show')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['category'] = Category::findOrFail($id);


        return view('admin.categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $scripts[] = 'https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js';

//        view()->share('scripts', $scripts);
//        $mixScripts[] = '/dist/js/create-blog.js';
//        view()->share('mixScripts', $mixScripts);
        $category = Category::findOrFail($id);
        $data['model'] = $category;
        return view('admin.categories.form', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->input();
        $category = Category::findOrFail($id);
        $category->update($input);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
