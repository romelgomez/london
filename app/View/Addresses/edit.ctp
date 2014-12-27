<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
	
		<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre"> 

	<div class="preguntas">


		<?php 
			
			echo $this->Form->create('Store',  array('url' => '/editAddress/'.Inflector::slug($this->data['Address']['name']).'/'.$this->data['Address']['id']));
							
					echo '<h2>Editar una dirección</h2>';							
						
						echo $this->Form->input( 'Address.id', array('type' => 'hidden')); 
						echo $this->Form->input('Address.name',array('label'=>'Nombre:','class'=>'input-basic'));
						echo $this->Form->input('Address.address',array('label'=>'Dirección:','class'=>'input-basic'));
						
						############################################# Selectores ####################################################
						echo '<div id="selectores-dependientes" style="overflow: hidden;">';
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
									
							$state = $selector['Address']['state_id'];	
							if(!$state){
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '','disabled'=>'disabled');
							}else{
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '');
							}
							echo $this->Form->input('Address.state_id',$stateConfig);
							
							
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
						echo $this->Form->input('Address.phones',array('label'=>'Telefonos del receptor final:','class'=>'input-basic'));
		
					echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					
					echo $this->Form->end();										
										
		?>

	
	</div>

	</div>
</div>	
	
	



	




	


