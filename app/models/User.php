<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Register user
        public function register($data) {
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Login user
        public function login($email, $password) {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            // Bind value
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check if password matches
            if(password_verify($password, $row->password)) {
                return $row;
            } else {
                return false;
            }
        }

        // Find user by name
        public function findUserByName($name) {
            $this->db->query('SELECT * FROM users WHERE name = :name');
            // Bind value
            $this->db->bind(':name', $name);

            $row = $this->db->single();

            // If rowCount > 0 return true (email exists)
            return ($this->db->rowCount() > 0);
        }

        // Find user by email
        public function findUserByEmail($email) {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            // Bind value
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // If rowCount > 0 return true (email exists)
            return ($this->db->rowCount() > 0);
        }

        // Recover password
        public function recoverPassword($email) {
            $verification = randomString(12);
            $this->db->query('INSERT INTO recover (email, verification, valid_til) VALUES (:email, :verification, :valid_til)');
            // Time for verification
            $date = new DateTime();
            $date->modify('+1 day');
            $valid_til = $date->format('Y-m-d H:i:s');
            // Bind values
            $this->db->bind(':email', $email);
            $this->db->bind(':verification', $verification);
            $this->db->bind(':valid_til', $valid_til);

            if($this->db->execute()) {
                return $verification;
            } else {
                return false;
            }    
        }

        // Find verification row
        public function findVerification($verification) {
            $this->db->query('SELECT * FROM recover WHERE verification = :verification');
            // Bind value
            $this->db->bind(':verification', $verification);

            $row = $this->db->single();

            // If rowCount > 0 return true (verification exists)
            return ($this->db->rowCount() > 0);
        }

        // Is Verification still valid
        public function isValidVerification($verification) {
            $this->db->query('SELECT * FROM recover WHERE verification = :verification');
            // Bind value
            $this->db->bind(':verification', $verification);

            $row = $this->db->single();
            // Time for verification
            $date = new DateTime();
            $valid_til = $date->format('Y-m-d H:i:s');

            // Only valid if in time
            return ($date < $row->valid_til);
        }
        
        // Get verification row
        public function getVerification($verification) {
            $this->db->query('SELECT * FROM recover WHERE verification = :verification');
            // Bind value
            $this->db->bind(':verification', $verification);

            return $this->db->single();
        }

        // Delete verification
        public function deleteVerification($id) {
            $this->db->query('DELETE FROM recover WHERE id = :id');
            // Bind value
            $this->db->bind('id', $id);
            $this->db->execute();
        }

        // Update password
        public function updatePassword($email, $password) {
            $this->db->query('UPDATE users SET password = :password WHERE email = :email');
            // Bind values
            $this->db->bind(':password', $password);
            $this->db->bind(':email', $email);

            return ($this->db->execute());
        }
    }