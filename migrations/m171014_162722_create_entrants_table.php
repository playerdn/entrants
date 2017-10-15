<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entrants`.
 */
class m171014_162722_create_entrants_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('entrants', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'surname' => $this->string(100)->notNull(),
            'sex' => $this->string(1)->notNull(),
            'group' =>$this->string(5)->notNull(),
            'email' => $this->string(100)->notNull(),
            'grade' => $this->integer()->notNull(),
            'birth_year' => $this->integer()->notNull(),
            'is_local' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('entrants');
    }
}
