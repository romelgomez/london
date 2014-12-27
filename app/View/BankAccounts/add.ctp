<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
	
		<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre"> 

	<div class="preguntas">

		<?php 
			
			echo $this->Form->create('BankAccount',  array('url' => '/addBankAccount'));
							
					echo '<h2>Añade un numero de cuenta</h2>';							
						
						//echo $this->Form->input( 'Address.id', array('type' => 'hidden')); 
						
						//echo $this->Form->input('BankAccount.bank_id',array('label'=>'Nombre:','class'=>'input-basic'));
						
						?>
								<div style="background: white; border: 1px solid azure; padding: 5px; margin-bottom: 10px;  border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px;">
						<?php 

								echo '<b>Nombre corporativo:</b> '.$company['Company']['name'].' '.$company['Company']['type'].'<br>';  
								echo '<b>RIF:</b> '.$company['Company']['rif'].'<br>';  
								echo '<b>Tipo de cuenta: </b>  Corriente<br>';  
							
						?>
								</div>
						<?php
						
						echo $this->Form->input(
							'BankAccount.bank_id',
							array(
								'options' => $allBanks,
								'type' => 'select',
								'empty' => '-- Seleciona un banco. --',
								'label' => ''
							)
						);
						
						echo $this->Form->input('BankAccount.number',array('label'=>'Numero:','class'=>'input-basic'));
					
					
					echo '<br>';
						
						echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					
					echo $this->Form->end();										
										
		?>

	
	</div>

	</div>
</div>	
	
	



	




	


