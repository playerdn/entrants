<?php

use yii\db\Migration;

class m171014_170554_alter_entrants extends Migration
{
    public function up()
    {
        $this->addColumn('entrants', 'secret', $this->string(255)->notNull());
        $this->addColumn('entrants', 'cookie_id', $this->string(255)->notNull());
    }

    public function down()
    {
        $this->dropColumn('entrants', 'secret');
        $this->dropColumn('entrants', 'cookie_id');
    }
}
