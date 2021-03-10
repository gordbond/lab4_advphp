<?php if ($loggedin) { ?>
    <h2>Editors</h2>

    <p>This is the editors page! Only editors and admins should be able to view this page, not the general public or members!</p>

    <?php echo $acl ?>
<?php } else { ?>
    <h2>YOU DON'T HAVE ACCESS TO THIS PAGE.</h2>


<?php } ?>