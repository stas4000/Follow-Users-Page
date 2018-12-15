<?php
/**
 * Created by PhpStorm.
 * User: Evo-Crypt
 * Date: 12/14/2018
 * Time: 16:01 PM
 */

class Main
{
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=seeking_alpha","root","");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_users() {
        try {
            setcookie('user', 'Semion');
            setcookie('user_id', '12');
            if(!isset($_COOKIE['user'])) {
                header("Refresh:0");
            }
            $stmt = $this->pdo->prepare("SELECT u.id, u.name, g.name group_name, 
                                                  IF(f.followers IS NOT NULL, f.followers, '0') following,
                                                  (SELECT 1 FROM follow_scheme WHERE following_user_id = ? AND followed_user_id = u.id) is_following
                                                  FROM users u JOIN groups g ON g.id = u.group_id 
                                                  LEFT JOIN following f ON f.user_id = u.id                                                 
                                                  ORDER BY u.name");
            $stmt->execute([$_COOKIE['user_id']]);
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update_followers($followed_user_id) {
        try {
            $stmt = $this->pdo->prepare("INSERT IGNORE INTO follow_scheme (following_user_id, followed_user_id) VALUES(?, ?)");
            $stmt->execute([$_COOKIE['user_id'], $followed_user_id]);

            $stmt = $this->pdo->prepare("SELECT followers FROM following WHERE user_id = ?");
            $stmt->execute([$followed_user_id]);
            $followers_count = $stmt->fetchColumn();

            return $followers_count;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function unfollow($followed_user_id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM follow_scheme WHERE following_user_id = ? AND followed_user_id = ?");
            $stmt->execute([$_COOKIE['user_id'], $followed_user_id]);

            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}