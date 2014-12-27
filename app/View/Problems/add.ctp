<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

		<?php echo $this->Session->flash(); ?>

	<div class="preguntas">


		<?php 

			echo $this->Form->create('Problem',  array('url' => '/addRequestForToFixAProblem/'.$purchase['Purchase']['id']));
							
					echo '<h2>Describe el problema</h2>';			
						
						$quantityOfProducts = count($purchase['PurchasedProduct']);
						
						if($quantityOfProducts <2){
						
							echo '<h3>Por el siguiente producto:</h3>';
							echo '<a href="'.$this->Html->url('/'.Inflector::slug($purchase['Company']['name']).'/'.Inflector::slug($purchase['PurchasedProduct'][0]['title']).'/'.$purchase['PurchasedProduct'][0]['product_id'], true).'" >'.$purchase['PurchasedProduct'][0]['title'].'</a>';
						
						}else{
							echo '<h3>Seleciona el o los productos con el cuales tienes incovenientes:</h3>';
							
							
							foreach($purchase['PurchasedProduct'] as $v){
							
								echo $this->Form->checkbox('ProblemProduct.'.$v['id'].'.purchased_product_id', array('value' => $v['id']));
								
								echo '<a href="'.$this->Html->url('/'.Inflector::slug($purchase['Company']['name']).'/'.Inflector::slug($v['title']).'/'.$v['product_id'], true).'" >'.$v['title'].'</a>';

								echo '<br>';
										
							}
						} 
						
						if(isset($problemProductsIsNull)){
								echo 'Falta';
						}
						
							echo '<br>';
							echo '<br>';
							
							
						
						echo $this->Form->input('Problem.title',array('label'=>'Titulo descriptivo:','class'=>'input-basic'));
						echo $this->Form->input('Problem.description',array('label'=>'Descripcion completa:','class'=>'input-basic'));
				
					
					echo $this->Form->submit('Enviar', array('class' => 'g-button-red g-button'));
					
					echo $this->Form->end();

										
										
		?>

	<br>
	
	
	<h4 style="margin: 12px; margin-left: 5px;" ><?php echo $purchase['Company']['name'].' '.$purchase['Company']['type']; ?> recomienda apliamente al cliente informarse de las  <?php echo '<a href="/policiesOfTheSeller/'.Inflector::slug($purchase['Company']['name']).'/'.$purchase['Company']['id'].'">Politicas</a> y <a href="/warrantiesOfTheSeller/'.Inflector::slug($purchase['Company']['name']).'/'.$purchase['Company']['id'].'">Garantias</a>'; ?> de la Empresa.</h4>
	
	
<!--	Santomercado.com recomienda apliamente al cliente luego de notificarnos su incoformidad a la brevedad posible, seguir los canales regulares legales ya que existe la figura legal del vendedor. este beneficio se debe gracias 
	a la politica de santomercado.com  que solo permite a empresas legalmente registradas publicar sus ofertas.
	
	<br><br>
	Las empresas que publican en santomercado.con son selecionadas teniendo en cuenta la trayectoria y la calidad del servicio que prestan. Por lo tanto debe espresar su incoformidad con bases.  
-->	
	
	
	</div>

	</div>
</div>	
	
	



	




	



