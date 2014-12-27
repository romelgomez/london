<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
	
		<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre"> 

		<?php echo $this->Session->flash(); ?>

	<div class="preguntas">


		<?php 

			echo $this->Form->create('Store',  array('url' => "/newStoreAddress", 'type' => 'file'));
							
					echo '<h2>Añadir una dirección</h2>';			
				



						echo $this->Form->input('Store.name',array('label'=>'Nombre:','class'=>'input-basic'));
						echo $this->Form->input('Store.address',array('label'=>'Dirección:','class'=>'input-basic'));
						
						############################################# Selectores ####################################################
						echo '<div id="selectores-dependientes" style="overflow: hidden;">';
							
							// select 1
							$country = $selector['Store']['country_id'];
							echo $this->Form->input(
								'Store.country_id',
									array(
										'options' => $country,
										'type' => 'select',
										'empty' => '-- Seleciona un pais. --',
										'label' => ''
									)
							);
														
							// select 2
							$state = $selector['Store']['state_id'];	
							if(!$state){
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '','disabled'=>'disabled');
								}else{
								$stateConfig = array('options' => $state, 'type' => 'select', 'empty' => '-- Seleciona un estado. --', 'label' => '');
							}
							echo $this->Form->input('Store.state_id',$stateConfig);
							
							// select 3
							$city = $selector['Store']['city_id'];
							if(!$city){
								$cityConfig = array('options' => $city, 'type' => 'select', 'empty' => '-- Seleciona una ciudad. --', 'label' => '','disabled'=>'disabled');
							}else{
								$cityConfig = array('options' => $city, 'type' => 'select', 'empty' => '-- Seleciona una ciudad. --', 'label' => '');
							}
							echo $this->Form->input('Store.city_id',$cityConfig);
						
						
						echo '</div>';
						############################################# End Selectores ####################################################
						
						
						echo $this->Form->input('Store.phones',array('label'=>'Telefonos:','class'=>'input-basic'));
						echo $this->Form->input('Store.email',array('label'=>'Emails:','class'=>'input-basic'));

					echo '<h2>Imagenes de la tienda</h2>';
						
						
					?>
	
	
			
			
		<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
						
			<div style="padding-left: 10px;">	
				<div class="admonition note">
					<p class="first admonition-title">Nota</p>
					<p class="last">Si el producto no tiene al menos una imagen, el sistema no mostrara la dirección a los clientes.</p>
				</div>	
			</div>	
		
		</div>	
		
		<br>
					
					
					<div id="add-image">
						<?php
							echo $this->Form->input('addStoreImage.1',array('label'=>'1) ','type'=>'file'));
							echo $this->Form->input('addStoreImage.2',array('label'=>'2) ','type'=>'file'));
							echo $this->Form->input('addStoreImage.3',array('label'=>'3) ','type'=>'file'));
						?>
					</div>	
					<input  type="button" id="add-input-image-button" value="Otra imagen"" />
					
				
					<?php 	
					echo '<h2>Status</h2>';	
					
						echo $this->Form->input(
							'Store.status',
							array(
								'options' => array('1'=>'Publico','0'=>'No publico'),
								'type' => 'select',
								'empty' => '-- Seleciona un status. --',
								'label' => ''
							)
						);
					
					echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					
					echo $this->Form->end();

										
										
		?>

	
	</div>

	</div>
</div>	
	
	



	




	


