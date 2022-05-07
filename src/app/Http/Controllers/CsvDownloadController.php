<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

use Illuminate\Support\Facades\Storage;
use App\Services\MallListing\YahooCsvService;

class CsvDownloadController extends Controller
{
    public function downloadCsv(Request $request)
    {
        $ids = explode(',', $request->itemId);
        $service = new YahooCsvService();
        $item = Item::whereIn('id', $ids)
            ->with(['skus' => function ($q) {
                $q->orderBy('color_display_order')->orderBy('size_display_order');
            }])
            ->get();
        $service->Listing($item);

        $this->export();
        $headers = ["Content-Type: application/octet-stream; charset=utf-8"];
        return response()->download(storage_path("app/public/ProductCsv.zip"), "ProductCsv.zip", $headers)->deleteFileAfterSend();
    }

    public function export()
    {
        $compressDir = storage_path("app/public/ProductCsv");
        $compressfileName = "$compressDir.zip";
        $command =  "cd " . $compressDir . ";" . "zip -r $compressfileName .";
        exec($command);

        $res = Storage::disk('local')->deleteDirectory("public/ProductCsv");
    }
}
