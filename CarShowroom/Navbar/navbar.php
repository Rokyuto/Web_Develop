
<nav>
    <a href="../HomePage/home.php" target="_self">Начало</a> |
    <?php if (isset($_SESSION['user'])) { ?>
        <a href="../Gallery/page.php" target="_self">Галерия</a> |
    <?php } else{ ?>
        <a href="" target="_self">Галерия</a> |
    <?php } ?>
    <a href="#" target="_self">Тест Драйв</a> |
    <a href="#" target="_self">Информация</a> |
    <a href="../AboutUs/page.html" target="_self">Относно нас</a>
</nav>
