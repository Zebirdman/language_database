#!/bin/bash
docker build -t zeft/langdb-web -f build/web/Dockerfile .
docker build -t zeft/langdb-db -f build/database/Dockerfile build/database
