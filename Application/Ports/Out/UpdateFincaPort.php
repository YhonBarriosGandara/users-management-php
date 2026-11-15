<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface UpdateFincaPort
{
    public function update(FincaModel $finca): FincaModel;
}
