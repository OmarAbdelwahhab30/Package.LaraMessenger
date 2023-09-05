<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('h:i a');
    }
    public function getContentAttribute() {
        if ($this->attributes['type'] !== "text"){
            return asset("storage/".$this->attributes['content']);
        }
        return $this->attributes['content'];
    }

    public function chat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
