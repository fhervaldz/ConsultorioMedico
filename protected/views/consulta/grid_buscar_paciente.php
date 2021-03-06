<div>

    <div class="modal-header">
        <h2>Buscar Paciente</h2>
    </div> 

	<div class="modal-body">

		<p>
			Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
		</p>

		<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'paciente-grid',
			'dataProvider'=>$model->search(),
			'type'=>'striped',
			'template'=>'{summary}{items}{pager}{summary}',	
			'filter'=>$model,
			'columns'=>array(
				'cedula_paciente',
				'nombre_paciente',
				'apellido_paciente',
				array(

					'class'=>'CButtonColumn',	
					'template' => '{select}',		
					'buttons' => array(
						'select' => array(
							'label' => 'Seleccionar', 
							'options' => array('title' => 'Selecciona el registro indicado.', 'class' => 'btn btn-inverse'),
							'type' => 'inverse',
							'url'=>'Yii::app()->createUrl("consulta/BuscarPacientePorId", array("ID"=>$data->paciente_id))',
							'click' => "function(e){

								e.preventDefault();

								$.ajax({
									url: $(this).attr('href'), 
									type: 'post',
									dataType: 'json',
									success: function(data) { 						

										if(data.success){
											$('#Consulta_nombrePaciente').val(data.paciente);
											$('#Consulta_paciente_id').val(data.id);
											$('#Consulta_antecedentePaciente').val(data.antecedente);
											$('#Consulta_nombrePaciente').focus();
										}
										else{
											$('#Consulta_nombrePaciente').val('');
											$('#Consulta_paciente_id').val('');
											$('#Consulta_antecedentePaciente').val('');
											$('#Consulta_cedulaPaciente').focus();
										}

										showAlertAnimatedToggled(data.success, 'Paciente seleccionado.', data.paciente, 'Error', data.mensaje);										
									}									
								});								

								$('#buscar-paciente').modal('hide');								
							}",
						)
					),
				),
			),
		)); ?>

	</div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cerrar</a>	
    </div>

</div>