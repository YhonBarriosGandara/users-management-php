<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateFincaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface CreateFincaUseCase
{
    public function execute(CreateFincaCommand $command): FincaModel;
}
