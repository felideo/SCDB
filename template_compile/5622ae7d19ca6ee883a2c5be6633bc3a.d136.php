<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><section class="login-section auth-section">
    <div class="container">
        <div class="row">
            <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                <h1 class="form-box-heading logo text-center">
                    <span class="pe-icon pe-7s-box2 icon"></span><span class="highlight"><?php echo APP_NAME; ?></span>
                </h1>
                <div class="form-box-inner">
                    <h2 class="title text-center"><i class="fa fa-times-circle-o" aria-hidden="true" style="font-size: 85px;"></i></h>
                    <div class="row">
                        <div class="form-container col-md-12 col-sm-12 col-xs-12">
                    		<h1 class="title text-center">Pagina Inexistente</h1>
                            <button type="button" onclick="window.history.back();" class="btn btn-block btn-primary">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>