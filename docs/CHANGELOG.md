# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),  
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.4.0] - 2025-02-10

### ADD

- Affichage du score


## [0.3.1] - 2025-02-10

### FIX

- Réparation du calcul de l'équation

## [0.3.0] - 2025-02-10

### ADD

- Ajout d'un décompte pour chronométrer la résolution d'une équation
- Ajout d'un décompte global pour tenter de résoudre un certain nombre d'équations
- Ajout d'un bouton pour lancer le defi
- Mise en place de 100 équations côté SvelteKit

### UPDATE

- Changement du visuel pour la reussite ou l'erreur de l'équation
- Mise à jour des espacements

## [0.2.0] - 2025-02-08

### ADD

- Ajout de la vérification visuelle d'une victoire ou d'une erreur

### UPDATE

- Changement de couleur de fond de l'interface
- Modification du design pour mobile


## [0.1.1] - 2025-02-08

**Réparation pour déploiement**

### FIX 
- Configuration Vite, ajout des paramètres --host et --port 80

## [0.1.0] - 2025-02-08

**Mise en place des configurations pour mettre en ligne**

### ADD

- Ajout du Dockerfile, pour build l'image
- Ajout du Makefile, pour simplifier les `docker build` et `docker push`

## [0.0.0] - 2025-02-08

**Mise en place du projet, documentation et des premiers composants**

### ADD

- Ajout de la documentation explicative `docs/README.md`
- Ajout des composants :
  - `MentalCalculation.svelte`
  - `Equation.svelte`
  - `KEypad.svelte`