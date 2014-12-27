<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

	<div class="preguntas" >
	
	
				<?php echo $this->Session->flash(); ?>

	
<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> <span>Personal:</span> </div>	
	
		<h4 style="margin: 12px; margin-left: 5px;" >Datos personales: <?php echo '<a href="'.$this->Html->url('/editPersonalData', true).'">Editar</a>'; ?></h4>
			<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
				<b>Nombres:</b> <?php echo $user['User']['name']; ?> <br>
				<b>Apellidos:</b> <?php echo $user['User']['family_name']; ?> <br>
				<b>Email:</b> <?php echo $user['User']['email']; ?> <br>	
				<b>Telefonos:</b> <?php echo $user['User']['phone']; ?> <br><br>
				
				<?php echo '<a href="'.$this->Html->url('/editPassword', true).'">Editar clave</a>'; ?>
								
			</div>







	<?php echo '<h4 style="margin: 12px; margin-left: 5px;" >Direcciones: <a href="'.$this->Html->url('/newAddress', true).'">Añadir una dirección</a></h4>'; ?>

	<?php if($addresses){
			foreach($addresses as $key=>$value){
	?>		
			<!--Direccion -->
			<div class="inCart" >
				<div>
					<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" >
						<span style="font-size: 16px;" >
							<?php  echo $value['Address']['name'];  ?> 
							<?php  echo '<a href="/editAddress/'.Inflector::slug($value['Address']['name']).'/'.$value['Address']['id'].'">Editar</a>' ?> 
							<?php  echo '<a href="/deletedPersonalAddress/'.$value['Address']['id'].'">Borrar</a>' ?> 
						</span>
					</div>
				
					<div style="padding: 10px; padding-top: 0px;">
						<div style="padding-bottom: 6px; padding-top: 10px;"><b><?php  echo $value['Country']['name'].'->'.$value['State']['name'].'->'.$value['City']['name'];  ?></b></div>
						<div>	
							<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
								<b>Dirección: </b><?php  echo $value['Address']['address'];  ?><br> 
								<b>Información adicional: </b><?php  echo $value['Address']['additional_information'];  ?> <br>
								<b>Telefonos del receptor final: </b><?php  echo $value['Address']['phones'];  ?> <br>
							</div>
						</div>
					</div>
				</div>		
			</div><!--end direccion -->

<?php	}
	 }else{ // end Address
?>
			<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
				<center><h2>No hay direcciónes personales</h2></center>		
					<div style="padding-left: 10px;">	
						<div class="admonition note">
							<p class="first admonition-title">Nota</p>
							<p class="last">
								Al añadir direcciones, tendras la facilida de selecionar la direccion de envio de tu preferencia al comprar productos en santomercado.com 
												
							</p>
						</div>	
					</div>
			</div>

<?php } ?>


			
	<?php  if($user['Company']['id']){ ?>

<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> <span>Empresa:</span> </div>
	

	<h4 style="margin: 12px; margin-left: 5px;" >Datos de la Empresa:  <a href="/policies">Politicas</a> y <a href="/warranties">Garantias</a></h4>
		<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
			<b>Nombre: </b><?php echo $user['Company']['name'].' '.$user['Company']['type']; ?><br>
			<b>RIF: </b><?php echo $user['Company']['rif']; ?><br>
		</div>



	<?php  echo '<h4 style="margin: 12px; margin-left: 5px;" >Cuentas bancarias: <a href="'.$this->Html->url('/addBankAccount', true).'">Añadir una cuenta bancaria</a></h4>'; ?>

<?php if($bankAccountsData){ ?>
	
	
	<?php foreach ($bankAccountsData as $v){ ?>


			<!--Direccion -->
			<div class="inCart" >
				<div>
					<div class="inFecha" style=" background: teal; padding: 9px; font-size: 17px; height: 20px;" >
						<span style="font-size: 16px;" >
							<?php  echo $v['name'];  ?> 
						</span>
					</div>
				
					<div style="padding: 10px; padding-top: 0px;">
						<div style="padding-bottom: 6px; padding-top: 10px;"><b>Cuenta: Corriente</b></div>
						<div>	
							<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
							<?php
								foreach($v['bankAccounts'] as $k2 => $v2){
									
									echo '<b>'.$v2['BankAccount']['number'].'</b> | ';
									
									echo '<a href="/editBankAccount/'.$v2['BankAccount']['id'].'">Editar</a>';
									echo ' <a href="/deletedBankAccount/'.$v2['BankAccount']['id'].'">Borrar</a>';
								
									echo '<br>';	
									
								}
							?>
							
							</div>
						</div>
					</div>
				</div>		
			</div><!--end direccion -->

	<?php	//debug($v); ?>

	<?php } ?>

<?php }else{ ?>

		<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
									<center><h2>no hay cuentas bancarias registradas</h2></center>		
									<div style="padding-left: 10px;">	
										<div class="admonition note">
											<p class="first admonition-title">Nota</p>
											<p class="last">
												Para generar seguridad en el cliente, solo es permitido registrar cuentas bancarias juridicas. (al cliente se le aconseja de no tranferir o depositar a una cuenta personal). Nosotros daremos de baja preventiva y temporal 
la cuenta del vendedor al detertar el uso de cuentas bancarias personales. La cuenta del vendedor pasara por un proceso de auditoria para descartar que sus clientes no han sido afectados. <br> 
												
											</p>
										</div>	
									</div>			
</div>			

<?php } ?>


	<?php  echo '<h4 style="margin: 12px; margin-left: 5px;" >Direcciones: <a href="'.$this->Html->url('/newStoreAddress', true).'">Añadir una dirección</a></h4>'; ?>

	<?php if($stores){
			foreach($stores as $key=>$value){
	?>		
			<!--Direccion -->
			<div class="inCart" >
				<div>
					<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" >
						<span style="font-size: 16px;" >
							<?php echo $value['Store']['name'];  ?> 
							<?php echo '<a href="/editStoreAddress/'.Inflector::slug($value['Store']['name']).'/'.$value['Store']['id'].'">Editar</a>' ?> 
							<?php echo '<a href="/deletedStoreAddress/'.$value['Store']['id'].'">Borrar</a>' ?> 
							 
						</span>
					</div>
				
					<div style="padding: 10px; padding-top: 0px;">
						<div style="padding-bottom: 6px; padding-top: 10px;"><b><?php echo $value['Country']['name'].'->'.$value['State']['name'].'->'.$value['City']['name'];  ?></h4></b></div>
						<div>	
							<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
								<b>Dirección: </b><?php echo $value['Store']['address'];  ?><br> 
								<b>Telefonos: </b><?php echo $value['Store']['phones'];  ?> <br>
								<b>Correo: </b><?php echo $value['Store']['email'];  ?> <br>
							</div>
						</div>			
		
						
					
					</div>
				</div>		
			</div><!--end direccion -->

<?php	}
	 } // end stores
?>
		
<?php } ?>	

	</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	


