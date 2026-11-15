<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/FincaPersistenceDto.php';
require_once __DIR__ . '/../Entity/FincaEntity.php';
require_once __DIR__ . '/../../../../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaNombre.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaSuperficie.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaPersonal.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaUbicacion.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaProduccion.php';

final class FincaPersistenceMapper
{
    public function fromModelToDto(FincaModel $finca): FincaPersistenceDto
    {
        return new FincaPersistenceDto(
            $finca->id()->value(),
            $finca->nombre()->value(),
            $finca->numHectareas(),
            $finca->metrosCuadrados(),
            $finca->propietario(),
            $finca->capataz(),
            $finca->pais(),
            $finca->departamento(),
            $finca->ciudad(),
            $finca->produceLeche(),
            $finca->produceCereales(),
            $finca->produceFrutas(),
            $finca->produceVerduras()
        );
    }

    public function fromDtoToEntity(FincaPersistenceDto $dto): FincaEntity
    {
        return new FincaEntity(
            $dto->id(),
            $dto->nombre(),
            $dto->numHectareas(),
            $dto->metrosCuadrados(),
            $dto->propietario(),
            $dto->capataz(),
            $dto->pais(),
            $dto->departamento(),
            $dto->ciudad(),
            $dto->produceLeche(),
            $dto->produceCereales(),
            $dto->produceFrutas(),
            $dto->produceVerduras()
        );
    }

    public function fromRowToEntity(array $row): FincaEntity
    {
        return new FincaEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (float) $row['num_hectareas'],
            (float) $row['metros_cuadrados'],
            (string) $row['propietario'],
            (string) $row['capataz'],
            (string) $row['pais'],
            (string) $row['departamento'],
            (string) $row['ciudad'],
            (bool) $row['produce_leche'],
            (bool) $row['produce_cereales'],
            (bool) $row['produce_frutas'],
            (bool) $row['produce_verduras'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(FincaEntity $entity): FincaModel
    {
        return new FincaModel(
            new FincaId($entity->id()),
            new FincaNombre($entity->nombre()),
            new FincaSuperficie($entity->numHectareas(), $entity->metrosCuadrados()),
            new FincaPersonal($entity->propietario(), $entity->capataz()),
            new FincaUbicacion($entity->pais(), $entity->departamento(), $entity->ciudad()),
            new FincaProduccion(
                $entity->produceLeche(),
                $entity->produceCereales(),
                $entity->produceFrutas(),
                $entity->produceVerduras()
            )
        );
    }
}
