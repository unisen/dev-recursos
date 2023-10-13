<!-- Modal DELETE CLIENTE -->
<div class="modal fade show" id="modalChangeFields" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCenterTitle">Alterar Campos da Tabela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalChangeFields_" name="modalChangeFields_" action="" method="POST" class="form-horizontal">
                <div class="modal-body">
                    <p>Deseja realmente Alterar os Campos da Tabela: </p>
                    <input type="hidden" name="database_name" id="database_name" value="">
                    <input type="hidden" name="table_change" id="table_change" value="">
                    <p id="nomeTabelaChange"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="alterar_tabela btn btn-danger" onclick="alterar_sql_ajax()">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>
