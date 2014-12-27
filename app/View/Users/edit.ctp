<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<ul>
				<li><a href="/myPurchases">Productos comprados</a></li>
				<li><a href="/questionsAndAnswers">Preguntas y respuestas</a></li>
				<li><a href="/newProduct">Nuevo producto</a></li>
				<li><a href="/listProducts">Listar todos los productos</a></li>
				<li><a href="/soldProducts">Productos vendidos</a></li>
				<li><a href="#">Reputación</a></li>
				<li><a href="/accountSettings">Configuración de la cuenta</a></li>
		</ul>
	</div>
	<div class="b-sobre"> 

		<div class="preguntas" >
			<h2 style="margin: 12px; margin-left: 5px;" >Editar datos personales:</h2>
				


					<?php 
						echo $this->Form->create('Store',  array('url' => '/editPersonalData'));
								
							echo $this->Form->input('User.name',array('label'=>'Nombres:','class'=>'input-basic'));
							echo $this->Form->input('User.family_name',array('label'=>'Apellidos:','class'=>'input-basic'));
							echo $this->Form->input('User.email',array('label'=>'Email:','class'=>'input-basic'));
							echo $this->Form->input('User.phone',array('label'=>'Telefonos:','class'=>'input-basic')); 

						echo '<br>';
					
						echo $this->Form->submit('Guardar', array('class' => 'g-button-red g-button', 'title' => 'Guarda, podras editar posteriormente.'));
						
						
						echo $this->Form->end();
						
					?>



		</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	



