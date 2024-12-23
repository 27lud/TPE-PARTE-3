# TPE-PARTE-3

## Endpoints

### GET 

- User/token:
  
Se utiliza para obtener un Token de acceso para realizar las accines de agregar y modificar, para esto en la aplicación Postman se dirigen al apartado "Authorization" e inician sesion en Basic Auth donde se tienen que completar los datos de usuario (webadmin) y contraseña (admin).

Ejemplo: http://localhost/TPE-PARTE-3/api/user/token

Si es correcto se te dara el token, luego vas a Bearer Token y pones el token eliminando las comillas y el último espacio(tiene un tiempo de vencimiento de 30 segundos). Si lo introduciste bien vas a poder hacer las modificaciones (CRUD) que quieras. Siempre obligatoriamente en la misma página en donde se realizó todo este procedimiento.

- Listado:

Devuelve la lista completa de bicicletas con sus respectivos atributos de la base de datos con opciones para paginar, filtrar y ordenar los resultados por diferentes campos.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes

- GET /bikes/ID 

Devuelve un objeto con todos sus atributos a partir de su ID pedido

Ejemplo:http://localhost/TPE-PARTE-3/api/bikes/id

- Ordenamiento:

Devuelve la lista completa pero de manera ordenada por marca de bicicleta ya sea de manera ascendente o descendente (alfabéticamente).

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes?order=ASC
         http://localhost/TPE-PARTE-3/api/bikes?order=DESC

- Filtrado:

Devuelve aquellas bicicletas que cumplan los filtros aplicados, se especifíca un valor de un campo determinado. Los campos válidos son: marca, anio y/o color.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes?color=rojo

- Paginacion:

Devuelve 5 elementos por pagina, indica el número de página a mostrar.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes?page=1

Se podra cambiar la cantidad de bicicletas a mostrar por página.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes?page=1&per_page=8

## POST

Crea una nueva bicicleta.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes

{
        "marca": "Bire fird",
        "anio": 2002,
        "color": "negro",
        "id_tipos_fk": 9
    },


## PUT 

Edita una bicicleta tomando su id respectivo.

Ejemplo:http://localhost/TPE-PARTE-3/api/bikes/id 

{
        "marca": "Bire fird",
        "anio": 2002,
        "color": "negro",
        "id_tipos_fk": 9
    },

## DELETE 

Elimina una bicicleta completamente de la base de datos.

Ejemplo: http://localhost/TPE-PARTE-3/api/bikes/id

### Integrantes: 

Manuel Díaz y Ludmila Argüello
