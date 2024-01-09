<?php
require_once ('conf.php');
session_start();
// punktide lisamine
if (isset($_REQUEST["punktid0"])){
    global $yhendus;
    $kask=$yhendus->prepare("update tantsid set punktid=0 where id=?");
    $kask->bind_param("i",$_REQUEST["punktid0"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");

    //exit

}
//peitmine
if (isset($_REQUEST["peitmine"])){
    global $yhendus;
    $kask=$yhendus->prepare("update tantsid set avalik=0 where id=?");
    $kask->bind_param("i",$_REQUEST["peitmine"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");

    //exit

}
//naitmine
if (isset($_REQUEST["naitmine"])){
    global $yhendus;
    $kask=$yhendus->prepare("update tantsid set avalik=1 where id=?");
    $kask->bind_param("i",$_REQUEST["naitmine"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");

    //exit

}




?>


    <!doctype html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Administreerimis leht</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Tantsud tähtedega</h1>
    <nav>
        <?php
        if(isset($_SESSION['kasutaja'])){
            ?>
            <h1>Tere, <?="$_SESSION[kasutaja]"?></h1>
            <a href="logout.php">Logi välja</a>

            <?php
            echo "<ul>";
            echo "<li>";
            echo '<a href="kasutaja_leht.php">Kasutaja</a>';
            echo "</li>";

                echo "<li>";
                echo  '<a href="admin_leht.php">Admin</a>';
                echo "</li>";


            echo "</ul>";
        }
        else {
            ?>
            <a href="login.php">Logi sisse</a>
            <?php
        }

        ?>


    </nav>
    <h2> Admini leht </h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Tantsupaari nimi</th>
            <th>Punktid</th>
            <th>Ava paev</th>
            <th>kommentaarid</th>
            <th>Avalik</th>
        </tr>
        <?php
        global $yhendus;
        $kask=$yhendus->prepare("select id,tantsupaar,punktid,ava_paev_,kommentaarid,avalik from tantsid");
        $kask->bind_result($id,$tantsupaar,$punktid,$paev,$kommentaarid,$avalik);
        $kask->execute();

        while($kask->fetch()){
            $test="Näita";
            $seisnud="naitmine";
            $test2="Kasutaja ei näe";
            if ($avalik==1){
                $test="Peita";
                $seisnud="peitmine";
                $test2="Kasutaja näeb";
            }


            echo "<tr>";
            $tantsupaar=htmlspecialchars($tantsupaar);
            echo "<td>".$id."</td>";
            echo "<td>".$tantsupaar."</td>";
            echo "<td>".$punktid."</td>";
            echo "<td>".$paev."</td>";
            echo "<td>".$kommentaarid."</td>";
            echo "<td>".$avalik."/".$test2."</td>";
            echo "<td><a href='?punktid0=$id'>Punktid 0</a></td>";
            echo "<td><a href='?$seisnud=$id'>$test</a></td>";

        }   echo "</tr>";
        function isAdmin(){
            return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
        }
        ?>

    </table>
    </body>
    </html>
<?php