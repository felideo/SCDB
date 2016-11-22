<div class="row-fluid">
    <div class="span12">
        <form method="post"
            id="lazy_view"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span8">
                    <label>Email</label>
                    <input class="form-control validar_email letras_e_numeros remover_caracteres_especiais" <?php if(isset($this->cadastro)){echo 'disabled';} ?> value="<?php if(isset($this->cadastro)){echo $this->cadastro['email'];} ?>" required>
                </div>
                <div class="form-group span4">
                     <label>Hierarquia</label>
                     <br>
                     <select class="form-group span12" name="<?php echo $this->modulo['modulo']; ?>[hierarquia]" >
                        <option disabled>Selecnione</option>
                        <?php foreach ($this->hierarquia_list as $indice => $hierarquia) : ?>
                            <option value="<?php echo $hierarquia['id']?>" <?php if(isset($this->cadastro) && $this->cadastro['hierarquia'] == $hierarquia['id']){echo ' selected ';} ?> >
                                <?php echo $hierarquia['nome']; ?>
                            </option>
                        <?php endforeach ?>
                     </select>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <?php if(isset($this->cadastro)) : ?>
                            Editar <?php echo $this->modulo['send']; ?>
                        <?php else : ?>
                            Cadastrar Novo <?php echo $this->modulo['send']; ?>
                        <?php endif?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.validar_email').change(function(){

            if($('.validar_email').val() == ''){
            return false;
            }

            if (!validar_email($('.validar_email').val())) {
                swal("Erro", "Digite um email válido!", "error");
                $('.validar_email').val('');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: "<?php echo URL; ?>usuario/verificar_duplicidade_ajax",
                data: {
                    usuario: $('.validar_email').val()
                },
                dataType: 'json',
                async: false,
                beforeSend: function(){
                    carregar_loader('show');
                },
                success: function(dados) {
                    if(dados == false){
                        swal({
                            title: 'Erro',
                            text: 'Email ja cadastrado no sistema!',
                            type: 'error',
                            tconfirmButtonText: 'OK'
                        });

                        $('.validar_email').val('');
                    } else {
                        setTimeout("carregar_loader('hide');", 1000);
                    }
                }
            });
        });
    });
</script>