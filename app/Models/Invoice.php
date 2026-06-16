<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no',
        'po_number',
        'customer_id',
        'invoice_date',
        'due_date',
        'subtotal',
        'is_taxable',
        'tax',
        'total',
        'status',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}