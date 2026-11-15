<?php

declare(strict_types=1);

final class FincaPersistenceDto
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
        float $numHectareas,
        float $metrosCuadrados,
        string $propietario,
        string $capataz,
        string $pais,
        string $departamento,
        string $ciudad,
        bool $produceLeche,
        bool $produceCereales,
        bool $produceFrutas,
        bool $produceVerduras
    ) {
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->numHectareas = $numHectareas;
        $this->metrosCuadrados = $metrosCuadrados;
        $this->propietario = trim($propietario);
        $this->capataz = trim($capataz);
        $this->pais = trim($pais);
        $this->departamento = trim($departamento);
        $this->ciudad = trim($ciudad);
        $this->produceLeche = $produceLeche;
        $this->produceCereales = $produceCereales;
        $this->produceFrutas = $produceFrutas;
        $this->produceVerduras = $produceVerduras;
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
