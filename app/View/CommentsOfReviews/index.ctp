





<?php 

	echo 'Review Details:<br><br>';
	
	echo $this->Html->image('/img/products/'.$product['Image'][4]['name'], array('alt' => 'Test')).'<br><br>'; 
	
	
	echo '<a href="'.$this->Html->url('/'.$product['User']['username'].'/'.Inflector::slug($product['Product']['title']).'/'.$product['Product']['id'], true).'">'.$product['Product']['title'].'</a>'.'<br><br>';

	echo 'Costumer review:<br><br>';


			$helpfulReviewTotal = count($review['HelpfulReview']);
							
							$helpfulReview = 0;
							foreach($review['HelpfulReview'] as $key=>$value){
								if($value['yes_or_no']){
									$helpfulReview += 1; 	
								}
							}
								
	echo $helpfulReview.' of '.$helpfulReviewTotal.' people found the following review helpful:</br>';
							

	echo 'Title: '.$review['Review']['title'].'<br>';
	echo 'by: '.$reviewer['User']['username'].'<br>';
	echo 'Body: '.$review['Review']['body'].'<br>';
	
	echo 'Was this review helpful to you?'; 	

	echo ' <a href="'.$this->Html->url('/test/'.'1/'.$review['Review']['id'], true).'" >Yes</a>';
	echo ' / <a href="'.$this->Html->url('/test/'.'0/'.$review['Review']['id'], true).'" >no</a>';


	echo '<br><br>';	
	echo '<h2>Comments</h2>';

		foreach($commentsOfReview as $key=>$values){
			
			
			echo '<br>';
			echo '<br>';
			echo 'By '.$values['User']['name'];
			echo '<br><br>';
			echo $values['CommentsOfReview']['body'].' / '.$values['CommentsOfReview']['created'];
			echo '<br>';
			echo 'Was this review helpful to you?';
			echo ' <a href="'.$this->Html->url('/test2/'.'1/'.$values['CommentsOfReview']['id'], true).'" >Yes</a>';
			echo ' / <a href="'.$this->Html->url('/test2/'.'0/'.$values['CommentsOfReview']['id'], true).'" >no</a>';
			
		}


echo '<br><br>';echo '<br><br>';

	//debug($review);
	//debug($reviewer);
	//debug($commentsOfReview);
?>
