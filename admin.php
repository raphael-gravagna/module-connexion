<?php
require 'header.php';
$errormess = '';
$Requete = mysqli_query($bdd, "SELECT * FROM `utilisateurs`");
$Users = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

if(isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
}

?>

<body>
    <header>
        <div class="tableauheader">

    </header>

    <main>
            <table class>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Password</th>
                </tr>
                <tr><?php
                    foreach($Users as $User){
                    echo '<tr><td>'.$User['id'].'</td>';
                    echo '<td>'.$User['login'].'</td>';
                    echo '<td>'.$User['prenom'].'</td>';
                    echo '<td>'.$User['nom'].'</td>';
                    echo '<td>'.$User['password'].'</td>';
                    }?>
                </tr>
            </table>
    </main>
</body>

<?php require 'footer.php'; ?>