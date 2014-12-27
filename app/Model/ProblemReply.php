<?php class ProblemReply extends AppModel{
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'problem_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
} ?>
