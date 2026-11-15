<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        // Finca Module (Ejercicio 4)
        'InvalidFincaDataException' => 'Domain/Exceptions/InvalidFincaDataException.php',
        'FincaNotFoundException' => 'Domain/Exceptions/FincaNotFoundException.php',
        'FincaId' => 'Domain/ValueObjects/FincaId.php',
        'FincaNombre' => 'Domain/ValueObjects/FincaNombre.php',
        'FincaSuperficie' => 'Domain/ValueObjects/FincaSuperficie.php',
        'FincaPersonal' => 'Domain/ValueObjects/FincaPersonal.php',
        'FincaUbicacion' => 'Domain/ValueObjects/FincaUbicacion.php',
        'FincaProduccion' => 'Domain/ValueObjects/FincaProduccion.php',
        'FincaCreatedDomainEvent' => 'Domain/Events/FincaCreatedDomainEvent.php',
        'FincaUpdatedDomainEvent' => 'Domain/Events/FincaUpdatedDomainEvent.php',
        'FincaDeletedDomainEvent' => 'Domain/Events/FincaDeletedDomainEvent.php',
        'FincaModel' => 'Domain/Models/FincaModel.php',
        'SaveFincaPort' => 'Application/Ports/Out/SaveFincaPort.php',
        'UpdateFincaPort' => 'Application/Ports/Out/UpdateFincaPort.php',
        'GetFincaByIdPort' => 'Application/Ports/Out/GetFincaByIdPort.php',
        'GetAllFincasPort' => 'Application/Ports/Out/GetAllFincasPort.php',
        'DeleteFincaPort' => 'Application/Ports/Out/DeleteFincaPort.php',
        'CreateFincaUseCase' => 'Application/Ports/In/CreateFincaUseCase.php',
        'UpdateFincaUseCase' => 'Application/Ports/In/UpdateFincaUseCase.php',
        'GetFincaByIdUseCase' => 'Application/Ports/In/GetFincaByIdUseCase.php',
        'GetAllFincasUseCase' => 'Application/Ports/In/GetAllFincasUseCase.php',
        'DeleteFincaUseCase' => 'Application/Ports/In/DeleteFincaUseCase.php',
        'CreateFincaCommand' => 'Application/Services/Dto/Commands/CreateFincaCommand.php',
        'UpdateFincaCommand' => 'Application/Services/Dto/Commands/UpdateFincaCommand.php',
        'DeleteFincaCommand' => 'Application/Services/Dto/Commands/DeleteFincaCommand.php',
        'GetFincaByIdQuery' => 'Application/Services/Dto/Queries/GetFincaByIdQuery.php',
        'GetAllFincasQuery' => 'Application/Services/Dto/Queries/GetAllFincasQuery.php',
        'FincaApplicationMapper' => 'Application/Services/Mappers/FincaApplicationMapper.php',
        'CreateFincaService' => 'Application/Services/CreateFincaService.php',
        'UpdateFincaService' => 'Application/Services/UpdateFincaService.php',
        'GetFincaByIdService' => 'Application/Services/GetFincaByIdService.php',
        'GetAllFincasService' => 'Application/Services/GetAllFincasService.php',
        'DeleteFincaService' => 'Application/Services/DeleteFincaService.php',
        'FincaEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/FincaEntity.php',
        'FincaPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/FincaPersistenceDto.php',
        'FincaPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/FincaPersistenceMapper.php',
        'FincaRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/FincaRepositoryMySQL.php',
        'CreateFincaWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateFincaWebRequest.php',
        'UpdateFincaWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateFincaWebRequest.php',
        'FincaResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/FincaResponse.php',
        'FincaWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/FincaWebMapper.php',
        'FincaController' => 'Infrastructure/Entrypoints/Web/Controllers/FincaController.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}