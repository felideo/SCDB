<script type="text/javascript">
    $(document).ready(function(){
        $('#clone_relacao').on('click', function(){
            var container_clone = $('#container_clone');
            var id_container_clone = get_id_proximo_itens_clone(container_clone);

            $('#nenhum_clone_adicionado').hide();

            var clone = $('#clonar').html();
            clone = clone.replaceAll("$id_clone", id_container_clone);
            clone = clone.replaceAll("disabled", "", clone);

            container_clone.prepend(clone);

            $('#clone_' + id_container_clone).find('.remove-box').click(function() {
                $('#clone_' + $(this).data('id_remover')).remove();
            });

            atualizar_datepicker(id_container_clone, false);
        });


    });

    $(window).load(function(){
        <?php
            if(isset($this->relacoes_list)){
                foreach ($this->relacoes_list as $indice => $relacao) {
                    $indice_div = $indice + 1;
                    echo "$('#clone_relacao').trigger('click');\n\t\t";
                    echo "$('div#relacao_aluno_" . $indice_div . " select').val(" . $relacao['id_aluno'] . ");\n\t\t";
                    echo "$('div#relacao_paciente_" . $indice_div . " select').val(" . $relacao['id_paciente'] . ");\n\t\t";

                    if(isset($this->cadastro)){
                        echo "$('div#relacao_aluno_" . $indice_div . " :input').prop('disabled', true);\n\t\t";
                        echo "$('div#relacao_paciente_" . $indice_div . " :input').prop('disabled', true);\n\t\t";
                    }
                }
            }
        ?>
    });

    String.prototype.replaceAll = function(search, replacement){
        var target = this;
        return target.split(search).join(replacement);
    }

    function get_id_proximo_itens_clone(id_container_clone) {
        return ($('#container_clone').children(":not(#nenhum_clone_adicionado)").first().data('id_clone') + 1 || 1);
    }

    function atualizar_datepicker(id){
        $('#data_agendamento_' +  id).datetimepicker({
            sideBySide: true,
            debug: false,
            format: 'DD/MM/YYYY',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            },

            daysOfWeekDisabled: [
                0,
                6
            ]
        });

        $('#data_agendamento_' + id).keydown(function(){
            swal("Erro", "Selecione uma data no calendario a baixo!", "error");
                $('#data_agendamento_' + id).val('');
        });

        $('#data_agendamento_' + id).val('')
    }


</script>