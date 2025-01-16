<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports\PlayersModel;

class TeamsModel extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'team_bot_id',
        'conference',
        'division',
        'city',
        'name',
        'full_name',
        'abbreviation',
    ];

    public function players()
    {
        return $this->hasMany(PlayersModel::class, 'team_id', 'id');
    }
}
