<div class="contenedor-b" style="padding: 10px; overflow: hidden;">
	<div class="b-menu"> 
	
	<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre" style="width: 978px;"> 

		<?php echo $this->Session->flash(); ?>

	<div class="preguntas">
	<style type="text/css">
	
		.problem-title{
			background: black; color: white; font-size: 17px; font-weight: bold; height: 22px; opacity: 0.65; border-top-right-radius: 6px 6px; border-top-left-radius: 6px 6px;  padding-left: 5px; font-family:'Times New Roman',Georgia,Serif; overflow: hidden; padding-top: 4px;
		}
	
	
	
	</style> 


		<?php 

							
					?>	
						<br>
					<div style="overflow: hidden; font-size: 20px;">
						
							<div style="float: left;"><b>El problema</b></div>
							<div style="float: right;">
							
								<b>Status:</b>  				
																<?php 
																switch ($problem['Problem']['status']) {
																	case 0:
																		echo "Por procesar";
																		break;
																	case 1:
																		echo "Procedente";
																		break;
																	case 2:
																		echo "No procedente";
																		break;
																	case 3:
																		echo "En espera de recaudos";
																		break;
																}
																?>
							
								|
								<b>Fecha:</b>  <?php echo $problem['Problem']['created'] ?>
							
							</div>
					</div>
					
					<?php
						
						
						$quantityOfProducts = count($problem['ProblemProduct']);
						
						if($quantityOfProducts <2){
						
							echo '<h3>Por el siguiente producto ofertado:</h3>';
							echo '<a href="'.$this->Html->url('/'.Inflector::slug($problem['Company']['name']).'/'.Inflector::slug($problem['PurchasedProduct'][0]['title']).'/'.$problem['PurchasedProduct'][0]['product_id'], true).'" >'.$problem['PurchasedProduct'][0]['title'].'</a>';
						
						}else{
							echo '<h3>Por los siguientes productos ofertados:</h3>';
							foreach($problem['ProblemProduct'] as $v){
								
								echo '<a href="'.$this->Html->url('/'.Inflector::slug($problem['Company']['name']).'/'.Inflector::slug($v['PurchasedProduct']['title']).'/'.$v['PurchasedProduct']['product_id'], true).'" >'.$v['PurchasedProduct']['title'].'</a>';

								echo '<br>';										
							}
						} 
						
						?>
						
						<br>
						<br>
												<div style=" border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; background: #EFEFEF; ">
													<div class="problem-title"><?php echo $problem['Problem']['title']; ?></div>
													<div style=" padding: 10px; border: 1px solid #777; border-top: none; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; ">
														<b>Decripcion:</b>  <?php echo $problem['Problem']['description']; ?><br>
													</div>
												</div>
						<br>
		
						<?php 
												
							if(!$problem['ProblemExtension']['id'] && !$problem['ProblemReply']){
								echo $this->Form->create('Problem',  array('url' => '/extendThisRequest'));
					
								echo '<h4>Extiende si lo consideras necesario:</h4>';
							
								echo $this->Form->hidden('ProblemExtension.problem_id',array('value'=>$problem['Problem']['id']));
								
								echo $this->Form->input('ProblemExtension.extension',array('label'=>'Descripción:','class'=>'input-basic'));
						
								echo $this->Form->submit('Enviar', array('class' => 'g-button-red g-button'));
							
								echo $this->Form->end();
							} 
							
						?>
						
						
						<?php if($problem['ProblemExtension']['id']){ ?>							
							<div style=" border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; background: #EFEFEF; ">
								<div class="problem-title">Extención</div>
								<div style=" padding: 10px; border: 1px solid #777; border-top: none; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; ">
									<b>Decripcion:</b>  <?php echo $problem['ProblemExtension']['extension']; ?><br>
								</div>
							</div>
							<br>
						
							<?php if(!$problem['ProblemReply']){ ?>
								<b>Nota:</b> Tendra un sin numero de opotunidades de expresarse nuevamente una vez que la empresa responda su requerimiento en su primera oportunidad.							
							<?php } ?>
						
						<?php } ?>
						
						
						<?php 
							if($problem['ProblemReply']){
								foreach($problem['ProblemReply'] as $k=>$v){
									?>

									<div style=" border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; background: #EFEFEF; ">
										<div class="problem-title">
										<?php 
											if($v['role']==2){
												echo $problem['Company']['name'].' '.$problem['Company']['type'];
											}else{
												echo 'Cliente';	
											}
										?>
										</div>
										<div style=" padding: 10px; border: 1px solid #777; border-top: none; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; ">
											<?php echo $v['response']; ?><br>
										</div>
									</div>
									
									<br>
									<?php 
										
								}
								
								
								echo $this->Form->create('ProblemReply',  array('url' => '/replyThis'));						
								echo $this->Form->hidden('ProblemReply.problem_id',array('value'=>$problem['Problem']['id']));
								echo $this->Form->input('ProblemReply.response',array('label'=>'Responde:','class'=>'input-basic'));					
								
								echo '<br>';
								echo $this->Form->submit('Enviar', array('class' => 'g-button-red g-button'));						
								echo $this->Form->end();							
							
							
							}
						?>
						
						
<?php if(!$problem['ProblemReply']){ ?>
	<br>

	<div >
		<center><h2>No has respondido ahun.</h2></center>
	</div>


<?php } ?>	
	
	
	
	</div>

	</div>
</div>	
	
	



	




	



