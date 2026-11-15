<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveFincaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateFincaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetFincaByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllFincasPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteFincaPort.php';

require_once __DIR__ . '/../Mapper/FincaPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/FincaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/FincaId.php';

final class FincaRepositoryMySQL implements
    SaveFincaPort,
    UpdateFincaPort,
    GetFincaByIdPort,
    GetAllFincasPort,
    DeleteFincaPort
{
    private PDO $pdo;
    private FincaPersistenceMapper $mapper;

    public function __construct(PDO $pdo, FincaPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(FincaModel $finca): FincaModel
    {
        $dto = $this->mapper->fromModelToDto($finca);

        $sql = '
            INSERT INTO fincas (
                id,
                nombre,
                num_hectareas,
                metros_cuadrados,
                propietario,
                capataz,
                pais,
                departamento,
                ciudad,
                produce_leche,
                produce_cereales,
                produce_frutas,
                produce_verduras,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :nombre,
                :num_hectareas,
                :metros_cuadrados,
                :propietario,
                :capataz,
                :pais,
                :departamento,
                :ciudad,
                :produce_leche,
                :produce_cereales,
                :produce_frutas,
                :produce_verduras,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':num_hectareas' => $dto->numHectareas(),
            ':metros_cuadrados' => $dto->metrosCuadrados(),
            ':propietario' => $dto->propietario(),
            ':capataz' => $dto->capataz(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':produce_leche' => $dto->produceLeche() ? 1 : 0,
            ':produce_cereales' => $dto->produceCereales() ? 1 : 0,
            ':produce_frutas' => $dto->produceFrutas() ? 1 : 0,
            ':produce_verduras' => $dto->produceVerduras() ? 1 : 0,
        ));

        $savedFinca = $this->getById(new FincaId($dto->id()));

        if ($savedFinca === null) {
            throw new RuntimeException('No se pudo recuperar la finca tras persistirla.');
        }

        return $savedFinca;
    }

    public function update(FincaModel $finca): FincaModel
    {
        $dto = $this->mapper->fromModelToDto($finca);

        $sql = '
            UPDATE fincas
               SET nombre = :nombre,
                   num_hectareas = :num_hectareas,
                   metros_cuadrados = :metros_cuadrados,
                   propietario = :propietario,
                   capataz = :capataz,
                   pais = :pais,
                   departamento = :departamento,
                   ciudad = :ciudad,
                   produce_leche = :produce_leche,
                   produce_cereales = :produce_cereales,
                   produce_frutas = :produce_frutas,
                   produce_verduras = :produce_verduras,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':num_hectareas' => $dto->numHectareas(),
            ':metros_cuadrados' => $dto->metrosCuadrados(),
            ':propietario' => $dto->propietario(),
            ':capataz' => $dto->capataz(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':produce_leche' => $dto->produceLeche() ? 1 : 0,
            ':produce_cereales' => $dto->produceCereales() ? 1 : 0,
            ':produce_frutas' => $dto->produceFrutas() ? 1 : 0,
            ':produce_verduras' => $dto->produceVerduras() ? 1 : 0,
        ));

        $updatedFinca = $this->getById(new FincaId($dto->id()));

        if ($updatedFinca === null) {
            throw new RuntimeException('No se pudo recuperar la finca tras actualizarla.');
        }

        return $updatedFinca;
    }

    public function getById(FincaId $fincaId): ?FincaModel
    {
        $sql = 'SELECT * FROM fincas WHERE id = :id LIMIT 1';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $fincaId->value()));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        $entity = $this->mapper->fromRowToEntity($row);

        return $this->mapper->fromEntityToModel($entity);
    }

    /**
     * @return array<int, FincaModel>
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM fincas ORDER BY nombre ASC';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        $fincas = array();

        foreach ($rows as $row) {
            $entity = $this->mapper->fromRowToEntity($row);
            $fincas[] = $this->mapper->fromEntityToModel($entity);
        }

        return $fincas;
    }

    public function delete(FincaId $fincaId): void
    {
        $sql = 'DELETE FROM fincas WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $fincaId->value()));
    }
}
