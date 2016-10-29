<script type="text/javascript">
$(document).ready(function() {

	 $('#data_table').DataTable({
        responsive: true,
        "order": [[ 2, "asc" ]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
        }
    });

    $('.transformar_paciente').click(function(){

        var id_candidato;
        id_candidato = $(this).attr('data-id-paciente');

        swal({
          title: "Tem certeza?",
          text: "Transformar este candidato em paciente?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#A5DC86",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não!",
          closeOnConfirm: false
        },
        function(){
            console.log(id_candidato);
            window.location='candidato/transformar_paciente/' +  id_candidato;
        });
    });

    $('.transformar_ex_paciente').click(function(){

        var id_candidato;
        id_candidato = $(this).attr('data-id-paciente');

        swal({
          title: "Tem certeza?",
          text: "Transformar este candidato em ex paciente?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#A5DC86",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não!",
          closeOnConfirm: false
        },
        function(){
            console.log(id_candidato);
            window.location='candidato/transformar_ex_paciente/' +  id_candidato;
        });
    });
});
</script>