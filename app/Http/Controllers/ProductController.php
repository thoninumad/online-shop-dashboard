<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Gate::allows('manage-products')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if($status) {
            $products = \App\Product::with('categories')->where('name', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $products = \App\Product::with('categories')->where('name', "LIKE", "%$keyword%")->paginate(10);
        }

        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "name" => "required|min:5|max:191",
            "description" => "required|min:20|max:1000",
            "producer" => "string|max:191",
            "price" => "required|digits_between:0,10",
            "weight" => "required|digits_between:0,10",
            "stock" => "required|digits_between:0,10",
            "image" => "required|image",
            "categories" => "required"
        ])->validate();

        $new_product = new \App\Product;

        $new_product->name = $request->get('name');
        $new_product->description = $request->get('description');
        $new_product->producer = $request->get('producer');
        $new_product->price = $request->get('price');
        $new_product->weight = $request->get('weight');
        $new_product->stock = $request->get('stock');

        $new_product->status = $request->get('save_action');

        $image = $request->file('image');
        if($image) {
            $image_path = $image->store('product-images', 'public');
            $new_product->image = $image_path;
        }

        $new_product->slug = str_slug($request->get('name'));
        $new_product->created_by = \Auth::user()->id;

        $new_product->save();
        $new_product->categories()->attach($request->get('categories'));

        if($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('products.create')->with('status', 'Product successfully saved and published');
        } else {
            return redirect()->route('products.create')->with('status', 'Product saved as draft');
        }
    }

    public function show($id)
    {
        $product = \App\Product::with('categories')->findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = \App\Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:5|max:191",
            "slug" => [
                "required",
                Rule::unique("products")->ignore($product->slug, "slug")
            ],
            "description" => "required|min:20|max:1000",
            "producer" => "string|max:191",
            "price" => "required|digits_between:0,10",
            "weight" => "required|digits_between:0,10",
            "stock" => "required|digits_between:0,10",
            "categories" => "required"
        ])->validate();

        $product->name = $request->get('name');
        $product->slug = $request->get('slug');
        $product->description = $request->get('description');
        $product->producer = $request->get('producer');
        $product->stock = $request->get('stock');
        $product->price = $request->get('price');
        $product->weight = $request->get('weight');

        $new_image = $request->file('image');

        if($new_image) {
            if($product->image && file_exists(storage_path('app/public/'.$product->image))) {
                \Storage::delete('public/'.$product->image);
            }

            $new_image_path = $new_image->store('product-images', 'public');
            $product->image = $new_image_path;
        }

        $product->updated_by = \Auth::user()->id;
        $product->status = $request->get('status');
        $product->save();
        $product->categories()->sync($request->get('categories'));
        return redirect()->route('products.edit', ['id' => $product->id])->with('status', 'Product successfully updated');
    }

    public function destroy($id)
    {
        $product = \App\Product::findOrFail($id);

        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product moved to trash');
    }

    public function trash(){
        $products = \App\Product::onlyTrashed()->paginate(10);
        return view('products.trash', ['products' => $products]);
    }

    public function restore($id) {
        $product = \App\Product::withTrashed()->findOrFail($id);

        if($product->trashed()) {
            $product->restore();
            return redirect()->route('products.trash')->with('status', 'Product successfully restored');
        } else {
            return redirect()->route('products.trash')->with('status', 'Product is not in trash');
        }
    }

    public function deletePermanent($id) {
        $product = \App\Product::withTrashed()->findOrFail($id);

        if(!$product->trashed()) {
            return redirect()->route('products.trash')->with('status', 'Product is not in trash')->with('status_type', 'alert');
        } else {
            $product->categories()->detach();
            $product->forceDelete();
            if($product->image && file_exists(storage_path('app/public/'.$product->image))) {
                \Storage::delete('public/'.$product->image);
            }

            return redirect()->route('products.trash')->with('status', 'Product permanently deleted!');
        }
    }

}
