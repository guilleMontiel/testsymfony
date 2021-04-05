# Acerca de

Sitema web desarrollado como prueba de conocimiento en Symfony

- Desarrollado en Symfony 5.2
- Mysql 5.7
- Bootstrap 4
- Libreria FontAwesome 5
- Integra Docker para que se pueda levantar el proyecto.

# FUNCIONAMIENTO
- Para poder ingresar al sistema es necesito tener un usuario y password.
- Los usuarios de prueba tienen rol "CLIENTE" Y "ADMIN"
- Cada usuario esta habilitado para realizar distintas acciones.
- ADMIN:
    <ul>
        <li>Crear, editar y eliminar empresas</li>
        <li>Crear, editar y eliminar sectores</li>
        <li>Crear, editar y eliminar usuarios</li>
        <li>Asociar usuarios a sectores</li>
        <li>Asociar sectores a empresas</li>
    </ul>
- CLIENTE:
    <ul>
        <li>Ver el sector asociado a su usuario.</li>
        <li>Ver las empresas asociadas a el sector.</li>
    </ul>

- <b>RESTRICCIONES</b>
    <ul>
        <li>El nombre de la empresa y el sector son obligatorios</li>
        <li>El nombre del sector no se puede repetir</li>
        <li>No se pude eliminar un sector que esta asociado a empresas.</li>
    </ul>

- <b>USUARIO DE PRUEBA: </b>
    <ul>
        <li>Usuario: cliente@test.com</li>
        <li>Password: 1234</li>
        <li>Usuario: admin@admin.com</li>
        <li>Password: 1234</li>
    </ul>

# INSTALACION

INSTALACION CON DOCKER COMPOSE <br>
<ul>
  <li> Se requiere tener instalado Docker y docker compose.</li>
  <li>Realizar un git clone del proyecto</li>
  <li>Ejecutar en la consola docker-compose up -d --build</li>
</ul>
