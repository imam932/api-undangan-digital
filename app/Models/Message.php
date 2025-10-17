<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
    ];

    /**
     * Accessor: format created_at to "10 Oct 25 14:30 wib" (Asia/Jakarta).
     * This affects JSON serialization while keeping DB ordering intact.
     */
    public function getCreatedAtAttribute($value)
    {
        // Ensure we parse and convert timezone to Asia/Jakarta, then format.
        return Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->format('d M y H:i') . ' WIB';
    }
}
