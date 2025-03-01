#Makefile
SHELL := /bin/bash
VERSION=$(shell node -p "require('./package.json').version")
NAME=$(shell node -p "require('./package.json').name")
REGISTRY_NAME=$(shell node -p "require('./package.json').registry")


# Cible par défaut
all: help

# Build l'image
build:
	@docker build --no-cache --tag ${REGISTRY_NAME}${NAME}:latest --tag ${REGISTRY_NAME}${NAME}:${VERSION} --file configs/Dockerfile .

# Push l'image
push: build
	@docker push ${REGISTRY_NAME}${NAME}:latest
	@docker push ${REGISTRY_NAME}${NAME}:${VERSION}

dev:
	@npm run dev

up:
	@docker compose up

help:
	@echo "Makefile pour exécuter des commandes pour le projet '${NAME}'"

version:
	@echo "${NAME} at V${VERSION}"
	@echo "docker build --no-cache --tag ${REGISTRY_NAME}${NAME}:latest --tag ${REGISTRY_NAME}${NAME}:${VERSION} --file configs/Dockerfile ."

