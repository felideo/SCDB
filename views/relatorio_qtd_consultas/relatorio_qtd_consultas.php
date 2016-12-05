<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo URL . $this->modulo['modulo']; ?>/gerar_relatorio_qtd_consultas">

            <div class="row-fluid">

                <div class="form-group span6" style="position: relative;">
                    <label>Data Inicial:</label>
                    <input id="inicio_bateria" autocomplete="off" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_inicio]" required>
                </div>
                <div class="form-group span6" style="position: relative;">
                    <label>Data Final:</label>
                    <input id="fim_bateria" autocomplete="off" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_fim]" required>
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span12">
                    <button type="submit" class="btn btn-success" style="float: right;">Geral <?php echo $this->modulo['send']; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#inicio_bateria').datetimepicker({
            sideBySide: true,
            debug: false,
            format: 'DD/MM/YYYY',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        $('#fim_bateria').datetimepicker({
            sideBySide: true,
            debug: false,
            format: 'DD/MM/YYYY',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        $('#inicio_bateria').keydown(function(){
            swal("Erro", "Selecione uma data no calendario a baixo!", "error");
                $('#inicio_bateria').val('');
        });

        $('#fim_bateria').keydown(function(){
            swal("Erro", "Selecione uma data no calendario a baixo!", "error");
                $('#fim_bateria').val('');
        });



        $('#submit').on('click', function(){

            var inicio_bateria =  moment($('#inicio_bateria').val(), "DD-MM-YYYY");
            var fim_bateria = moment($('#fim_bateria').val(), "DD-MM-YYYY");

            if(inicio_bateria > fim_bateria){
                swal("Erro", "A data final deve ser maior que a inicial!", "error");

                $('#inicio_bateria').val('');
                $('#fim_bateria').val('');

                return false;
            }
        });

    });
</script>