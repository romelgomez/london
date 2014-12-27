<div class="contenedor-b" style="padding: 10px; overflow: hidden;">
	<div class="b-menu"> 

		<?php echo $this->element('menu'); ?>
	
	</div>
	<div class="b-sobre" style="width: 978px;"> 

usuario	
	fecha
		compra
			incoveniente
				productos
				descipcion 
				estado
			incoveniente
				productos
				descipcion 
				estado


		<?php echo $this->Session->flash(); ?>

		<div class="preguntas" style="background:#DBDBDB;">

<?php //debug($problems); ?>

<br>

<style type="text/css">
	.problem-title{
		background: black; color: white; font-size: 17px; font-weight: bold; height: 22px; opacity: 0.65; border-top-right-radius: 6px 6px; border-top-left-radius: 6px 6px;  padding-left: 5px; font-family: 'Times New Roman',Georgia,Serif; overflow: hidden; padding-top: 4px;
	}
	.problem-title:hover{
		background: #65B9BF;
	}
</style>

			<?php  foreach($problems as $k=>$v){ ?>  
				<div style="background: whitesmoke; border: 1px solid azure; padding: 5px; margin-bottom: 10px;  border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px;">
					<div style=" border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; background: #EFEFEF; ">
						<a style="text-decoration:none" href="/viewThisClientRequest/<?php echo $v['Problem']['id']; ?>"><div  class="problem-title"><?php echo $v['Problem']['title']; ?></div></a>
						<div style=" padding: 10px; border: 1px solid #777; border-top: none; border-bottom-left-radius: 6px 6px; border-bottom-right-radius: 6px 6px; ">
	
								
							<b>Decripcion:</b>  <?php echo myTruncate($v['Problem']['description'], 100, ' ', '…'); ?><br>
								
								
							<br>
							<b>Status:</b> 
							<?php			
								switch ($v['Problem']['status']){
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
																	
						</div>
					</div>												
				</div>						
			<?php } ?>
		
		</div>

	</div>
</div>	
	
	



	

	



