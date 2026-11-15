<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidFincaDataException.php';

final class FincaUbicacion
{
    private string $pais;
    private string $departamento;
    private string $ciudad;

    public function __construct(string $pais, string $departamento, string $ciudad)
    {
        $normPais = trim($pais);
        $normDepto = trim($departamento);
        $normCiudad = trim($ciudad);

        if ($normPais === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('pais');
        }
        if ($normDepto === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('departamento');
        }
        if ($normCiudad === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('ciudad');
        }

        if (mb_strlen($normPais) < 2) {
            throw InvalidFincaDataException::becauseLengthIsTooShort('pais', 2);
        }
        if (mb_strlen($normDepto) < 2) {
            throw InvalidFincaDataException::becauseLengthIsTooShort('departamento', 2);
        }
        if (mb_strlen($normCiudad) < 2) {
            throw InvalidFincaDataException::becauseLengthIsTooShort('ciudad', 2);
        }

        $this->pais = $normPais;
        $this->departamento = $normDepto;
        $this->ciudad = $normCiudad;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function departamento(): string
    {
        return $this->departamento;
    }

    public function ciudad(): string
    {
        return $this->ciudad;
    }

    public function equals(FincaUbicacion $other): bool
    {
        return $this->pais === $other->pais()
            && $this->departamento === $other->departamento()
            && $this->ciudad === $other->ciudad();
    }
}
