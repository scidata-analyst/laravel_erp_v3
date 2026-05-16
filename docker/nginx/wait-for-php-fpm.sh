#!/bin/sh
set -e

host="${PHP_FPM_HOST:-app}"
port="${PHP_FPM_PORT:-9000}"

echo "Waiting for PHP-FPM at ${host}:${port}..."

until nc -z "$host" "$port"; do
    sleep 2
done

echo "PHP-FPM is ready."
