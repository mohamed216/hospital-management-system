<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name', 'appointments'];
    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'section_id', 'status'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class, 'appointment_doctor');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(ReceiptAccount::class);
    }
}
