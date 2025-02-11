<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'board_id'];

    public const STATUS_NUEVA = 'nueva';
    public const STATUS_EN_PROCESO = 'en_proceso';
    public const STATUS_PAUSADA = 'pausada';
    public const STATUS_COMPLETADA = 'completada';

    public static function getStatuses()
    {
        return [
            self::STATUS_NUEVA => 'Nueva',
            self::STATUS_EN_PROCESO => 'En proceso',
            self::STATUS_PAUSADA => 'Pausada',
            self::STATUS_COMPLETADA => 'Completada',
        ];
    }
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id'); // Especificar la clave foránea
    }
}
