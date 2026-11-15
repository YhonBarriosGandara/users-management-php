<?php

declare(strict_types=1);

final class FincaProduccion
{
    private bool $produceLeche;
    private bool $produceCereales;
    private bool $produceFrutas;
    private bool $produceVerduras;

    public function __construct(
        bool|int|string $produceLeche,
        bool|int|string $produceCereales,
        bool|int|string $produceFrutas,
        bool|int|string $produceVerduras
    ) {
        $this->produceLeche = filter_var($produceLeche, FILTER_VALIDATE_BOOLEAN);
        $this->produceCereales = filter_var($produceCereales, FILTER_VALIDATE_BOOLEAN);
        $this->produceFrutas = filter_var($produceFrutas, FILTER_VALIDATE_BOOLEAN);
        $this->produceVerduras = filter_var($produceVerduras, FILTER_VALIDATE_BOOLEAN);
    }

    public function produceLeche(): bool
    {
        return $this->produceLeche;
    }

    public function produceCereales(): bool
    {
        return $this->produceCereales;
    }

    public function produceFrutas(): bool
    {
        return $this->produceFrutas;
    }

    public function produceVerduras(): bool
    {
        return $this->produceVerduras;
    }

    public function hasAnyProduction(): bool
    {
        return $this->produceLeche || $this->produceCereales || $this->produceFrutas || $this->produceVerduras;
    }

    /**
     * @return array<int, string>
     */
    public function activeLines(): array
    {
        $lines = array();
        if ($this->produceLeche) {
            $lines[] = 'Leche';
        }
        if ($this->produceCereales) {
            $lines[] = 'Cereales';
        }
        if ($this->produceFrutas) {
            $lines[] = 'Frutas';
        }
        if ($this->produceVerduras) {
            $lines[] = 'Verduras';
        }

        return $lines;
    }

    public function equals(FincaProduccion $other): bool
    {
        return $this->produceLeche === $other->produceLeche()
            && $this->produceCereales === $other->produceCereales()
            && $this->produceFrutas === $other->produceFrutas()
            && $this->produceVerduras === $other->produceVerduras();
    }
}
