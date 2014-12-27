<div class="contenedor-b"  style=" padding:10px">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre" style="width: 978px;"> 

<?php	if($purchases){
			echo $this->Form->create(null, array('url' => '/rate_your_experience/set'));
?>

<div class="preguntas" >
		<h2 style="margin: 12px; margin-left: 5px;" >Califica tu experiencia con la empresa:</h2>
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
				<div style="padding: 7px;" ><h3 style=" margin-top: 0px;  margin-bottom: 0px; ">Vendedor: <?php echo $vendedor.' '.$type; ?> <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($vendedor)).'/'.$id; ?>">Contacta al vendedor</a> </h3></div>
				<div class="inHora" style="padding: 5px; padding-left: 20px;">
					
					
					<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
						<h3 style="margin-bottom: 7px; margin-top: 0px; ">Tienda: <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($vendedor)).'/'.$id.'#'.Inflector::slug($storeName); ?>"> <?php echo $storeName; ?></a> | <?php echo $storeStateName.' - '.$storeCityName; ?>.<br></h3>
						
						<?php foreach($v2 as $k3 => $v3){ ?>
							<?php foreach($v3 as $hora => $v4){ ?>
							 
											

								
								<?php foreach($v4 as $v5){ ?>

										<span><b style=" padding-left: 5px; ">Hora: <?php echo $hora; ?></b></span> <a name="<?php echo $v5['Purchase']['id']; ?>"></a>
								
									<?php //debug($v5); ?>
								
										<div>
																<?php 
									
																	//echo $this->Form->hidden('RatingOfPurchase.'.$v5['Purchase']['id'].'.purchase_id',array('value'=>$v5['Purchase']['id']));
																	echo $this->Form->hidden('Data.'.$v5['Purchase']['id'].'.RatingOfPurchase.purchase_id',array('value'=>$v5['Purchase']['id']));
																	
																	echo $this->Form->input(
																		'Data.'.$v5['Purchase']['id'].'.RatingOfPurchase.rating',
																		array(
																			'options' => array('1' => '★ Pésima','2' => '★★ Deficiente','3' => '★★★ Regular - Aceptable','4' => '★★★★ Bueno - Mejorable', '5' => '★★★★★ Exelente - Impecable'),
																			'type' => 'select',
																			'empty' => '-- Seleciona una calificacion en general basada en su experiencia con la empresa.  --',
																			'label' => ''
																		)
																	); 
																
																?> 
										</div>
								
								
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
												<div style="float:left; width: 121px; overflow: hidden;"><a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($data['title'])).'/'.$data['product_id'], true); ?>" style="text-decoration: none;">  <?php echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0], array('alt' => '','class'=>'product-universal-image')); ?>  </a></div>
												<div style=" overflow: hidden;"><a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($data['title'])).'/'.$data['product_id'], true); ?>" style="text-decoration: none;"><div class="product-universal-name"><?php echo $data['title']; ?></div></a>
													<div class="product-universal-options">
													
														<div style="  width: 600px; float: left; ">
															
																<style type="text/css">
																
																	.extencion{
																		
																		height:64px;
																		}
																	
																	.extencion2{
																		
																		padding-top:3px;
																		}
																	
																
																</style> 

															<?php echo $this->Form->hidden('Data.'.$v5['Purchase']['id'].'.RatingOfPurchasedProduct.'.$data['product_id'].'.product_id',array('value'=>$data['product_id']));  ?>	
															
															¿El artículo estaba bien embalado?
															
															<?php
																$options=array('1'=>'Si','0'=>'No');
																$attributes=array('legend'=>false);
																echo $this->Form->radio('Data.'.$v5['Purchase']['id'].'.RatingOfPurchasedProduct.'.$data['product_id'].'.well_packaged',$options,$attributes);
															?>
															
															<br>
																		
															¿El artículo es según lo descrito por el vendedor?
														
															<?php
																$options=array('1'=>'Si','0'=>'No');
																$attributes=array('legend'=>false);
																echo $this->Form->radio('Data.'.$v5['Purchase']['id'].'.RatingOfPurchasedProduct.'.$data['product_id'].'.as_described',$options,$attributes);
															?>
															

															
														</div>  
														<div style="float: right;">
															<div style="overflow: hidden; float: right; padding-left: 30px">Cantidad: <br> <center><?php echo $data['quantity']; ?></center></div>
															<div style="overflow: hidden; float: right;" >Precio:  <br> <center><?php echo $data['price']; ?></center> </div>																					
														</div>
													
													</div>
												</div>
											</div>
										</div>				
						
									<?php } ?>	
								<?php } ?>	
								
								
										<input type="submit" value="Enviar" class="g-button-red g-button" style=" margin-bottom: 10px; " >
	
									<br>
								
							<?php } ?>	
						<?php } ?>	
					
					</div>
				
				
				
				</div>		
			
			
				
			</div>
			
			<?php } ?>	
		<?php } ?>	
			
			
			
		</div>
	</div>


<?php 	echo $this->Form->end(); ?>

<?php }else{ ?>
	
		<div class="preguntas" >		
				<center><h2>No tienes registrado productos comprados</h2></center>
		</div>
		
<?php } ?>	


	</div>
</div>	
	
	



	




	
