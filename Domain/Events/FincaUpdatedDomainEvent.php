<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';

final class FincaUpdatedDomainEvent extends DomainEvent
{
    private object $finca;

    public function __construct(object $finca)
    {
        parent::__construct('finca.updated');
        $this->finca = $finca;
    }

    public function finca(): object
    {
        return $this->finca;
    }

    public function payload(): array
    {
        return $this->finca->toArray();
    }
}
