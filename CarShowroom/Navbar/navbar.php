<?php 
session_start();
?>
<nav>
    <a href="../HomePage/home.php" target="_self">Начало</a> |
    <?php if (isset($_SESSION['user'])) { 
            if ($_SESSION['user']["email"] == "admin@gmail.com") { ?>
                <a href="../AdminPanel/page.php" target="_self">Админ панел</a> |
        <?php } ?>
        <a href="../Gallery/page.php" target="_self">Галерия</a> |
    <?php } else{ ?>
        <a href="" target="_self">Галерия</a> |
    <?php } ?>
    <a href="#" target="_self">Тест Драйв</a> |
    <a href="../Information/page.php" target="_self">Информация</a> |
    <a href="../AboutUs/page.html" target="_self">Относно нас</a>
    <?php if (isset($_SESSION['user'])) { ?>
         | <a href="../Logout.php" target="_self">Излизане</a>
    <?php } ?>  
</nav>
