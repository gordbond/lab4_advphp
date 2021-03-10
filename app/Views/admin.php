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