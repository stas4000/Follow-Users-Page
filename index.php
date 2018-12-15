
<?php
/**
 * Created by PhpStorm.
 * User: Evo-Crypt
 * Date: 12/14/2018
 * Time: 16:03 PM
 */

include 'classes/Main.php';

$userId = isset($_POST['user_id']) ? $_POST['user_id'] : false;
$unfollow = isset($_POST['unfollow']) ? $_POST['unfollow'] : false;
$main = new Main();

if($userId && !$unfollow) {
    echo $main->update_followers($userId);
} else if($userId && $unfollow){
    echo $main->unfollow($userId);
} else {
    $users = $main->get_users();

    include 'html/user_page.php';
}
