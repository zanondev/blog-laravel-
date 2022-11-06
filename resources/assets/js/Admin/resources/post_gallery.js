var redirectToList = function () {
    window.location.reload();
}

$("input[name='images']").on("change", function (e) {

    var imageCount = document.getElementById("images").files.length;

    $(".images-to-add .preview-img").not(".div-to-add").remove()

    for (var i = 0; i < imageCount; i++) {

        var image = document.getElementById("images").files[i];

        if (!image.type.includes("image")) {
            showModalSmallResponse("Selecione apenas imagens! (Formatos jpg, png ou gif)", 'error');
            return false;
        }

        let div = $(".preview-img.div-to-add").clone();
        div.removeClass("div-to-add");
        div.find(".alt-text").removeAttr("hidden");

        var reader = new FileReader();

        reader.onload = function (e) {

            div.css('background-image', 'url(' + e.target.result + ')').addClass("w-background")

        }

        reader.readAsDataURL(image);

        $(".div-to-add").before(div);
    }



})

$(".geral-gallery-form").submit(function (e) {

    e.preventDefault();

    var imageCount = document.getElementById("images").files.length;

    if (imageCount > 20) {
        showModalSmallResponse("Selecione 20 imagens por vez! (Formatos jpg, png ou gif)", 'error');
        return false;
    }

    if (imageCount == 0) {
        showModalSmallResponse("Selecione ao menos uma imagem para poder fazer o upload.", 'error');
        return false;

    }

    // Loading
    var values = new FormData();
    values.append('image_count', imageCount);

    let image_alt = [];

    $("input[name='image_alt[]']").each(function () {
        image_alt.push($(this).val())
    });

    values.append('image_alt', image_alt);
    values.append('_token', $("input[name='_token']").val());
    values.append('post_id', $("input[name='post_id']").val());

    for (var i = 0; i < imageCount; i++) {

        var image = document.getElementById("images").files[i];

        if (!image.type.includes("image")) {
            showModalSmallResponse("Selecione apenas imagens! (Formatos jpg, png ou gif)", 'error');
            return false;
        }

        let div = $(".preview-img.div-to-add").clone();
        div.removeClass("div-to-add");

        values.append('image' + i, image);

    }

    $('input[type="submit"]').addClass('disabled');

    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = ((evt.loaded / evt.total) * 100);
                    percentComplete = Math.round(percentComplete);
                    $(".loading-form").width(percentComplete + '%');
                }
            }, false);
            return xhr;
        },
        url: url,
        type: "POST",
        data: values,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $(".loading-form").width('0%');
        },
        success: function (retorno) {
            $('input[type="submit"]').removeClass('disabled');
            if (retorno.status == 1) {
                showModalSmallResponse(retorno.msg, 'success')
                setTimeout(() => { window.location.reload() }, 2000);
            } else {
                showModalSmallResponse(retorno.msg, 'error')
            }
        },
        error: function (retorno) {
            $('input[type="submit"]').removeClass('disabled');
            showModalSmallResponse("Ocorreu um erro ao efetuar a operação. Por favor, entre em contato com o Suporte.", 'error')
        }
    });
});

$(".input_image_alt").on("blur", function () {

    let id = $(this).parents(".image-item").find(".id").val();
    let image_alt = $(this).parent().find(".alt").val();
    $(".input_image_alt").addClass("disabled");

    $.ajax({
        url: url_update,
        type: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            alt_text: image_alt,
            _token: $("input[name='_token']").val()
        },
        success: function (retorno) {
            $(".input_image_alt").removeClass("disabled");

            if (retorno.status != 1) {
                showModalSmallResponse(retorno.msg, 'error')
            }
        },
        error: function (retorno) {
            $(".input_image_alt").removeClass("disabled");
            showModalSmallResponse("Ocorreu um erro interno de sistema, tente novamente mais tarde.", 'error')
        }
    });

})

$(".remove-gallery-image").click(function () {
    var id = $(this).data("value");
    var confirma = confirm('Deseja realmente remover este item? Esta ação é irreversível.');
    if (confirma) {
        $.ajax({
            url: url_delete,
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                _token: $("input[name='_token']").val()
            },
            success: function (retorno) {
                if (retorno.status == 1 || retorno.status == 2) {
                    showModalSmallResponse(retorno.msg, 'success')
                    setTimeout(redirectToList, 2000);
                }
            }
        });
    }
});