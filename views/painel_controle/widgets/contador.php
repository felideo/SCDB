    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Fim da bateria
            </div>
            <div class="panel-body">
                <h3>Faltam:</h3>
               <div id="contador"></div>
            </div>
        </div>
    </div>


<script type="text/javascript">

    $(document).ready(function() {
        $('#contador').countdown('<?php echo $this->bateria_atual[0]['data_fim'] ?>', function(event) {
          var $this = $(this).html(event.strftime(''
            + '<span>%w</span> semanas, '
            + '<span>%d</span> dias, '
            + '<span>%H</span> horas, '
            + '<span>%M</span> minutos '
            + 'e <span>%S</span> segundos.'));
        });
    });

</script>
