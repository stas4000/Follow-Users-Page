<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Users Page</title>
    </head>
    <body>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Users Follow List</h1>
                <p class="lead"><p>Welcome Mr. <span id="user"></span>, here you can follow users that you like.</p></p>
            </div>
        </div>

        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Group Name</th>
                    <th>Number Of Followers</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $key=>$value): ?>
                    <tr>
                        <td><?= $value['name']; ?></td>
                        <td><?= $value['group_name']; ?></td>
                        <td id="follow_user_<?= $value['id']; ?>"><?= $value['following']; ?></td>
                        <td>
                            <div id="follow_btn_<?= $value['id']; ?>">
                                <?php if(isset($value['is_following'])):?>
                                    <button type="button" onclick="unfollow(<?= $value['id']; ?>)" class="btn following">
                                        <span>Following</span>
                                    </button>
                                <?php else: ?>
                                    <button type="button" onclick="follow(<?= $value['id']; ?>)" class="btn follow"
                                        <?php if($value['name'] === $_COOKIE['user']) echo 'disabled'?>>
                                        Follow
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <!--scripts-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="scripts/index.js"></script>
    </body>
</html>

<?php
