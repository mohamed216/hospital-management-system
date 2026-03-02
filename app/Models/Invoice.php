<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'section_id',
        'group_id',
        'service_id',
        'invoice_status',
        'invoice_date',
        'invoice_type',
        'price',
        'discount_value',
        'tax_rate',
        'tax_value',
        'total_with_tax',
        'amount_paid',
        'remaining_amount',
        'notes',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'price' => 'decimal:2',
        'discount_value' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_value' => 'decimal:2',
        'total_with_tax' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    // Relationships
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(ReceiptAccount::class, 'invoice_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PaymentAccount::class, 'invoice_id');
    }
}
