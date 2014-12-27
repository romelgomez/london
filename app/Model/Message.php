<?php class Message extends AppModel {
	
	public $displayField = 'body';
	public $actsAs = array('Containable');

	var $validate = array(
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Escribe algo.',
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
