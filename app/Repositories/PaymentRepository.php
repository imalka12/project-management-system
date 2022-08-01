<?php
namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class PaymentRepository implements PaymentRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return Payment::whereId($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(Payment $payment, array $data): bool
    {
        return $payment->update($data);
    }

    /**
     * @inheritDoc
     */
    public function getPaymentsByProject($id, $from_date, $to_date): Collection
    {
        return Payment::where('project_id', $id)
        ->whereBetween('created_at', [$from_date, $to_date])
        ->with('project')->get();
    }

}