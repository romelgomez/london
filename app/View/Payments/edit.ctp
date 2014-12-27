<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

	<div class="preguntas">

		<?php 
			
			echo $this->Form->create('BankAccount',  array('url' => '/edit_payment/'.$purchase['Purchase']['id']));
							
					echo '<h2>Edita el pago para:</h2>';							
						
							echo ''.$company['Company']['name'].' '.$company['Company']['type'];  
							echo ' RIF: '.$company['Company']['rif'].'<br>';  
							
						
						$quantityOfProducts = count($purchase['PurchasedProduct']);
						
						if($quantityOfProducts <2){
						
							echo '<h3>Por el siguiente producto ofertado:</h3>';
							echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($purchase['PurchasedProduct'][0]['title'])).'/'.$purchase['PurchasedProduct'][0]['product_id'], true).'" >'.$purchase['PurchasedProduct'][0]['title'].'</a>';
						
						}else{
							echo '<h3>Por los siguientes productos ofertados:</h3>';
							foreach($purchase['PurchasedProduct'] as $v){
										
								echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($v['title'])).'/'.$v['product_id'], true).'" >'.$v['title'].'</a>';

								echo '<br>';
										
							}
						} 
						
						
					//	echo $this->Form->input( 'Payment.purchase_id', array('type' => 'hidden','value'=>$purchase['Purchase']['id'])); 
						
						
						?>
						
								
								
							<?php  echo '<h3 style="" >Deposito o tranferencia:</h3>'; ?>

<?php if(isset($bankAccountsData)){ ?>
	
	<?php 
	
	# Banesco Banco Universal C.A - Nº 1222-1110-2223-2222  
	# Mercantil C.A Nº 1222-1110-2223-2222
	
		//debug($bankAccountsData);
	
						echo $this->Form->input(
							'Payment.bank_account_id',
							array(
								'options' => $bankAccountsData,
								'type' => 'select',
								'empty' => '-- Cuenta donde despositaste o transferiste --',
								'label' => '',
								'error'=>false
							)
						);
	?>
	

<?php }else{
	
	
		echo  '<h3>Solicitale a la empresa cargar los numeros de cuentas bancarias para que registres el pago con facilidad.</h3>'; 
		
	
	} ?>		
								
	
				<?php 
				
						echo $this->Form->input(
							'Payment.transaction_type',
							array(
								'options' => array('1'=>'Deposito','2'=>'Tranferecia'),
								'type' => 'select',
								'empty' => '-- Tipo de transasción --',
								'label' => '',
								'error'=>false
							)
						);
				
				?>
								
				<?php echo $this->Form->input('Payment.control_number',array('label'=>'Número de deposito o transferencia:','class'=>'input-basic','error'=>false)); ?>
				<?php echo $this->Form->input('Payment.amount',array('label'=>'Monto depositado o transferido:','class'=>'input-basic','error'=>false)); ?>
				<?php echo $this->Form->input('Payment.additional_information',array('label'=>'Información adicional que desee agregar:','class'=>'input-basic','error'=>false)); ?>

				
				<h3>Los siguientes datos solicitados son los que iran en la factura:</h3>
				
				<?php echo $this->Form->input('Billing.billing_name',array('label'=>'La factura estara a nombre de:','class'=>'input-basic','error'=>false)); ?>
				<?php echo $this->Form->input('Billing.identity_card',array('label'=>'Cedula:','class'=>'input-basic','error'=>false)); ?>
				<?php echo $this->Form->input('Billing.fiscal_address',array('label'=>'Dirección fiscal:','class'=>'input-basic','error'=>false)); ?>
				<?php echo $this->Form->input('Billing.phone',array('label'=>'Telefono:','class'=>'input-basic','error'=>false)); ?>
								
				<?php
						
					
					
					echo '<br>';
						
						echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					
					echo $this->Form->end();										
										
		?>

	
	</div>

	</div>
</div>	
	
	



	




	


