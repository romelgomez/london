<div class="contenedor-b" style="padding:10px;" >
	<div class="b-menu"> 

<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre" > 


	<div class="preguntas" >
		
		<?php  echo $this->Session->flash(); ?>
		
		<h3 style="margin: 12px; margin-left: 5px;" >Borradores:</h3>
		
			<?php		
				if($products){
			
				foreach ($products as $product):
					if($product['Image']){
						$arrayImagenes = array();
						foreach ($product['Image'] as $i => $arrayValues  ){
							if($arrayValues['deleted']=='0'){
								$arrayImagenes[] = $arrayValues['name'];  
							}
						}
						if(!$arrayImagenes){
							$arrayImagenes[0] = 'noImage.jpg';
						}
					}else{
						$arrayImagenes[0] = 'noImage.jpg';
					}				
			
					// noImage-120x120.jpg
			?>
			
								<!-- producto -->
								 <div class="product-universal-container" style="margin-bottom: 10px; background: whiteSmoke;">
                                    <div style="float:left; width: 121px; overflow: hidden;">
                                    
										<?php  if($arrayImagenes[0] != 'noImage.jpg'){ ?>
											<a  href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($product['Product']['title'])).'/'.$product['Product']['id'], true); ?>" >
												<?php echo '<img src="/imageProduct/120/120/2/'.$arrayImagenes[0].'" alt="Test" class"product-universal-image" >';  ?>
											</a>	
										<?php }else{ ?>
											<a href="<?php echo $this->Html->url('/edit_draft/'.$product['Product']['id'], true); ?>" >						
												<?php echo '<img src="/imageProduct/120/120/2/'.$arrayImagenes[0].'" alt="Test" class"product-universal-image" >';  ?>
											</a>
										<?php } ?>
                                    
                                    </div>
                                    <div style=" overflow: hidden;">
                                       
                                      
                     <?php  if($product['Image']){ ?>
						<a style="text-decoration: none;"  href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($product['Product']['title'])).'/'.$product['Product']['id'], true); ?>" >
							<div class="product-universal-name"> <?php echo  substr($product['Product']['title'], 0, 18); if((strlen($product['Product']['title']))>18){ echo" ...";} ?></div>
						</a>	
					<?php }else{ ?>
						<a  style="text-decoration: none;"  href="<?php echo $this->Html->url('/edit_draft/'.$product['Product']['id'], true); ?>" >
							<div class="product-universal-name"><?php  echo  substr($product['Product']['title'], 0, 18); if((strlen($product['Product']['title']))>18){ echo" ...";} ?></div>
						</a>
					<?php } ?>
                                      
                                      
                                      
                                        <div class="product-universal-options">
												Opciones disponibles: <br> 
                                         
												<a href="<?php echo $this->Html->url('/edit_draft/'.$product['Product']['id'], true); ?>">1) Editar.</a>
											  	
											  	<!-- 4) Statistics. -->
												<br>
												Data basica: <br>
												Precio :<?php echo $product['Product']['price']; ?> BsF.
																	 
                                         
                                         </div>
                                    </div>
                                </div>
								<!-- end -->
		
	
	
	
		<?php endforeach; 
		
		}else{
			echo 'no hay productos publicados, no hay producto que listar.';
		}	
		
		?>
		<!-- Fin Productos -->
	
	</div>
	
	
	</div>
</div>	
