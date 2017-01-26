<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $name;
    public $comment;

    public function rules()
    {
        return [
	    ['name', 'required'],
	    ['name', 'string', 'min' => 1, 'max' => 255],
	    ['comment', 'required'],
	    ['comment', 'string', 'min' => 1, 'max' => 255],
        ];
    }
}

