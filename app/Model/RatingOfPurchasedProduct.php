<?php
class RatingOfPurchasedProduct extends AppModel {
	var $name = 'RatingOfPurchasedProduct';

	var $belongsTo = array(
		'RatingOfPurchase' => array(
			'className' => 'RatingOfPurchase',
			'foreignKey' => 'rating_of_purchase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}


?>
