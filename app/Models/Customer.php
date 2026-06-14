<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'company_name',
        'pic_name',
        'email',
        'phone',
        'address',
        'npwp',
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function beritaAcara(): HasMany
    {
        return $this->hasMany(BeritaAcara::class);
    }
}