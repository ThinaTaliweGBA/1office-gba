<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralHasTransactions extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'funerals_has_transactions';

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transactions_id');
    }

    public function bank()
    {
        return $this->hasOneThrough(Bank::class, Transactions::class, 'id', 'id', 'transactions_id', 'bank_id');
    }
}
