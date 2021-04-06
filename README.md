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
- <b>USUARIO DE PRUEBA: </b>
    <ul>
        <li>Usuario: guille@admin.com</li>
        <li>Password: 1234</li>
        <li>Usuario: estefi@cliente.com</li>
        <li>Password: 1234</li>
    </ul>
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
        <li>No se pude eliminar un usuario con sectores asociados.</li>
    </ul>



# INSTALACION

* SIN DOCKER COMPOSE
- PHP 7.3
- Mysql 5.7
- <a href="https://git-scm.com/book/en/v2/Getting-Started-Installing-Git" target="_blank">Git</a>
- <a href="https://nodejs.org/es/download/" target="_blank">Nodejs</a>
- <a target="_blank" href="https://yarnpkg.com/getting-started/install">yarn</a>

* CON DOCKER COMPOSE
- <a href="https://docs.docker.com/engine/install/" target="_blank">Docker</a>
- <a href="https://docs.docker.com/compose/install/" target="_blank"> Docker Compose </a>
- <a href="https://git-scm.com/book/en/v2/Getting-Started-Installing-Git" target="_blank">Git</a>

- Una vez instalado Docker y Git se debe ejecutar el siguiente comando:
<b>git clone https://github.com/guilleMontiel/testsymfony.git</b>

- Al finalizar se debe ingresar a la carpeta donde se clono el proyecto y ejecutar:
1) - <b>docker-compose up -d</b>
2) - <b>docker-compose run --rm php composer install --prefer-dist</b>
1) - <b>docker-compose exec apache php bin/console doctrine:migrations:execute</b>
1) - <b>docker-compose exec yarn insttal</b>


