<?php
require_once 'app/models/model.php';

class UserModel extends Model {
    
    public function getUser($email) {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $query->execute(array($email));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}