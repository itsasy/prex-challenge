# Prex Challenge - GIF API (Hexagonal + DDD)

API REST para búsqueda y gestión de GIFs con integración a GIPHY, autenticación OAuth2.0 y auditoría completa.

## Tecnologías

- PHP 8.4+
- Laravel 13
- MariaDB / MySQL
- Laravel Passport (OAuth2)
- Arquitectura Hexagonal + DDD

## Requisitos cumplidos

- Login con token de 30 minutos
- Búsqueda de GIFs y obtención por ID
- Guardar / listar / eliminar favoritos
- Auditoría completa de todas las peticiones
- Tests unitarios y de feature
- Docker listo

## Cómo levantar el proyecto

1. Copiar el `.env.example` a `.env`:

```bash
cp .env.example .env
```

2. Agregar la clave de GIPHY en .env:

```bash
GIPHY_API_KEY=tu_clave_de_giphy_aquí
```

3. Levantar los contenedores Docker:

```bash
docker-compose up -d --build
```

4. Instalar dependencias y migrar base de datos:

```bash
docker-compose exec app composer install
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan passport:install
```

Acceder a la API: `http://localhost:8000/api`

## Endpoints

### Autenticación

| Método | Endpoint      | Descripción                   |
| ------ | ------------- | ----------------------------- |
| POST   | `/api/login`  | Obtiene token Bearer (OAuth2) |
| POST   | `/api/logout` | Revoca token                  |

### GIFs

| Método | Endpoint                                       | Descripción                  |
| ------ | ---------------------------------------------- | ---------------------------- |
| GET    | `/api/gifs/search?query={query}&limit={limit}` | Busca GIFs por palabra clave |
| GET    | `/api/gifs/{id}`                               | Obtiene un GIF por su ID     |

### Favoritos

| Método | Endpoint                                                        | Descripción                                          |
| ------ | --------------------------------------------------------------- | ---------------------------------------------------- |
| POST   | `/api/favorites`                                                | Guarda un GIF como favorito                          |
| GET    | `/api/favorites/{id}`                                           | Obtiene un favorito específico (incluye info de GIF) |
| GET    | `/api/favorites?user_id={userId}&limit={limit}&offset={offset}` | Lista favoritos de un usuario                        |
| DELETE | `/api/favorites/{id}`                                           | Elimina un favorito                                  |

---

## Diagramas

### Diagramas de Secuencia

1. **Login**

- User -> AuthController: POST /api/login
- AuthController -> AuthenticatorInterface: validateCredentials()
- AuthenticatorInterface -> PassportTokenGenerator: createToken()
- PassportTokenGenerator --> AuthController: token
- AuthController --> User: 200 OK + token

2. **Buscar GIFs**

- User -> GifController: GET /api/gifs/search
- GifController -> GifProviderInterface: searchGifs(query, limit)
- GifProviderInterface -> GiphyAdapter: requestGiphyAPI(query, limit)
- GiphyAdapter --> GifProviderInterface: gifs
- GifProviderInterface --> GifController: gifs
- GifController --> User: 200 OK + gifs

3. **Guardar Favorito**

- User -> FavoriteController: POST /api/favorites
- FavoriteController -> GifProviderInterface: getGifById(gif_id)
- GifProviderInterface -> GiphyAdapter: requestGiphyAPI(gif_id)
- GiphyAdapter --> GifProviderInterface: gif
- FavoriteController -> FavoriteRepositoryInterface: save(favorite)
- FavoriteRepositoryInterface --> FavoriteController: favorite
- FavoriteController --> User: 200 OK + favorite DTO

---

### DER (Base de datos)

### Tabla `users`

- `id` PK
- `name`
- `email`
- `password`

### Tabla `favorites`

- `id` PK
- `user_id` FK → `users.id`
- `gif_id`
- `alias`

### Tabla `audit_logs`

- `id` PK
- `user_id` FK → `users.id`
- `service`
- `request_body`
- `http_status`
- `response_body`
- `ip`

## Postman Collection

Importar `postman/GIF_API_Collection.json` (incluye automatización del token).

## Tests

```bash
php artisan test
```

## Estructura del proyecto

- `src/Domain/` → Entidades, Value Objects, Ports
- `src/Application/` → Use Cases y DTOs
- `src/Infrastructure/` → Implementaciones concretas
- `src/Adapters/` → Controladores y Middleware

Proyecto desarrollado cumpliendo estrictamente los requisitos del challenge.

---

**Autor:** Alexis Maldonado  
**Fecha de entrega:** 26/03/2026
