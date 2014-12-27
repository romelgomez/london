<?php class ProblemExtension extends AppModel{

	public $belongsTo = array(
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'problem_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
}?>
