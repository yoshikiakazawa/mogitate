<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Carbon\Carbon;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::Paginate(6);
        return view('products/index', compact('products'));
    }

    public function search(Request $request) {
        $name = $request->name;
        $sort = $request->input('sort');
        $query = Product::query();
        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }
        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->paginate(6)->appends($request->all());
        if ($products->isEmpty()) {
            return view('products/index', compact('products', 'name'))->with('message', '検索結果がありません。');
        }
        return view('products/index', compact('products', 'name', 'sort'));
    }

    public function create()
    {
        return view('products/register');
    }

    public function detail($productId)
    {
        $product = Product::find($productId);
        return view('products/detail', compact('product'));
    }

    public function update(ProductRequest $request,$productId)
    {
        $product = Product::find($productId);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = storage_path('app/public/images/' . $filename);
        $image->move(storage_path('app/public/images'), $filename);
        $path = '/storage/images/' . $filename;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $path;
        $product->description = $request->description;
        $product->save();
        $product->seasons()->sync($request->input('seasons', []));
        return redirect()->back()->with('message', '変更しました。');
    }

    public function delete($productId)
    {
        $product = Product::find($productId)->delete();
        session()->flash('fs_msg', '削除しました。');
        return redirect()->route('index');
    }

    public function store(ProductRequest $request)
    {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = storage_path('app/public/images/' . $filename);
        $image->move(storage_path('app/public/images'), $filename);
        $path = '/storage/images/' . $filename;
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description,
        ]);
        $product->seasons()->sync($request->input('seasons', []));
        session()->flash('fs_msg', '登録しました。');
        return redirect()->route('index');
    }
}
