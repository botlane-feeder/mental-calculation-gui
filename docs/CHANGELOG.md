# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),  
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Dev

### UPDATE

- TODO : Changer les boutons, de `<div>` en `<button>`

## [0.7.0] - 2025-03-01

### ADD

- Ajout d'un bouton pour afficher la modal.

### UPDATE 

- Mise en place de la librairie game-utils avec les composants
  - `CountdownBar.svelte`
  - `CountdownTime.svelte`
- Changement de la récupération des informations VERSION, NAME et REGISTRY_NAME

### DELETE

- Suppression du fichier `.env`

## [0.6.2] - 2025-02-26

### FIX

- Modfication du lien vers le changelog

## [0.6.1] - 2025-02-26

### FIX

- Modification de l'affichage du timer en secondes

## [0.6.0] - 2025-02-25

### ADD

- Ajouter d'un champ `scoreFactor` dans une équation pour le calcul du score
- Ajouter un stockage de la difficulté et des scores dans le localstorage
- Ajouter une page à propos, avec ce changelog

### UPDATE

- Modification du timer pour rendre disponible le bouton Rejouer
- Modification du design de la croix de la modal
- Modification du calcul du score, en fonction du `scoreFactor` et du temps restant

### FIX

- La réponse n'est pas `0` par défaut, mais `null`

## [0.5.0] - 2025-02-24

### ADD

- Ajout d'une modale pour un titre explication le bouton de lancement et l'affichage du score
  - Délai sur le bouton de lancement, pour éviter un click d'erreur
- Ajout d'un menu pour lancer une partie et choisir le niveau de difficulté

### UPDATE

- Modification du `globalTimer` à 30s et du `equationTimer` à 5s
- Quand le timer d'une équation est fini, la réponse du joueur est réinitialisée
- TODO : Changer les boutons, de `<div>` en `<button>`

## [0.4.0] - 2025-02-10

### ADD

- Affichage du scores

## [0.3.1] - 2025-02-10

### FIX

- Réparation du calcul de l'équation

## [0.3.0] - 2025-02-10

### ADD

- Ajout d'un décompte pour chronométrer la résolution d'une équation
  - composant : `CountdownBar.svelte`
- Ajout d'un décompte global pour tenter de résoudre un certain nombre d'équations
  - composant : `CountdownTime.svelte`
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
  - `Keypad.svelte`