<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateFincaUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateFincaPort.php';
require_once __DIR__ . '/../Ports/Out/GetFincaByIdPort.php';
require_once __DIR__ . '/Mappers/FincaApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/FincaId.php';
require_once __DIR__ . '/../../Domain/Exceptions/FincaNotFoundException.php';

final class UpdateFincaService implements UpdateFincaUseCase
{
    private UpdateFincaPort $updateFincaPort;
    private GetFincaByIdPort $getFincaByIdPort;

    public function __construct(
        UpdateFincaPort $updateFincaPort,
        GetFincaByIdPort $getFincaByIdPort
    ) {
        $this->updateFincaPort = $updateFincaPort;
        $this->getFincaByIdPort = $getFincaByIdPort;
    }

    public function execute(UpdateFincaCommand $command): FincaModel
    {
        $fincaId = new FincaId($command->id());
        $existing = $this->getFincaByIdPort->getById($fincaId);

        if ($existing === null) {
            throw FincaNotFoundException::becauseIdWasNotFound($command->id());
        }

        $finca = FincaApplicationMapper::fromUpdateCommandToModel($command);

        return $this->updateFincaPort->update($finca);
    }
}
