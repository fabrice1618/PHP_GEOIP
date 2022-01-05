# Critères de notation

## 1 - Fonctionnement
- fonctionnement de l'application, respect des spécifications
- nom de l'exécutable (script principal)
- contrôle des arguments de la ligne de commande (--help, --version...)
- code de retour au shell
- Gestion des messages d'erreur (stderr, syslog...)
- Vitesse d'exécution raisonnable

## 2 - Code source
- contenu du repository github fichiers recommendés / fichiers indésirables (documentation, fichiers binaires, config IDE...)
- fichiers .gitignore / exclude
- pertinence des commit et "commit message"
- noms de fichiers, extensions des fichiers
- fichier header de configuration (configuration générale, noms fichiers, formats, tailles...)
- Coding style ( PSR-1 / PSR-12 )
- formatage des fichiers: indentation, taille des tabulations, LF, UTF-8...
- Erreurs et warning de compilation
- Gestion des exceptions
- choix de l'algorithme
- découpage fonctionnel (interfaces, prototypes....)
- variables globales / locales
- choix des noms de variables
- utilisation de structures et des bons types de données
- programmation structurée, ré-utilisation de code
- programamtion défensive: contrôles des paramètres pour toutes les fonctions
- contrôle du code de retour de toutes les fonctions
- DRY (Don't Repeat Yourself)
- KISS (Keep It Simple Stupid)
- commentaires code source

## 3 - Tests
- Tests de fonctionnement (spécifications)
- Tests unitaires
- Mode debug (#define DEBUG), assertions 
