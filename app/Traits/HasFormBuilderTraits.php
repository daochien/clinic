<?php

namespace App\Traits;

use App\Models\Form;
use App\Models\Submission;

trait HasFormBuilderTraits
{
    /**
     * A User can have one or many forms
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forms()
    {
    	return $this->hasMany(Form::class);
    }

    /**
     * A User can have one or many submission
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
    	return $this->hasMany(Submission::class);
    }
}
