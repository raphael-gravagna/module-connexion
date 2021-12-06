<?php
require 'header.php';
$errormess = '';
//var_dump($_SESSION);

if(isset($_SESSION['login'])) {
    header('Location:profil.php');
}   /*/ouverture d'une session, si login est renseigné redirection vers la page profil.php*/

if (isset($_POST['logout']))
{
    session_destroy();
    header('location:connexion.php');
} // ! A enlever de la page connexion

if(isset($_POST['connexion'])) {
    $bdd_username = 'root';
    $bdd_password = '';
    $bdd_name     = 'moduleconnexion';
    $bdd_host     = 'localhost';
    $bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name)
           or die('could not connect to database');

    mysqli_set_charset($bdd, 'utf8');
    
    $login = $_POST['username'];
    $mdp = $_POST['password'];

    if(isset($login) && isset($mdp))
    {
        $Requete = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$mdp'");
        $result = mysqli_fetch_all($Requete); // assoc récupère chaque colonne de ma table du coup
        //var_dump($result);
        // * condition qui permet de savoir si la requête est true si oui => on rentre dedans
        if ($Requete == true)
        {
            if ($login === 'admin' && $mdp === 'admin')
            {
                $_SESSION['admin'] = $result;
                header('location:admin.php');
            }
            elseif ($_SESSION['user'] = $result)
            {
                header('location:profil.php');
            }
            else {
                $errormess = "Utilisateur inconnu, réessayez si vous avez un compte ou inscrivez-vous";
            }
        }

    }

    // requête d'insertion : insert into 



}

?>


<body>
        <div id="container">
            <!-- zone de connexion -->
            <h3 ><?php echo $errormess; ?></h3>

            <form action="" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' name="connexion" value='Connexion'>
                <input type="submit" id='submit' name="logout" value='DeConnexion'>
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
    </body>

    <?php require 'footer.php'; ?>