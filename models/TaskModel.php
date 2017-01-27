<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\HtmlPurifier;

class TaskModel extends Model
{

   /*
    * Get all records from task table
    * @return array | NULL
   */
   public function getAllTasks() 
   {
	  $records = Yii::$app->db->createCommand("SELECT TASK.text, TASK.deadline, TASK.task_id, TASK.status, TASK.created, TASK.done, IFNULL(VIEWS.views, 0) as views FROM (SELECT text, deadline, task_id, status, done, created FROM task ORDER BY task_id DESC) AS TASK LEFT JOIN (SELECT task_id, COUNT(*) AS views FROM task_to_comment GROUP BY task_id) AS VIEWS ON (TASK.task_id = VIEWS.task_id)")
              ->queryAll();
	  
	  return $records;
   } 
   
    /* Add new record to task table
     * @input array
    */ 
    public function addNewTask($data) {
	
	       $time = date("Y-m-d H:i:s");

	        Yii::$app->db->createCommand()->insert('task', [
                                'text' => HtmlPurifier::process($data['TaskForm']['text']),
		                'deadline' => HtmlPurifier::process($data['TaskForm']['deadline']),
		                'status' => 0,
		                'created' => $time,
                ])->execute(); 	    
	}
}
