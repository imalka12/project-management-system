<?php
namespace App\Repositories\Contracts;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{
    /**
     * create new payment entry
     * 
     * @param array $data
     * @return Payment $payment
     */
    public function create(array $data): Payment;

    /**
     * delete given payment entry
     * 
     * @param mixed $id
     * @return boolean
     */
    public function delete($id): bool;

    /**
     * update given payment entry
     * 
     * @param Payment $payment
     * @param array $data
     * @return boolean
     */
    public function update(Payment $payment, array $data): bool;

    /**
     * get payments for project
     * 
     * @param mixed $id
     * @param string $from_date
     * @param string $to_date
     * @return collection
     */
    public function getPaymentsByProject($id, $from_date, $to_date): Collection;

    
}