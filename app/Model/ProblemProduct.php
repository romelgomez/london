<?php class ProblemProduct extends AppModel {



	var $belongsTo = array(
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'problem_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PurchasedProduct' => array(
			'className' => 'PurchasedProduct',
			'foreignKey' => 'purchased_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>
