<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

	<div class="preguntas" >
	
	<?php if($addresses){ ?>
	
	<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> <span>Seleciona una dirección o añade una nueva:</span> </div>	
	
	<br>
	
	<?php
			foreach($addresses as $key=>$value){
	?>		
			<!--Direccion -->
			<div class="inCart" >
				<div>
					
					<div style="overflow: hidden; background: black; color: white; padding: 5px">
						<div style="overflow: hidden;" >
							<div  style="float: left;">
								<div style="overflow: hidden; padding-top: 7px;"  ><span style="font-size: 16px;" > <?php  echo $value['Address']['name'];  ?> </span></div>
							</div>	
							<div style="float: right;">	
								<a href="<?php echo '/select_this_delivery_address/'.$purchase_id.'/'.$value['Address']['id']; ?>" class="g-button" style=" padding: 6px 10px; -webkit-border-radius: 2px 2px; border: solid 1px rgb(153, 153, 153);  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(255, 255, 255)), to(rgb(221, 221, 221)));  color: #333;  text-decoration: none;  cursor: pointer;  display: inline-block;  text-align: center;  line-height: 1; ">
									Seleciono esta dirección
								</a>
							</div>
						</div>
					</div>
				
					<div style="padding: 10px; padding-top: 0px;">
						<div style="padding-bottom: 6px; padding-top: 10px;"><b><?php  echo $value['Country']['name'].'->'.$value['State']['name'].'->'.$value['City']['name'];  ?></h4></b></div>
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


	<?php } ?> 

<?php 

					echo $this->Form->create('Address',  array('url' => "/new_address_bridge"));
							
					echo '<h2>Añade una nueva dirección</h2>';			
						
						echo $this->Form->input( 'Purchase.id', array('value' =>$purchase_id,'type' => 'hidden')); 
						echo $this->Form->input( 'Address.country_id', array('value' =>'1','type' => 'hidden')); 
						echo $this->Form->input( 'Address.state_id', array('value' =>'16','type' => 'hidden')); 
						echo $this->Form->input( 'Address.city_id', array('value' =>'21','type' => 'hidden')); 

						echo $this->Form->input('Address.name',array('label'=>'Nombre:','class'=>'input-basic','error'=>false));
						echo $this->Form->input('Address.address',array('label'=>'Dirección:','class'=>'input-basic','error'=>false));
						echo $this->Form->input('Address.additional_information',array('label'=>'Información adicional:','class'=>'input-basic','error'=>false));
						echo $this->Form->input('Address.phones',array('label'=>'Telefonos de quien recibe el paquete o el comprador:','class'=>'input-basic','error'=>false));
						
				
					
					echo $this->Form->submit('Guardar Y Selecionar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
					
					echo $this->Form->end();

										
										
		?>

<br>

<?php	
	}else{ // end Address
?>

	<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> <span>Añade una nueva direción:</span> </div>	
	
	<br>
			<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
				<center><h2>No hay direcciónes personales precargadas</h2></center>		
					<div style="padding-left: 10px;">	
						<div class="admonition note">
							<p class="first admonition-title">Nota</p>
							<p class="last">
								Al añadir direcciones, tendras la facilida de selecionar la direccion de envio de tu preferencia al comprar productos publicados en santomercado.com.
							</p>
						</div>	
					</div>
			</div>

		<?php 

			echo $this->Form->create('Address',  array('url' => "/new_address_bridge"));
							
			echo '<h2>Añade una nueva dirección</h2>';			
						
				echo $this->Form->input( 'Purchase.id', array('value' =>$purchase_id,'type' => 'hidden')); 
				echo $this->Form->input( 'Address.country_id', array('value' =>'1','type' => 'hidden')); 
				echo $this->Form->input( 'Address.state_id', array('value' =>'16','type' => 'hidden')); 
				echo $this->Form->input( 'Address.city_id', array('value' =>'21','type' => 'hidden')); 

				echo $this->Form->input('Address.name',array('label'=>'Nombre:','class'=>'input-basic','error'=>false));
				echo $this->Form->input('Address.address',array('label'=>'Dirección:','class'=>'input-basic','error'=>false));
				echo $this->Form->input('Address.additional_information',array('label'=>'Información adicional:','class'=>'input-basic','error'=>false));
				echo $this->Form->input('Address.phones',array('label'=>'Telefonos de quien recibe el paquete o el comprador:','class'=>'input-basic','error'=>false));
				
			echo $this->Form->submit('Guardar Y Selecionar', array('class' => 'g-button', 'title' => 'Guarda, podras editar posteriormente.'));
					
			echo $this->Form->end();	
										
		?>



<?php } ?>


	

	</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	


