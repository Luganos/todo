<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m170126_120201_create_author_table extends Migration
{

    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
    
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('author', [
            'author_id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT,
        ], $this->engine);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('author');
    }
}
