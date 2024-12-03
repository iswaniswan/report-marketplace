<?php

use yii\db\Migration;

/**
 * Class m241203_121044_alter_table_user
 */
class m241203_121044_alter_table_user extends Migration
{
    
    protected $tableName = 'user';

    protected $newColumns = [
        'image',
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->newColumns as $columnName) {
            $this->addColumn($this->tableName, $columnName, $this->string(255)->null());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableSchema = $this->db->schema->getTableSchema($this->tableName);

        if ($tableSchema !== null) {
            // Loop through all columns
            foreach ($tableSchema->columns as $columnName => $column) {
                // Drop the column if it's not in the list of columns to keep
                if (in_array($columnName, $this->newColumns)) {
                    $this->dropColumn($this->tableName, $columnName);
                }
            }
        }  
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241203_121044_alter_table_user cannot be reverted.\n";

        return false;
    }
    */
}
