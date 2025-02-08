#Makefile
SHELL := /bin/bash
include .env
export VERSION
export NAME
export REGISTRY_NAME

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
