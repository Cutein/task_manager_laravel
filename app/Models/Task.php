<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'board_id','due_date', 'tags'];

    protected $casts = [
        'tags' => 'array', // Convierte `tags` en un array automáticamente
        'due_date' => 'date', // Maneja `due_date` como una fecha
    ];
    

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
    
    public function getTagsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')->withTimestamps();
    }
}
