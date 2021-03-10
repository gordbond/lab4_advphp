<!-- 

    ADMIN PAGE 

 -->
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
                <td>F</td>
                <td><?= $allUsers[$i]['username'] ?></td>
                <td><?= $allUsers[$i]['password'] ?></td>
                <td><?= $allUsers[$i]['accesslevel'] ?></td>
                <td><?= $allUsers[$i]['frozen'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div>
    <?= form_open('Admin/createForm') ?>

    <h5>User name</h5>
    <input type="text" name="username" value="" size="50" />

    <h5>Password</h5>
    <input type="text" name="password" value="" size="50" />

    <h5>Access level</h5>
    <input type="text" name="accesslevel" value="" size="50" />

    <div><input type="submit" value="Submit" /></div>

    </form>
</div>