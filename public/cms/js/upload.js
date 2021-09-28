$('#editor').summernote({
    placeholder: 'Tulis di sini..',
    tabsize: 2,
    height: 300,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        }
    }
});

function uploadImage(image) {
    //modalWaiting.show();

    
    
    const limitSize = image.size / 1000;
    if(limitSize > 1000)
    {
        Swal.fire("Ukuran gambar maksimal adalah 1Mb");

        return false;
    }
    var data = new FormData();
    data.append("image", image);
    var base = $('.baseUrl').val() + '/upload-image';
    const token = $('meta[name="X-CSRF-TOKEN"]').attr('content'); 

    Swal.showLoading();
    $.ajax({
        url: base,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        },
        success: function(url) {
            $('#editor').summernote("insertImage", url);
            Swal.hideLoading()
        },
        error: function(data) {
            Swal.hideLoading()
            Swal.fire("Error Upload...");
        }
    });
};

function checkImage(e)
{
    const image = e.files;
    const many = image.length;
    
    for(let i=0; i<many; i++) {
        const imageSize = image[i].size;
        if(imageSize > 1000)
        {
            const limitSize = imageSize / 1000;
            if(limitSize > 1000)
            {
                const ef = document.querySelector('.file-upload-image');
                ef.value = "";

                Swal.fire("Ukuran gambar maksimal adalah 1Mb");
                
                return false;
            }
        }
    }
};