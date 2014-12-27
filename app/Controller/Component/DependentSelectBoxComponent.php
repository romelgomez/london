<?php
class DependentSelectBoxComponent extends Component {

		public $data=array();
		
		public function newSimpleSelect($selectConfig=null,$thisRequest=null,$ajax,$currentModel=null){
									
			if(!$thisRequest){
				foreach($selectConfig as $key=>$value){
					$this->{$key} = ClassRegistry::init($key);
	
					if($selectConfig[$key]['parentClass'] == null){
						
						$fields = array();
						if(isset($value['fields'])){
							$fields =  $value['fields'];						
						}
							
						$conditions = array();
						if(isset($value['conditions'])){
							$conditions =  $value['conditions'];						
						}
						
						$targetField = strtolower($key).'_id';						
						$data[$currentModel][$targetField] = $this->$key->find('list',array('fields'=>$fields,'conditions' =>$conditions));
						
						# lleno el array con los select dependientes - nulos.
						foreach($selectConfig[$key]['update'] as $v){
							
							$targetField = strtolower($v).'_id';
							$data[$currentModel][$targetField] = array();
							
						}
					}
				}
			}
			
			if($ajax){
				if($thisRequest){
					
					foreach($thisRequest as $k=>$v){
						$requestQuery[$k]['id']=  $v;
					}
					
					if($selectConfig[key($requestQuery)]['childClass']){
						$childClass = $selectConfig[key($requestQuery)]['childClass']; // la clase hija del select que selecionamos.
						
						$this->{$childClass} = ClassRegistry::init($childClass);

						$fields = array();
						if(isset($selectConfig[$childClass]['fields'])){
							$fields =  $selectConfig[$childClass]['fields'];						
						}
						
						$conditions = array($childClass.'.'.$selectConfig[$childClass]['foreignKey']=>$requestQuery[key($requestQuery)]['id']);
						//debug($conditions);
						
						if($selectConfig[$childClass]['conditions']){
							$conditions +=  $selectConfig[$childClass]['conditions'];
						}			
						
						$targetField = strtolower($childClass).'_id';
						$data[$currentModel][Inflector::camelize($targetField)] = $this->$childClass->find('list', array('fields'=>$fields,'conditions' => $conditions));
					
						# lleno el array con los select dependientes - nulos.
						
						if(isset($selectConfig[$childClass]['update'])){
							foreach($selectConfig[$childClass]['update'] as $v){
									
								$targetField = strtolower($v).'_id';	
								$data[$currentModel][Inflector::camelize($targetField)] = array();
									
							}
						}
					}
				}
			}elseif($thisRequest){
				
			
				foreach($selectConfig as $key=>$value){
					$this->{$key} = ClassRegistry::init($key);
					
										
					########### Fields
					$fields = array();
					if(isset($selectConfig[$key]['fields'])){
						$fields =  $selectConfig[$key]['fields'];						
					}
					
					
					########### Conditions
					$conditions = array();
					if($selectConfig[$key]['parentClass'] == null){
						
						// trae todos los registros del elemento padre.
						if(isset($selectConfig[$key]['conditions'])){
							$conditions =  $selectConfig[$key]['conditions'];						
						}
					}else{
						/*
						Array
						(
							[State.country_id] => debe se el id del padre en la solicitud. es decir Address.country_id
						)
						*/
						//debug($thisRequest[$currentModel][$selectConfig[$key]['foreignKey']]);
						
						if(isset($thisRequest[$currentModel][$selectConfig[$key]['foreignKey']])){
							$conditions = array($key.'.'.$selectConfig[$key]['foreignKey'] =>$thisRequest[$currentModel][$selectConfig[$key]['foreignKey']]);
						}else{
							$conditions = array($key.'.'.$selectConfig[$key]['foreignKey'] =>null);
						}
						
						
						if(isset($selectConfig[$key]['conditions'])){
							foreach($selectConfig[$key]['conditions'] as $k =>$v){
								$conditions[$k] = $v;
							}
						}
					
					}
					
					########### Consulta
					$targetField = strtolower($key).'_id';
					$data[$currentModel][$targetField] = $this->$key->find('list',array('fields'=>$fields,'conditions' =>$conditions));
					
				}
			}
			if(!isset($data)){ $data = null; }
			return $data;
		}
}
?>
