<?php
    class Account {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function change_password($password) {
            $this->db->query('UPDATE users SET password = :password WHERE id = :user_id');
            // Bind values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':password', $password);
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function balance_delete() {
            $this->db->query('DELETE FROM balances WHERE user_id = :user_id');
            // Bind value
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->execute();
        }

        public function account_delete() {
            $this->db->query('DELETE FROM users WHERE id = :user_id');
            // Bind value
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->execute();
        }
    }