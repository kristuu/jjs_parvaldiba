<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_start_date',
        'user_person_code',
        'certificate_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'job_start_date' => 'date',
    ];

    /**
     * Get the user that is the instructor.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_person_code', 'person_code');
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

}
