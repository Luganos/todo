<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170126_120303_create_comment_table extends Migration
{

    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
    
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'comment_id' => Schema::TYPE_PK . '(11)',
            'text' => Schema::TYPE_TEXT,
            'author_id' => Schema::TYPE_INTEGER,
            'created' => Schema::TYPE_DATETIME . ' DEFAULT NULL'
        ], $this->engine);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
