<script type="text/javascript">

function buscar_trabalhos(dados){

	var busca = '';

    $.each(dados, function(index, item) {
        busca = item.id + ';' + busca;
    });

    console.log(busca);
}
</script>