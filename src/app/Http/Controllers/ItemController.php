<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function index(request $request)
    {
        $items = Item::sortable()->paginate(50);

        return view('/index',compact('items'));
    }

    public function show(request $request)
    {
        $item = Item::with('skus')->find($request->itemId);
        dd($item);
    }
}
