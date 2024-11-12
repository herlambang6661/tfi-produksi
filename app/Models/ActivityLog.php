<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'referer_url',
        'status_code',
        'status_description',
        'request_data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getLogs()
    {
        return DB::table('activity_logs as A')
            ->join('users as B', 'A.user_id', '=', 'B.id')
            ->select(
                'A.id',
                'A.action',
                'A.description',
                'A.ip_address',
                'A.status_code',
                'A.status_description',
                'A.request_data',
                'A.updated_at',
                'B.stb',
                'B.nickname',
                'B.username',
                'B.role',
                'B.telp',
            )
            ->where('A.request_data', '<>', '[]')
            ->orderBy('A.updated_at', 'DESC')
            ->limit(35)
            ->get();
    }

    public static function getLogsAll()
    {
        return DB::table('activity_logs as A')
            ->join('users as B', 'A.user_id', '=', 'B.id')
            ->select(
                'A.*',
                'B.stb',
                'B.nickname',
                'B.username',
                'B.role',
                'B.telp',
            )
            ->orderBy('A.updated_at', 'DESC')
            ->get();
    }
}
