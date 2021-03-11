<!-- 

    ADMIN PAGE 

 -->
<h1>Admin Page</h1>
<?php
if ($errors) {
    foreach ($errors as &$error) {
?>

        <h4><?= $error ?></h4>

<?php }
} ?>
<h2>User Table</h2>
<table>
    <thead>
        <!-- 
            TABLE HEADERS
         -->
        <tr>
            <th>Delete</th>
            <th>Freeze</th>
            <th>User Name</th>
            <th>Password</th>
            <th>Access Level</th>
            <th>Frozen</th>
        </tr>
    </thead>
    <tbody>
        <!-- 
            CURRENT QUESTIONS IN DB
            - Also update and delete buttons
         -->
        <?php for ($i = 0; $i < count($allUsers); $i++) { ?>
            <tr>
                <td>
                    <a href="<?= base_url("Admin/DeleteUser/" . $allUsers[$i]['compid']) ?>">
                        D
                    </a>
                </td>
                <td>
                    <a href="<?= base_url("Admin/toggleFrozen/" . $allUsers[$i]['compid'] . "/" . $allUsers[$i]['frozen']) ?>">
                        F
                    </a>
                </td>
                <td><?= $allUsers[$i]['username'] ?></td>
                <td><?= $allUsers[$i]['password'] ?></td>
                <td><?= $allUsers[$i]['accesslevel'] ?></td>
                <td><?= $allUsers[$i]['frozen'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<fieldset>
    <legend>Add new user</legend>
    <?= form_open('Admin/createUser') ?>
    <label for="username">Username:</label>
    <br>
    <input type="text" name="username" value="" size="50" />
    <br>
    <label for="password">Password:</label>
    <br>
    <input type="text" name="password" value="" size="50" />
    <br>
    <label for="accesslevel">Access level:</label>
    <br>
    <input type="text" name="accesslevel" value="" size="50" />
    <div><input type="submit" value="Submit" /></div>
    </form>
</fieldset>