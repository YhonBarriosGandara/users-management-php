<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteFincaCommand.php';

interface DeleteFincaUseCase
{
    public function execute(DeleteFincaCommand $command): void;
}
