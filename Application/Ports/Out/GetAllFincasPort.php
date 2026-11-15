<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface GetAllFincasPort
{
    /**
     * @return array<int, FincaModel>
     */
    public function getAll(): array;
}
