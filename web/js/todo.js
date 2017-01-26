

(function(){
    
    
    $('#datetimepicker1').datetimepicker({
	
	format: 'YYYY-MM-DD'
    });

	
    var form = (function() {
	    
	    //validate data before send
	    function validate() {
		
		var result = [];
		
		var value = getDataFromForm();
		
		if (value.text.length < 1) {
		    result['error'] = 1;
		    result['error_text'] = 'You must fill text field';
		}
		
		if (value.deadline.length < 1) {
		    result['error'] = 1;
		    result['error_deadline'] = 'You must fill deadline field';
		}
		
		if (result['error'] == 1) {
		    return result;
		} else {
		    return value;
		}
	
	    }
	    
	    //Remove error
	    function removeError() {
		$('#text').parent().removeClass('has-error');
		$('#deadline').parent().removeClass('has-error');
		$('#error-deadline-form').html('');
		$('#error-text-form').html('');
	    }
	    
	    //Show error below field
	    function showError(data) {
		
		if (data.error_text) {
		    $('#text').parent().addClass('has-error');
		    $('#error-text-form').html(data.error_text);
		}
		
		if (data.error_deadline) {
		    $('#deadline').parent().addClass('has-error');
		    $('#error-deadline-form').html(data.error_deadline);
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
		    taskForm['text'] = data.text;
		    taskForm['deadline'] = data.deadline;
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['TaskForm'] = taskForm;
		    object['ajax'] = "TaskForm";
		    
		    addTask(object);
		    
		}
	    }
	    
	    //Get data from task form
	    function getDataFromForm() {
		
		var value = Object.create(null);
		
		value.text = $('#text').val();
		value.deadline = $('#deadline').val();
		
		return value;
	    }
	    
	    //Add new action 
	    function addAction() {
		
	        $('#button-add-new-task').on('click', function() {
		    
		    removeError();
		    createRequest();
		});
	    }
	    
	    function addTask(object) {
		
	       $.ajax({
                     url:"/index.php/site/add-task", 
		     type:"POST",
		     data: object,
		     dataType:"JSON",
		     success: function(data) {
			   list.loadTasks();     
		     } 
		});
	    }
	      

	    
	    return {
		addAction: addAction
		
	    };
	    
	})();
	
	var list = (function(){
	    
	    //Execute after load page
	   function loadTasks() {
		
		var object = prepareRequestStart();
		
	        $.ajax({
                     url:"/index.php/site/get-all-tasks", 
		     type:"POST",
		     data: object,
		     dataType:"JSON",
		     success: function(data) {
			   if (data) {
			     if (data.empty) {
				 notTasks();
			     } else {
				 showTasks(data);
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
		    object['ajax'] = 'ajax';

                    return object;
	    }
	    
	    //Prepare data for request
	    function notTasks() {
		
		var html = '';
		
		html +='    <h4 class="text-center">List of tasks</h4>';
		html +='    <h4 class="text-center">Tasks have not been found</h4>';
		
		$('#list-of-tasks').html(html);
	    }
	    function showTasks(data) {
		
		var html = '';
		
		    html +='    <h4 class="text-center">List of tasks</h4>'; 
	            html +='       <table class="table table-bordered">';
                    html +='           <thead>';
                    html +='             <tr>';
                    html +='               <th>State</th>';
                    html +='               <th>Text</th>';
                    html +='               <th>Deadline</th>';
		    html +='               <th>Created</th>';
		    html +='               <th>Views</th>';
                    html +='            </tr>';
                    html +='          </thead>';
                    html +='          <tbody>';
                    for (var content in data) {
 
                           html += '     <tr>'; 
			   if (data[content].status == 0) {
			      html +='     <td id ="checkbox-task"><input type="checkbox" id="disabled-checkbox-'+ data[content].task_id +'" value="0"></td>';
		           } else {
			      html +='     <td id ="checkbox-task"><input type="checkbox" id="disabled-checkbox-'+ data[content].task_id +'" checked></td>';
		           }
                           html += '        <td class ="task-row-'+ data[content].task_id +'" id ="task-row-text-'+ data[content].task_id +'">' + data[content].text + '</td>';
                           html += '        <td class ="task-row-'+ data[content].task_id +'" id ="task-row-deadline-'+ data[content].task_id +'">' + data[content].deadline + '</td>';
                           html += '        <td class ="task-row-'+ data[content].task_id +'" id ="task-row-created-'+ data[content].task_id +'">' + data[content].created + '</td>';
			   html += '        <td class ="task-row-'+ data[content].task_id +'" id ="task-row-views-'+ data[content].task_id +'">' + data[content].views + '</td>';
                           html += '     </tr>';
			   html += '     <br>';
                       
                    }
                    html +='         </tbody>';
                    html +='       </table>';
		    
		    $('#list-of-tasks').html(html);
		    
		    for (var block in data) {
			

			
			if (data[block].status == 1) {
			   $("#disabled-checkbox-"+ data[block].task_id).on("click", function(event) {
                              event.preventDefault();
                              return false;
                           });
			   $("#task-row-text-"+ data[block].task_id).css("text-decoration", "line-through"); 
			   $("#task-row-deadline-"+ data[block].task_id).css("text-decoration", "line-through");
			   $("#task-row-created-"+ data[block].task_id).css("text-decoration", "line-through"); 
			   $("#task-row-views-"+ data[block].task_id).css("text-decoration", "line-through");
			} else {
			    
			     $("#disabled-checkbox-"+ data[block].task_id).click(function() {
				 
				 setTask(this.id.substring(18));
			     });
			}
			  
		        $(".task-row-"+ data[block].task_id).click(function() {
			    
			    var name = $(this).attr('class');
			    
			    window.location.href = "/index.php/site/comment?id=" + name.substring(9);

			});
			
		    }
	    }
	    
	    //Prepare data for request
	    function prepareRequestCheck(id) {
		
		    var object = Object.create(null);
		
		    object['_csrf'] = yii.getCsrfToken();
		    object['id'] = id;
		    object['check'] = 1;
		    object['ajax'] = 'ajax';

                    return object;
	    }
	    
	    function showError() {
		alert('Task has not been found');
	    }
	    
	    function setTask(id) {
		
		   var object = prepareRequestCheck(id);
	    
	            $.ajax({
                         url:"/index.php/site/set-task", 
		         type:"POST",
		         data: object,
		         dataType:"JSON",
		         success: function(data) {
			     if (data['status'] == 1) {
				loadTasks();  
			     } else {
			       showError();
			     }
			       
		     } 
		});
	    }
	    return {
		loadTasks: loadTasks
	    };    
	})();
	
	form.addAction();
        list.loadTasks();
})();


