

(function(){

    var form = (function() {
	    
	    //validate data before send
	    function validate() {
		
		var result = [];
		
		var value = getDataFromForm();
		
		if (value.name.length < 1) {
		    result['error'] = 1;
		    result['error_name'] = 'You must fill name field';
		}
		
		if (value.comment.length < 1) {
		    result['error'] = 1;
		    result['error_comment'] = 'You must fill comment field';
		}
		
		if (result['error'] == 1) {
		    return result;
		} else {
		    return value;
		}
	
	    }
	    
	    //Remove error
	    function removeError() {
		$('#name').parent().removeClass('has-error');
		$('#comment').parent().removeClass('has-error');
		$('#error-name-form').html('');
		$('#error-comment-form').html('');
	    }
	    
	    //Show error below field
	    function showError(data) {
		
		if (data.error_name) {
		    $('#name').parent().addClass('has-error');
		    $('#error-name-form').html(data.error_name);
		}
		
		if (data.error_comment) {
		    $('#comment').parent().addClass('has-error');
		    $('#error-comment-form').html(data.error_comment);
		}
	    }
	    
	    //Create request body
	    function createRequest() {
		
		var data = validate();
		
		if (data.error == 1) {
		    showError(data);
		} else {
		    
		    var object = Object.create(null);
		
		    var taskForm = Object.create(null);
		    taskForm['name'] = data.name;
		    taskForm['comment'] = data.comment;
		    taskForm['id'] = id;
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['CommentForm'] = taskForm;
		    object['ajax'] = "CommentForm";
		    
		    addTask(object);
		    
		}
	    }
	    
	    //Get data from task form
	    function getDataFromForm() {
		
		var value = Object.create(null);
		
		value.name = $('#name').val();
		value.comment = $('#comment').val();
		
		return value;
	    }
	    
	    //Add new action 
	    function addAction() {
		
	        $('#button-add-new-comment').on('click', function() {
		    
		    removeError();
		    createRequest();
		});
	    }
	    
	    function addTask(object) {
		
	       $.ajax({
                     url:"/index.php/site/add-comment", 
		     type:"POST",
		     data: object,
		     dataType:"JSON",
		     success: function(data) {
			   comment.loadComments();    
		     } 
		});
	    }
    
	    return {
		addAction: addAction
		
	    };    
	})();
	
	var task = (function(){
	    
	    //Execute after load page
	    (function () {
		
		var object = prepareRequestStart();
		
	        $.ajax({
                     url:"/index.php/site/get-task", 
		     type:"POST",
		     data: object,
		     dataType:"JSON",
		     success: function(data) {
			   if (data !== 0) {
			       showTask(data); 
			       eventTask();
			   } else {
			       showError(); 
			   }
			       
		     } 
		});
	    })();
	    
	    function eventTask () {
		
                $("#checkbox-task").click(function() {
		    
		    var object = prepareRequestCheck();
		    
                    $.ajax({
                         url:"/index.php/site/set-task", 
		         type:"POST",
		         data: object,
		         dataType:"JSON",
		         success: function(data) {
			     if (data['status'] == 1) {
			       $('#disabled-checkbox').on("click", function(event) {
                                 event.preventDefault();
                                 return false;
                               });
			       $('.row-for-one-task').css("text-decoration", "line-through");  
			     } else {
			       showError();
			     }
			       
		     } 
		});
	      });
	    }
	    
	    function showTask(data) {
		
		var html = '';
		
		    html +='    <h4 class="text-center">Task</h4>'; 
	            html +='       <table class="table table-bordered" id ="table-for-one-task">';
                    html +='           <thead>';
                    html +='             <tr>';
                    html +='               <th>State</th>';
                    html +='               <th>Text</th>';
                    html +='               <th>Deadline</th>';
                    html +='            </tr>';
                    html +='          </thead>';
                    html +='          <tbody>';
                    html +='             <tr>';  
		    if (data.status == 0) {
			html +='           <td id ="checkbox-task"><input type="checkbox" id="disabled-checkbox" value="0"></td>';
		    } else {
			html +='           <td id ="checkbox-task"><input type="checkbox" id="disabled-checkbox" checked></td>';
		    } 
                    html +='               <td class ="row-for-one-task">' + data.text + '</td>';
                    html +='               <td class ="row-for-one-task">' + data.deadline + '</td>';
                    html +='            </tr>';
                    html +='         </tbody>';
                    html +='       </table>';
		    
		    $('#task-description').html(html);
		    
		    if (data.status == 1) {  
		       $('#disabled-checkbox').on("click", function(event) {
                          event.preventDefault();
                          return false;
                       });
		       
		       $('.row-for-one-task').css("text-decoration", "line-through"); 
	            }
		     
	    }
	    
	    
	    function showError() {
		alert('Task has not been found');
	    }
	    
	    //Prepare data for request
	    function prepareRequestCheck() {
		
		    var object = Object.create(null);
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['id'] = id;
		    object['check'] = 1;
		    object['ajax'] = 'ajax';

                    return object;
	    }
	    
	    //Prepare data for request
	    function prepareRequestStart() {
		
		    var object = Object.create(null);
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['id'] = id;
		    object['ajax'] = 'ajax';

                    return object;
	    }   
	})();
	
	var comment = (function(){
	    
	    //Execute after load page
	   function loadComments() {
		
		var object = prepareRequestStart();
		
	        $.ajax({
                     url:"/index.php/site/get-comments", 
		     type:"POST",
		     data: object,
		     dataType:"JSON",
		     success: function(data) {
			   if (data) {
			     if (data.empty) {
				 notComments();
			     } else {
				 showComments(data);
			     }			     
			   } else {
			       alert('Error'); 
			   }
			       
		     } 
		});
	     }
	     
	    //Prepare data for request
	    function prepareRequestStart() {
		
		    var object = Object.create(null);
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['id'] = id;
		    object['ajax'] = 'ajax';

                    return object;
	    }
	    
	    //Prepare data for request
	    function notComments() {
		
		var html = '';
		
		html +='    <h4 class="text-center">List of comments</h4>';
		html +='    <h4 class="text-center">Comments have not been found</h4>';
		
		$('#list-of-comments').html(html);
	    }
	    function showComments(data) {
		
		var html = '';
		
		    html +='    <h4 class="text-center">List of comments</h4>'; 
	            html +='       <table class="table table-bordered">';
                    html +='           <thead>';
                    html +='             <tr>';
                    html +='               <th>Author</th>';
                    html +='               <th>Text</th>';
                    html +='               <th>Created</th>';
                    html +='            </tr>';
                    html +='          </thead>';
                    html +='          <tbody>';
                    for (var content in data) {
 
                           html += '     <tr>'; 
                           html += '        <td>' + data[content].name + '</td>';
                           html += '        <td>' + data[content].text + '</td>';
                           html += '        <td>' + data[content].created + '</td>';
                           html += '     </tr>';
			   html += '     <br>';
                       
                    }
                    html +='         </tbody>';
                    html +='       </table>';
		    
		    $('#list-of-comments').html(html);
	    }
	    return {
		loadComments: loadComments
	    };    
	})();
	
	form.addAction(); 
	comment.loadComments();
})();


