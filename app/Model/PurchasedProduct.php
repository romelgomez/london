<?php
	class PurchasedProduct extends AppModel {
		var $name = 'PurchasedProduct';
		//The Associations below have been created with all possible keys, those that are not needed can be removed

		var $belongsTo = array(
			'Purchase' => array(
				'className' => 'Purchase',
				'foreignKey' => 'purchase_id',
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
			),
			'Store' => array(
				'className' => 'Store',
				'foreignKey' => 'store_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
		
	var $hasMany = array(	
		'Review' => array(
				'className' => 'Review',
				'foreignKey' => 'purchased_product_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			)
		);
		
			
}
?>
