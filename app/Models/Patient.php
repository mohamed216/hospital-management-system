<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name', 'address'];
    public $fillable = ['email', 'password', 'date_birth', 'phone', 'gender', 'blood_group', 'image'];

    protected $hidden = ['password', 'remember_token'];

    // Relationships
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(ReceiptAccount::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PaymentAccount::class);
    }

    // Accessor for age
    public function getAgeAttribute(): ?int
    {
        if (!$this->date_birth) {
            return null;
        }
        return \Carbon\Carbon::parse($this->date_birth)->age;
    }
}
