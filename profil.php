<?php
require 'header.php';
$errormess = '';
$bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name);
mysqli_set_charset($bdd, 'utf8');

if( isset($_SESSION['user'])) {
$user = $_SESSION['user'];
$userid = $user[0]['0'];
$Requete = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE id = '$userid'");
$userinfo = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
//var_dump($userinfo);
$usernom_bdd = $userinfo[0]['nom'];
$userprenom_bdd = $userinfo[0]['prenom'];
$userlogin_bdd = $userinfo[0]['login'];
$usermdp_bdd = $userinfo[0]['password'];
//foreach($userinfo['id']);
// var_dump($user_id);    
    if(isset($_POST['modification'])){
      if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['Cpassword'])) {
            $newprenom = ($_POST['prenom']);
            $newnom = ($_POST['nom']);
            $newlogin = ($_POST['username']);
            $newmdp = ($_POST['password']);
            $newCmdp = ($_POST['Cpassword']);
            $veriflogin_user = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs`WHERE login = '$newlogin'");
            $resultlogin_user = mysqli_fetch_assoc($veriflogin_user);
            //var_dump($resultlogin_user);
            $veriflogin_alluser = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs`"); //les logins de tous les utilisateurs
            $resultlogin_alluser = mysqli_fetch_all($veriflogin_alluser, MYSQLI_ASSOC);
            //var_dump($resultlogin_alluser);

            if($newmdp != $newCmdp) {
                $errormess = "Confirmation du mot de passe incorrect";
            }

            elseif($newlogin == $userlogin_bdd || empty($resultlogin_user)) {
                $reqinsert = mysqli_query($bdd, "UPDATE utilisateurs SET  login = '$newlogin', prenom = '$newprenom', nom = '$newnom', password = '$newmdp' WHERE id = $userid");
                session_destroy();
                header("Location:connexion.php");
            }
            elseif($newlogin != $userlogin_bdd && !empty($resultlogin_user)) {
                $errormess = "Ce login est déja utilisé";
            }


            
            
            /*

            elseif(empty($resultlogin_user) == false ||$userlogin_bdd == $newlogin ) { //si le login est dispo ok ou inchangé ok
                $reqinsert = mysqli_query($bdd, "UPDATE utilisateurs SET  login = '$newlogin', prenom = '$newprenom', nom = '$newnom', password = '$newmdp' WHERE id = $userid");
            }

            if(empty($resultlogin_user) == true && $userlogin_bdd != $newlogin ) { //si le login est pas dispo et changé ok
                $errormess = "Login déja utilisé";
            }
            

            else { 
                $errormess = "Login déja utilisé";
            }


            
            
            
            if(in_array($newlogin, array($veriflogin_alluser))) {
                echo "login déja utilisé";
            }
            
            if(empty($resultlogin_alluser) == false) { 
                $reqinsert = mysqli_query($bdd, "UPDATE utilisateurs SET  login = '$newlogin', prenom = '$newprenom', nom = '$newnom', password = '$newmdp' WHERE id = $userid");
                echo "bien gamin ce login est libre";
            }

            if(empty($veriflogin_user) == true && $userlogin_bdd == $newlogin) { 
                $reqinsert = mysqli_query($bdd, "UPDATE utilisateurs SET  login = '$newlogin', prenom = '$newprenom', nom = '$newnom', password = '$newmdp' WHERE id = $userid");
            }

            else {
                $errormess = "Nom d'utilisateur déja utilisé ou confirmation du mot de passe invalide";
            }*/


            
      }
    }
}
?>

<body>
        <div id="container">
            <h3 ><?php echo $errormess; ?></h3>
            <form action="" method="POST">
                <h1>Profil</h1>
                
                <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="prenom" value="<?php echo $userprenom_bdd ?>">

                <label><b>Nom</b></label>
                <input type="text" placeholder="Entrer votre nom" name="nom" value="<?php echo $usernom_bdd ?>">

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" value="<?php echo $userlogin_bdd ?>">

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" value="<?php echo $usermdp_bdd ?>" required>

                <label><b>Confirmation de mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="Cpassword" value="<?php echo $usermdp_bdd ?>" required>

                <input type="submit" id='submit' name="modification" value='modification'>
                <?php
                ?>
                
            </form>
        </div>
    </body>

<?php require 'footer.php'; ?>