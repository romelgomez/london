<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 

		<?php echo $this->element('menu'); ?>

	</div>
	<div class="b-sobre"> 

		<?php echo $this->Session->flash(); ?>

	<div class="preguntas">

		<?php 

			echo $this->Session->flash();
			
			echo $this->Form->create('Store',  array('url' => '/editStoreAddress/'.Inflector::slug($this->data['Store']['name']).'/'.$this->data['Store']['id'], 'type' => 'file'));
							
					echo '<h2>Editar una dirección</h2>';							
						
						echo $this->Form->input( 'Store.id', array('type' => 'hidden')); 
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

					echo '<h2>Imagenes de la tienda</h2> <h4>Nota: Guarda antes de borrar una imagen, de lo contrario perderas los cambios.</h4>';
					
					
					
					?>
					
					<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
							<!-- imagenes -->											
							<?php 
								if($this->data['StoreImage']){  //debug($value['StoreImage']); 								
									$imagenes = NULL;
									foreach($this->data['StoreImage'] as $key2=>$value2){
										if($value2['size'] == '120x120px' && $value2['deleted'] == 0){
											$imagenes = 1;
										}
									}									
									if($imagenes){
										
										
										echo '<ul id="mycarousel" class="jcarousel-skin-tango">';
											foreach($this->data['StoreImage'] as $key2=>$value2){
												
												if($value2['size'] == '900x600px' && $value2['deleted'] == 0){
													//$titulo = $value2['title'];
													$imagen_grande =  $value2['name'];
												}
												
												if($value2['size'] == '120x120px' && $value2['deleted'] == 0){
													echo '<li>
																<div ><a href="/deleteAddressImage/'.$value2['name'].'"  ><img src="/img/xy.png" style="height: 22px;"></a></div>
						
																	<a href="'.$this->Html->url('/img/stores/'.$imagen_grande, true).'" class="pirobox_gall" title="santomercado.com">
																	
																		<img src="/img/stores/'.$value2['name'].'" title="santomercado.com" class="thumb_ProductsView" border="0" style="margin-top: -10px;" />
																	
																	</a>										
														
														</li>';
												}
											}
										echo '</ul>';
									}
								}
							 ?>

							<!--<li><img src="/img/products/132-LF-E655-KR_XL_13.jpg" title="" class="thumb_ProductsView" border="0"/></li>-->
								
							<?php if(!isset($imagenes)){ ?>
								<center><h2>No hay imagenes</h2></center>		
									<div style="padding-left: 10px;">	
										<div class="admonition note">
											<p class="first admonition-title">Nota</p>
											<p class="last">
												Si la tienda no tiene al menos una foto, el sistema no mostrara la dirección a los clientes. <br> 
											</p>
										</div>	
									</div>		
							<?php } ?>
								
						<!-- end imagenes -->
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
	
	



	




	


