# Projet de test gestion d'utilisateurs


## Spécifications


## Résultat attendu

Voici la liste des fonctionnalités à coder :
• une page de connexion ( login + mot de passe), seul les utilisateurs validés
peuvent se connecter
• une page de listing des comptes utilisateurs avec tous les attributs
utilisateurs.
• un formulaire d'ajout/édition utilisateurs
• changement du statut d'un utilisateur en AJAX directement depuis le listing
• une page privée, avec un message de bienvenue personnalisé :
Hello {USER_NAME} {USER_LASTNAME}
Définition d'un utilisateur :
• Attributs : ID, nom, prénom, mot de passe, email, login, user role, statut
• (en attente, validé,désactivé )
• Rôles : SUPERADMIN, ADMIN, CUSTOMER
Voici le détail des droits d'accès par rôle
SUPERADMIN :
• ajouter/éditer/lister des utilisateurs ADMIN ET CUSTOMER
• changer le statut d'un utilisateur ADMIN ET CUSTOMER
• accéder à la page privée
ADMIN:
• ajouter/éditer/lister des utilisateurs CUSTOMER
• changer le statut d'un utilisateur CUSTOMER
• accéder à la page privée
 CUSTOMER :
• accéder à la page privée

## Livraison

Le code doit être pushé sur un repo public sur GitHub.

## Contraintes techniques

• Symfony 5
• Git
• Boostrap 4 (optionnel)
• jQuery
LE SUPERADMIN devra exister par défaut en DB
avec comme login:mot de passe ---> admin:123456
Le projet est à versionner sous GIT peu importe l'hébergeur du repo ( bitbucket,
github… ) avec un accès privé au code.
Le projet devra contenir un README avec les instructions d'installation du projet.


## Installation:

Avoir docker et docker-compose.

Une fois le dépot cloné:
```
$ make install-all

```
url de login : /login
url d'admin: /admin
page d'accueil: /


Ouvrir un navigateur sur http://localhost:8081
