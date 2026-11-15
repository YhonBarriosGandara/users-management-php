<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteFincaUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteFincaPort.php';
require_once __DIR__ . '/../Ports/Out/GetFincaByIdPort.php';
require_once __DIR__ . '/../../Domain/ValueObjects/FincaId.php';
require_once __DIR__ . '/../../Domain/Exceptions/FincaNotFoundException.php';

final class DeleteFincaService implements DeleteFincaUseCase
{
    private DeleteFincaPort $deleteFincaPort;
    private GetFincaByIdPort $getFincaByIdPort;

    public function __construct(DeleteFincaPort $deleteFincaPort, GetFincaByIdPort $getFincaByIdPort)
    {
        $this->deleteFincaPort = $deleteFincaPort;
        $this->getFincaByIdPort = $getFincaByIdPort;
    }

    public function execute(DeleteFincaCommand $command): void
    {
        $fincaId = new FincaId($command->id());
        $finca = $this->getFincaByIdPort->getById($fincaId);

        if ($finca === null) {
            throw FincaNotFoundException::becauseIdWasNotFound($command->id());
        }

        $this->deleteFincaPort->delete($fincaId);
    }
}
