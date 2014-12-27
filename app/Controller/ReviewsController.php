<?php  
	class ReviewsController extends AppController{
		
		public $name = 'Reviews';
		
		
		public function index(){

		}

		public function add($id){

			if($this->Auth->User()){
				
				$review = $this->Review->find('first', array('conditions' => array('Review.id' => $id)));
				if($review){
					$review['Review']['status'] = 1;
					if($this->Review->save($review)){
						$this->redirect('/myPurchases');
					}
				}
			}
		}
		
		public function edit($id){
			
			// la capacidad de edtar un review, teniendo en cuenta lo anterior. 
			if($this->Auth->User()){
				
				$review = $this->Review->find('first', array('conditions' => array('Review.id' => $id)));
				if($review){
					$this->data = $this->Review->read();
					$review = $this->Review->read();
						
						$this->loadModel('Purchase');
						$this->loadModel('Product');
						
						$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $review['Review']['purchase_id'],'Purchase.user_id'=>$this->userLogged['User']['id'])));
						$product = $this->Product->findById($purchase['Product']['id']);
						$this->set(compact('purchase','product'));
				}
			}
		}
		
		
		public function preview(){
			
			// guardar como borrador.
			// -createReview
			// -edit
			// acceden a este metodo.
			
			if($this->Auth->User()){
				
					$purchase_id = $this->data ['Purchase']['id']; 
					
					
					$this->loadModel('Purchase');
					$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $purchase_id,'Purchase.user_id'=>$this->userLogged['User']['id'])));
					if($purchase){
					
							if($purchase['Review']['id']){
								$this->Review->id = $purchase['Review']['id'];
							}
					
							$this->loadModel('Product');
							$product = $this->Product->findById($purchase['Product']['id']);	
					
							$data = array(
								'Review' => array
								(
									'part_id' => $product['Product']['part_id'],
									'purchase_id' => $this->data['Purchase']['id'],
									'title' => $this->data['Review']['title'],
									'body' => $this->data['Review']['body'],
									'rating' => $this->data['Review']['rating'],
									'status' => 0
								)
							);
								
							if($this->Review->save($data)){
									$preview = $this->Review->read();
									$this->set('preview',$preview);
							}
					
					}else{$this->redirect('/myPurchases');}
			}else{$this->redirect('/');}	
		}
		
		public function createReview($slug,$purchase_id){
			
			if($this->Auth->User()){


				$this->loadModel('Purchase');
				$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $purchase_id,'Purchase.user_id'=>$this->userLogged['User']['id'],'Review.id'=>null)));
				if($purchase){
					$this->loadModel('Product');
					$product = $this->Product->findById($purchase['Product']['id']);
					$this->set(compact('purchase','product'));
				}else{$this->redirect('/myPurchases');}
			}
			
		}

	}

/*	
 
como un producto obtiene todas las reviews posibles existente?:
el vendedor cuando publica el producto, suministra la marca y el modelo del producto. de esta forma realcionamos todos los posibles reviews del producto asi de sus posibles ofertas en el sistema, la mas economica.
	
*/	
?>
