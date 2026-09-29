<?php
require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../negocio/Ticket.php';


class TicketRepository
{
    public function guardar(Ticket $ticket): void
    {
        $conexion = Conexion::obtener();
        $consulta = $conexion->prepare(
            'INSERT INTO ticket (titulo, descripcion, estado)
             VALUES (:titulo, :descripcion, :estado)'
        );
        $consulta->execute([
            'titulo' => $ticket->getTitulo(),
            'descripcion' => $ticket->getDescripcion(),
            'estado' => $ticket->getEstado(),
        ]);
    }
}
