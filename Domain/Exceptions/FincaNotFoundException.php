<?php

declare(strict_types=1);

final class FincaNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self(sprintf('No se encontro la finca con identificador: %s', $id));
    }
}
