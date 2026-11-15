#!/usr/bin/env bash
# ================================================================
# Script de Migración de Base de Datos a la Nube (Paso 17)
# Proyecto: users-management-php (Arquitectura Hexagonal + DDD)
# ================================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(dirname "$SCRIPT_DIR")"

echo "=== MIGRACIÓN DE BASE DE DATOS A SERVICIO EN LA NUBE ==="

# Si existe un archivo .env en la raíz, cargar variables
if [ -f "$ROOT_DIR/.env" ]; then
    echo "Cargando configuración desde .env..."
    export $(grep -v '^#' "$ROOT_DIR/.env" | xargs -d '\n')
fi

TARGET_HOST="${DB_HOST:-127.0.0.1}"
TARGET_PORT="${DB_PORT:-3306}"
TARGET_DB="${DB_DATABASE:-crud_usuarios}"
TARGET_USER="${DB_USERNAME:-root}"
TARGET_PASS="${DB_PASSWORD:-}"

echo "Destino configurado:"
echo "  Host:     $TARGET_HOST"
echo "  Puerto:   $TARGET_PORT"
echo "  Base:     $TARGET_DB"
echo "  Usuario:  $TARGET_USER"

if [ -z "$TARGET_PASS" ]; then
    read -rsp "Introduce la contraseña para $TARGET_USER: " TARGET_PASS
    echo ""
fi

echo "1/2 Aplicando esquema DDL (sql/01_schema.sql)..."
mysql -h "$TARGET_HOST" -P "$TARGET_PORT" -u "$TARGET_USER" -p"$TARGET_PASS" "$TARGET_DB" < "$ROOT_DIR/sql/01_schema.sql"

echo "2/2 Insertando datos semilla (sql/02_seeds.sql)..."
mysql -h "$TARGET_HOST" -P "$TARGET_PORT" -u "$TARGET_USER" -p"$TARGET_PASS" "$TARGET_DB" < "$ROOT_DIR/sql/02_seeds.sql"

echo "=== MIGRACIÓN COMPLETADA EXITOSAMENTE ==="
