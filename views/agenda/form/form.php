<div class="span12">
	<h3 class="page-header">
		 <i class="fa fa-clock-o"> </i> Bateria Atual
	</h3>
	<h4 class="page-header">
		<strong>Periodo:</strong> <?php if(isset($this->bateria_atual[0]['data_inicio'])){echo $this->bateria_atual[0]['data_inicio'];} ?> à <?php if(isset($this->bateria_atual[0]['data_fim'])){echo $this->bateria_atual[0]['data_fim'];} ?>
	</h4>
</div>

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

				 <div class="form-group span12">
					<label>Aluno x Paciente</label>
					<br>
					<select class="span12" id="aluno_paciente" name="<?php echo $this->modulo['modulo']; ?>[id_bateria_relaciona_aluno_paciente]" required>
						<option disabled selected>Selecione</option>
						<?php foreach ($this->bateria_atual as $indice => $dados_bateria) : ?>
							<option value="<?php echo $dados_bateria['id_relacao']; ?>">Aluno: <?php echo $dados_bateria['aluno_nome']; ?> <=> Paciente: <?php echo $dados_bateria['paciente_nome']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div style="display: block; clear: both;">


				<div class="form-group span4" style="position: relative;">
					<label>Data da Consulta</label>
					<input id="data_consulta" autocomplete="off" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_consulta]" required>
				</div>

				<div class="form-group span4" style="position: relative;">

					<label>Horario da Consulta</label>
					<br>
					<select id="hora_consulta" class="form-group span12" name="<?php echo $this->modulo['modulo']; ?>[hora_consulta]" required >
						<option disabled>Selecione</option>
					</select>
				</div>

				<div class="form-group span4">
					<label>Agendamento Completo</label>
					<br>
					<label class="checkbox-inline">
						<input id="completo" type="checkbox" class="checkbox-inline" name="<?php echo $this->modulo['modulo']; ?>[completo]" value="1">Sim
					</label>
				</div>

				<input type="hidden" name="bateria[data__data_inicio]"        value="<?php echo $this->bateria_atual[0]['data_inicio']; ?>"               required>
				<input type="hidden" name="bateria[data__data_fim]"           value="<?php echo $this->bateria_atual[0]['data_fim']; ?>"                  required>
				<input type="hidden" name="bateria[atendimentos_simultaneos]" value="<?php echo $this->bateria_atual[0]['atendimentos_simultaneos']; ?>"  required>
			</div>

			<div class="row-fluid">
				<div class="form-group span12">
					<button type="submit" class="btn btn-primary" style="float: right;">Agendar Paciente</button>
				</div>
			</div>
		</form>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){

		$('#data_consulta').keydown(function(){
		 	swal("Erro", "Selecione uma data no calendario a baixo!", "error");
			$('#data_consulta').val('');
		});

		$('#data_consulta').datetimepicker({
			sideBySide: true,
			debug: false,
			format: 'DD/MM/YYYY',
			minDate: moment(),
			maxDate: '<?php echo $this->bateria_atual[0]['data_fim']; ?>',
			daysOfWeekDisabled: [0],
			widgetPositioning: {
				horizontal: 'auto',
				vertical: 'bottom'
			}
		});


		$("#data_consulta").on("dp.change", function (e) {
			$('#hora_consulta').html("<option selected disabled>Selecione</option>");

			 $.ajax({
				type: 'POST',
				url: "<?php echo URL; ?>agenda/verificar_horarios_disponiveis_ajax",
				data: {
					data_consulta: $('#data_consulta').val(),
					quantidade_atendimentos: <?php echo $this->bateria_atual[0]['atendimentos_simultaneos']; ?>
				},
				dataType: 'json',
				async: false,
				success: function(dados) {
					console.log(dados);
					if(jQuery.isEmptyObject(dados)){
						$('#hora_consulta').html("<option selected dasabled>Nenhum Horario Disponivel</option>");
					}else{
						$.each(dados, function(indice, item) {
							// console.log(item);
							 $('#hora_consulta')
								 .append($("<option></option>")
								 .attr("value", item)
								 .text(item));
						});
					}
				}
			});
		});


		$('#completo').on('change', function(){
			if($('#data_consulta').val() != ''){
				var dia = moment($('#data_consulta').val(), "YYYY-MM-DD HH:mm:ss");
				var dia_semana = dia.format('dddd');
			} else {
				swal("Atenção!", "Selecione uma data para a consulta.", "info");
				$(this).prop("checked", false);
				return false;
			}

			if($('#hora_consulta').find(":selected").text() == 'Selecione' || $('#hora_consulta').find(":selected").text() == ''){
				swal("Atenção!", "Selecione um horario para a consulta.", "info");
				$(this).prop("checked", false);
				return false;
			}

			if($(this).prop("checked") == true){
				swal("Atenção!", "Ao selecionar esta opção, o paciente sera agentado toda "
					+ dia_semana + " as " + $('#hora_consulta').val()
					+ " até a data final da bateria. Neste caso, certifique-se de selecionar o dia da primeira consulta!", "info");
			}
		});
	});









</script>