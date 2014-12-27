<?php
class BankAccount extends AppModel{
	var $name = 'BankAccount';
	var $displayField = 'number';

	
	
	var $validate = array(
		'bank_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'number' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);

	// pertenece a user - para saber quien registro la cuenta bancaria.
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
		'Bank' => array(
			'className' => 'Bank',
			'foreignKey' => 'bank_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'bank_account_id',
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
