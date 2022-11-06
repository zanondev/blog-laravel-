var redirectToList = function () {
    window.location.href = url_to_redirect;
}

var addPostCategory = function () {

    var data = new FormData(document.getElementById('add-post-category'));

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
        data: data,
        dataType: 'json',
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".loading-form").width('0%');
        },
        success: function (retorno) {

            $('input[type="submit"]').removeClass('disabled');
            if (retorno.status == 1) {
                showModalSmallResponse(retorno.msg, 'success');
                setTimeout(redirectToList(), 2000);
            } else {
                showModalSmallResponse(retorno.msg, 'error');
            }
        },
        error: function (retorno) {
            $('input[type="submit"]').removeClass('disabled');
            showModalSmallResponse("Ocorreu um erro ao efetuar a operação. Por favor, entre em contato com o Suporte.", 'error')
        }
    });
}

var editPostCategory = function () {

    var data = new FormData(document.getElementById('edit-post-category'));

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
        data: data,
        dataType: 'json',
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".loading-form").width('0%');
        },
        success: function (retorno) {

            $('input[type="submit"]').removeClass('disabled');
            if (retorno.status == 1) {
                showModalSmallResponse(retorno.msg, 'success');
                setTimeout(redirectToList(), 2000);
            } else {
                showModalSmallResponse(retorno.msg, 'error');
            }
        },
        error: function (retorno) {
            $('input[type="submit"]').removeClass('disabled');
            showModalSmallResponse("Ocorreu um erro ao efetuar a operação. Por favor, entre em contato com o Suporte.", 'error')
        }
    });
}

$('#add-post-category').submit(function (e) {

    let form = $(this);
    e.preventDefault();

    if (validateInputs(form) && validateImages(form) && validatePassword(form)) {
        $('input[type="submit"]').addClass('disabled');
        addPostCategory();
    }
});

$('#edit-post-category').submit(function (e) {

    let form = $(this);
    e.preventDefault();

    if (validateInputs(form) && validateImages(form) && validatePassword(form)) {
        $('input[type="submit"]').addClass('disabled');
        editPostCategory();
    }
});
