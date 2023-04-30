<?php

namespace App\Components;

class SelectComponent extends \Illuminate\View\Component
{

    public function __construct( public $label, public $placeholder, public $name, public $options, public $value, public $text, public $selectedOption = null )
    {

    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return $this->view( 'components.select' );
    }
}
