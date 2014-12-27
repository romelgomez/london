<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

	<div class="preguntas" >

		<?php  if($company['Company']['id']){ ?>

			<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> 
				<span>
					<div style="overflow: hidden;" >
						<div style="width: 100px; float: left;" >Garantias:</div> 
						<div style="float: right;" ><?php echo $company['Company']['name'].' '.$company['Company']['type'].' '.$company['Company']['rif']; ?></div>
					</div>
				</span> 
			</div>

			<h4 style="margin: 12px; margin-left: 5px;" > <b>Ver tambien:</b> <?php echo '<a href="/policies_of_the_seller/'.strtolower(Inflector::slug($company['Company']['name'])).'/'.$company['Company']['id'].'">Politicas</a>'; ?></h4>
				<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
					 <?php echo $company['Company']['warranties']; ?><br>
				</div>
			
		<?php } ?>	

	</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	


