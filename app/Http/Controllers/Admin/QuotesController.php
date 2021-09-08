<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Quote;
 
use Illuminate\Http\Request;

class QuotesController extends AdminController
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
        view()->share('active', ['0' => 'quotes']);

        $data['quotes'] = Quote::orderBy('created_at', 'desc')->paginate(300);
        return view('admin.quotes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Quote();
        $data['formOptions'] = ['route' => ['admin.quotes.store'], 'method' => 'POST'];
        return view('admin.quotes.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quote::create($request->input());
       return redirect('/admin/quotes/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        view()->share('active', ['0' => 'quotes']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Quotes')];
        $breadcrumbs[] = ['text' => __('Show')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['quote'] = Quote::findOrFail($id);


        return view('admin.quotes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $quote = Quote::findOrFail($id);
        $data['model'] = $quote;
        $data['formOptions'] = ['route' => ['admin.quotes.update', $quote->id], 'method' => 'PATCH'];
        return view('admin.quotes.form', $data);

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
        $quote = Quote::findOrFail($id);
        $quote->update($input);
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
        $quote = Quote::findOrFail($id);
        $quote->delete();

        return redirect()->back()->with('success', 'Quote deleted successfully');
    }
}
