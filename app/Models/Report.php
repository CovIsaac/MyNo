<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'report_type_id',
        'priority_id',
        'report_date',
        'body',
        'attachment',
    ];

    // Relación: Un reporte pertenece a un Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un reporte pertenece a un Proyecto
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relación: Un reporte pertenece a un Tipo de Reporte
    public function reportType(): BelongsTo
    {
        return $this->belongsTo(ReportType::class);
    }

    // Relación: Un reporte pertenece a una Prioridad
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }
}