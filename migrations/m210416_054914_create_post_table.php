<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210416_054914_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
          'author_id' => $this->integer()->notNull(),
          'category_id' => $this->integer()->defaultValue(1),
          'title' => $this->string(),
          'body' => $this->text(),
        ]);

      // creates index for column `author_id`
      $this->createIndex(
        'idx-post-author_id',
        'post',
        'author_id'
      );

      // add foreign key for table `test`
      $this->addForeignKey(
        'fk-post-author_id',
        'post',
        'author_id',
        'test',
        'id',
        'CASCADE'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

      // drops foreign key for table `test`
      $this->dropForeignKey(
        'fk-post-author_id',
        'post'
      );

      // drops index for column `author_id`
      $this->dropIndex(
        'idx-post-author_id',
        'post'
      );

        $this->dropTable('{{%post}}');
    }
}
