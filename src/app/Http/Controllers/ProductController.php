<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Carbon\Carbon;

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

        // 名前での検索処理
        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }

        // 並び替え処理
        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        // ページネーション処理
        $products = $query->paginate(6)->appends($request->all());

        // 検索結果がない場合の処理
        if ($products->isEmpty()) {
            return view('index', compact('products', 'name'))->with('message', '検索結果がありません。');
        }

        return view('index', compact('products', 'name', 'sort'));
    }
}
