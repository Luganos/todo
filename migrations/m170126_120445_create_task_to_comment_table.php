<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `task_to_comment`.
 */
class m170126_120445_create_task_to_comment_table extends Migration
{

    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
    
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task_to_comment', [
            'task_id' => Schema::TYPE_INTEGER . '(11)',
            'comment_id' => Schema::TYPE_INTEGER . '(11)'
        ], $this->engine);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('task_to_comment');
    }
}
