<?php

use yii\db\Migration;

/**
 * Class m190907_170227_create_base_tables
 */
class m190907_170227_create_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'user_id' => $this->primaryKey(10),
            'login' => $this->string(64)->notNull()->unique(),
            'passhash' => $this->string(64)->notNull()
        ]);

        $this->createTable('complexes', [
            'complex_id' => $this->primaryKey(10),
            'city_id' => $this->integer(10)->notNull(),
            'name' => $this->string(255)->notNull()
        ]);

        $this->createTable('cities', [
            'city_id' => $this->primaryKey(10),
            'name' => $this->string(255)->notNull()
        ]);

        $this->addForeignKey(
            'fk_complex_to_city',
            'complexes',
            'city_id',
            'cities',
            'city_id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('houses', [
            'house_id' => $this->primaryKey(10),
            'complex_id' => $this->integer(10)->notNull(),
            'address' => $this->string(255)->notNull()
        ]);

        $this->addForeignKey(
            'fk_house_to_complex',
            'houses',
            'complex_id',
            'complexes',
            'complex_id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('flats', [
            'flat_id' => $this->primaryKey(10),
            'house_id' => $this->integer(10)->notNull(),
            'flat_type_id' => $this->integer(10)->notNull(),
            'square' => $this->float(10)->notNull(),
            'price' => $this->integer(10)->unsigned()->notNull()
        ]);

        $this->addForeignKey(
            'fk_flat_to_house',
            'flats',
            'house_id',
            'houses',
            'house_id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('flat_types', [
            'flat_type_id' => $this->primaryKey(10),
            'name' => $this->string(64)
        ]);

        $this->addForeignKey(
            'fk_flat_to_flat_type',
            'flats',
            'flat_type_id',
            'flat_types',
            'flat_type_id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190907_170227_create_base_tables cannot be reverted.\n";

        return false;
    }
    */
}
