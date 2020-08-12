<?php

namespace App\Events\Form;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class FormCreated
{
    use Queueable, SerializesModels;

    /**
     * The deleted form
     *
     * @var App\Models\Form
     */
    public $form;

    /**
     * Create a new event instance.
     *
     * @param  $form
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }
}
