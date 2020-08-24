<?php
    class Balance {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getBalance($side, $type) {
            $this->db->query('SELECT * FROM balances WHERE user_id = :user_id && side = :side && type = :type ORDER BY value DESC');
            // Bind values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':side', $side);
            $this->db->bind(':type', $type);
            // Return results
            return $this->db->resultSet();
        }

        public function getShortActiva() {
            return $this->getBalance(1, 1);
        }

        public function getMidActiva() {
            return $this->getBalance(1, 2);
        }

        public function getLongActiva() {
            return $this->getBalance(1, 3);
        }

        public function getShortPassiva() {
            return $this->getBalance(2, 1);
        }

        public function getMidPassiva() {
            return $this->getBalance(2, 2);
        }

        public function getLongPassiva() {
            return $this->getBalance(2, 3);
        }

        public function getSum($side) {
            $this->db->query('SELECT SUM(value) as value FROM balances WHERE user_id = :user_id && side = :side');
            // Bind values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':side', $side);
            return $this->db->single();
        }

        public function getSumActiva() {
            return $this->getSum(1);
        }

        public function getSumPassiva() {
            return $this->getSum(2);
        }

        public function add($side, $type, $title, $value) {
            $this->db->query('INSERT INTO balances (user_id, side, type, title, value) VALUES (:user_id, :side, :type, :title, :value)');
            // Bind values
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $this->db->bind(':side', $side);
            $this->db->bind(':type', $type);
            $this->db->bind(':title', $title);
            $this->db->bind(':value', $value);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function edit($id, $title, $value) {
            $this->db->query('UPDATE balances SET title = :title, value = :value WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            $this->db->bind(':title', $title);
            $this->db->bind(':value', $value);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function findItemById($id) {
            $this->db->query('SELECT * FROM balances WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            // If rowCount > 0 return true (id exists)
            return ($this->db->rowCount() > 0);
        }

        public function itemBelongsToUser($id) {
            $this->db->query('SELECT * FROM balances WHERE id = :id && user_id = :user_id');
            // Bind value
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);

            $row = $this->db->single();

            // If rowCount > 0 return true 
            return ($this->db->rowCount() > 0);
        }

        public function getItemById($id) {
            $this->db->query('SELECT * FROM balances WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            return $this->db->single();
        }

        public function itemDelete($id) {
            $this->db->query('DELETE FROM balances WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }