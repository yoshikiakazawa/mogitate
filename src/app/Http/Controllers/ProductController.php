<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Carbon\Carbon;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::Paginate(6);
        return view('index', compact('products'));
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
            return view('index', compact('products', 'name'))->with('message', '検索結果がありません。');
        }
        return view('index', compact('products', 'name', 'sort'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('detail', compact('product'));
    }

    public function update(UpdateProductRequest $request,$id)
    {
        $product = Product::find($id);

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
        return redirect()->back()->with('message', '登録を変更しました。');
    }

    public function delete($id)
    {
        $product = Product::find($id)->delete();
        session()->flash('fs_msg', '削除しました');
        return redirect()->route('index');
    }
}
