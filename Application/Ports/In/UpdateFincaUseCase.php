<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateFincaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface UpdateFincaUseCase
{
    public function execute(UpdateFincaCommand $command): FincaModel;
}
