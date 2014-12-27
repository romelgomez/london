<?php class ProblemsController extends AppController{
	
	
	public function viewThisClientRequest($id){
		if($this->Auth->User()){
			$problem = $this->Problem->find('first', array('conditions' => array('Problem.id' => $id,'Problem.company_id' => $this->userLogged['User']['company_id'])));

			if($problem){
				$this->loadModel('PurchasedProduct');
				foreach($problem['ProblemProduct'] as $k => $v){
					
				 	$data = $this->PurchasedProduct->find('first', array('conditions' => array('PurchasedProduct.id' => $v['purchased_product_id'])));
					$problem['ProblemProduct'][$k]['PurchasedProduct'] =  $data['PurchasedProduct'];
					
				}
				$this->set('problem',$problem);				
			}else{
				$this->redirect('/yourAccount');
			}
		}
	}
	
	public function problemsRegistered(){
		if($this->Auth->User()){
			$problems = $this->Problem->find('all', array('conditions' => array('Problem.company_id' => $this->userLogged['User']['company_id'])));
		
			$this->set('problems',$problems);
			
		}
		
		
		function myTruncate($string, $limit, $break='.', $pad='…'){
						if(strlen($string) <= $limit)
						return $string;
						if(false !== ($breakpoint = strpos($string, $break, $limit))){
							if($breakpoint < strlen($string) - 1) {
								$string = substr($string, 0, $breakpoint).$pad;
							}
						}
						return $string;
					}
						
		
		
	}
	
	
	public function view($id=null){
		if($this->Auth->User()){
			$problem = $this->Problem->find('first', array('conditions' => array('Problem.id' => $id,'Problem.user_id' => $this->userLogged['User']['id'])));

			if($problem){
				$this->loadModel('PurchasedProduct');
				foreach($problem['ProblemProduct'] as $k => $v){
					
				 	$data = $this->PurchasedProduct->find('first', array('conditions' => array('PurchasedProduct.id' => $v['purchased_product_id'])));
					$problem['ProblemProduct'][$k]['PurchasedProduct'] =  $data['PurchasedProduct'];
					
				}
				$this->set('problem',$problem);				
			}else{
				$this->redirect('/myPurchases');
			}
		}
	}
	
	public function extendsThisRequest(){
		if($this->Auth->User()){
			if($this->request->data){
				$this->loadModel('ProblemExtension');
				
				
				$this->loadModel('Purchase');
				$problem = $this->Problem->find('first', array('conditions' => array('Problem.id' => $this->request->data['ProblemExtension']['problem_id'],'Problem.user_id' => $this->userLogged['User']['id'])));
				if($problem){
					
					if($this->ProblemExtension->save($this->request->data)){
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemExtension']['id']);
					}else{
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemExtension']['id']);	
					}
				
				}else{
					$this->redirect('/myPurchases');
				}				
			}
		}
	}
	
	public function replyThis(){
		if($this->Auth->User()){
			if($this->request->data){
				$this->loadModel('ProblemReply');
				
				debug($this->request->data);
				
				$this->loadModel('Purchase');
				$problem = $this->Problem->find('first', array('conditions' => array('Problem.id' => $this->request->data['ProblemReply']['problem_id'],'Problem.user_id' => $this->userLogged['User']['id'])));
				if($problem){
					
					//debug($problem);
					debug('client');
					/*
					if($this->ProblemReply->save($this->request->data)){
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemReply']['id']);
					}else{
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemReply']['id']);	
					}
					*/
				}
				$problem = $this->Problem->find('first', array('conditions' => array('Problem.id' => $this->request->data['ProblemReply']['problem_id'],'Problem.company_id' => $this->userLogged['User']['company_id'])));
				if($problem){
					
					//debug($problem);
					debug('seler');
					/*
					if($this->ProblemReply->save($this->request->data)){
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemReply']['id']);
					}else{
						$this->redirect('/viewThisRequest/'.$this->request->data['ProblemReply']['id']);	
					}
					*/
				}
				
			}
		}
	}
	

	public function add($id){

		if($this->Auth->User()){
			
			$this->loadModel('Purchase');
			$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $id,'Purchase.user_id' => $this->userLogged['User']['id'])));
				
			if($purchase){
				//debug($purchase);
			
				$this->set(compact('purchase'));

					if($this->request->data){
						
						$this->request->data['Problem']['user_id'] = $this->userLogged['User']['id'];	
						$this->request->data['Problem']['company_id'] = $purchase['Purchase']['company_id'];	
						$this->request->data['Problem']['purchase_id'] = $purchase['Purchase']['id'];	
						
						
						
						function hasManyProduct($array){
							foreach($array['ProblemProduct'] as $k=>$v){
								if($v['purchased_product_id']!=0){
									$filter['ProblemProduct'][$k] = $v; 
								}
							}
							if(isset($filter)){
								$a['ProblemProduct'] = $filter['ProblemProduct'];
							}
							$a['Problem'] = $array['Problem'];							
						
							return $a; 
						}

						function hasOneProduct($array,$thisData){
							
							foreach($array['PurchasedProduct'] as $k=>$v){
							
									$a['ProblemProduct'][$k]['purchased_product_id'] = $v['id']; 
								
							}
							
							$a['Problem'] = $thisData['Problem'];
							return $a;
							
						}
								
						$quantityOfProducts = count($purchase['PurchasedProduct']);
						if($quantityOfProducts <2){
							
							$data = hasOneProduct($purchase,$this->request->data);
							
						}else{
						
							$data = hasManyProduct($this->request->data);
						
						}

					
						if(isset($data['ProblemProduct'])){
							if($this->Problem->saveAssociated($data)){
								$this->redirect('/myPurchases');
							}
						}else{
							$this->set('problemProductsIsNull',false);
						}	
						
						
					}
				
			}else{
				$this->redirect('/myPurchases');
			}
		}
		
	}	
	
}

?>
