<?php Class HelpfulReviewsController extends AppController{

		public $name = 'HelpfulReviews';
	
		public function index($yesOrNo,$review_id){
				
			if($this->Auth->User()){
				
				$this->loadModel('Review');
				$review = $this->Review->findById($review_id);	
						
				if($review){  
					
						$helpfulReview =  $this->HelpfulReview->find('first',array('conditions' => array('HelpfulReview.user_id' => $this->userLogged['User']['id'],'HelpfulReview.review_id' =>$review_id)));
						
					  
						$this->HelpfulReview->id = $helpfulReview['HelpfulReview']['id'];
					  
						$data =array(
								'HelpfulReview' => array
									(
										'user_id' => $this->userLogged['User']['id'],
										'review_id' => $review_id,
										'yes_or_no' => $yesOrNo
									)
						);				
						if($this->HelpfulReview->save($data)){

							$this->redirect($this->referer());	
						}
						
				}else{
					$this->redirect($this->referer());
				}
			}
		}
	
}
?>
