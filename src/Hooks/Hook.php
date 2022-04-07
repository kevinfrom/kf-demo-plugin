<?php

namespace App\Hooks;

abstract class Hook
{

    protected string $hook;
    protected int $priority = 10;
    protected int $accepted_args = 1;

    abstract public function __construct();

    abstract public function register(): void;

    final public function getHook(): string
    {
        return $this->hook;
    }

    final public function getCallback(): array
    {
        return [$this, 'receiver'];
    }

    final public function getPriority(): int
    {
        return $this->priority;
    }

    final public function getAcceptedArgs(): int
    {
        return $this->accepted_args;
    }
}
