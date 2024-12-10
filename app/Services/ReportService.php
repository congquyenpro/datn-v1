<?php 
namespace App\Services;
use App\Models\TbTransaction;

class ReportService {
    protected $transaction;
    public function __construct(TbTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getAll() {
        return $this->transaction->orderBy('id', 'desc')->get();
    }
    
}