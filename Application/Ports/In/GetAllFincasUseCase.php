<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllFincasQuery.php';
require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface GetAllFincasUseCase
{
    /**
     * @return array<int, FincaModel>
     */
    public function execute(GetAllFincasQuery $query): array;
}
