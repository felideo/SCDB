<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="col-lg-4 col-md-4"><i class="fa fa-bell fa-fw"></i> Relação Aluno x Paciente </h4>
                <button id="clone_relacao" type="button" class="btn btn-primary" style="float: right;"> adicionar relação </button>
                <div style="display:block; clear: both;"></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group" id="container_clone">
                    <div id="nenhum_clone_adicionado">Nenhum item adicionado.</div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4" id="clonar" >
        <div class="panel panel-default" data-id_clone="$id_clone" id="clone_$id_clone">
            <div class="panel-heading">
                <h4><i class="fa fa-fw"></i>Clone => $id_clone</h4>
                <button type="button" class="btn btn-primary remove-box" data-id_remover="$id_clone" style="float: right;"> Remover </button>
                <div style="display:block; clear: both;"></div>
            </div>
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="form-group span3">
                         <label>Paciente</label>
                         <br>
                         <select class="form-group span12" name="<?php echo $this->modulo['modulo']; ?>[id_submenu]" >
                            <option></option>
                            <?php foreach ($this->paciente_list as $indice => $paciente) : ?>
                                <option value="<?php echo $paciente['id']?>" >
                                    <?php echo $paciente['nome']; ?>
                                </option>
                            <?php endforeach ?>
                         </select>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>


<script type="text/javascript">
    $(document).ready(function(){

        $('#clone_relacao').on('click', function(){
            var container_clone = $('#container_clone');
            console.log(container_clone);
            var id_container_clone = get_id_proximo_itens_clone(container_clone);

            $('#nenhum_clone_adicionado').hide();

            var clone = $('#clonar').html();
            clone = clone.replaceAll("$id_clone", id_container_clone);
            // clone = str_replace("disabled=\"disabled\"", "", clone);

            container_clone.prepend(clone);

            $('#clone_' + id_container_clone).find('.remove-box').click(function() {
                console.log(this);
                console.log($(this).data('id_remover'));
                $('#clone_' + $(this).data('id_remover')).remove();
            });
        });
    });

    String.prototype.replaceAll = function(search, replacement){
        var target = this;
        return target.split(search).join(replacement);
    }

    function get_id_proximo_itens_clone(id_container_clone) {
        return ($('#container_clone').children(":not(#nenhum_clone_adicionado)").first().data('id_clone') + 1 || 0);
    }

</script>