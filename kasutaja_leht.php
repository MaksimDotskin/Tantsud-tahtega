<?php
require_once ('conf.php');
session_start();
// punktide lisamine
if (isset($_REQUEST["heatants"])){
    global $yhendus;
    $kask=$yhendus->prepare("update tantsid set punktid=punktid+1 where id=?");
    $kask->bind_param("i",$_REQUEST["heatants"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");

    //exit

}
if (isset($_REQUEST["pahatants"])){
    global $yhendus;
    $kask=$yhendus->prepare("update tantsid set punktid=punktid-1 where id=?");
    $kask->bind_param("i",$_REQUEST["pahatants"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");


}
if (isset($_REQUEST["paarinimi"]) && !empty($_REQUEST["paarinimi"])){
    global $yhendus;
    $kask=$yhendus->prepare("insert into tantsid(tantsupaar,ava_paev_) values(?,NOW())");
    $kask->bind_param("s",$_REQUEST["paarinimi"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");


}



?>


<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tantsud tähtedega</title>
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
            if (isAdmin()) {
            echo "<li>";
            echo '<a href="kasutaja_leht.php">Kasutaja</a>';
            echo "</li>";

                echo "<li>";
                echo '<a href="admin_leht.php">Admin</a>';
                echo "</li>";
            }
            echo "</ul>";
        }
        else {
            ?>
            <a href="login.php">Logi sisse</a>
            <?php
        }

        ?>


    </nav>
    <h2> Kasutajate leht </h2>
<?php
if(isset($_SESSION['kasutaja'])){?>
    <table>
        <tr>
            <th>Tantsupaari nimi</th>
            <th>Punktid</th>
            <th>Ava paev</th>
        </tr>
    <?php
    global $yhendus;
    $kask=$yhendus->prepare("select id,tantsupaar,punktid,ava_paev_ from tantsid  where avalik=1");
    $kask->bind_result($id,$tantsupaar,$punktid,$paev);
    $kask->execute();

    while($kask->fetch()){
        echo "<tr>";
        $tantsupaar=htmlspecialchars($tantsupaar);
        echo "<td>".$tantsupaar."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".$paev."</td>";
        if (!isAdmin()){
            echo "<td><a href='?heatants=$id'>Lisa +1punkt</a></td>";
            echo "<td><a href='?pahatants=$id'>Kustuta -1punkt</a></td>";
        }





    }   echo "</tr>";
    function isAdmin(){
        return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
    }
    ?>
        <form action="?">
            <label for="paarinimi">Lisa uus paar</label>
            <input type="text" name="paarinimi" id="paarinimi">
            <input type="submit" value="Lisa paar">
        </form>
    </table>
    <?php } ?>
</body>
</html>
<?php