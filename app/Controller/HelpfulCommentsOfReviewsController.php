<?php Class HelpfulCommentsOfReviewsController extends AppController{
	
	public $name = 'HelpfulCommentsOfReviews';
	
	public function index($yesOrNo,$comments_of_review_id){
		
		if($this->Auth->User()){
				
				
				$this->loadModel('CommentsOfReview');
				$commentsOfReview = $this->CommentsOfReview->findById($comments_of_review_id);	
						
				if($commentsOfReview){  
					
						$helpfulCommentsOfReview =  $this->HelpfulCommentsOfReview->find('first',array('conditions' => array('HelpfulCommentsOfReview.user_id' => $this->userLogged['User']['id'],'HelpfulCommentsOfReview.comments_of_review_id' =>$comments_of_review_id)));
					  
						//debug($helpfulCommentsOfReview);
					  
						$this->HelpfulCommentsOfReview->id = $helpfulCommentsOfReview['HelpfulCommentsOfReview']['id'];
					  
						$data =array(
								'HelpfulCommentsOfReview' => array
									(
										'user_id' => $this->userLogged['User']['id'],
										'comments_of_review_id' => $comments_of_review_id,
										'yes_or_no' => $yesOrNo
									)
						);	
						
						//debug($data);
									
						if($this->HelpfulCommentsOfReview->save($data)){
							
							
							$this->redirect($this->referer());	
							//$this->redirect('/'.$product['User']['username'].'/'.Inflector::slug($product['Product']['title']).'/'.$product['Product']['id']);
						}
						
				}else{
					$this->redirect($this->referer());
				}
		}
		
	}
}
