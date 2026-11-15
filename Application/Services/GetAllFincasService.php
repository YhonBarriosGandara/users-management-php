<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllFincasUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllFincasPort.php';
require_once __DIR__ . '/../../Domain/Models/FincaModel.php';

final class GetAllFincasService implements GetAllFincasUseCase
{
    private GetAllFincasPort $getAllFincasPort;

    public function __construct(GetAllFincasPort $getAllFincasPort)
    {
        $this->getAllFincasPort = $getAllFincasPort;
    }

    /**
     * @return array<int, FincaModel>
     */
    public function execute(GetAllFincasQuery $query): array
    {
        return $this->getAllFincasPort->getAll();
    }
}
