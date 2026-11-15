<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/FincaWebMapper.php';
require_once __DIR__ . '/Dto/CreateFincaWebRequest.php';
require_once __DIR__ . '/Dto/UpdateFincaWebRequest.php';
require_once __DIR__ . '/Dto/FincaResponse.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateFincaUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateFincaUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetFincaByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllFincasUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteFincaUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllFincasQuery.php';

final class FincaController
{
    private CreateFincaUseCase $createFincaUseCase;
    private UpdateFincaUseCase $updateFincaUseCase;
    private GetFincaByIdUseCase $getFincaByIdUseCase;
    private GetAllFincasUseCase $getAllFincasUseCase;
    private DeleteFincaUseCase $deleteFincaUseCase;
    private FincaWebMapper $mapper;

    public function __construct(
        CreateFincaUseCase $createFincaUseCase,
        UpdateFincaUseCase $updateFincaUseCase,
        GetFincaByIdUseCase $getFincaByIdUseCase,
        GetAllFincasUseCase $getAllFincasUseCase,
        DeleteFincaUseCase $deleteFincaUseCase,
        FincaWebMapper $mapper
    ) {
        $this->createFincaUseCase = $createFincaUseCase;
        $this->updateFincaUseCase = $updateFincaUseCase;
        $this->getFincaByIdUseCase = $getFincaByIdUseCase;
        $this->getAllFincasUseCase = $getAllFincasUseCase;
        $this->deleteFincaUseCase = $deleteFincaUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return FincaResponse[]
     */
    public function index(): array
    {
        $fincas = $this->getAllFincasUseCase->execute(new GetAllFincasQuery());

        return $this->mapper->fromModelsToResponses($fincas);
    }

    public function show(string $id): FincaResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $finca = $this->getFincaByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($finca);
    }

    public function store(CreateFincaWebRequest $request): FincaResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $finca = $this->createFincaUseCase->execute($command);

        return $this->mapper->fromModelToResponse($finca);
    }

    public function update(UpdateFincaWebRequest $request): FincaResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $finca = $this->updateFincaUseCase->execute($command);

        return $this->mapper->fromModelToResponse($finca);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteFincaUseCase->execute($command);
    }
}
