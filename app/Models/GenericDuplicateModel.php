<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenericDuplicateModel extends Model
{
    use HasFactory;
    // Set the connection to the duplicate database
    protected $connection = 'duplicate';

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /**
     * Set the table name dynamically for the model.
     *
     * @param string $tableName The name of the table.
     */
    public function setTable($tableName)
    {
        $this->table = $tableName . '_duplicate_log';
        return $this;
    }
}