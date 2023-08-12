<div class='row'>
  <h5>マルチ画像</h5>
</div>
<div class='row'>
  @foreach($item->images as $image)
  <div class='col-3 p-1 border'>
    <img class='muliItemImage h-100 w-100' src="{{ $image->image_for_blade }}">
  </div>
  @endforeach
</div>
<div class="row mt-5 bulk-image-upload">
  <div class="custom-file border rounded-lg bg-light" style="height: 300px !important;">
    <div class="w-100 h-100 position-absolute d-flex justify-content-center align-items-center">
      <p class="text-center" style="font-size: 1.5rem;">一括アップロード</p>
    </div>
    <input type="file" accept="image/*" class="js-uploadMultiImages custom-file-input h-100" multiple data-url="{{ route('item-image.upload', [$item->id]) }}">
  </div>
</div>