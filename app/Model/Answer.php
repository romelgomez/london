<?php
class Answer extends AppModel {
	var $name = 'Answer';
	var $displayField = 'answer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $validate = array(
		'question_id' => array(
			'isUnique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Por favor, facilite el número de recibo válido.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty')
				//'message' => 'Indica un titulo, sigue por favor esta convecion: marca - nombre - característica relevante - numero de parte  o modelo.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);

	var $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
