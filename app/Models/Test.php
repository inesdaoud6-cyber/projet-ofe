<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
<<<<<<< HEAD

=======
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

class Test extends Model
{
    protected $fillable = [
        'name',
        'description',
        'eligibility_threshold',
        'talent_threshold',
    ];

<<<<<<< HEAD
  
    public function offre(): BelongsTo
    {
    
        return $this->belongsTo(Offre::class, 'id', 'test_id');
    }
=======
    public function offres(): HasMany
{
    return $this->hasMany(Offre::class, 'test_id');
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public function blocks()
    {
        return $this->belongsToMany(Block::class, 'test_block');
    }

<<<<<<< HEAD
=======
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_test');
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public function applicationProgresses(): HasMany
    {
        return $this->hasMany(ApplicationProgress::class);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
