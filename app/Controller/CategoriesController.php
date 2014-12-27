<?php class CategoriesController extends AppController{
	
	
	public function beforeFilter(){
			
		$this->Auth->allow('getChildElements','getPathOf');
			
		parent::beforeFilter();				
	
	}
	
	public function index(){
		
		$namespaces = $this->Category->find('all', array(
			'conditions' => array('Category.parent_id'=>null),
			'order' => 'lft ASC'
		));		
		$this->set('namespaces',$namespaces);	 
			
		$elementsData =  $this->Category->find('threaded', array(
			//'conditions' => array('article_id' => 50),
			'order' => 'lft ASC' 
		));	
		
		$this->set('elementsData',$elementsData);
		
		if($this->request->is('ajax')){
			$request = $this->request->query;
				foreach($request as $k=>$v){
					$requestQuery[$k]['id']=  $v;
				}
				
				$registeredData = $this->Category->save($request);
				
				//$object = json_encode(array('id'=>$registeredData['Category']['id'],'name'=>$registeredData['Category']['name'],'is'=>$registeredData['Category']['is']));
				$elementData = array('id'=>$registeredData['Category']['id'],'name'=>$registeredData['Category']['name'],'is'=>$registeredData['Category']['is']);
				
				$this->set('elementData',$elementData);
				$this->render('category','ajax');
				
		}		
	}
	
	
	public function editTree(){
		
		if($this->request->is('ajax')){
			$request = $this->request->data;
				
				//debug($request);

				$this->Category->id = $request['element'];
				$category = $this->Category->read();
									
				if($request['parent']){
					
					$category['Category']['parent_id'] = $request['parent'];	
					$this->Category->save($category);
				
				}else{
						
					$category['Category']['parent_id'] = NULL;	
					$this->Category->save($category);						
					
				}
				
				
				if($request['previous']){
					$element = $this->Category->findById($request['element']);
					$previous = $this->Category->findById($request['previous']);
				
				//	debug($element);	
				//	debug($previous);	
				
					if($element['Category']['lft'] < $previous['Category']['lft']){
						$resta = $previous['Category']['lft'] - $element['Category']['lft'];
						$media = $resta/2; 
						
						//debug('resta '.$resta);
						//debug('media '.$media);
						$this->Category->moveDown($request['element'], $media);	
						
						//debug('bajar');
						
					}
					if($element['Category']['lft'] > $previous['Category']['lft']){
						
						$resta = $element['Category']['lft'] - $previous['Category']['lft'];
						$mediaAltered = ($resta/2)-1; 
						
						//debug('resta '.$resta);
						//debug('media MENOS 1 =  '.$mediaAltered);
						
						if($mediaAltered){
							$this->Category->moveUp($request['element'], $mediaAltered);
							//debug('subir');
						}
					}
				}
				
				$elementData = null;
				$this->set('elementData',$elementData);
				$this->render('category','ajax');
				
		}
		
	}
	
	public function getChildElements(){			
				
		if($this->request->is('ajax')){
			
			$request = $this->request->query;
									
			$children = $this->Category->find('all', array(
				'conditions' => array('Category.parent_id'=>$request['parent']),
				'order' => 'lft ASC'
			));
					
			if($children){
				foreach($children as $k => $v){
					$data[$v['Category']['id']] = $v['Category']['name']; 
				}
			}else{
				$data['last'] = $request['parent'];
			}
		
			$this->set('children',$data);
			$this->render('childElements','ajax');	
				
		}			
		
	}
	
	public function getPathOf(){

			if($this->request->is('ajax')){			
				$request = $this->request->query;
				
				$parents = $this->Category->getPath($request['pathOf']);
						
				foreach($parents as $k => $v){
					
					$parents2[$k]['id'] = $v['Category']['id'];
					$parents2[$k]['name'] = $v['Category']['name']; 
					
				}
				
				$this->set('parents',$parents2);
				$this->render('getPathOf','ajax');
			}
	}
	
	public function getChildElements2($id){
	
		
		// esta logia la usa buildMenu()
		$children = $this->Category->find('all', array(
			'conditions' => array('Category.parent_id'=>$id),
			'order' => 'lft ASC'
		));
					
		if($children){
			foreach($children as $k => $v){
				$data[$v['Category']['id']] = $v['Category']['name']; 
			}
						
		}else{
			$data['last'] = $id;
		}	
		
		return $data;	
		
	}
	
	public function buildMenu(){

		if($this->request->is('ajax')){			
			$request = $this->request->query;
				
			$parents = $this->Category->getPath($request['id']);
						
			foreach($parents as $k => $v){				
				$parents2[$k]['id'] = $v['Category']['id'];
				$parents2[$k]['name'] = $v['Category']['name'];					
			}
			
			foreach($parents2 as $k => $v){
				 				 
				 $parents3[$k]['id']  =  $v['id'];
				 $parents3[$k]['name']  = $v['name'];
				 $parents3[$k]['children']  = $this->getChildElements2($v['id']);
				
			}
							
			$this->set('parents',$parents3);
			$this->render('buildMenu','ajax');
		}
	}



}


?>
