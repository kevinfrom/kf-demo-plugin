<?php

namespace App\Hooks\Action;

use App\Hooks\Hook;

abstract class Action extends Hook
{

    abstract public function receiver(): void;

    final public function register(): void
    {
        add_action(
            $this->getHook(),
            $this->getCallback(),
            $this->getPriority(),
            $this->getAcceptedArgs()
        );
    }
}
