function extrair_pasta(userid) {
    //alert('kkk');

    $.ajax({
        url: '../ajax-extrair.php',
        type: 'post',
        data: { userid: userid },
        success: function(response) {
            if (response[0] == 'sucesso') {
                alert("Pasta Extraída com sucesso!");
            } else {
                alert("Pasta não extraída!");
            }
        }
    });
}