
<div class="contenedor-b"  style=" padding:10px">
	<div class="b-menu"> 

		<?php echo $this->element('menu'); ?>

	</div>
	<div class="b-sobre" style="width: 978px;"> 

<?php

if($purchases){	 ?>	

<?php  // debug($purchases); ?>

<div class="preguntas" >
		<!-- <span>archivar: esconde las compras, borrar: borrar las compras</span> -->
		<h2 style="margin: 12px; margin-left: 5px; " >
			<div style="overflow: hidden; ">
				<div style="float: left;">
					Productos comprados Archivados:
				</div>
				<div style="float: right;">
				</div>
			</div>
		</h2>
		<div class="inCart" style="margin-bottom: 0px;">

		<?php foreach($purchases as $fecha =>$v){ ?>	
			<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" > <span style="font-size: 16px;" ><?php echo $fecha; ?></span></div>		
			
			<?php	foreach($v as $vendedor => $v2){
				
				
					foreach($v2 as $v3){
						foreach($v3 as $k4 => $v4){
							foreach($v4 as $k5 => $v5){
							
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
				<div style="padding: 7px;" ><h3 style=" margin-top: 0px;  margin-bottom: 0px; ">Vendedor: <?php echo $vendedor.' '.$type; ?> <a href="<?php echo '/contactTheSeller/'.Inflector::slug($vendedor).'/'.$id; ?>">Contacta al vendedor</a> </h3></div>
				<div class="inHora" style="padding: 5px; padding-left: 20px;">
					
					
					<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
						<h3 style="margin-bottom: 7px; margin-top: 0px; ">Tienda: <a href="<?php echo '/contactTheSeller/'.Inflector::slug($vendedor).'/'.$id.'#'.Inflector::slug($storeName); ?>"> <?php echo $storeName; ?></a> | <?php echo $storeStateName.' - '.$storeCityName; ?>.<br></h3>
						
						<?php foreach($v2 as $k3 => $v3){ ?>
							<?php foreach($v3 as $hora => $v4){ ?>
						
								<?php foreach($v4 as $v5){ ?>
						
									<span><b style=" padding-left: 5px; ">Hora: <?php echo $hora; ?>
											<?php  if(!$v5['RatingOfPurchase']['rating']){  ?>	
												<a href="<?php echo '/rateYourExperience/#'.$v5['Purchase']['id']; ?>">Califica esta compra</a> | 
													<?php }else{ ?>
												<a href="<?php echo '/editYourExperience/'.$v5['Purchase']['id']; ?>">Edite la calificación de esta compra</a> | 
											<?php } ?>
									
									 <a href="#">registra el pago </a> | <a href="#">registra la direccion de envio</a> | <a href="#">informanos de algun inconveniete</a> </b> </span>
									
									<?php if($v5['RatingOfPurchase']['id']){  ?>

										<br>
										<br>
											<center><b>Esta compra fue calificada como: 
											
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
													
											</b></center>
						
										<br>
										<b><center>Puedes: <a href="<?php echo $this->Html->url('/deletedThisPurchase'.'/'.$v5['Purchase']['id'], true); ?>" >Borrar</a> esta compra.</center></b>
																				
						
									<?php } ?>			
						
						
									<?php foreach($v5['PurchasedProduct']  as $data){ ?>
										
										<?php 
										
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
											<div class="product-universal-container" style="margin-bottom: 10px; background: whiteSmoke;">
												<div style="float:left; width: 121px; overflow: hidden;"><a href="<?php echo $this->Html->url('/'.Inflector::slug($v5['Company']['name']).'/'.Inflector::slug($data['title']).'/'.$data['product_id'], true); ?>" style="text-decoration: none;">  <?php echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0], array('alt' => $data['Image'][0]['name'],'class'=>'product-universal-image')); ?>  </a></div>
												<div style=" overflow: hidden;"><a href="<?php echo $this->Html->url('/'.Inflector::slug($v5['Company']['name']).'/'.Inflector::slug($data['title']).'/'.$data['product_id'], true); ?>" style="text-decoration: none;"><div class="product-universal-name"><?php echo $data['title']; ?></div></a>
													<div class="product-universal-options">
														<div style="float: left; ">
															<a href="" >Edite la evaluación del producto</a><br>
															<a href="" >Escriba una evaluación del producto</a>
														</div>  
														<div style="overflow: hidden; float: right; padding-left: 30px">Cantidad: <br> <center><?php echo $data['quantity']; ?></center></div>
														<div style="overflow: hidden; float: right;" >Precio:  <br> <center><?php echo $data['price']; ?></center> </div>																					
													</div>
												</div>
											</div>
										</div>				
						
									<?php } ?>	
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
	
	



	




	
