<?php

use yii\db\Migration;

/**
 * Class m190911_105159_column_type_change
 */
class m190911_105159_column_type_change extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('flats', 'square', $this->decimal(10, 3)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('flats', 'square', $this->float(10)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_105159_column_type_change cannot be reverted.\n";

        return false;
    }
    */
}
