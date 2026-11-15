<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';

interface SaveFincaPort
{
    public function save(FincaModel $finca): FincaModel;
}
