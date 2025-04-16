<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Products_Seasons;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Product::query();

        // 並び替え条件を取得
        $sort = $request->input('sort');

        if ($sort === 'high') {
        $query->orderBy('price', 'desc'); // 高い順
        } elseif ($sort === 'low') {
        $query->orderBy('price', 'asc'); // 低い順
        }

        // 商品を取得
        $products = $query->paginate(6);
        return view('product', compact('products', 'sort'));
    }

    public function search(Request $request)
    {
        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // ローカルスコープを使用して商品を検索
        $products = Product::searchByName($keyword)->paginate(6);

        // 検索結果をビューに渡す
        return view('search', compact('products', 'keyword'));
    }
    public function show($id)
    {
        // 指定されたIDの商品を取得
        $product = Product::with('seasons')->findOrFail($id);

        // 商品詳細ビューにデータを渡す
        return view('detail', compact('product'));
    }

    public function update(PatchRequest $request, $id)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 商品を取得
        $product = Product::findOrFail($id);

        // 商品情報を更新
        $product->name = $validated['name'];
         $product->price = $validated['price'];
         $product->description = $validated['description'];

        // 画像のアップロード処理
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('public/fruits-img', 'public');
            $product->image = $path;
         }

        // 季節の関連付けを更新
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id')->toArray();
        $product->seasons()->sync($seasonIds);

         $product->save();

        return redirect()->route('products.index')->with('success', '商品情報を更新しました。');
    }

    public function destroy($id)
    {
        // 商品を取得
        $product = Product::findOrFail($id);

        // 商品を削除
        $product->delete();

        // 削除後、商品一覧ページにリダイレクト
        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        // 画像の保存
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('public/fruits-img'); 
        $validated['image'] = basename($path); 
    }

        // 商品データの保存
        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->image = $validated['image'];
        $product->description = $validated['description'];
        $product->save();

        // 季節の関連付け
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id')->toArray();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }
}
