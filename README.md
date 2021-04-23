<p align="center">Code test: Aplicación Almacén de restaurantes</p>

## Sobre la Aplicacion
 <h1>Requerimientos</h1>
 
    PHP 7.4
    Mysql 8.0
    Laravel 8
<h1>Enunciado</h1>
<p>
Se requiere crear una api en laravel que resuelva la necesidad de una empresa de
publicidad de almacenar distintos datos sobre restaurantes de sus clientes.
Para ello cada cliente podrá registrarse en el sistema como usuario con rol ‘customer’,
autenticarse, añadir un número ilimitado de restaurantes al sistema con un máximo de 5
fotos por cada restaurante.
</p>
<h1>ROLES</h1>
<p>Campos</p>
<ul>
  <li>name: string</li>
  <li>description: string</li>
</ul>
<p>
Cada ‘role’ puede tener [0 || 1 || n] ‘users’.
Los roles se crearán durante la instalación del sistema y no se pueden editar ni
eliminar.
</p>
<h2>Datos iniciales:</h2>
<h3>id: 1 | name: Admin | description: This user can control everything.</h3>
<p>Puede</p>
<ul>
  <li>Listar, ver, editar y eliminar todos los usuarios.</li>
  <li>Listar, ver, editar y eliminar todos los restaurantes.</li>
  <li>Listar, ver, editar y eliminar todas las imágenes de un restaurante.</li>
</ul>
<p>No puede</p>
<ul>
  <li>Crear usuarios</li>
  <li>Crear restaurantes</li>
  <li>Crear imágenes de un restaurante</li>
</ul>
<h3>id: 2 | name: Customer | description: This user only controls their restaurants.</h3>
<p>Puede</p>
<ul>
  <li>Ver, editar y eliminar solo su usuario.</li>
  <li>Listar y ver, todos los restaurantes.</li>
  <li>Listar y ver todas las imágenes de un restaurante.</li>
  <li>Crear, editar y eliminar sólo sus restaurantes.</li>
  <li>Crear, editar y eliminar imágenes sólo de sus restaurantes.</li>
</ul>
<p>No puede</p>
<ul>
  <li>Crear usuarios</li>
  <li>Listar, ver, editar y eliminar usuarios que no sean suyos.</li>
  <li>Editar y eliminar restaurantes que no sean suyos.</li>
  <li>Editar y eliminar imágenes de un restaurante que no sea suyo.</li>
</ul>

<h1>USERS</h1>
<h2>Campos</h2>
<ul>
  <li>name: string</li>
  <li>lastname: string</li>
  <li>email: string</li>
  <li>password: string</li>
</ul>
<p>
Un usuario se creará mediante un registro. Todos los usuarios registrados tienen rol
‘Customer’ (id:2) obligatoriamente. Solo habrá un usuario de tipo ‘Admin’ (id:1)
definido durante la instalación del sistema.
Todos los datos son obligatorios y ninguno puede quedar vacío.
</p>
<h2>Datos iniciales</h2>
<p>id: 1 | role_id: 1 | name: Admin | lastname: Admin | email: admin@example.com | password: 12345678</p>
<h1>RESTAURANTS</h1>
<h2>Campos</h2>
<ul>
  <li>name: string</li>
  <li>address: string</li>
  <li>town: string</li>
  <li>country: string</li>
</ul>
<p>Un usuario puede crear de 0 a N restaurantes y para cada restaurante es obligatorio
rellenar todos sus datos.</p>
<h1>PICTURES</h1>
<h2>Campos</h2>
<ul>
  <li>url: string</li>
  <li>path: string</li>
</ul>
<p>
Un usuario puede crear de 0 a 5 imágenes por cada restaurante. Las imágenes
deben listarse en cada restaurante.
</p>
<h1>Revisión</h1>
<p>La prueba se revisará usando Postman y comprobando los siguientes enlaces:</p>
<ul>
  <li>{domain}/auth/register [POST] (register)</li>
  <li>{domain}/auth/login [POST] (login)</li>
  <li>{domain}/auth/logout [GET] (logout)</li>
  <li>{domain}/users [GET] (list)</li>
  <li>{domain}/users/{user_id} [GET] (show)</li>
  <li>{domain}/users/{user_id} [PUT] (update)</li>
  <li>{domain}/users/{user_id} [DELETE] (delete)</li>
  <li>{domain}/restaurants [GET] (list)</li>
  <li>{domain}/restaurants [POST] (store)</li>
  <li>{domain}/restaurants/{restaurant_id} [GET] (show)</li>
  <li>{domain}/restaurants/{restaurant_id} [PUT] (update)</li>
  <li>{domain}/restaurants/{irestaurant_id} [DELETE] (delete)</li>
  <li>{domain}/restaurants/{restaurant_id}/pictures [POST] (store)</li>
  <li>{domain}/restaurants/{restaurant_id}/pictures/{picture_id} [DELETE] (delete)</li>
</ul>

<h1>Modelo relacional creado para la aplicación</h1>

<a href="https://drive.google.com/uc?export=view&id=19qvXD0S1zKC7dbGLUzDtSQnZfSnz_7Tv"><img src="https://drive.google.com/uc?export=view&id=19qvXD0S1zKC7dbGLUzDtSQnZfSnz_7Tv" style="width: 500px; max-width: 100%; height: auto" title="Click for the larger version." /></a>
