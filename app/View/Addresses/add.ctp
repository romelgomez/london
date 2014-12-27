<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 

		<?php echo $this->element('menu'); ?>
	
	
	</div>
	<div class="b-sobre"> 

		<?php echo $this->Session->flash(); ?>

	<div id="debug"></div>

	<div class="preguntas">

		<?php 

			echo $this->Form->create('Store',  array('url' => "/newAddress"));
							
					echo '<h2>Añadir una dirección</h2>';			



						
								

						echo $this->Form->input('Address.name',array('label'=>'Nombre:','class'=>'input-basic'));
						echo $this->Form->input('Address.address',array('label'=>'Dirección:','class'=>'input-basic'));
						
						
						############################################# Selectores ####################################################
						echo '<div id="selectores-dependientes" style="overflow: hidden;">';
							
							// select 1
							$country = $selector['Address']['country_id'];
							echo $this->Form->input(
								'Address.country_id',
									array(
										'options' => $country,
										'type' => 'select',
										'empty' => '-- Seleciona un pais. --',
										'label' => ''
									)
							);
														
							// select 2
							$state = $selector['Address']['state_id'];	
							if(!$state){
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '','disabled'=>'disabled');
								}else{
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '');
							}
							echo $this->Form->input('Address.state_id',$stateConfig);
							
							// select 3
							$city = $selector['Address']['city_id'];
							if(!$city){
								$cityConfig = array('options' => $city, 'type' => 'select', 'empty' => '-- Seleciona una ciudad. --', 'label' => '','disabled'=>'disabled');
							}else{
								$cityConfig = array('options' => $city, 'type' => 'select', 'empty' => '-- Seleciona una ciudad. --', 'label' => '');
							}
							echo $this->Form->input('Address.city_id',$cityConfig);
						
						
						echo '</div>';
						############################################# End Selectores ####################################################
						
						
						echo $this->Form->input('Address.additional_information',array('label'=>'Información adicional:','class'=>'input-basic'));
						echo $this->Form->input('Address.phones',array('label'=>'Telefonos de quien recibe el paquete o el comprador:','class'=>'input-basic'));
						
					
					echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					echo $this->Form->end();

										
										
		?>

	
	</div>

	</div>
</div>	
	
	



	




	



