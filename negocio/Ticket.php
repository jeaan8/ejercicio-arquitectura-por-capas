<?php

class Ticket
{
    private string $titulo;
    private string $descripcion;
    private string $estado;

    public function __construct(string $titulo, string $descripcion)
    {
        $titulo = trim($titulo);
        $descripcion = trim($descripcion);

        if ($titulo === '' || $descripcion === '') {
            throw new InvalidArgumentException('Completa el titulo y la descripcion.');
        }
        if (mb_strlen($titulo, 'UTF-8') > 150) {
            throw new InvalidArgumentException('El titulo puede tener hasta 150 caracteres.');
        }
        if (mb_strlen($descripcion, 'UTF-8') > 5000) {
            throw new InvalidArgumentException('La descripcion puede tener hasta 5000 caracteres.');
        }

        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
      
        $this->estado = 'pendiente';
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}
