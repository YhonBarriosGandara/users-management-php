<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/FincaId.php';

interface DeleteFincaPort
{
    public function delete(FincaId $fincaId): void;
}
