<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m170126_120349_create_task_table extends Migration
{

    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
    
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task', [
            'task_id' => Schema::TYPE_PK . '(11)',
            'text' => Schema::TYPE_TEXT,
            'deadline' => Schema::TYPE_DATE . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER,
            'done' => Schema::TYPE_DATE . ' DEFAULT NULL',
            'created' => Schema::TYPE_DATETIME . ' DEFAULT NULL'
        ], $this->engine);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('task');
    }
}
