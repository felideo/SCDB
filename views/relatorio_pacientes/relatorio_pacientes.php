<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo URL . $this->modulo['modulo']; ?>/gerar_relatorio_pacientes">

            <div class="row-fluid">

               <div class="form-group span12">
                     <label>Bateria</label>
                     <br>
                     <select class="form-group span12" name="id_bateria" >
                        <option disabled selected>Selecnione</option>
                        <?php foreach ($this->bateria_list as $indice => $bateria) : ?>
                            <option value="<?php echo $bateria['id']?>" >
                                De: <?php echo $bateria['data_inicio']; ?> a <?php echo $bateria['data_fim']; ?>
                            </option>
                        <?php endforeach ?>
                     </select>
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