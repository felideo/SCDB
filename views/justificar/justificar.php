<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Justificativa de Falta</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo URL . $this->modulo['modulo']; ?>/justificar">
                    <input type="hidden" value="<?php echo $this->tipo; ?>" name="tipo">
                    <fieldset>
                        <div class="form-group">
                            <label>Data</label>
                            <br>
                            <select class="form-group span12" name="justificar[id]" >
                                <option disabled>Selecnione</option>
                                <?php foreach ($this->faltas as $indice => $falta) : ?>
                                    <option value="<?php echo $falta['id']?>" >
                                        <?php echo $falta['data']; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row-fluid marginB10">
                                <textarea class="form-control" rows="3" name="justificar[justificativa_<?php echo $this->tipo; ?>]" ></textarea>
                            </div>
                        </div>
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Justificar">
                        <br>
                        <button id="recuperar_senha" type="button" class="btn btn-lg btn-primary btn-block voltar">Cancelar</button>
                    </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    autosize(document.querySelectorAll('textarea'));
</script>
