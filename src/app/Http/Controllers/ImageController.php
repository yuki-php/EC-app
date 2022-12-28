<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Item;

class ImageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Item::find($request->itemId);
        $colors = $item->skus->groupBy('color_code')->map(function ($sku) {
            // return $color->first()->getColorImages();
            return [
                'color' => $sku->first()->color,
                'image' => $sku->first()->getColorImages()->first() ?? null
            ];
        });
        return view('item.image.index', compact(['item', 'colors']));
    }


    /**
     * カラー画像のアップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadColorImage(Request $request)
    {
        $color = $request->colorName;
        $item = Item::with(['color_images' => function ($q) use ($color) {
            $q->where('color', $color);
        }])->find($request->itemId);
        if (!$item->cm_number) return response()->json('先に商品番号を登録してください', 500);

        $image = $request->image;
        $count = $item->color_images->max() + 1;
        $fileName = $item->cm_number . '_' . $request->colorName . sprintf('%02d', $count) . '.' . $image->extension();
        $path = Storage::disk('HDD')->putFileAs($item->cm_number, $image, $fileName);
        $item->color_images()->create([
            'item_id' => $item->id,
            'color' => $color,
            'file_path' => $path
        ]);

        return true;
    }
    /**
     * 商品画像のアップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $item = Item::find($request->itemId);
        if (!$item->cm_number) return response()->json('先に商品番号を登録してください', 500);
        $count = $item->images->count() + 1;
        foreach ($request->images as $key => $image) {
            $fileName = $item->cm_number . '_'  . sprintf('%02d', $count) . '.' . $image['file']->extension();
            $path = Storage::disk('HDD')->putFileAs($item->cm_number, $image['file'], $fileName);
            // $path = $image['file']->storeAs('public/HDD/' . $item->cm_number,  $fileName);
            // dd($path);
            $item->images()->create([
                'item_id' => $item->id,
                'file_path' => $path,
                'display_order' => $count
            ]);
            $count++;
        }
        return true;
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
