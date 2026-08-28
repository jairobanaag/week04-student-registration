<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Student Model
 *
 * Represents a registered student record, including
 * personal information, academic details, and the
 * path to their uploaded profile picture.
 */
class Student extends Model
{
    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile_number',
        'gender',
        'date_of_birth',
        'program',
        'year_level',
        'address',
        'profile_picture',
    ];
}