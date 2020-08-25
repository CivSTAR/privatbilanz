<?php 
    class Accounts extends Controller {
        public function __construct() {
            // Only allow logged in users
            if(!isLoggedIn()) {
                redirect('pages/index');
            } else {
                $this->accountModel = $this->model('Account');
            }
        }

        public function index() {
            // Set the data
            $data = [];
            // Set the view
            $view = strtolower(__CLASS__) . '/index';
            // Load View
            $this->view($view, $data);
        }

        public function change() {
            // Set the data
            $data = [
                'password' => '',
                'confirm_password' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Set the data
                $data['password'] = $_POST['password'];
                $data['confirm_password'] = $_POST['confirm_password'];
                // Validate password
                if(empty($data['password'])) {
                    $data['password_err'] = 'Please enter a password';
                } elseif(strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 charackters';
                }
                // Validate confirm password
                if(empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } elseif($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
                // Check for errors
                if(empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // No errors
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if($this->accountModel->change_password($data['password'])) {
                        // Success
                        flash('accounts_msg', 'Password changed!');
                        redirect('accounts/index');
                    }   else {
                        // Failure
                        flash('accounts_msg', 'Something went wrong, please try again', 'alert alert-failure');
                        redirect('accounts/index');
                    }
                } else {
                    // Set the view
                    $view = strtolower(__CLASS__) . '/index';
                    // Load View
                    $this->view($view, $data);
                }
            } else {
                // Set the view
                $view = strtolower(__CLASS__) . '/index';
                // Load View
                $this->view($view, $data);
            }    
        }

        public function delete() {
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Delete balance
                $this->accountModel->balance_delete();
                // Delete account
                $this->accountModel->account_delete();
                // Unset data
                unset($_SESSION['user_id']);
                unset($_SESSION['user_email']);
                unset($_SESSION['user_name']);
                session_destroy();
                redirect('users/login');
            } else {
                redirect('accounts');
            }
        }
    }