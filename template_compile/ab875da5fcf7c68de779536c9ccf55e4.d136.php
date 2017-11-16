<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('public/fineuploader/templates/template.html', null, null, null, '_root', null));?>

<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('modulos/'.(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null).'/view/form/clones/autor.html', null, null, null, '_root', null));?>

<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('modulos/'.(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null).'/view/form/clones/orientador.html', null, null, null, '_root', null));?>





<div class="content col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


        <div class="clearfix"></div>

            <div id="" class="row"  >
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="upload_trabalho_trigger"></div>
                    <!-- <input type="text" class="form-control" id="id_arquivo" name="<?php echo $this->scope["modulo"]["modulo"];?>[id_arquivo]" value=""> -->
                </div>
            </div>




            <div id="upload_trabalho" class="row">
                <div class="icon">
                    <i class="fa "></i>
                </div>
                <div class="content">
                    <!-- <button type="button" class="btn btn-link" data-id_trabalho=""><i class="fa fa-close"></i> Visualizar</button> -->
                </div>
            </div>


        <!-- <div id="link_trabalho" class="row"  >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label>Link do Trabalho</label>
                    <input type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[link_trabalho]" value="">
                </div>
            </div>
        </div> -->
    </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[titulo]" value="">
            </div>

            <!-- <div class="form-group">
                <label>Idioma</label>
                <br>
                <input id="idioma" name="<?php echo $this->scope["modulo"]["modulo"];?>[idioma]" style="width: 100%">
            </div> -->

            <div class="form-group">
                <label>Ano</label>
                <input type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[ano]" value="">
            </div>

            <div class="form-group">
                <label>Palavras Chave</label>
                <br>
                <input id="palavra_chave" name="<?php echo $this->scope["modulo"]["modulo"];?>[palavras_chave]" style="width: 100%">
            </div>

            <div class="form-group">
                <label>Resumo</label>
                <textarea class="form-control" rows="3" name="<?php echo $this->scope["modulo"]["modulo"];?>[resumo]"></textarea>
            </div>

<!--             <fieldset class="form-group">
                <legend>Tipo de Trabalho</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="<?php echo $this->scope["modulo"]["modulo"];?>[tipo_trabalho]" id="upload" value="upload" > Upload de Arquivo
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="<?php echo $this->scope["modulo"]["modulo"];?>[tipo_trabalho]" id="link" value="link" > Link
                    </label>
                </div>
            </fieldset> -->
        </div>

       <!--  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <button id="add_trabalho" type="button" class="btn btn-primary green_buttom">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div> -->


</div>


<script type="text/javascript">
    $('#autor').select2({
        multiple: false,
        minimumInputLength: 2,
        ajax: {
            type: 'POST',
            url: "/autor/buscar_autor_select2",
            dataType: 'json',
            data: function(term) {
                return {
                    busca: {
                        nome: term,
                        page_limit: 10,
                        cadastrar_busca: true
                    }
                };
            },
            results: function(data) {
                return {
                    results: data
                };
            }
        },
        formatResult: function(object) {
            return object.nome
        },
        formatSelection: function(object) {
            console.log(object);
            if($.isNumeric(object['id'])){
                $('#link_autor_div').html(object['link']);
                $('#email_autor_div').html(object['email']);

                $('#link_autor_div').show();
                $('#email_autor_div').show();

                $('#link_autor_input').attr('disabled', true);
                $('#email_autor_input').attr('disabled', true);
                $('#link_autor_input').hide();
                $('#email_autor_input').hide();
            }else{
                $('#link_autor_div').html('');
                $('#email_autor_div').html('');

                $('#link_autor_div').hide();
                $('#email_autor_div').hide();

                $('#link_autor_input').attr('disabled', false);
                $('#email_autor_input').attr('disabled', false);
                $('#link_autor_input').show();
                $('#email_autor_input').show();
            }

            return object.nome.replace_all('Cadastrar ', '')
        }
    });

    $('#idioma').select2({
        placeholder: $(this).data('placeholder'),
        multiple: false,
        minimumInputLength: 2,
        ajax: {
            type: 'POST',
            url: "/idioma/buscar_idioma_select2",
            dataType: 'json',
            data: function(term) {
                return {
                    busca: {
                        nome: term,
                        page_limit: 10,
                        cadastrar_busca: true
                    }
                };
            },
            results: function(data) {
                return {
                    results: data
                };
            }
        },
        formatResult: function(object) {
            return object.idioma
        },
        formatSelection: function(object) {
            return object.idioma.replace_all('Cadastrar ', '')
        }
    });


    $('#palavra_chave').select2({
        placeholder: $(this).data('placeholder'),
        multiple: true,
        minimumInputLength: 2,
        ajax: {
            type: 'POST',
            url: "/palavra_chave/buscar_palavra_chave_select2",
            dataType: 'json',
            data: function(term) {
                return {
                    busca: {
                        nome: term,
                        page_limit: 10,
                        cadastrar_busca: true
                    }
                };
            },
            results: function(data) {
                return {
                    results: data
                };
            }
        },
        formatResult: function(object) {
            console.log(object);
            return object.palavra_chave
        },
        formatSelection: function(object) {
            return object.palavra_chave.replace_all('Cadastrar ', '')
        }
    });

    // $('input[type=radio][name={$modulo.modulo}\\[tipo_trabalho\\]]').change(function() {
    //     if($('input[type=radio][name={$modulo.modulo}\\[tipo_trabalho\\]]:checked').val() == 'upload'){
    //         $('#upload_trabalho').show();
    //         $('#link_trabalho').hide();
    //     }else{
    //         $('#upload_trabalho').hide();
    //         $('#link_trabalho').show();
    //     }
    // });

     var trabalho_manualUploader = new qq.FineUploader({
        element: document.getElementById('upload_trabalho_trigger'),
        validation: {
            allowedExtensions: ["pdf"],
            sizeLimit: 50000000
        },
        template: 'qq-template-manual-trigger',
        request: {
            endpoint: "/ajax_upload/upload/",
        },
        thumbnails: {
            placeholders: {
                waitingPath: '/public/fineuploader/placeholders/waiting-generic.png',
                notAvailablePath: '/public/fineuploader/placeholders/not_available-generic.png'
            }
        },
        uploadSuccess: {
            endpoint: '/s3/success'
        },
        autoUpload: false,
        debug: true,
        multiple: false,
        callbacks: {
            onSubmit: function (id, fileName) {
                var local = {
                    local: 'trabalhos'
                }

                this.setParams(local);
            },
            onComplete: function(id, name, retorno, maybeXhr) {
                console.log(retorno);

                $('#id_arquivo').val(retorno['id']);

                // input = '<div>\n\t\t'
                //  + '<input type="hidden" value="' + retorno['id'] + '" name="imagens[' + $("#image_inputs > div").length + ']" />\n\t\t'
                //  + '</div>\n';


            }
        }
    });

    qq($('#upload_trabalho_trigger #trigger-upload').on('click', function(){
        trabalho_manualUploader.uploadStoredFiles();
    }));

    $(document).ready(function(){
        $('#add_trabalho').on('click', function(){
            var id = $("#trabalho_conteiner > div").length;

            var trabalho = ''
                + ' <div id="id_trabalho_' + id + '" class="item col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center" data-id_trabalho="' + id + '">\n\t'
                + '     <div class="icon">\n\t\t'
                + '         <i id="icone_tipo_trabalho_' + id + '" class="fa"></i>\n\t'
                + '     </div>\n'
                + '     <div class="content">\n\t'
                + '         <h3 class="title">leroelro leorler leorleor </h3>\n\t'
                + '         <p class=short_description>Primeiros 144 caracteres do Resumo do trabalho</p>\n\t'
                + '         <button type="button" class="remover_trabalho btn btn-link" data-id_trabalho="' + id + '"><i class="fa fa-close"></i> Remover</button>\n'
                + '     </div>\n'
                + ' </div>\n';

            $('#trabalho_conteiner').append(trabalho);

            $('#id_trabalho_' + id + " .short_description").html();


            $('#add_trabalho_modal :input').each(function(){
                if (typeof $(this).attr('name') !== 'undefined' && $(this).val() != '') {
                    if($(this).attr('name') == 'titulo'){
                        $('#id_trabalho_' + id + " .title").html($(this).val());
                    }

                    if($(this).attr('name') == 'resumo'){
                        $('#id_trabalho_' + id + " .short_description").html(($(this).val()).substring(0,256));
                    }

                    if($(this).attr('name') == 'tipo_trabalho'){
                        if($(this).val() == 'link' && $(this).is(':checked') != 0){
                            $('#icone_tipo_trabalho_' + id).addClass('fa-link');
                        }else if($(this).val() == 'upload' && $(this).is(':checked') != 0){
                            $('#icone_tipo_trabalho_' + id).addClass('fa-file-pdf-o');
                        }
                    }


                    if($(this).attr('name') != 'tipo_trabalho'){
                        var input = '<input id="' + $(this).attr('name') + '_' + id + '" name="[trabalho][' + id + '][' + $(this).attr('name') + ']" value="' + $(this).val() + '"> '
                        $('#id_trabalho_' + id + ' .content').append(input);
                    }

                    if($(this).attr('name') != 'tipo_trabalho'){
                        $(this).val('');
                    }

                    $(this).select2('val', '');

                }
            });

            $('#link_autor_div').html('');
            $('#email_autor_div').html('');

            $('#link_autor_div').hide();
            $('#email_autor_div').hide();

            $('.modal').modal('toggle');

            $('.remover_trabalho').on('click', function(){
                console.log($(this).data('id_trabalho'));
                $('#id_trabalho_' + id).remove();
            });
        });

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    });


    <?php if(isset($this->cadastro)) : ?>

            $('#idioma').select2(
                'data', {
                    id: "<?php echo $this->cadastro['idioma'][0]['id']; ?>",
                    idioma: "<?php echo $this->cadastro['idioma'][0]['idioma']; ?>"
                }
            );

            $('#autor').select2(
                'data', {
                    id: "<?php echo $this->cadastro['autor'][0]['id']; ?>",
                    nome: "<?php echo $this->cadastro['autor'][0]['nome']; ?>"
                }
            );

    <?php
        $palavras_chave = [];

        foreach($this->cadastro['trabalho_relaciona_palavra_chave'] as $indice => $palavra){

            $palavras_chave[] = [
                'id'        => $palavra['palavra_chave'][0]['id'],
                'palavra'   => $palavra['palavra_chave'][0]['palavra_chave']
            ];
        }

        echo 'var palavras_chave = ' . json_encode($palavras_chave);
    ?>


    $('#palavra_chave').select2(
        'data', palavras_chave
    );

        console.log(palavras_chave);

    <?php endif; ?>




    //  document.getElementById("trigger-upload")).attach("click", function() {
    // });
</script>


<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>