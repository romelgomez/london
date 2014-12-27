<div class="contenedor-b"  style=" padding:10px">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre" style="width: 978px;"> 



<?php    
	echo $this->Form->create(null, array('url' => '/edit_your_experience/'.$this->data['Purchase']['id']));
?>

<div class="preguntas" >
		<!-- <span>archivar: esconde las compras, borrar: borrar las compras</span> -->
		<h2 style="margin: 12px; margin-left: 5px;" >Califica tu experiencia con la empresa:</h2>
		<div class="inCart" style="margin-bottom: 0px;">
			<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" > <span style="font-size: 16px;" ><?php echo $this->data['Purchase']['created']; ?></span></div>		
			
			<div style="padding: 5px;">		
				<div style="padding: 7px;" ><h3 style=" margin-top: 0px;  margin-bottom: 0px; ">Vendedor: <?php echo $this->data['Company']['name'].' '.$this->data['Company']['type']; ?> <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($this->data['Company']['name'])).'/'.$this->data['Company']['id']; ?>">Contacta al vendedor</a> </h3></div>
				<div class="inHora" style="padding: 5px; padding-left: 20px;">
					
					<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
						<h3 style="margin-bottom: 7px; margin-top: 0px; ">Tienda: <a href="<?php echo '/contact_the_seller/'.strtolower(Inflector::slug($this->data['Company']['name'])).'/'.$this->data['Company']['id'].'#'.Inflector::slug($this->data['Store']['name']); ?>"> <?php echo $this->data['Store']['name']; ?></a> | <?php echo $this->data['Store']['stateName'].' - '.$this->data['Store']['cityName']; ?>.<br></h3>
						
										<span><b style=" padding-left: 5px; ">Hora: <?php echo $this->data['Company']['created']; ?></b></span>
								
										<div>
											<?php 
												echo $this->Form->hidden('RatingOfPurchase.id',array('value'=>$this->data['RatingOfPurchase']['id']));
													
												echo $this->Form->input(
													'RatingOfPurchase.rating',
													array(
														'options' => array('1' => '★ Pésima','2' => '★★ Deficiente','3' => '★★★ Regular - Aceptable','4' => '★★★★ Bueno - Mejorable', '5' => '★★★★★ Exelente - Impecable'),
														'type' => 'select',
														'empty' => '-- Seleciona una calificacion en general basada en su experiencia con la empresa.  --',
														'label' => ''
													)
												); 
											?> 
										</div>
								
								
									<?php foreach($this->data['PurchasedProduct']  as $data){ ?>
										
										
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
												<div style="float:left; width: 121px; overflow: hidden;"><a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($data['title'])).'/'.$data['product_id'], true); ?>" style="text-decoration: none;">  <?php echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0], array('alt' => $data['Image'][0]['name'],'class'=>'product-universal-image')); ?>  </a></div>
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

															<?php echo $this->Form->hidden('RatingOfPurchasedProduct.'.$data['product_id'].'.id',array('value'=>$data['RatingOfPurchasedProduct']['id']));  ?>	
															
															¿El artículo estaba bien embalado?
															
															<?php
																$options=array('1'=>'Si','0'=>'No');
																$attributes=array('legend'=>false,'value'=>$data['RatingOfPurchasedProduct']['well_packaged']);
																echo $this->Form->radio('RatingOfPurchasedProduct.'.$data['product_id'].'.well_packaged',$options,$attributes);
															?>
															
															<br>
																		
															¿El artículo es según lo descrito por el vendedor?
														
															<?php
																$options=array('1'=>'Si','0'=>'No');
																$attributes=array('legend'=>false,'value'=>$data['RatingOfPurchasedProduct']['as_described']);
																echo $this->Form->radio('RatingOfPurchasedProduct.'.$data['product_id'].'.as_described',$options,$attributes);
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
								
										<input type="submit" value="Enviar" class="g-button">
										
						
					</div>
				</div>
			</div>
		</div>
	</div>


<?php 	echo $this->Form->end(); ?>

	</div>
</div>	
