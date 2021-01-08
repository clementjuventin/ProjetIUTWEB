# Projet de php 2020-2021 - Todolist

## Introduction

> Membre du groupe:
- Bastien Bougé
- Clément Juventin

## Code Samples

> Liste des fichiers:
- assets/image/
- Autoload.php
- config/
- - config.php
- - Validation.php
- controleur/
- -     FrontControler.php
- -     PublicControler.php
- -     UserControler.php
- dataBase/
- - Connexion.php
- factory/
- - Factory.php
- gateway/
- -     GatewayList.php
- -     GatewayTask.php
- -     GatewayUser.php
- index.php
- model/
- - metier/
- - -     Liste.php
- - -     Task.php
- - -    User.php
- - TaskModel.php
- - UserModel.php
- - ViewModel.php
- view/
- - addList.php
- - addTask.php
- - css/
- - - style.css
- - erreur.php
- - login.php
- - sample/
- - -    footer.php
- - - head.php
- - - header.php
- - signUp.php
- - toDoList.php


## Installation

> Séparation du travail:
- Bastien:
- config/
- - config.php
- - Validation.php  (Validation tâche)
- controleur/
- -     PublicControler.php
- -     UserControler.php
- dataBase/
- - Connexion.php
- gateway/
- -     GatewayUser.php
- model/
- - metier/
- - -     Liste.php
- - -    User.php
- - UserModel.php
- view/
- - addList.php
- - css/
- - - style.css
- - login.php
- - signUp.php
- - toDoList.php
- 
- 
- Clément:
- Autoload.php
- config/
- - Validation.php (Validation liste, utilisateur)
- controleur/
- -     FrontControler.php
- -     PublicControler.php
- factory/
- - Factory.php
- gateway/
- -     GatewayList.php
- -     GatewayTask.php
- model/
- - metier/
- - -     Liste.php
- - -     Task.php
- - TaskModel.php
- - ViewModel.php
- view/
- - addTask.php
- - css/
- - - style.css
- - erreur.php
- - sample/
- - -    footer.php
- - - head.php
- - - header.php
- - toDoList.php

    Pour tester le site web nous vous avons laissé le choix entre une base de donnée avec un stub (user: user, mot de passe: password) et une base de donnée vierge.
