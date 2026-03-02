<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name'];
    public $fillable = ['email', 'phone', 'notes', 'doctor_id', 'section_id', 'type', 'appointment', 'status'];

    protected $casts = [
        'appointment' => 'datetime',
    ];

    // Relationships
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'appointment_doctor');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
