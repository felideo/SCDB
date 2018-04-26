<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <section class="module">
        <div class="module-inner">
            <div class="module-heading">
                <h3 class="module-title">Listagem de <?php echo $this->scope["modulo"]["name"];?></h3>
            </div>
            <div class="module-content collapse in" id="content-listagem-<?php echo $this->scope["modulo"]["modulo"];?>">
                <div class="module-content-inner no-padding-bottom">
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped display dataTable responsive" role="grid">
                            <thead>
                                <tr>
                                    <?php 
$_fh0_data = (isset($this->scope["colunas_datatable"]) ? $this->scope["colunas_datatable"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['coluna'])
	{
/* -- foreach start output */
?>

                                        <?php echo $this->scope["coluna"];?>

                                    <?php 
/* -- foreach end output */
	}
}?>

                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                </tr>
                            </tfoot> -->
                            <tbody>
                                <?php if (! empty($this->scope["linhas_datatable"])) {
?>

                                    <?php 
$_fh2_data = (isset($this->scope["linhas_datatable"]) ? $this->scope["linhas_datatable"] : null);
if ($this->isTraversable($_fh2_data) == true)
{
	foreach ($_fh2_data as $this->scope['linhas'])
	{
/* -- foreach start output */
?>

                                        <tr role="row" class="gradeA odd">
                                            <?php 
$_fh1_data = (isset($this->scope["linhas"]) ? $this->scope["linhas"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['coluna_linha\''])
	{
/* -- foreach start output */
?>

                                                <?php echo $this->scope["coluna_linha"];?>

                                            <?php 
/* -- foreach end output */
	}
}?>

                                        </tr>
                                    <?php 
/* -- foreach end output */
	}
}?>

                                <?php 
}?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('#data_table').DataTable({
        "order": [[ 0, "desc" ]],
        "bProcessing": true,
        "serverSide": true,
        "responsive": true,
        "scrollX": false,
        "language": {
            "url": "/public/back/js/DataTable-Portuguese-Brasil.json"
        },
        "ajax":{
            url :"/<?php echo $this->scope["modulo"]["modulo"];?>/carregar_listagem_ajax",
            type: "post",
            error: function(){
            },
            complete: function(){
                $.each($('.validar_deletar'), function(index, item){
                    var link_deletar = $(this).attr('data-redirecionamento');
                    var id_deletar = $(this).attr('data-id_registro');



                    $(this).on('click', function(){
                        swal({
                             title: "Tem certeza que deseja deletar o registro?",
                             text: "Está operação é irreversivel e de sua inteira responsabilidade!",
                             // type: "input",
                             showCancelButton: true,
                             closeOnConfirm: false,
                             animation: "slide-from-top",
                             // inputPlaceholder: "email@email.com.br",
                             showLoaderOnConfirm: true,
                        },
                        function(inputValue){
                            if(inputValue){
                                window.location.href = link_deletar;
                            }
                        });
                    });
                });
            }
        }
    });
});
</script>


<script type="text/javascript">

        $('.validar_deletar').on('click', function(){
        swal({
              title: "Tem certeza que deseja deletar esse registro?",
              // text: "Digite seu Email",
              // type: "input",
              showCancelButton: true,
              closeOnConfirm: false,
              animation: "slide-from-top",
              // inputPlaceholder: "email@email.com.br",
              showLoaderOnConfirm: true,
            },
            function(inputValue){
                window.location.href = $(this).data('cu');
            });
        })
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>