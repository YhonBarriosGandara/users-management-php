<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateFincaUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveFincaPort.php';
require_once __DIR__ . '/Mappers/FincaApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/FincaModel.php';

final class CreateFincaService implements CreateFincaUseCase
{
    private SaveFincaPort $saveFincaPort;

    public function __construct(SaveFincaPort $saveFincaPort)
    {
        $this->saveFincaPort = $saveFincaPort;
    }

    public function execute(CreateFincaCommand $command): FincaModel
    {
        $finca = FincaApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveFincaPort->save($finca);
    }
}
