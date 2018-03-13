<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <section class="module">
        <div class="module-inner">
            <div class="module-heading">
                <h3 class="module-title"><?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?>Editar <?php echo $this->scope["modulo"]["send"];

}
elseif (! empty($this->scope["lazy_view"])) {
?>Visualizar <?php echo $this->scope["modulo"]["send"];

}
else {
?>Cadastrar <?php echo $this->scope["modulo"]["send"];

}?></h3>
                <ul class="actions list-inline">
                    <li><a class="collapse-module" data-toggle="collapse" href="#content-6" aria-expanded="false" aria-controls="content-6"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                </ul>
            </div>
            <form method="post" class="lazy_view" id="lazy_view"
                <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?>

                    action="/<?php echo $this->scope["modulo"]["modulo"];?>/update/<?php echo $this->scope["cadastro"]["id"];?>"
                <?php 
}
else {
?>

                    action="/<?php echo $this->scope["modulo"]["modulo"];?>/create"
                <?php 
}?>

            >
                <div class="module-content collapse in" id="content-6">
                    <div class="module-content-inner no-padding-bottom">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom-md">
                                <div class="controls"><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>