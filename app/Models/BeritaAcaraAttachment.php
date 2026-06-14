<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaAcaraAttachment extends Model
{
    protected $fillable = [
        'berita_acara_id',
        'file_path',
        'caption',
        'order',
    ];

    public function beritaAcara(): BelongsTo
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}