

<div class="contenedor-b" style="padding: 10px;" >
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 
	
		<!-- Notas: Se debe agregar al modelo purchases, un campo que almace los valores que puedan cambiar en la vida de un producto publicado. como precio.<br><br> -->



<?php if($soldProducts){ ?> 

<?php //debug($soldProducts); ?>

	<div class="preguntas" >
		<h4 style="margin: 12px; margin-left: 5px;" >Productos vendidos:</h4>
			
			<?php foreach($soldProducts as $fecha => $dataEtapa1){ ?> 

		
					<div class="inCart" style="margin-bottom: 0px;">
						<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" >
							<span style="font-size: 16px;" >Fecha: <?php echo $fecha; ?> </span>
						</div>		
							
								<?php foreach($dataEtapa1 as $comprador => $dataEtapa2){ ?> 
								<div style="padding: 5px;">		
									<div style="padding: 7px;" ><span><b>Comprador: <?php echo $comprador; ?> --  Contacta al cliente  ---  Registra el cupon de envio  -- informanos de algun inconveniete.</b></span></div>
									
										<?php foreach($dataEtapa2 as $hora => $dataEtapa3){ ?>
									
										<div class="inHora" style="padding: 5px; padding-left: 20px;">
											<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
												<span><b>Hora: <?php echo $hora; ?></b></span>
												<div style="padding-top: 5px;">
												
													<?php foreach($dataEtapa3 as $data){ ?>
													
													
														<?php  foreach($data['PurchasedProduct'] as $k =>$v){ //debug($v);
														
															$arrayImagenes = array();
															foreach ($v['Image'] as $i => $arrayValues  ){
																if($arrayValues['deleted']=='0'){
																	$arrayImagenes[] = $arrayValues['name'];  
																}
															}
															if(!$arrayImagenes){
																$arrayImagenes[0] = 'noImage.jpg';
															}
														
														
														
														 ?>
															<!-- producto -->
															 <div class="product-universal-container" style="margin-bottom: 10px; background: whiteSmoke;">
																<div style="float:left; width: 121px; overflow: hidden;">
															
																	<a href="<?php echo $this->Html->url('/'.Inflector::slug($data['Company']['name']).'/'.Inflector::slug($v['title']).'/'.$v['product_id'], true); ?>" style="text-decoration: none;">
																		<?php echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0], array('alt' => 'Test','class'=>'product-universal-image')); ?>
																	</a>
																	
																</div>
																<div style=" overflow: hidden;">
																	
																	<a href="<?php echo $this->Html->url('/'.Inflector::slug($data['Company']['name']).'/'.Inflector::slug($v['title']).'/'.$v['product_id']); ?>" style="text-decoration: none;">
																		<div class="product-universal-name"> <?php echo $v['title'] ?></div>
																	</a>
																	
																	<div class="product-universal-options"> 
																	
																		<b>Precio:</b> <?php echo  $v['price']; ?>  <br>
																		<b>Cantidad:</b> <?php echo $v['quantity']; ?>
																	
																	</div>
																</div>
															</div>
															<!-- end -->
														<?php  } ?>													
													<?php  } ?>													
												
												</div>
												
											</div>
									</div>
								

										<?php  } ?>
								</div>
							<?php  } ?>
					</div>
			<?php } ?>
	</div>

<?php }else{ ?>

	<div class="preguntas" >
		<h2>No hay productos comprados</h2>
	</div>

<?php } ?>
		
						
		
	</div>
</div>	
