<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetFincaByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface GetFincaByIdUseCase
{
    public function execute(GetFincaByIdQuery $query): FincaModel;
}
