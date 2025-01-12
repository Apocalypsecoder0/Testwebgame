<html>
<head>
    <title>{TITLE} - Access Levels</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Access Name</th>
                <th>Access?</th>
                <th>Level Needed</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            global $q;
            while($val = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= htmlspecialchars($val['aname']); ?></td>
                    <td><?= ($s->isAllowed($val['alevel']) ? "Yes" : "No"); ?></td>
                    <td><?= htmlspecialchars($val['alevel']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
