<?php
class Purchase extends AppModel {
	var $name = 'Purchase';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'address_id',
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
	
	var $hasOne = array(
        'RatingOfPurchase' => array(
            'className'    => 'RatingOfPurchase',
            'foreignKey' => 'purchase_id',
            'conditions'   => '',
            'dependent'    => true
        ),
        'Payment' => array(
            'className'    => 'Payment',
            'foreignKey' => 'purchase_id',
            'conditions'   => '',
            'dependent'    => true
        ),
        'Billing' => array(
            'className'    => 'Billing',
            'foreignKey' => 'purchase_id',
            'conditions'   => '',
            'dependent'    => true
        )
    );
	
	var $hasMany = array(
		'PurchasedProduct' => array(
			'className' => 'PurchasedProduct',
			'foreignKey' => 'purchase_id',
			'dependent' => false,
			'conditions' =>'',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'purchase_id',
			'dependent' => false,
			'conditions' =>'',
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
