<?php class CommentsOfReview extends AppModel{ 

	var $name = 'CommentsOfReview';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'User_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Review' => array(
			'className' => 'Review',
			'foreignKey' => 'review_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(	
	'HelpfulCommentsOfReview' => array(
			'className' => 'HelpfulCommentsOfReview',
			'foreignKey' => 'comments_of_review_id',
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
