# Instrucciones del repositorio

- El esquema clínico existente no está representado por las migraciones históricas de `database/migrations`; esas migraciones incluyen tablas de otro dominio.
- Las migraciones nuevas de RIPS están aisladas en `database/migrations/rips`. No ejecutes la migración global sobre una base clínica. Para desplegar solo las tablas RIPS, usa `php artisan migrate --path=database/migrations/rips` después de revisar la conexión y obtener autorización para esa base.
