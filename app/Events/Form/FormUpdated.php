<?php

namespace App\Events\Form;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class FormUpdated
{
    use Queueable, SerializesModels;

    /**
     * The updated form
     *
     * @var Form
     */
    public $form;

    /**
     * Create a new event instance.
     *
     * @param Form $form
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }
}
