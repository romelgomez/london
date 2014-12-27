<?php
// este modelo esta obsoleto.
class FeatureName extends AppModel {
	var $name = 'FeatureName';
	
	/*
	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
	
	*/
	var $hasMany = array(
		'Feature' => array(
			'className' => 'Feature',
			'foreignKey' => 'feature_name_id',
			'dependent' => false,
			'conditions'=>'',
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
