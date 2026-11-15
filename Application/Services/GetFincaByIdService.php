<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetFincaByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetFincaByIdPort.php';
require_once __DIR__ . '/../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/FincaId.php';
require_once __DIR__ . '/../../Domain/Exceptions/FincaNotFoundException.php';

final class GetFincaByIdService implements GetFincaByIdUseCase
{
    private GetFincaByIdPort $getFincaByIdPort;

    public function __construct(GetFincaByIdPort $getFincaByIdPort)
    {
        $this->getFincaByIdPort = $getFincaByIdPort;
    }

    public function execute(GetFincaByIdQuery $query): FincaModel
    {
        $fincaId = new FincaId($query->id());
        $finca = $this->getFincaByIdPort->getById($fincaId);

        if ($finca === null) {
            throw FincaNotFoundException::becauseIdWasNotFound($query->id());
        }

        return $finca;
    }
}
