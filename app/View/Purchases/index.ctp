<div class="contenedor-b"  style=" overflow: hidden; padding:10px">
	<div class="b-menu"> 
	
		<?php echo $this->element('menu'); ?>

	</div>
	<div class="b-sobre" style="width: 978px;"> 

<?php

if($purchases){	 ?>

<div class="preguntas" >
		<h2 style="margin: 12px; margin-left: 5px; " >Productos comprados:</h2>
		
		<div class="inCart" style="margin-bottom: 0px;">
		<?php foreach($purchases as $fecha =>$v){ ?>	
			<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" > <span style="font-size: 16px;" ><?php echo $fecha; ?></span></div>		
			
			<?php	foreach($v as $vendedor => $v2){
				
					foreach($v2 as $v3){
						foreach($v3 as $k4 => $v4){
							foreach($v4 as $k5 => $v5){
							
								$companyName = $v5['Company']['name'];
								$type = $v5['Company']['type'];
								$id = $v5['Company']['id'];
								$storeName = $v5['Store']['name'];
								$storeId = $v5['Store']['id'];
								$storeStateName = $v5['Store']['stateName'];
								$storeCityName = $v5['Store']['cityName'];
							
							}
						}
					}
					
			?>
			
			<div style="padding: 5px;">		
				<div style="padding: 7px;" ><h3 style=" margin-top: 0px;  margin-bottom: 0px; ">Vendedor: <?php echo $companyName.' '.$type; ?> <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($companyName)).'/'.$id; ?>">Contacta al vendedor</a> </h3></div>
			

			
				<div class="inHora" style="padding: 5px; padding-left: 20px;">
					
					
					<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
						<h3 style="margin-bottom: 0px; margin-top: 0px; ">Tienda: <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($companyName)).'/'.$id.'#'.Inflector::slug($storeName); ?>"> <?php echo $storeName; ?></a> | <?php echo $storeStateName.' - '.$storeCityName; ?>.</h3>
						

						<?php foreach($v2 as $k3 => $v3){ ?>
							<?php foreach($v3 as $hora => $v4){ ?>
						
								<?php foreach($v4 as $v5){ ?>
									
									<?php  //debug($v5); ?>
						
									<div style=" padding-left: 5px; padding-top: 10px; padding-bottom: 10px;" >
										<span><b>Hora:</b> <?php echo $hora; ?>
												<?php  if(!$v5['RatingOfPurchase']['rating']){  ?>	
													<a href="<?php echo '/rate_your_experience/#'.$v5['Purchase']['id']; ?>">Califica esta compra</a> | 
														<?php }else{ ?>
													<a href="<?php echo '/edit_your_experience/'.$v5['Purchase']['id']; ?>">Edite la calificación de esta compra</a> | 
												<?php } ?>
										
										<?php if($v5['Payment']['id']){ ?>
											<a href="/edit_payment/<?php echo $v5['Purchase']['id']; ?>">Edita el pago </a> 
										 <?php }else{ ?>
											<a href="/add_payment/<?php echo $v5['Purchase']['id']; ?>">Registra el pago</a>
										 <?php } ?>
										 
										 |
										 
										 <?php if($v5['Purchase']['address_id']){ ?>
											<a href="<?php echo '/edit_the_delivery_address/'.$v5['Purchase']['id']; ?>">Edita la direccion de envio</a> 
										 <?php }else{ ?>
											<a href="<?php echo '/edit_the_delivery_address/'.$v5['Purchase']['id'] ?>">Registra la direccion de envio</a> 
										 <?php } ?>
										 
										 </span>

									</div>									


								
									
									<?php if($v5['Address']['id']){ ?>
										
										<div style="background: whitesmoke; border: 1px solid azure; padding: 5px; margin-bottom: 10px;  border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px;">
										
											<h4 style=" margin: 5px;">Ya definiste la direccion de envio:</h4>	
											<b><?php echo $v5['Address']['stateName'] ?> - <?php echo $v5['Address']['cityName'] ?> </b><br>
											<b>Nombre:</b>  <?php echo $v5['Address']['name'] ?> <br>
											<b>Dirección:</b>  <?php echo $v5['Address']['address'] ?> <br>
											<b>Telefonos de quien recibe el paquete:</b>  <?php echo $v5['Address']['phones'] ?> <br>
											<b>Información adicional:</b>  <?php echo $v5['Address']['additional_information'] ?> 
											<br>
											<br>
											<b>Nota: En <a href="/account_settings">Configuración de la cuenta</a>, podras editar esta dirección.</b>
										</div>										
										
									<?php } ?>
									
									<?php if($v5['Payment']['id']){ ?>

										<div style="background: whitesmoke; border: 1px solid azure; padding: 5px; margin-bottom: 10px;  border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px;">
										
											<h4 style=" margin: 5px;">Ya registraste el pago:</h4>	
											<b>Cuenta donde despositaste o transferiste:</b>  <?php echo $v5['Payment']['bankAccountIdName'] ?> <br>
											<b>Tipo de transacion:</b>  <?php echo $v5['Payment']['transactionTypeName'] ?> <br>
											<b>Número de deposito o transferencia:</b>  <?php echo $v5['Payment']['control_number'] ?> <br>
											<b>Monto:</b>  <?php echo $v5['Payment']['amount'] ?> <br>
											<b>Información adicional:</b>  <?php echo $v5['Payment']['additional_information'] ?> 
										</div>																				
			

									<?php } ?>										
									<?php if($v5['Billing']['id']){ ?>
										
										<div style="background: whitesmoke; border: 1px solid azure; padding: 5px; margin-bottom: 10px;  border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px;">
											<h4 style=" margin: 5px;">Ya definiste datos solicitados que iran en la factura:</h4>	
											<b>La factura estara a nombre de:</b>  <?php echo $v5['Billing']['billing_name'] ?> <br>
											<b>Cedula:</b>  <?php echo $v5['Billing']['identity_card'] ?> <br>
											<b>Direccion Fiscal:</b>  <?php echo $v5['Billing']['fiscal_address'] ?> <br>
											<b>Telefono:</b>  <?php echo $v5['Billing']['phone'] ?> 
										</div>										

									<?php } ?>										
									
						
						<div style=" background: whitesmoke; border: 1px solid azure;  padding-bottom: 10px; border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; padding-right: 10px;">	
						
						<?php if($v5['RatingOfPurchase']['id']){ ?>
							
							<div style="overflow: hidden; margin-top: 10px;">
											<div style="float: left; padding-left: 10px;">
								
												<b>Esta compra fue calificada como: 
											
													<?php 	
														switch ($v5['RatingOfPurchase']['rating']) {
															case 1:
																echo '★ Pésima';
																break;
															case 2:
																echo '★★ Deficiente';
																break;
															case 3:
																echo '★★★ Regular - Aceptable';
																break;
															case 4:
																echo '★★★★ Bueno - Mejorable';
																break;
															case 5:
																echo '★★★★★ Exelente - Impecable';
																break;
														}
													?>	
												</b>			
											
											</div>
											<div style="float: right;">
											
												<b><a href="<?php echo $this->Html->url('/deleted_this_purchase'.'/'.$v5['Purchase']['id'], true); ?>" >Borrar</a> esta compra.</b>
											
											</div>
							</div>
							
								
							
						<?php } ?>
						
						
									<?php foreach($v5['PurchasedProduct']  as $data){ ?>
										
										<?php //debug(); //debug($data['Image'][0]['name']); 

											$arrayImagenes = array();
											foreach ($data['Image'] as $i => $arrayValues  ){
												if($arrayValues['deleted']=='0'){
													$arrayImagenes[] = $arrayValues['name'];  
												}
											}
											if(!$arrayImagenes){
												$arrayImagenes[0] = 'noImage.jpg';
											}										
										
										 ?>
						
										
										<div style="padding-top: 10px; padding-left: 10px;">
											<div class="product-universal-container" style=" background: whiteSmoke;">
												<div style="float:left; width: 121px; overflow: hidden;"><a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($data['title'])).'/'.$data['product_id'], true); ?>" style="text-decoration: none;">  <?php echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0], array('alt' => $data['Image'][0]['name'],'class'=>'product-universal-image')); ?>  </a></div>
												<div style=" overflow: hidden;"><a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($data['title'])).'/'.$data['product_id'], true); ?>" style="text-decoration: none;"><div class="product-universal-name"><?php echo $data['title']; ?></div></a>
													<div class="product-universal-options">
														<div style="float: left;">
															<div style="display: none;">
																<a href="" >Edite la evaluación del producto</a><br>
																<a href="" >Escriba una evaluación del producto</a>
															</div>
														</div>  
														<div style="overflow: hidden; float: right; padding-left: 30px">Cantidad: <br> <center><?php echo $data['quantity']; ?></center></div>
														<div style="overflow: hidden; float: right;" >Precio:  <br> <center><?php echo $data['price']; ?></center> </div>																					
													
													</div>
												</div>
											</div>
										</div>				
									
		
						
									<?php } ?>
									
						</div>						
										
								<?php } ?>	
							<?php } ?>	
						<?php } ?>	
					
					</div>
				
				
				
				</div>		
			</div>
			
			<?php } ?>	
		<?php } ?>	
			
		</div>

<?php }else{ ?>
	
		<div class="preguntas" >		
				<center><h2>No tienes registrado productos comprados</h2></center>
		</div>
		
<?php } ?>	


	</div>
</div>	
</div>
