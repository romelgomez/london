<?php
class Payment extends AppModel {
	var $name = 'Payment';
	
	var $validate = array(
		'bank_account_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'billing_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'transaction_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'control_number' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Falta',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'amount' => array(
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


	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BankAccount' => array(
			'className' => 'BankAccount',
			'foreignKey' => 'bank_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Purchase' => array(
			'className' => 'Purchase',
			'foreignKey' => 'purchase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Billing' => array(
			'className' => 'Billing',
			'foreignKey' => 'billing_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);




}
?>
