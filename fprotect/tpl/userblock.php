<?php ///Isida Yoko ##pop
        $ses = false;
    if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        $ses= true;
?>
<div>
    <?php if ($ses) : ?>
        <tbody class="hdr2">
                <tr class="user-name">
                    <td><p>Вы зашли как <a href="/personal"><?php echo $_SESSION['user']; ?></a></p></td>
                </tr>
                <tr class="exit">
                    <td><a href="/login.php?user_logout">Выход »</a></td>
                </tr>
        </tbody>
    <?php endif; ?>

</div>
