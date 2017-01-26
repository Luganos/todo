<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentModel extends Model
{

	/* Get task by using certain id
	 * @input $news_id
	 * @return array | NULL
	 */
	public function getTask($task_id) 
	{ 
		 if (!is_numeric($task_id)) {
		     return NULL;
		 }
		 
		 $record = Yii::$app->db->createCommand("SELECT * FROM task WHERE task_id =:task_id")
			 ->bindValue(':task_id', $task_id)
			 ->queryOne();
		 
		 if ($record) {
		     return $record;
		 } else {
		     return NULL;
		 }	
	}
 
	/* Get all comments for certain id
	 * @input $task_id
	 * @return array | NULL
	 */
	public function getComments($task_id) 
	{
		  
		 if (!is_numeric($task_id)) {
		     return NULL;
		 }
		 
		 $records = Yii::$app->db->createCommand("SELECT * FROM comment c LEFT JOIN task_to_comment tc ON(c.comment_id = tc.comment_id) INNER JOIN author a ON(a.author_id = c.author_id) WHERE tc.task_id =:task_id ORDER BY c.created ASC")
			 ->bindValue(':task_id', $task_id)
			 ->queryAll();
		 
		 if ($records) {
		     return $records;
		 } else {
		     return NULL;
		 }
	}	
	
    /* Add new comment to task
     * @input array
    */ 
    public function addNewComment($data) {

                
		 //Add new record in table comments
	
	        $time = date("Y-m-d H:i:s");
		
		$author_id = $this->getAuthorId($data['CommentForm']['name']);
		
	        Yii::$app->db->createCommand()->insert('comment', [
                                'text' => $data['CommentForm']['comment'],
		                'author_id' => $author_id,
		                'created' => $time,
                ])->execute(); 

              
		 $id = Yii::$app->db->getLastInsertID();
		 
		 Yii::$app->db->createCommand()->insert('task_to_comment', [
                                'task_id' => intval($data['CommentForm']['id']),
		                'comment_id' => $id,
                 ])->execute(); 	    
	}
	
   /*
    * Get author id
    * @param  string $author
    * @return int
    */
   private function getAuthorId($author) {
	  
	  $row = Yii::$app->db->createCommand("SELECT author_id FROM author WHERE name=:name LIMIT 1")
		->bindValue(':name', $author)  
                ->queryOne();
          
          if(!$row)
          {
              return $this->createNewAuthor($author);
          } else {
	      return intval($row['author_id']);
	      
	  }
         
   }
   
   /*
    * Get author id
    * @param  int $task_id
    * @return int
   */
   public function setTaskMade($task_id) {
       
          if (!is_numeric($task_id)) {
	     return NULL;
          }
	  
	 $result = Yii::$app->db->createCommand("UPDATE task SET status = 1, done = NOW() WHERE task_id=:task_id")
            ->bindValue(':task_id', $task_id)
            ->execute();
          
          if($result)
          {
              return 1;
          } else {
	      return 0;
	      
	  }
         
   }
   
   /*
    * Get author id
    * @param  string $author
    * @return int
   */
   private function createNewAuthor($author)
   {	   
	  Yii::$app->db->createCommand()->insert('author', [
              'name' => $author,
          ])->execute(); 
      
          $id = Yii::$app->db->getLastInsertID();
      
          if (is_numeric($id)) {
	    return $id; 
          } else {
	     return NULL;
          }
    }
}
