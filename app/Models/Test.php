<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Test extends Model
{
    protected $fillable = [
        'name',
        'description',
        'eligibility_threshold',
        'talent_threshold',
       
    ];

  
    public function offre(): BelongsTo
    {
    
        return $this->belongsTo(Offre::class, 'id', 'test_id');
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class, 'test_block');
    }

    public function applicationProgresses(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }
}
