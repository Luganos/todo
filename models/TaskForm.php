<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TaskForm extends Model
{
    public $text;
    public $deadline;

    public function rules()
    {
        return [
	    ['text', 'required'],
	    ['text', 'string', 'min' => 1, 'max' => 255],
	    ['deadline', 'required'],
        ];
    }
    
    /*
     * Validate text
     * @input string $attribute The attribute currently being validated.
     * @input array  $params    The additional name-value pairs.
     */
    public function validateText($attribute, $params)
    {
	if (mb_strlen($params, 'UTF-8') < 1) {
	    
	    $this->addError($attribute, 'You must fill text field.');
	}
	
    }
    
    /*
     * Validate deadline
     * @input string $attribute The attribute currently being validated.
     * @input array  $params    The additional name-value pairs.
     */
    public function validateDeadLine($attribute, $params)
    {
	if (!$this->hasErrors()) {
	    
	    //$this->addError($attribute, 'Incorrect deadline.');
	}
	
    }
}

