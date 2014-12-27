<?php class Review extends AppModel{ 

	var $name = 'Review';
	
	var $belongsTo = array(
		'Part' => array(
			'className' => 'Part',
			'foreignKey' => 'Part_id',
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
	
	var $hasMany = array(	
	'CommentsOfReview' => array(
			'className' => 'CommentsOfReview',
			'foreignKey' => 'review_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	'HelpfulReview' => array(
			'className' => 'HelpfulReview',
			'foreignKey' => 'review_id',
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
