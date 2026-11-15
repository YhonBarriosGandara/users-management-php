<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateFincaCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateFincaCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteFincaCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetFincaByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaNombre.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaSuperficie.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaPersonal.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaUbicacion.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/FincaProduccion.php';

final class FincaApplicationMapper
{
    public static function fromCreateCommandToModel(CreateFincaCommand $command): FincaModel
    {
        return FincaModel::create(
            new FincaId($command->id()),
            new FincaNombre($command->nombre()),
            new FincaSuperficie($command->numHectareas(), $command->metrosCuadrados()),
            new FincaPersonal($command->propietario(), $command->capataz()),
            new FincaUbicacion($command->pais(), $command->departamento(), $command->ciudad()),
            new FincaProduccion(
                $command->produceLeche(),
                $command->produceCereales(),
                $command->produceFrutas(),
                $command->produceVerduras()
            )
        );
    }

    public static function fromUpdateCommandToModel(UpdateFincaCommand $command): FincaModel
    {
        return new FincaModel(
            new FincaId($command->id()),
            new FincaNombre($command->nombre()),
            new FincaSuperficie($command->numHectareas(), $command->metrosCuadrados()),
            new FincaPersonal($command->propietario(), $command->capataz()),
            new FincaUbicacion($command->pais(), $command->departamento(), $command->ciudad()),
            new FincaProduccion(
                $command->produceLeche(),
                $command->produceCereales(),
                $command->produceFrutas(),
                $command->produceVerduras()
            )
        );
    }

    public static function fromGetByIdQueryToFincaId(GetFincaByIdQuery $query): FincaId
    {
        return new FincaId($query->id());
    }

    public static function fromDeleteCommandToFincaId(DeleteFincaCommand $command): FincaId
    {
        return new FincaId($command->id());
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromModelToArray(FincaModel $finca): array
    {
        return $finca->toArray();
    }

    /**
     * @param array<int, FincaModel> $fincas
     * @return array<int, array<string, mixed>>
     */
    public static function fromModelsToArray(array $fincas): array
    {
        $result = array();
        foreach ($fincas as $finca) {
            $result[] = self::fromModelToArray($finca);
        }

        return $result;
    }
}
