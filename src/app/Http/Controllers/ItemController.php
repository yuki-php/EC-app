<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Maker;

class ItemController extends Controller
{
    public function index(request $request)
    {
        $items = Item::sortable()->paginate(50);

        return view('/index',compact('items'));
    }

    public function show(request $request)
    {
        $makers = Maker::all();
        $item = Item::with(['images', 'color_images', 'categories', 'maker'])
        ->with(['skus' => function ($q) {
            $q->orderby('size_display_order')
            ->orderBy('color_display_order')
            ->orderBy('type3_display_order');
        }])
            ->find($request->itemId);

        $packShape = Item::PACKING_SHAPE;
        return view('item.show', compact('item', 'makers', 'packShape'));
    }

    public function update(Request $request)
    {
        $item = Item::find($request->item_id);
        $item->update($request->all());
        foreach ($request->sku as $skuId => $value) {
            $item->skus()->where('id', $skuId)->update($value);
        }

        return back()->with('success', '更新しました!');
    }
}
