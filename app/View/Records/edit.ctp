  <?php
  
		//debug($this->data);
		//debug($product);
		//debug($purchase);
  
  ?> 


Your Purcharsed: <br><br>
<?php 
 
if($this->data){
 
	echo $this->Form->create('Record', array('url' => '/editYourExperience/set'));
		
		echo $this->Html->image('/img/products/'.$product['Image'][4]['name'], array('alt' => 'Market Of London'));
		echo '<br>';
		echo $product['Product']['title'].' (new)';
		echo '<br>';
		echo 'from: '.$product['User']['username'].'.<br>';
		echo 'seler rating (1 to 5 stars) click on star to choose a rating: ';
		
		echo $this->Form->hidden('id',array('value'=>$this->data['Record']['id']));
		echo $this->Form->hidden('user_id',array('value'=>$this->data['Record']['user_id']));
		echo $this->Form->hidden('product_id',array('value'=>$this->data['Record']['product_id']));
		echo $this->Form->hidden('purchase_id',array('value'=>$this->data['Record']['purchase_id']['id']));
		
		echo '<br>';
		echo $this->Form->textarea('body');
		echo '<br>';
		$options = array('1' => '★ Lo peor','2' => '★★ Deficiente','3' => '★★★ Regular','4' => '★★★★ Bueno', '5' => '★★★★★ Exelente');
		echo $this->Form->select('rating', $options);	
		echo '<br>';
		
		echo $this->data['Purchase']['created'];
		
		echo '<br>';
		echo '<br>';
		echo 'view seller profile +';
		echo 'contact the seller<br>';

	echo $this->Form->end('listo!');

}else{

	echo 'No hay compras que calificar.';  
	
}

?>

