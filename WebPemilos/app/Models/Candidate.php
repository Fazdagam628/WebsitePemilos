<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'candidate_photo',
        'leader_name',
        'coleader_name',
        'vision_mission',
        'no_urut'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
