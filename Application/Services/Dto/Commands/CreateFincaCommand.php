<?php

declare(strict_types=1);

final class CreateFincaCommand
{
    private string $id;
    private string $nombre;
    private float $numHectareas;
    private float $metrosCuadrados;
    private string $propietario;
    private string $capataz;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private bool $produceLeche;
    private bool $produceCereales;
    private bool $produceFrutas;
    private bool $produceVerduras;

    public function __construct(
        string $id,
        string $nombre,
        float|int|string $numHectareas,
        float|int|string|null $metrosCuadrados,
        string $propietario,
        string $capataz,
        string $pais,
        string $departamento,
        string $ciudad,
        bool|int|string $produceLeche,
        bool|int|string $produceCereales,
        bool|int|string $produceFrutas,
        bool|int|string $produceVerduras
    ) {
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->numHectareas = (float) $numHectareas;
        $this->metrosCuadrados = $metrosCuadrados !== null ? (float) $metrosCuadrados : $this->numHectareas * 10000.0;
        $this->propietario = trim($propietario);
        $this->capataz = trim($capataz);
        $this->pais = trim($pais);
        $this->departamento = trim($departamento);
        $this->ciudad = trim($ciudad);
        $this->produceLeche = filter_var($produceLeche, FILTER_VALIDATE_BOOLEAN);
        $this->produceCereales = filter_var($produceCereales, FILTER_VALIDATE_BOOLEAN);
        $this->produceFrutas = filter_var($produceFrutas, FILTER_VALIDATE_BOOLEAN);
        $this->produceVerduras = filter_var($produceVerduras, FILTER_VALIDATE_BOOLEAN);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function numHectareas(): float
    {
        return $this->numHectareas;
    }

    public function metrosCuadrados(): float
    {
        return $this->metrosCuadrados;
    }

    public function propietario(): string
    {
        return $this->propietario;
    }

    public function capataz(): string
    {
        return $this->capataz;
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
}
