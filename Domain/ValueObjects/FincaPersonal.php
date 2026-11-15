<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidFincaDataException.php';

final class FincaPersonal
{
    private string $propietario;
    private string $capataz;

    public function __construct(string $propietario, string $capataz)
    {
        $normProp = trim($propietario);
        $normCap = trim($capataz);

        if ($normProp === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('propietario');
        }
        if ($normCap === '') {
            throw InvalidFincaDataException::becauseFieldIsEmpty('capataz');
        }

        if (mb_strlen($normProp) < 3) {
            throw InvalidFincaDataException::becauseLengthIsTooShort('propietario', 3);
        }
        if (mb_strlen($normCap) < 3) {
            throw InvalidFincaDataException::becauseLengthIsTooShort('capataz', 3);
        }

        $this->propietario = $normProp;
        $this->capataz = $normCap;
    }

    public function propietario(): string
    {
        return $this->propietario;
    }

    public function capataz(): string
    {
        return $this->capataz;
    }

    public function equals(FincaPersonal $other): bool
    {
        return $this->propietario === $other->propietario()
            && $this->capataz === $other->capataz();
    }
}
