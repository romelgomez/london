<?php class AddressesController extends AppController{
	
		public $name = 'Addresses';
		
		public function add(){			
			if($this->Auth->User()){
			
				$this->selectoresDependientes('Address');
				
				if($this->request->data){
				
						$address =	array(
							'Address'=>Array
								(							
								   'user_id'=>$this->userLogged['User']['id'],
								   'country_id'=>$this->request->data['Address']['country_id'],
								   'state_id'=>$this->request->data['Address']['state_id'],
								   'city_id'=>$this->request->data['Address']['city_id'],
								   'name'=>$this->request->data['Address']['name'],
								   'address'=>$this->request->data['Address']['address'],
								   'additional_information'=>$this->request->data['Address']['additional_information'],
								   'phones'=>$this->request->data['Address']['phones'],
								   'deleted'=>0
								)
						);
						
						if($this->Address->save($address)){
							$this->redirect('/accountSettings');
						}					
														
				}			
			}
		}
		
		public function edit($controller,$slug,$id){
			if($this->Auth->User()){
				
				$address = $this->Address->find('first', array('conditions' => array('Address.id' => $id,'Address.user_id'=>$this->userLogged['User']['id'],'Address.deleted'=>0)));
				if($address){
					
					if(empty($this->data)){
						$this->data = $address;
					
						$this->selectoresDependientes('Address');
					
					}else{
					
						$this->selectoresDependientes('Address');
					
						$address =	array(
							'Address'=>Array
								(	
								   'id'=>$this->request->data['Address']['id'],
								   'country_id'=>$this->request->data['Address']['country_id'],
								   'state_id'=>$this->request->data['Address']['state_id'],
								   'city_id'=>$this->request->data['Address']['city_id'],
								   'name'=>$this->request->data['Address']['name'],
								   'address'=>$this->request->data['Address']['address'],
								   'phones'=>$this->request->data['Address']['phones'],
								   'additional_information'=>$this->request->data['Address']['additional_information'],								   
								   'deleted'=>0
								)
						);					
						if($this->Address->save($address)){
							
							$this->Session->setFlash('Your stuff has been saved.');
							$this->redirect('/accountSettings');
						}	
					}				
				}else{
					$this->redirect('/accountSettings');
				}
			}
		}
		
		public function deleted($id){
			if($this->Auth->User()){

			$address = $this->Address->find('first', array('conditions' => array('Address.id' => $id,'Address.user_id'=>$this->userLogged['User']['id'])));
				if($address){	
					$address['Address']['deleted'] = 1;
					$this->Address->save($address);		
					$this->redirect('/accountSettings');
				}else{
					$this->redirect('/accountSettings');
				}
			}	
			
		}
		
		
	}
?>
 
