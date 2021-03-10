<?php if ($loggedin) { ?>
    <h2>Members</h2>

    <p>This page is only accessible by members and admins - no general public or editors!</p>
    
    <?php echo $acl ?>
<?php } else { ?>
    <h2>YOU DON'T HAVE ACCESS TO THIS PAGE.</h2>


<?php } ?>