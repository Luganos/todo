<?php

/* @var $this yii\web\View */

use app\assets\CommentAsset;

CommentAsset::register($this);

$this->title = 'Comments';
?>
<?php Yii::$app->view->registerJs('var id = "'. $id.'";',  \yii\web\View::POS_HEAD);?>
    <div class ="col-md-12">
       <div class ="row">
        <div class ="col-md-12" id ="task-description"></div>
	<div class ="col-md-12" id ="list-of-comments"></div>
	<div class ="col-md-4">
	      <h4 class="text-center">Add new comment</h4>
	      <form>
                <div class="form-group">
                   <label for="text">Name:</label>
                   <input type="text" class="form-control" id="name">
		   <div id ="error-name-form"></div>
                </div>
                <div class="form-group">
		      <label for="text">Comment:</label>  
                      <textarea class="form-control" rows="5" id="comment"></textarea>
		      <div id ="error-comment-form"></div>
               </div>
            </form>
	    <button id ="button-add-new-comment" class="btn btn-default">Submit</button> 
	   </div>   
      </div>	   
    </div>


