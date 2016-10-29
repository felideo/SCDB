<script type="text/javascript">
        $(document).ready(function(){
            <?php
                if(isset($this->cadastro)){
                    echo 'var data_inicio = "' . $this->cadastro['data_inicio'] . '";';
                    echo "\n\t\t";
                    echo 'var data_fim = "' . $this->cadastro['data_fim'] . '";';
                } else {
                        echo 'var data_inicio = false;';
                        echo "\n\t\t";
                        echo 'var data_fim = false;';
                }
            ?>


        $('#inicio_bateria').datetimepicker({
            sideBySide: true,
            debug: false,
            defaultDate: data_inicio,
            format: 'DD/MM/YYYY',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });

        $('#fim_bateria').datetimepicker({
            sideBySide: true,
            debug: false,
            defaultDate: data_fim,
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

        $('#inicio_bateria').on('change', function(){
            console.log('cu');
            if($('#inicio_bateria').val() != '' && $('#fim_bateria').val() != ''){
                if($('#inicio_bateria').val() > $('#fim_bateria').val()){
                    swal("Erro", "A data final deve ser maior que a inicial!", "error");
                    $('#inicio_bateria').val('');
                    $('#fim_bateria').val('');
                   return false;
                }
            }
        });

        $('#fim_bateria').change(function(){
            console.log('cu1');

            if($('#inicio_bateria').val() != '' && $('#fim_bateria').val() != ''){
                if($('#inicio_bateria').val() > $('#fim_bateria').val()){
                    swal("Erro", "A data final deve ser maior que a inicial!", "error");
                    $('#inicio_bateria').val('');
                    $('#fim_bateria').val('');
                   return false;
                }
            }
        });

    });
</script>