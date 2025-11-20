# SoundSnack REST API

**Desarrolladores:**

- **Nombre:** Martín Lorenzi
- **Email:** alorenzi@alumnos.exa.unicen.com

---

Este proyecto implementa una **API RESTful** para gestionar **artistas** y **canciones**.  
Incluye autenticación con **JWT**, operaciones **CRUD**, y soporte para **paginación** y **ordenamiento** en los listados.

---

## Librería de ruteo

La API usa una librería de ruteo propia ubicada en `libs/router/`.  
Se puede consultar más información sobre su funcionamiento en [libs/router/README.md](https://gitlab.com/unicen/Web2/livecoding2025/tandil/todo-list-rest/-/blob/main/libs/router/README.md).

---

## Requisitos y configuración

- **XAMPP** (descargable desde [https://www.apachefriends.org/es/download.html](https://www.apachefriends.org/es/download.html)).  
  Asegurarse de tener activado `mod_rewrite` en Apache para evitar errores al probar la API con Postman.

El sistema cuenta con un **autodeploy** que crea automáticamente la base de datos y las tablas al realizar la **primera consulta a la API** (por ejemplo, un `GET` desde Postman).  
Si por algún motivo el autodeploy falla, se puede crear la base manualmente importando el archivo `soundSnack.sql` que está en `app/database/` usando **phpMyAdmin**.

### Pasos de instalación

1. Clonar o copiar el proyecto dentro de la carpeta pública de su servidor, por ejemplo:
   ```
   C:\xampp\htdocs\TP3_WEBII\TP3\soundSnack
   ```
2. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
3. Acceder a la API desde el navegador o herramientas como **Postman**:
   ```
   http://localhost/TP3_WEBII/TP3/soundSnack/api/
   ```

---

## Autenticación (JWT)

### Obtener token

**POST** `http://localhost/TP3_WEBII/TP3/soundSnack/api/auth/login`

**Auth Type (Basic Auth):**
 ```
  "username": "webadmin@gmail.com",
  "password": "admin"
 ```
**Respuesta:**

```json
{
  "token": "ej12342weds..."
}
```

Usar el token en los endpoints protegidos mediante:

```
Auth Type: Bearer TOKEN
```

---

## Endpoints

### ARTISTAS

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/artistas

Listar todos los artistas.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/artistas?limit=5

Listar con límite (paginación por tamaño de página).

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/artistas?order=alphabetic

Listar ordenados alfabéticamente por nombre.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/artistas?limit=5&order=alphabetic

Combina límite y orden.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/artista/:id

Obtener artista por ID.

Crear artista.  

#### POST http://localhost/TP3_WEBII/TP3/soundSnack/api/artistas

**Auth Type:** `Authorization: Bearer <token>`  
**Body (raw opcion JSON):**

```json
{
  "name": "martin",
  "biography": "Biografía",
  "cover": "cover.png",
  "date_of_birth": "2001-12-07",
  "date_of_death": null,
  "place_of_birth": "tandil, buenos aires, Argentina"
}
```

Actualizar artista.  

#### PUT http://localhost/TP3_WEBII/TP3/soundSnack/api/artista/:id

**Auth Type:** `Authorization: Bearer <token>`  
**Body (JSON)** — se envian solo los campos a modificar:

```json
{
  "name": "Nombre nuevo",
  "biography": "Biografía actualizada"
}
```

Eliminar artista.  

#### DELETE http://localhost/TP3_WEBII/TP3/soundSnack/api/artista/:id

**Auth Type:** `Authorization: Bearer <token>`

---

### CANCIONES

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/canciones/:id_artista

Listar canciones de un artista.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/canciones/:id_artista?limit=5

Listar con límite.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/canciones/:id_artista?order=alphabetic

Listar ordenadas por título.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/canciones/:id_artista?limit=5&order=alphabetic

Combinar límite y orden.

#### GET http://localhost/TP3_WEBII/TP3/soundSnack/api/cancion/:id_cancion

Obtener una canción por su ID global.

Crear canción para un artista (se indica el id del artista).  

#### POST http://localhost/TP3_WEBII/TP3/soundSnack/api/canciones/:id_artista

**Auth Type:** `Authorization: Bearer <token>`  
**Body (JSON):**

```json
{
  "title": "La  moda del monton",
  "album": "Libertad",
  "duration": "03:45",
  "genre": "PopRock",
  "video": "https://youtube.com/..."
}
```
Actualizar canción por ID.

#### PUT http://localhost/TP3_WEBII/TP3/soundSnack/api/cancion/:id_cancion

**Auth Type:** `Authorization: Bearer <token>`  
**Body (JSON)** — Se envian solo los campos a modificar:

```json
{
  "title": "Título actualizado",
  "duration": "04:10"
}
```
Eliminar canción por ID. 

#### DELETE http://localhost/TP3_WEBII/TP3/soundSnack/api/cancion/:id_cancion

**Auth Type:** `Authorization: Bearer <token>`

---

## Consultas con Postman

### Obtener token para autenticación

```
POST http://localhost/TP3_WEBII/TP3/soundSnack/api/auth/login
```

**Auth (basic Auth):**

```
"username": "webadmin@gmail.com"
"password": "admin"
```
Copiar el token de la respuesta para futuras operaciones post, put, o delete.
