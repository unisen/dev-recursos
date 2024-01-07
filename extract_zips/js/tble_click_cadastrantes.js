var table = document.getElementById('tbl_cadastrantes');
for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].onclick = function() {
        const newLocal = this.cells[0].innerText;
        //rIndex = this.rowIndex;
        //document.getElementById("id_delete_cliente").value = newLocal;
        document.getElementById("id_cadastrante_view").value = newLocal;

        //document.getElementById("id_cadastrante_field").value = newLocal;

        document.getElementById("nomeCadastrante_id").value = newLocal;
        document.getElementById("cpf_user_cadastrante").value = this.cells[4].innerText;

        //display: grid; position: fixed; top: 50%; right: 0;
        document.getElementById("doc-cad-float").style.display = "grid";
        document.getElementById("doc-cad-float").style.position = "fixed";
        document.getElementById("doc-cad-float").style.top = "50%";
        document.getElementById("doc-cad-float").style.right = "0";

        var idCadastrante = document.getElementById("ver_dados_bancarios");
        idCadastrante.dataset.id = newLocal;

        var docCadastrante = document.getElementById("docsCadastrante-float");
        docCadastrante.dataset.id = newLocal;

        var viewCadastrante = document.getElementById("viewCadastrante-float");
        viewCadastrante.dataset.id = newLocal;

        var VerifCadastrante = document.getElementById("VerifCadastrante-float");
        VerifCadastrante.dataset.id = newLocal;

        var editCadastrante = document.getElementById("editCadastrante-float");
        editCadastrante.dataset.id = newLocal;

        var delCadastrante = document.getElementById("btnExcluir-float");
        delCadastrante.dataset.id = newLocal;

        //var UploadDocsCadastrante = document.getElementById("ver_documentos_cadastrante");
        //UploadDocsCadastrante.dataset.id = newLocal;

        setTimeout(function() {
            // Do something after 3 seconds
            // This can be direct code, or call to some other function
            var idCadastrante = document.getElementById("ver_dados_bancarios");
            idCadastrante.dataset.id = "";

            var docCadastrante = document.getElementById("docsCadastrante-float");
            docCadastrante.dataset.id = "";

            var viewCadastrante = document.getElementById("viewCadastrante-float");
            viewCadastrante.dataset.id = "";

            var VerifCadastrante = document.getElementById("VerifCadastrante-float");
            VerifCadastrante.dataset.id = "";

            var editCadastrante = document.getElementById("editCadastrante-float");
            editCadastrante.dataset.id = "";

            var delCadastrante = document.getElementById("btnExcluir-float");
            delCadastrante.dataset.id = "";

            document.getElementById("doc-cad-float").style.display = "block";
            document.getElementById("doc-cad-float").style.display = "flex";
            document.getElementById("doc-cad-float").style.display = "";

            if (document.getElementById("id_cadastrante_view") !== null) {
                document.getElementById("id_cadastrante_view").value = "";
            }


            //document.getElementById("id_cadastrante_field").value = "";


            document.getElementById("nomeCadastrante_id").value = "";

        }, 3000);

        //var tipoUsuario = this.cells[4].innerHTML;

        //document.getElementById("editar_crm").value = this.cells[2].innerHTML;

    }
};

$(document).ready(function() {
    $('.visualizar_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Editar Cadastrante request
        $.ajax({
            url: 'ajax-visualizar-cadastrante.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                // Add response in Modal body
                $('#modalViewCadastrante .modal-body').html(response);
                // Display Modal
                $('#modalViewCadastrante').modal('show');
            }
        });
    });
});


function form_uploads_documentos(id_user) {

    var userid = id_user;
    //alert(userid);
    // AJAX Editar Cadastrante request
    $.ajax({
        url: 'ajax-form-uploads.php',
        type: 'post',
        data: { userid: userid },
        success: function(response) {
            // Add response in Modal body
            $('#modalUploadDocumentos .modal-body').html(response);
            // Display Modal
            $('#modalUploadDocumentos').modal('show');
        }
    });
}


$(document).ready(function() {
    $('.dados_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Editar Cadastrante request
        $.ajax({
            url: 'ajax-editar.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                // Add response in Modal body
                $('#modalEditarCadastrante .modal-body').html(response);
                // Display Modal
                $('#modalEditarCadastrante').modal('show');
            }
        });
    });
});


/* $(document).ready(function() {
    $('.aprovar_cadastrante').click(function() {
        var userid = $(this).data('id');
        alert(userid);
        // AJAX Editar Cadastrante request

    });
}); */

$(document).ready(function() {
    $('.dados_bancarios_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Editar Cadastrante request
        $.ajax({
            url: 'ajax-editar-dados-bancarios.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                // Add response in Modal body
                //$('#modalEditarCadastrante').modal('hide');

                $('#modalEditarDadosBancarios .modal-body').html(response);
                // Display Modal

                $('#modalEditarDadosBancarios').modal('show');
            }
        });
    });
});


$(document).ready(function() {
    $('.documentos_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Documentos Cadastrante request
        $.ajax({
            url: 'ajax-documentos.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                // Add response in Modal body
                $('#modalPainelDocumentos .modal-body').html(response);
                //mostra ajax-editar no modal Documentos
                $('#modalPainelDocumentos').modal('show');
            }
        });
    });
});

$(document).ready(function() {
    $('.verificar_documentos_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Documentos Cadastrante request
        $.ajax({
            url: 'ajax-verificar-documentos.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);
                //mostra ajax-editar no modal Documentos
                $('#modalPainelDocumentos').modal('show');
            }
        });
    });
});


$(document).ready(function() {

    $('.deletar_cadastrante').click(function() {

        //var userid = $(this).data('id');
        var userid = $("#id_delete_cadastrante").val();
        //alert(userid);
        // AJAX Documentos Cadastrante request
        $.ajax({
            url: 'ajax-deletar-cadastrante.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                response = JSON.parse(response);
                //response[0] = 'sucesso';
                //alert(response[0]);

                // Add response for delete cadastrante
                if (response[0] == 'sucesso') {
                    Swal.fire({
                        title: '',
                        text: 'Cadastrante Excluido!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            var url = "?id=" + userid + "&cad=" + response[1];
                            location.replace(url);
                            //window.location.href = url;                            
                            //location.reload();
                        }
                    })
                    var url = " ?id=" + userid + "&cad=" + response[1];
                    location.replace(url);
                    //$('#delete_selecionados').modal('toggle');
                } else {
                    Swal.fire({
                        title: '',
                        text: "Erro ao excluir cadastrante: " + response,
                        icon: 'Erro',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    })
                }
            }
        });
    });
});

function uploadDocumentos(user_id) {


    //$("#loading-upload").css("display", "block !important");
    //alert("EU");
    document.getElementById('btnSubmitDocs').classList.add('loading-uploads');

    //stop jquery ajax form submit with form data example, we will post it manually.
    event.preventDefault();

    // Get form
    var form = $('#uploadDocs')[0];

    // Create an FormData object 
    var data = new FormData(form);

    // If you want to add an extra field for the FormData
    //data.append("CustomField", "This is some extra data, testing");

    // disabled the submit button
    $('#btn-upload-loading').css('display', 'inline-block');
    $("#btnSubmitDocs").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "uploads.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function(data) {
            //$("#output").text(data);
            console.log("SUCCESS : ", data);
            $("#btnSubmitDocs").prop("disabled", false);

            if (data) {
                Swal.fire({
                    title: '',
                    text: "Upload de Arquivos Realizado!",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // MOSTRA O URL COM PARAMETROS
                        document.getElementById('btnSubmitDocs').classList.remove('loading-uploads');
                        form_uploads_documentos(user_id);
                        $('#btn-upload-loading').css('display', 'none');
                        //console.log(data);
                        //sessionStorage.setItem("page_step", "3");
                        //location.href = "cadastro.php";
                        //location.href = "cadastro.php" + window.location.search + "&page=3";


                        //alert(window.location.search);
                        //console.log(result.val());
                        //location.reload();
                        //$('#enviar_mensagem').modal('toggle');
                        //$('#enviar_mensagem').find('input').val('');
                    }
                });
            }

        },
        error: function(e) {
            //$("#output").text(e.responseText);
            console.log("ERROR : ", e);
            $("#btnSubmitDocs").prop("disabled", false);

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e,

            });

        }
    });

}

/* $(document).ready(function() {
    $("#salvar_cadastrante").click(function(e) {
        //var formulario = new FormData(this);
        //console.log(formulario);
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "salvar_cadastrante_edit.php",
            data: $("#editar_cadastrante").serialize(),
            dataType: "text",
            success: function(strMessage) {
                $("#message").text(strMessage);
                if ($.trim(strMessage) == 'sucesso') {
                    Swal.fire({
                        title: '',
                        text: "Dados do Cadastrante atualizado!",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //alert('ok');
                            //location.href = "confirmacao-cadastro.php";
                            //$('.btn-proximo2').css("display", "initial");
                            //$("#btn-proximo2").removeAttr("disabled");
                            //$("#btn-proximo2").removeClass("btn-proximo2");
                            //$('#enviar_mensagem').find('input').val('');
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: strMessage,

                    });

                }
            }
        });

    });
}); */


/* $(document).ready(function() {

    $('.deletar_cadastrante').click(function() {
        var userid = $(this).data('id');
        //alert(userid);
        // AJAX Documentos Cadastrante request
        $.ajax({
            url: 'ajax-deletar-cadastrante.php',
            type: 'post',
            data: { userid: userid },
            success: function(response) {
                response = JSON.parse(response);

                //alert(response[0]);

                // Add response for delete cadastrante
                if (response[0] == 'sucesso') {
                    Swal.fire({
                        title: '',
                        text: "Cadastrante Excluido!",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            
                            var url = " ?id=" + userid + "&cad=" + response[1];
                            location.replace(url);
                            //window.location.href = url;
                            
                            //location.reload();

                        }
                    })
                    //$('#delete_selecionados').modal('toggle');
                } else {
                    Swal.fire({
                        title: '',
                        text: "Erro ao excluir cadastrante: " + response,
                        icon: 'Erro',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    })
                }
            }
        });        
    });
});  */