<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="perdu" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modulecss.css">

    <title>Document</title>
</head>

<header>
    <nav class=nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php
        if(!isset($_SESSION['user'])) {
        echo "<li><a href='connexion.php'>Connexion</a></li>";
        }
        ?>
        <?php
        if(!isset($_SESSION['user'])) {
        echo "<li><a href='inscription.php'>S'inscrire</a></li>";
        }
        ?>
        <li><a href="profil.php">Profil</a></li>
        <?php
        if(isset($_SESSION['user'])) {
           echo "<li><a href='logout.php'><input type='button' value='Déconnexion'></a></li>";
        }
      ?>
      </ul>
    </nav>
  </header>

  