<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    protected $fillable = [
        'quotation_no',
        'customer_id',
        'quotation_date',
        'subtotal',
        'is_taxable',
        'discount',
        'tax',
        'total',
        'status',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    public static function generateNumber(): string
    {
        $year = date('Y');
        $lastQuotation = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastQuotation) {
            $lastNumber = (int) substr($lastQuotation->quotation_no, -4);
            $nextNumber = $lastNumber + 1;
        }

        return sprintf('QTN/HNET/%s/%04d', $year, $nextNumber);
    }
}