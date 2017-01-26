<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\TaskForm;
use app\models\CommentForm;
use app\models\CommentModel;
use app\models\TaskModel;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('task');
    }
    
    /**
     * Add new task
     * @return json
     */
    public function actionAddTask()
    {
         $model = new TaskForm();
	 
         if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
	     
	     $validate = ActiveForm::validate($model);
	     if (empty($validate)) {
		  
		 $task = new TaskModel();
		 
		 //Add new record in task table
		 $task->addNewTask(Yii::$app->request->post());
		 
		 $validate['success'] = 1;
	     }
	     
             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $validate;
         }	
    }
    
    
    
    /**
     * Get current task
     * @return json
     */
    public function actionGetTask()
    {
         $model = new CommentForm();
	 
         if (Yii::$app->request->isAjax) {
	 
	         $request = Yii::$app->request->post();
		 
		 if (!empty($request['id'])) {
		     
		     $comment = new CommentModel();
		     
		     $task = $comment->getTask(intval($request['id'])) ;
		     
		     if ($task == null) {
			$task = 0; 
		     }    
		 } else {
		     $task = 0;
		 }

             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $task;
         }	
    }
    
    /**
     * Get all tasks
     * @return json
     */
    public function actionGetAllTasks()
    {
         $model = new CommentForm();
	 
         if (Yii::$app->request->isAjax) {
	 
	         $request = Yii::$app->request->post();
		     
		 $comment = new TaskModel();
		 
		 $result = array();
		     
		 $result = $comment->getAllTasks() ;
		     
		 if (!$result) {
		     $result['empty'] = 1;
		 }    

             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $result;
         }	
    }
    
    /**
     * Set task as made
     * @return json
     */
    public function actionSetTask() 
    {
	 $model = new CommentForm();
	 
         if (Yii::$app->request->isAjax) {
	 
	         $request = Yii::$app->request->post();
		 
		 if (!empty($request['id'])) {
		     
		     $comment = new CommentModel();
		     
		     $out = array();
		     
		     $task = $comment->setTaskMade(intval($request['id'])) ;
		     
		     if ($task == 0) {
			$out['status'] = 0; 
		     } else {
			 $out['status'] = 1;
		     }   
		 } else {
		     $out['status'] = 0;
		 }

             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $out;
         }
	
    }
    
    /**
     * Get all comments
     * @return json
     */
    public function actionGetComments()
    {
         $model = new CommentForm();
	 
         if (Yii::$app->request->isAjax) {
	 
	         $request = Yii::$app->request->post();
		 
		 if (!empty($request['id'])) {
		     
		     $comment = new CommentModel();
		     
		     $result = array();
		     
		     $result = $comment->getComments(intval($request['id']));
		     
		     if ($result == null) {
			 $result['empty'] = 1;
		     }
		 }

             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $result;
         }	
    }
    
    /**
     * Add new comment
     * @return json
     */
    public function actionAddComment()
    {
         $model = new CommentForm();
	 
         if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
	     
	     $validate = ActiveForm::validate($model);
	     if (empty($validate)) {
		 
		 $comment = new CommentModel();
		 
		 //Add new record in comment table
		 $comment->addNewComment(Yii::$app->request->post());
		 
		 $validate['success'] = 1;
	     }
	     
             Yii::$app->response->format = Response::FORMAT_JSON;
	     
             return $validate;
         }
	
    }
    
    /**
     * Displays taskpage.
     *
     * @return string
     */
    public function actionComment()
    {
	$request = Yii::$app->request->get();
	
	$id = intval($request['id']);
	
	if (is_numeric($id)) {
	    return $this->render('comment', ['id' => $id]); 
	} else {
	    return $this->redirect(Yii::$app->request->referrer);
	}

	
       
    }

}
