<?php

/* @var $this yii\web\View */

use app\assets\TodoAsset;

TodoAsset::register($this);

$this->title = 'List of tasks';
?>

<div class ="col-md-12">
    <div class ="row">
	<div class ="col-md-12" id ="list-of-tasks"></div>
	<div class ="col-md-4">
	      <h4 class="text-center">Add new task</h4>
	      <form>
                <div class="form-group">
                   <label for="text">Text:</label>
                   <input type="text" class="form-control" id="text">
		   <div id ="error-text-form"></div>
                </div>
                <div class="form-group">
		   <label for="pwd">Deadline:</label>
		   <div class='input-group date' id='datetimepicker1'>   
                      <input type="text" class="form-control" id="deadline" />
		      <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                      </span>
		   </div>  
		   <div id ="error-deadline-form"></div>
               </div>
               
            </form>
	    <button id ="button-add-new-task" class="btn btn-default">Submit</button>  
	</div>  
    </div>
</div>

