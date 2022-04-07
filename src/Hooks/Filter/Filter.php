<?php

namespace App\Hooks\Filter;

use App\Hooks\Hook;

abstract class Filter extends Hook
{

    protected int $accepted_args = 1;

    final public function register(): void
    {
        add_filter(
            $this->getHook(),
            $this->getCallback(),
            $this->getPriority(),
            $this->getAcceptedArgs()
        );
    }
}
