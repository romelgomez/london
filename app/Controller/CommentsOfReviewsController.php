 <?php Class CommentsOfReviewsController extends AppController{

	public $name = 'CommentsOfReviews'; 
	
	public function beforeFilter(){
			
		$this->Auth->allow('index');
		parent::beforeFilter();				
	}
	
	public function index($id,$product_id){
		
		$this->loadModel('Review');
		$review	= $this->Review->find('first', array('conditions' => array('Review.id' => 1)));
		
		if($review){
			$this->loadModel('User');
			$reviewer = $this->User->find('first', array('conditions' => array('User.id' => $review['Purchase']['user_id'])));
			
			$commentsOfReview = $this->CommentsOfReview->find('all',array('conditions' => array('CommentsOfReview.review_id' => $id)));
			
			$this->loadModel('Product');
			$product = $this->Product->find('first', array('conditions' =>array('Product.id'=>$product_id)));
				
			$this->set(compact('product','review','reviewer','commentsOfReview'));
		}else{
			$this->redirect($this->referer());
		}
	}
	
	
	public function add(){
		
		
		
	}
	
}
?> 
