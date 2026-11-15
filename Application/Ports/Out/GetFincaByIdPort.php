<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaId.php';

interface GetFincaByIdPort
{
    public function getById(FincaId $fincaId): ?FincaModel;
}
