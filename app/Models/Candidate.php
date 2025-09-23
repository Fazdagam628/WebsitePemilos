<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['candidate_photo', 'leader_name', 'coleader_name', 'vision', 'mission', ];
}
