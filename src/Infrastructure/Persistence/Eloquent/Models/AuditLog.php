<?php

namespace Src\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_logs';

    protected $fillable = [
        'user_id',
        'service',
        'request_body',
        'http_status',
        'response_body',
        'ip',
    ];

    protected $casts = [
        'request_body' => 'array',
        'response_body' => 'array',
    ];
}
