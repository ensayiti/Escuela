<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'name', 'teacher_id', 'address_1', 'address_2', 'subject_id'];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
