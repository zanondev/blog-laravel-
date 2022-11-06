var redirectToList = function() {
    window.location.href = url_to_redirect;
}

$(".remove-item").click(function() {

	var id    = $(this).data("value");
	var confirma = confirm('Deseja realmente remover este item? Esta ação é irreversível.');
	if(confirma){
		$.ajax({
			url      : url_delete,
			type     : 'PUT',
			dataType : 'JSON',
			data     : {id : id, _token: $('input[name="_token"]').val()},
			success  : function(retorno){
				if(retorno.status == 1 || retorno.status == 2){
					showModalSmallResponse(retorno.msg, 'success')
					setTimeout(redirectToList, 2000);
				}
			}
		});
	}
});

$(".remove-multiple-itens").click(function() {

    let inputs = [];

    $("input[name='delete-itens[]']").each(function(){
        if($(this).prop("checked")){
            inputs.push($(this).val())
        }
    });

    var confirma = confirm('Deseja realmente remover estes itens? Esta ação é irreversível.');
    if(confirma){
        $.ajax({
            url      : url_delete_multiple,
            type     : 'PUT',
            dataType : 'JSON',
            data     : {inputs : inputs, _token: $('input[name="_token"]').val()},
            success  : function(retorno){
                if(retorno.status == 1 || retorno.status == 2){
                    showModalSmallResponse(retorno.msg, 'success')
                    setTimeout(redirectToList(), 2000);
                }
            }
        });
    }
});
