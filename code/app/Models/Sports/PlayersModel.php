<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports\TeamsModel;

class PlayersModel extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'player_bot_id',
        'team_id',
        'first_name',
        'last_name',
        'position',
        'height',
        'weight',
        'jersey_number',
        'college',
        'country',
        'draft_year',
        'draft_round',
        'draft_number',
    ];

    public static function findOrCreateTeam(int $teamId, array $teamData): TeamsModel
    {
        return TeamsModel::firstOrCreate(
            ['team_bot_id' => $teamId],
            [
                'team_bot_id' => $teamId,
                'conference' => $teamData['conference'] ?? null,
                'division' => $teamData['division'] ?? null,
                'city' => $teamData['city'] ?? null,
                'name' => $teamData['name'],
                'full_name' => $teamData['full_name'],
                'abbreviation' => $teamData['abbreviation'] ?? null,
            ]
        );
    }

    public function team()
    {
        return $this->belongsTo(TeamsModel::class, 'team_id', 'id');
    }
}
