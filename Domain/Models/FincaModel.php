<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/FincaId.php';
require_once __DIR__ . '/../ValueObjects/FincaNombre.php';
require_once __DIR__ . '/../ValueObjects/FincaSuperficie.php';
require_once __DIR__ . '/../ValueObjects/FincaPersonal.php';
require_once __DIR__ . '/../ValueObjects/FincaUbicacion.php';
require_once __DIR__ . '/../ValueObjects/FincaProduccion.php';

final class FincaModel
{
    private FincaId $id;
    private FincaNombre $nombre;
    private FincaSuperficie $superficie;
    private FincaPersonal $personal;
    private FincaUbicacion $ubicacion;
    private FincaProduccion $produccion;

    public function __construct(
        FincaId $id,
        FincaNombre $nombre,
        FincaSuperficie $superficie,
        FincaPersonal $personal,
        FincaUbicacion $ubicacion,
        FincaProduccion $produccion
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->superficie = $superficie;
        $this->personal = $personal;
        $this->ubicacion = $ubicacion;
        $this->produccion = $produccion;
    }

    public static function create(
        FincaId $id,
        FincaNombre $nombre,
        FincaSuperficie $superficie,
        FincaPersonal $personal,
        FincaUbicacion $ubicacion,
        FincaProduccion $produccion
    ): self {
        return new self(
            $id,
            $nombre,
            $superficie,
            $personal,
            $ubicacion,
            $produccion
        );
    }

    public function id(): FincaId
    {
        return $this->id;
    }

    public function nombre(): FincaNombre
    {
        return $this->nombre;
    }

    public function superficie(): FincaSuperficie
    {
        return $this->superficie;
    }

    public function numHectareas(): float
    {
        return $this->superficie->numHectareas();
    }

    public function metrosCuadrados(): float
    {
        return $this->superficie->metrosCuadrados();
    }

    public function personal(): FincaPersonal
    {
        return $this->personal;
    }

    public function propietario(): string
    {
        return $this->personal->propietario();
    }

    public function capataz(): string
    {
        return $this->personal->capataz();
    }

    public function ubicacion(): FincaUbicacion
    {
        return $this->ubicacion;
    }

    public function pais(): string
    {
        return $this->ubicacion->pais();
    }

    public function departamento(): string
    {
        return $this->ubicacion->departamento();
    }

    public function ciudad(): string
    {
        return $this->ubicacion->ciudad();
    }

    public function produccion(): FincaProduccion
    {
        return $this->produccion;
    }

    public function produceLeche(): bool
    {
        return $this->produccion->produceLeche();
    }

    public function produceCereales(): bool
    {
        return $this->produccion->produceCereales();
    }

    public function produceFrutas(): bool
    {
        return $this->produccion->produceFrutas();
    }

    public function produceVerduras(): bool
    {
        return $this->produccion->produceVerduras();
    }

    public function changeNombre(FincaNombre $nombre): self
    {
        return new self(
            $this->id,
            $nombre,
            $this->superficie,
            $this->personal,
            $this->ubicacion,
            $this->produccion
        );
    }

    public function changeSuperficie(FincaSuperficie $superficie): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $superficie,
            $this->personal,
            $this->ubicacion,
            $this->produccion
        );
    }

    public function changePersonal(FincaPersonal $personal): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->superficie,
            $personal,
            $this->ubicacion,
            $this->produccion
        );
    }

    public function changeUbicacion(FincaUbicacion $ubicacion): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->superficie,
            $this->personal,
            $ubicacion,
            $this->produccion
        );
    }

    public function changeProduccion(FincaProduccion $produccion): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->superficie,
            $this->personal,
            $this->ubicacion,
            $produccion
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'nombre' => $this->nombre->value(),
            'numHectareas' => $this->superficie->numHectareas(),
            'metrosCuadrados' => $this->superficie->metrosCuadrados(),
            'propietario' => $this->personal->propietario(),
            'capataz' => $this->personal->capataz(),
            'pais' => $this->ubicacion->pais(),
            'departamento' => $this->ubicacion->departamento(),
            'ciudad' => $this->ubicacion->ciudad(),
            'produceLeche' => $this->produccion->produceLeche(),
            'produceCereales' => $this->produccion->produceCereales(),
            'produceFrutas' => $this->produccion->produceFrutas(),
            'produceVerduras' => $this->produccion->produceVerduras(),
        );
    }
}
