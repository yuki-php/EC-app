<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Item;
use App\Models\Maker;

class ItemController extends Controller
{
    public function index(request $request)
    {
        // キーワードを取得
        $keyword = $request->input('keyword');
        $search_target = $request->input('search_target') ??  'cm_number';
        $search_maker_id = $request->input('search_maker_id');

        $pagination_params = [
            'keyword' => $keyword,
            'search_target' => $search_target,
            'search_maker_id' => $search_maker_id,
        ];

        $items = Item::sortable()
            ->when(
                $keyword,
                function ($query) use ($search_target, $keyword) {
                    if ($search_target === 'item_name') {
                        return $query->where('maker_item_name', 'like', '%' . $keyword . '%')
                            ->orWhere('name', 'like', '%' . $keyword . '%');
                    }
                    return $query->where($search_target, 'like', '%' . $keyword . '%');
                }
            )
            ->when(
                $search_maker_id,
                function ($query) use ($search_maker_id) {
                    return $query->where('maker_id', $search_maker_id);
                }
            )
            ->paginate(50);
        $makers = Maker::all();
        $file = Storage::disk('HDD')->path('test/lack/3329097_1017.jpg');
        dd($file);
        $tt = Storage::disk('public')->putFile(
            'HDD/test',
            Storage::disk('public')->path('icon/camera.jpeg'),
            'public'
        );

        return view('/index', compact('items', 'makers', 'sample', 'pagination_params'));
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
