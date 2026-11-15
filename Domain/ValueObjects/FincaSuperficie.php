<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidFincaDataException.php';

final class FincaSuperficie
{
    private float $numHectareas;
    private float $metrosCuadrados;

    public function __construct(float|int|string $numHectareas, float|int|string|null $metrosCuadrados = null)
    {
        $hectareas = (float) $numHectareas;

        if ($hectareas <= 0) {
            throw InvalidFincaDataException::becauseHectareasMustBePositive($hectareas);
        }

        if ($metrosCuadrados === null || (float) $metrosCuadrados <= 0) {
            $metros = $hectareas * 10000.0;
        } else {
            $metros = (float) $metrosCuadrados;
            if ($metros <= 0) {
                throw InvalidFincaDataException::becauseMetrosCuadradosMustBePositive($metros);
            }
        }

        $this->numHectareas = round($hectareas, 2);
        $this->metrosCuadrados = round($metros, 2);
    }

    public function numHectareas(): float
    {
        return $this->numHectareas;
    }

    public function metrosCuadrados(): float
    {
        return $this->metrosCuadrados;
    }

    public function equals(FincaSuperficie $other): bool
    {
        return abs($this->numHectareas - $other->numHectareas()) < 0.001
            && abs($this->metrosCuadrados - $other->metrosCuadrados()) < 0.001;
    }
}
