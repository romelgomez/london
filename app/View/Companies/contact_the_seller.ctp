<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>
	<div class="b-sobre"> 

	<div class="preguntas" >
	

	<?php  if($company['Company']['id']){ ?>



<div style="background: #424242; color: white; padding: 10px; margin-top: 10px; font-size: 17px;"> <span>Empresa:</span> </div>

	<h4 style="margin: 12px; margin-left: 5px;" >Datos de la Empresa:  <?php echo '<a href="/policies_of_the_seller/'.strtolower(Inflector::slug($company['Company']['name'])).'/'.$company['Company']['id'].'">Politicas</a> y <a href="/warranties_of_the_seller/'.strtolower(Inflector::slug($company['Company']['name'])).'/'.$company['Company']['id'].'">Garantias</a>'; ?></h4>
		<div style="border:1px solid #CCC; padding: 10px; background: #DBDBDB">
			<b>Nombre: </b><?php echo $company['Company']['name'].' '.$company['Company']['type']; ?><br>
			<b>RIF: </b><?php echo $company['Company']['rif']; ?><br>
		</div>

	<?php if($stores){
		
		echo '<h4 style="margin: 12px; margin-left: 5px;" >Direcciones:</h4>';
			foreach($stores as $key=>$value){			 
	
	?>		
			<!--Direccion -->
			<div class="inCart" >
				<div>
					<div class="inFecha" style=" background: #E8402A; padding: 9px; font-size: 17px; height: 20px;" >
						<span style="font-size: 16px;" >
							<?php echo $value['Store']['name'];  ?> <div style="display:none"><a  href="#<?php echo Inflector::slug($value['Store']['name']); ?>"></a></div>
						</span>
					</div>
				
					<div style="padding: 10px; padding-top: 0px;">
						<div style="padding-bottom: 6px; padding-top: 10px;"><b><?php echo $value['Country']['name'].'->'.$value['State']['name'].'->'.$value['City']['name'];  ?></h4></b></div>
						<div>	
							<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
								<b>Dirección: </b><?php echo $value['Store']['address'];  ?><br> 
								<b>Telefonos: </b><?php echo $value['Store']['phones'];  ?> <br>
								<b>Correo: </b><?php echo $value['Store']['email'];  ?> <br>
							</div>
						</div>			
									
					</div>
				</div>		
			</div><!--end direccion -->

<?php	}
	 } // end stores
?>
		
<?php } ?>	

	</div><!-- end preguntas -->

	</div>
</div>	
	
	



	




	


