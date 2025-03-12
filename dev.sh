#!/bin/bash

# Run composer install
composer install

# Run bun install
bun install

# Enter the ./docker directory and run docker compose up --build
cd ./docker
docker compose up --build
