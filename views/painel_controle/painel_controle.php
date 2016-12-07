<div class="row">
    <?php
        if(!empty($this->chamada)
            && \Util\Permission::check_user_permission('aluno', 'aluno_efetuar_chamada')
            || \Util\Permission::check_user_permission('paciente', 'paciente_efetuar_chamada')
        ){
            include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/widgets/chamada.php';
        }
    ?>

    <?php
        if(!empty($this->faltas)
            && \Util\Permission::check_user_permission('aluno', 'aluno_remover_por_excesso_de_faltas')
            || \Util\Permission::check_user_permission('paciente', 'paciente_remover_por_excesso_de_faltas')
        ){
            include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/widgets/faltas.php';
        }
    ?>
</div>

