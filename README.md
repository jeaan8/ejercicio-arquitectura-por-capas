# Alta de tickets

En este ejercicio separe el codigo en tres capas:

- **Presentacion:** en `public/tickets/crear.php` esta el formulario donde se escribe el titulo y la descripcion. Ese archivo recibe los datos y muestra un mensaje para saber si el ticket se guardo o si hubo un error. El CSS tambien es parte de esta capa.
- **Negocio:** en `negocio/Ticket.php` esta la clase Ticket. Ahi reviso que los datos esten completos y que no sean demasiado largos. Cuando se crea un ticket, la clase le pone el estado `pendiente`.
- **Persistencia:** en `datos/Conexion.php` esta la conexion con la base de datos y en `datos/TicketRepository.php` esta el codigo que guarda el ticket.

El INSERT esta en TicketRepository porque esa clase se encarga de guardar los datos. Asi el formulario no mezcla el HTML con las consultas SQL.

El estado pendiente es una regla de negocio porque todos los tickets nuevos tienen que empezar asi. Por eso lo puse en la clase Ticket: el usuario solo completa el titulo y la descripcion, no elige el estado.
