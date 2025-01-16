<?php

namespace App\Models\Sports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports\TeamsModel;

class GamesModel extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'game_bot_id',
        'home_team_id',
        'visitor_team_id',
        'date',
        'season',
        'status',
        'period',
        'time',
        'postseason',
        'home_team_score',
        'visitor_team_score',
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

    public function homeTeam()
    {
        return $this->belongsTo(TeamsModel::class, 'home_team_id', 'id');
    }

    public function visitorTeam()
    {
        return $this->belongsTo(TeamsModel::class, 'visitor_team_id', 'id');
    }
}
