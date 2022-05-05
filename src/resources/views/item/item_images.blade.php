<div>
  <div class=' clearfix'>
    <h5 class='d-inline'>画像</h5>
    <a href="{{route('item-image.show',['itemId' => $item->id])}}" class='btn btn-primary float-right p-1'>詳細</a>
  </div>
  <div class='row'>
    <div class='image-container container-fluid'>
      @if($item->images->isNotEmpty())
      <div class="slick-box">
        @foreach($item->images as $image)
        <div>
          <img src="{{ $image->url }}">
        </div>
        @endforeach
        <div>
          <img id='upImage' src="{{ asset('storage/icon/no_image.png') }}" alt="" class='m-0'>
          <input id="image_file" type="file" name="fileinput"  class="d-none"  accept="image/*" multiple="multiple"/>
        </div>
      </div>
      @else
      <div>
        <img id='upImage' src="{{ asset('storage/icon/no_image.png') }}" alt="">
        <input id="image_file" type="file" name="fileinput"  class="d-none"  accept="image/*" multiple="multiple"/>
      </div>
      @endif
    </div>
  </div>
</div>