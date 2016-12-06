

<div class="row">
    <?php
        if(!empty($this->chamada)){
            include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/widgets/chamada.php';
        }
    ?>

    <?php
        if(!empty($this->faltas)){
            include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/widgets/faltas.php';
        }
    ?>
</div>

