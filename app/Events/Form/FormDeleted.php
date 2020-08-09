<?php

namespace App\Events\Form;

use jazmy\FormBuilder\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class FormDeleted
{
    use Queueable, SerializesModels;

    /**
     * The deleted form
     *
     * @var jazmy\FormBuilder\Models\Form
     */
    public $form;

    /**
     * Create a new event instance.
     *
     * @param jazmy\FormBuilder\Models\Form $form
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }
}
