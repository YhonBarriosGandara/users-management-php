<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/FincaId.php';

final class FincaDeletedDomainEvent extends DomainEvent
{
    private FincaId $fincaId;

    public function __construct(FincaId $fincaId)
    {
        parent::__construct('finca.deleted');
        $this->fincaId = $fincaId;
    }

    public function fincaId(): FincaId
    {
        return $this->fincaId;
    }

    public function payload(): array
    {
        return array(
            'id' => $this->fincaId->value(),
        );
    }
}
