
/**
 * カラー画像を登録する処理
 */
$(document).on('change', 'input[type="file"].js-uploadColorImage', e => { 
  e.preventDefault()
  const target = $(e.currentTarget)
  const method = 'POST'
  const url = target.attr('data-url')
  const data = new FormData()
  data.append('image', e.currentTarget.files[0])

  window.overlayLoading.show()
    $.ajax({
        type: method,
        enctype: 'multipart/form-data',
        url,
        data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: data => {
          window.overlayLoading.hide()
          location.reload();
        },
        error: e => {
            console.error(e)
            window.overlayLoading.hide()
        }
    })
});

/**
 * マルチ画像を一括登録する処理
 */
/**
 * 一括画像アップロード処理
 */
 $(document).on('change', 'input[type="file"].js-uploadMultiImages', e => {
  e.preventDefault()
    const target = $(e.currentTarget)
    const method = 'POST'
    const url = target.attr('data-url')

//   if (max < (currentImageCount + e.currentTarget.files.length)) {
//       return alert('画像は' + max + '枚までアップロード可能です。残り' + (max - currentImageCount) + '枚アップロードすることができます。')
//   }

  var data = new FormData()
  Array.from(e.currentTarget.files).forEach((file, index) => {
      data.append('images[' + index + '][file]', file)
  })

  window.overlayLoading.show()
  $.ajax({
      type: method,
      enctype: 'multipart/form-data',
      url,
      data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: data => {
          window.overlayLoading.hide()
          location.reload();
      },
      error: e => {
          if (e.status === 422) {
              if (e.responseJSON.errors.images[0]) {
                  alert(e.responseJSON.errors.images[0])
              }
          } else {
              console.error(e)
          }
          window.overlayLoading.hide()
      }
  })
})
