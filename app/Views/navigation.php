<ul>
    <li <?php if ($active['home']) { ?> class="active" <?php } ?>><a href="<?= base_url();  ?>/Home">Home</a></li>
    <li <?php if ($active['members']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>/Members">Members</a></li>
    <li <?php if ($active['editors']) { ?> class="active" <?php } ?>><a href="<?= base_url();  ?>/Editors">Editors</a></li>
    <li <?php if ($active['admin']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>/Admin">Admin</a></li>
    <?php if ($loggedin) { ?>
        <li><a href="<?= base_url(); ?>/Login/logout">Logout</a></li>
    <?php } else { ?>
        <li <?php if ($active['login']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>/Login">Login</a></li>
    <?php } ?>

</ul>
