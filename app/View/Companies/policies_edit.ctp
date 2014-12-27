<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		
		<?php echo $this->element('menu'); ?>
		
	</div>
	<div class="b-sobre"> 

	<div class="preguntas" >

	<?php 
			
			echo $this->Form->create('Company',  array('url' =>'/policiesEdit'));
					
			echo '<h2>Edite las politicas de la empresa</h2>';		

			echo $this->Form->textarea('Company.policies',array('label'=>'Descipción:','class'=>'input-basic'));
			
			echo '<h2>Status</h2>';	
					
						echo $this->Form->input(
							'Company.policies_status',
							array(
								'options' => array('1'=>'Publico','0'=>'Privado - Borrador'),
								'type' => 'select',
								'empty' => '-- Seleciona un status. --',
								'label' => ''
							)
						);
			
			echo '<br>';
			
			echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
			echo $this->Form->end();

		?>


	</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	



