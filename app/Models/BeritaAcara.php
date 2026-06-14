<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BeritaAcara extends Model
{
    protected $table = 'berita_acara';
    
    protected $fillable = [
        'nomor',
        'customer_id',
        'tanggal',
        'jenis',
        'isi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(BeritaAcaraAttachment::class)->orderBy('order');
    }
}