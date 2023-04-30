<?php

namespace App\Components;

use Illuminate\View\Component;

class InputComponent extends Component
{
    public function __construct( public $label, public $placeholder, public $name, public $type, public $value = null )
    {

    }

    public function render()
    {
        return $this->view( 'components.input' );
    }
}
