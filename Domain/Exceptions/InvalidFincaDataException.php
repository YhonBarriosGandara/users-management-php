<?php

declare(strict_types=1);

final class InvalidFincaDataException extends InvalidArgumentException
{
    public static function becauseFieldIsEmpty(string $fieldName): self
    {
        return new self(sprintf('El campo %s no puede estar vacio.', $fieldName));
    }

    public static function becauseLengthIsTooShort(string $fieldName, int $minLength): self
    {
        return new self(sprintf('El campo %s debe contener al menos %d caracteres.', $fieldName, $minLength));
    }

    public static function becauseHectareasMustBePositive(float $hectareas): self
    {
        return new self(sprintf('El numero de hectareas debe ser mayor a cero. Valor ingresado: %.2f', $hectareas));
    }

    public static function becauseMetrosCuadradosMustBePositive(float $metrosCuadrados): self
    {
        return new self(sprintf('Los metros cuadrados deben ser mayores a cero. Valor ingresado: %.2f', $metrosCuadrados));
    }

    public static function becauseInconsistentArea(float $hectareas, float $metrosCuadrados): self
    {
        return new self(sprintf(
            'Inconsistencia en superficie: %.2f hectareas no corresponden con %.2f m2 (1 ha = 10,000 m2).',
            $hectareas,
            $metrosCuadrados
        ));
    }
}
