<div class="contenedor-b"  style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>	
	<div class="b-sobre"> 

		<div class="preguntas">

<div id="debug"></div>

<h2>Seleciona una categoria: </h2>

	<div id="menu-container" class="class-all-menu-container" >
		
		<div id="path" style="overflow: hidden; height: 20px;">Seleccione una categoría que mejor se adapte a el artículo</div>
		
		<div id="menu-box"  style=" border: 1px solid #61D7FF; height: 265px; border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px;border-bottom-left-radius: 6px 6px;border-bottom-right-radius: 6px 6px;overflow-x: scroll;overflow-y: hidden;" >
			<div id="menu" style="overflow: hidden;">
				<?php 
					if($namespaces){
						echo  '<div class="ulMenu" id="default-options">';		
						foreach($namespaces as $k => $v){
							echo '<div class="liMenu" id="category-id-'.$v['Category']['id'].'"> '.$v['Category']['name'].'</div>';	
						}
						echo '</div>';
					}
				?>
			</div>		
		</div>

	</div>

<div>

<br>
<h2>Metas:</h2>
<br>
<br>
- integrar con add product
<br>
- hacer la nube de cateorias: basasda en la selecion del vendedor. ordenada segun su popularidad. 
<br>
- eleminar el bug de configuracion del menu. el comportamiento no es muy solido.

<h2><br><br><br>Data: </h2>

<?php 

function tree($elementsData){
	
	foreach($elementsData as $k=>$v){		
		// nivel 1
		echo '<li id="'.$v['Category']['id'].'"> '.$v['Category']['name'];	
		if($v['children']){
			// nivel 2
			echo '<ul>';
				tree($v['children']);
			echo '</ul>';				
			echo '</li>';	
		}else{
			echo '</li>';
		}	
	}
		
} 


echo  '<ul id="mytree-standard">';
tree($elementsData);
echo '</ul>';


?>





<br>
<br>
<h2>Form: </h2>

<?php 

	echo $this->Form->create('Category',array('url' => '/categories')); 
	
		echo $this->Form->input('name', array('label' => 'Nombre:'));

		echo $this->Form->input(
			'is',
				array(
					'options' => array('1'=>'Un departamento','2'=>'Una categoría','3'=>'Un sub-titulo'),
					'type' => 'select',
					'empty' => '<--- Sera --->',
					'label' => 'Cual es el fin del nombre'
				)
		);

	echo $this->Form->submit('Guardar');
					
	echo $this->Form->end();

?>



</div>

		
		</div>

		
	</div>	

</div>
