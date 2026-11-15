<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateFincaWebRequest.php';
require_once __DIR__ . '/../Dto/UpdateFincaWebRequest.php';
require_once __DIR__ . '/../Dto/FincaResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateFincaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateFincaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteFincaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetFincaByIdQuery.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetAllFincasQuery.php';
require_once __DIR__ . '/../../../../../Domain/Models/FincaModel.php';

final class FincaWebMapper
{
    public function fromCreateRequestToCommand(CreateFincaWebRequest $request): CreateFincaCommand
    {
        return new CreateFincaCommand(
            $request->id(),
            $request->nombre(),
            $request->numHectareas(),
            $request->metrosCuadrados(),
            $request->propietario(),
            $request->capataz(),
            $request->pais(),
            $request->departamento(),
            $request->ciudad(),
            $request->produceLeche(),
            $request->produceCereales(),
            $request->produceFrutas(),
            $request->produceVerduras()
        );
    }

    public function fromUpdateRequestToCommand(UpdateFincaWebRequest $request): UpdateFincaCommand
    {
        return new UpdateFincaCommand(
            $request->id(),
            $request->nombre(),
            $request->numHectareas(),
            $request->metrosCuadrados(),
            $request->propietario(),
            $request->capataz(),
            $request->pais(),
            $request->departamento(),
            $request->ciudad(),
            $request->produceLeche(),
            $request->produceCereales(),
            $request->produceFrutas(),
            $request->produceVerduras()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetFincaByIdQuery
    {
        return new GetFincaByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteFincaCommand
    {
        return new DeleteFincaCommand($id);
    }

    public function fromModelToResponse(FincaModel $model): FincaResponse
    {
        return new FincaResponse(
            $model->id()->value(),
            $model->nombre()->value(),
            $model->numHectareas(),
            $model->metrosCuadrados(),
            $model->propietario(),
            $model->capataz(),
            $model->pais(),
            $model->departamento(),
            $model->ciudad(),
            $model->produceLeche(),
            $model->produceCereales(),
            $model->produceFrutas(),
            $model->produceVerduras()
        );
    }

    /**
     * @param array<int, FincaModel> $models
     * @return array<int, FincaResponse>
     */
    public function fromModelsToResponses(array $models): array
    {
        $responses = array();
        foreach ($models as $model) {
            $responses[] = $this->fromModelToResponse($model);
        }

        return $responses;
    }
}
