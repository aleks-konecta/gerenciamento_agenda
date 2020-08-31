<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json">

	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="css/bootstrap.css">DASHBOARD</a>
		</div>
	</nav>
	<div class="col-md-2"></div>
	<div class="col-md-8 well">
		<h3 class="text-primary">Gereciamento de Agenda Pessoal</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Novo Evento</button>
		<br /><br/ >
		<table class="table table-bordered" id="table_id">
			<thead class="alert-info">
				<tr>
					<th>Descrição</th>
					<th>Data</th>
					<th class="blockquote text-center">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require 'conn.php';
					$query = $conn->prepare("SELECT * FROM `agenda`");
					$query->execute();
					$x = 0;
					while($fetch = $query->fetch()){
						$checked_1 = "";
						$checked_2 = "";
						
						if($fetch['tipo'] == "Exclusivo") {
							$checked_1 = "checked";
						}else{
							$checked_2 = "checked";
						}
						
				?>
				<tr >
					<td><?php echo $fetch['descricao']?></td>
					<td><?php echo $fetch['data_cri']." - ".$fetch['hora_ini']?></td>
					<td class="blockquote text-center"><button class="btn btn-primary type="button" data-toggle="modal" data-target="#visualiza_agenda<?php echo $fetch['agenda_id']?>">
							<span class="glyphicon glyphicon-primary"></span> Visualizar
						</button> 
						<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#update_agenda<?php echo $fetch['agenda_id']?>">
							<span class="glyphicon glyphicon-edit"></span> Alterar
						</button> 
						<a href="delete_agenda.php?id=<?php echo $fetch['agenda_id']?>" class="btn btn-danger">
							<span class="glyphicon glyphicon-trash"></span> Excluir
						</a>
					</td>
				</tr>

				<div class="modal fade" id="visualiza_agenda<?php print $fetch['agenda_id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="POST">
								<div class="modal-header">
									<h3 class="modal-title alert-info">Evento <?php echo $fetch['descricao']?></h3>
								</div>
								<div class="modal-body">
									<div class="col-md-2"></div>
									<div class="col-md-8 list-group-item list-group-item-action list-group-item-secondary">
										<div class="form-group">
											<label>Nome: <?php echo $fetch['nome']?></label>
										</div>
										<div class="form-group">
											<label>Data: <?php echo $fetch['data_cri']?> Hora: <?php echo $fetch['hora_ini']?> às <?php echo $fetch['hora_fim']?></label>
										</div>
										<div class="form-group">
											<label>Local: <?php echo $fetch['local_evento']?></label>
										</div>
										<div class="form-group">
											<label>Qtd. Participantes: <?php echo $fetch['participantes']?></label>
										</div>
										<div class="form-group">
											<label>Tipo de Evento: <?php echo $fetch['tipo']?></label>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="update_agenda<?php print $fetch['agenda_id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form name="alterar_<?php print $fetch['agenda_id']?>" id="alterar_<?php print $fetch['agenda_id']?>" action="update_agenda.php" method="POST">
								<div class="modal-header">
									<h3 class="modal-title">Alterar Evento</h3>
								</div>
								<div class="modal-body">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<div class="form-group">
											<label>Nome</label>
											<input type="text" class="form-control" value="<?php echo $fetch['nome']?>" name="nome_altera_<?php echo $fetch['agenda_id']?>" id="nome_altera_<?php echo $fetch['agenda_id']?>"/>
											<input type="hidden" class="form-control" value="<?php echo $fetch['agenda_id']?>" name="agenda_id"/>
										</div>
										<div class="form-group">
											<label>Descrição</label>
											<input type="text" class="form-control" value="<?php echo $fetch['descricao']?>" name="descricao_altera_<?php echo $fetch['agenda_id']?>" id="descricao_altera_<?php echo $fetch['agenda_id']?>"/>
										</div>
										<div class="form-group">
											<label>Data</label>
											<div class="input-group date" id="id_data_altera_<?php echo $x?>">
												<input type="text" class="form-control" name="data_altera_<?php echo $fetch['agenda_id']?>" id="data_altera_<?php echo $fetch['agenda_id']?>" value="<?php echo $fetch['data_cri']?>">
												<div class="input-group-addon">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Hora</label>
											<div class="input-group" style="width:200px">
												<select class="form-control" style="width:154px" name="hora_ini_altera_<?php echo $fetch['agenda_id']?>" id="hora_ini_altera_<?php echo $fetch['agenda_id']?>">
												<?php
													$array_hora_ini = explode(":", $fetch["hora_ini"]);

													for($h=00; $h < 24; $h++) {
														if($h < 10) {
															$i = "0";
														}else{
															$i = "";
														}
														if($array_hora_ini[0] == $i.$h) {
															$selected = "selected";
														}else{
															$selected = "";
														}
														echo "<option value='".$i.$h.":00' ".$selected.">".$i.$h.":00</option>";
													}
												?>
												
												</select>
												<span class="input-group-addon" style="background-color: #FAFAFA">às</span>
												<select class="form-control" style="width:154px" name="hora_fim_altera_<?php echo $fetch['agenda_id']?>" id="hora_fim_altera_<?php echo $fetch['agenda_id']?>">
												<?php
													$array_hora_fim = explode(":", $fetch["hora_fim"]);

													for($h=00; $h < 24; $h++) {
														if($h < 10) {
															$i = "0";
														}else{
															$i = "";
														}
														if($array_hora_fim[0] == $i.$h) {
															$selected = "selected";
														}else{
															$selected = "";
														}
														echo "<option value='".$i.$h.":00' ".$selected.">".$i.$h.":00</option>";
													}
												?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label>Local</label>
											<input type="text" class="form-control" value="<?php echo $fetch['local_evento']?>" name="local_altera_<?php echo $fetch['agenda_id']?>" id="local_altera_<?php echo $fetch['agenda_id']?>"/>
										</div>
										<div class="form-group">
											<label>Participantes</label>
											<input type="text" class="form-control" value="<?php echo $fetch['participantes']?>" name="participantes_altera_<?php echo $fetch['agenda_id']?>" id="participantes_altera_<?php echo $fetch['agenda_id']?>"/>
										</div>
										<div class="form-group">
											<label>Tipo</label>
											<div class="radio">
												<label><input type="radio" name="tipo_altera_<?php echo $fetch['agenda_id']?>" id="tipo_altera_<?php echo $fetch['agenda_id']?>_e" value="Exclusivo" <?php echo $checked_1?> />Exclusivo</label>
												<label><input type="radio" name="tipo_altera_<?php echo $fetch['agenda_id']?>" id="tipo_altera_<?php echo $fetch['agenda_id']?>_c" value="Compartilhado" <?php echo $checked_2?>/>Compatilhado</label>
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
								<div class="modal-footer">
									<span class="btn btn-warning" onclick="ValidaCamposAlterar('<?php echo $fetch['agenda_id']?>');"> Salvar</span>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<?php
					$x++;
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="cadastro" id="cadastro" method="POST" action="insert_agenda.php">
					<div class="modal-header">
						<h3 class="modal-title">Incluir Evento</h3>
					</div>
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" class="form-control" name="nome" id="nome"/> 
							</div>
							<div class="form-group">
								<label>Descrição</label>
								<input type="text" class="form-control" name="descricao" id="descricao"/>
							</div>
							<div class="form-group">
								<label>Data</label>
								<div class="input-group date" id="id_data">
									<input type="text" class="form-control" name="data" id="data"/>
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-th"></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Hora</label>
								<div class="input-group" style="width:200px">
									<select class="form-control" style="width:154px" name="hora_ini" id="hora_ini">
										<?php for($h=00; $h < 24; $h++) {
											if($h < 10) {
												$i = "0";
											}else{
												$i = "";
											}
											echo "<option value='".$i.$h.":00'>".$i.$h.":00</option>";
										}?>
									</select>
									<span class="input-group-addon" style="background-color: #FAFAFA">às</span>
									<select class="form-control" style="width:154px" name="hora_fim" id="hora_fim">
										<?php for($h=00; $h < 24; $h++) {
											if($h < 10) {
												$i = "0";
											}else{
												$i = "";
											}
											echo "<option value='".$i.$h.":00'>".$i.$h.":00</option>";
										}?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Local</label>
								<input type="text" class="form-control" name="local" id="local"/>
							</div>
							<div class="form-group">
								<label>Participantes</label>
								<input type="text" class="form-control" name="participantes" id="participantes"/>
							</div>
							<div class="form-group">
								<label>Tipo</label>
								<div class="radio">
									<label><input type="radio" name="tipo" value="Exclusivo" id="tipo_e"/>Exclusivo</label>
									<label><input type="radio" name="tipo" value="Compartilhado" id="tipo_c"/>Compartilhado</label>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<span class="btn btn-primary" onclick="ValidaCampos();" >Salvar</span>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap-datepicker.pt-BR.min.js"></script>
<script src="js/consistencia.js"></script>
<script src="js/jquery.dataTables.js"></script>

<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable( {
			"language": {
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ resultados por página",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Pesquisar",
				"oPaginate": {
					"sNext": "Próximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "Último"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				},
				"select": {
					"rows": {
						"_": "Selecionado %d linhas",
						"0": "Nenhuma linha selecionada",
						"1": "Selecionado 1 linha"
					}
				},
				"buttons": {
					"copy": "Copiar para a área de transferência",
					"copyTitle": "Cópia bem sucedida",
					"copySuccess": {
						"1": "Uma linha copiada com sucesso",
						"_": "%d linhas copiadas com sucesso"
					}
				}
			}
		}
		);			
	} );

	for (var i = 0; i < <?php echo $x?>; i++) {
		$('#id_data_altera_'+i).datepicker({
			format: "dd/mm/yyyy",
			startDate: "+0",
			language: "pt-BR"
		});
	}
	$('#id_data').datepicker({
		format: "dd/mm/yyyy",
		startDate: "+0",
		language: "pt-BR"
	});
</script>	

</body>
</html>