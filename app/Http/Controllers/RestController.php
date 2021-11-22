<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Routing\ResponseFactory;

class RestController extends Controller
{

    public function list()
    {
        $products=Product::paginate(10);
        return response()->make($products, 200, ['Content-Type'=>'application/json']);
    }


    public function show($code)
    {
        $products=Product::query()->where('code', $code)->get();
        return response()->make($products, 200, ['Content-Type'=>'application/json']);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required','unique:products,code'],
            'name' => ['required'],
            'category' => ['required']
        ]);
        //dd($request);
        if ($validator->fails()) {   //check all validations are fine, if not then redirect and show error messages
            return response()->make(['status'=>400,'message'=>'Create product fails. Code is unique and required.Name and category are required.'], 400, ['Content-Type'=>'application/json']);
        } else {
            //handle the form
            Product::query()->insert(['code'=>$request->get('code'),'name'=>$request->get('name'),'category'=>$request->get('category'),'brand'=>$request->get('brand'),'type'=>$request->get('type'),'description'=>$request->get('description')]);
            return response()->make(['status'=>200,'message'=>'Product created.'], 200, ['Content-Type'=>'application/json']);
        }
    }

    public function update(Request $request, $code)
    {

        $exist =true;
        $productCount=collect(Product::query()->where('code', $code)->get())->count();
        $name=$request->get('name');
        $category=$request->get('category');
        $brand=$request->get('brand');
        $type=$request->get('type');
        $description=$request->get('description');

        if ($productCount==0) {
            $exist =false;
        }

        if ($exist==false) {   //check all validations are fine, if not then redirect and show error messages
            return response()->make(['status'=>400,'message'=>'Product update fails. Product not found.'], 400, ['Content-Type'=>'application/json']);
        } else {
            if (isset($name) == true) {
                $product['name']=$request->get('name');
            }

            if (isset($category)==true) {
                 $product['category']=$request->get('category');
            }

            if (isset($brand)==true) {
                 $product['brand']=$request->get('brand');
            }

            if (isset($type)==true) {
                 $product['type']=$request->get('type');
            }

            if (isset($description)==true) {
                 $product['description']=$request->get('description');
            }

            Product::query()->where('code', $code)->update($product);

            return response()->make(['status'=>200,'message'=>'Product updated.'], 200, ['Content-Type'=>'application/json']);
        }
    }

    public function delete($code)
    {
        $product=collect(Product::query()->where('code', $code)->get());

        if ($product->count()==0) {
            return response()->make(['status'=>400,'message'=>'Product not found'], 400, ['Content-Type'=>'application/json']);
        } else {
             Product::query()->where('code', $code)->delete();
             return response()->make(['status'=>200,'message'=>'Product deleted.'], 200, ['Content-Type'=>'application/json']);
        }
    }
}
