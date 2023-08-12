<div class='row w-100'>
  <h5>カラー画像</h5>
</div>
<div class='row border'>
  @foreach($colors as $key => $value)
  <div  class="col-3 position-relative p-0 border">
    <div  class="position-relative">
        @if($value['image'] ?? null)
        <div class="w-100 d-flex justify-content-center align-items-center bg-light" style="height: 200px; width: 200px;">
          <img
            src="{{ $value['image']->color_image_for_blade }}"
            class="w-100 h-100 d-block js-mallImageName"
          />
        </div>
        @else
          <div class="w-100 d-flex justify-content-center align-items-center bg-light" style="height: 200px; width: 200px;">
            <i class="fas fa-camera fa-3x"></i>
          </div>
        @endif
        <input
          type="file"
          class="js-uploadColorImage position-absolute w-100 h-100  cursor-pointer"
          style="top: 0; opacity: 0;"
          accept="image/*"
          data-form="mallImage"
          data-url="{{ route('item-color-image.upload', [$item->id, $key]) }}"
        >
      </div>
      <div class="text-center">
        <p class="my-1" style="font-size: 0.5rem;">
          {{$value['color']}}
        </p>
      </div>
    </div>
  @endforeach
</div>