<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $products=Product::paginate(10);

          return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->get('code'));
        $validator = Validator::make($request->all(), [
            'code' => ['required','unique:products,code'],
            'name' => ['required'],
             'category' => ['required']
        ]);

        if ($validator->fails()) {   //check all validations are fine, if not then redirect and show error messages
             // validation failed redirect back to form
            return back()->withInput()->withErrors($validator);
        } else {
            //handle the form
             Product::query()->insert(['code'=>$request->get('code'),'name'=>$request->get('name'),'category'=>$request->get('category'),'brand'=>$request->get('brand'),'type'=>$request->get('type'),'description'=>$request->get('description')]);
            return redirect('/product')->with('status', 'Product Saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $product=Product::query()->where('id', $id)->get()->first();
         // dd($products->id);
          return view('product.edit', compact('product'));
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

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category' => ['required']
        ]);
        if ($validator->fails()) {   //check all validations are fine, if not then redirect and show error messages
            // validation failed redirect back to form
            return back()->withInput()->withErrors($validator);
        } else {
            $product=Product::query()->where('id', $id)->update(['name'=>$request->get('name'),'category'=>$request->get('category'),'brand'=>$request->get('brand'),'type'=>$request->get('type'),'description'=>$request->get('description')]);
            return redirect('/product')->with('status', 'Product Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
