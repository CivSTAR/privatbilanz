<?php
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function register() {
            // Only run if user is not logged in
            if($this->isLoggedIn()) {
                redirect('pages/index');
            }
            // Set the data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Set the data
                $data['name'] = trim($_POST['name']);
                $data['email'] = trim($_POST['email']);
                $data['password'] = trim($_POST['password']);
                $data['confirm_password'] = trim($_POST['confirm_password']);
                // Validate name
                if(empty($data['name'])) {
                    $data['name_err'] = 'Please enter a name';
                } elseif($this->userModel->findUserByName($data['name'])) {
                    $data['name_err'] = 'Name is already taken';
                }
                // Validate email
                if(empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                } elseif($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
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
                // Make sure errors are empty
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validated
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    // Register user
                    if($this->userModel->register($data)) {
                        // Registration successful
                        flash('register_success', 'You are now registered and can log in');
                        redirect('users/login');
                    } else {
                        flash('register_failure', 'Something went wrong, please try again');
                        redirect('users/register');
                    }
                }
            } 
            // Set the view
            $view = strtolower(__CLASS__) . '/register';
            // Load View
            $this->view($view, $data);
        }

        public function login() {
            // Only run if user is not logged in
            if($this->isLoggedIn()) {
                redirect('pages/index');
            }
            // Set the data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Set the data
                $data['email'] = trim($_POST['email']);
                $data['password'] = trim($_POST['password']);
                // Validate email
                if(empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                } elseif(!$this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'No user found';
                }
                // Validate password
                if(empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                }
                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])) {
                    // Validated
                    // Check and set looged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if(!$loggedInUser) {
                        $data['password_err'] = 'Password incorrect';
                    } else {
                        // Login successful
                        $this->createUserSession($loggedInUser);
                    }
                }
            } 
            // Set the view
            $view = strtolower(__CLASS__) . '/login';
            // Load View
            $this->view($view, $data);
        }

        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('pages/index');
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }

        public function isLoggedIn() {
            return isset($_SESSION['user_id']);
        }

        public function recoverPassword() {
            if($this->isLoggedIn()) {
                redirect('pages/index');
            }
            // Set the data
            $data = [
                'email' => '',
                'email_err' => ''
            ];
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Set the data
                $data['email'] = trim($_POST['email']);
                // Validate email
                if(empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                } elseif(!$this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'No user found';
                }
                // Make sure errors are empty
                if(empty($data['email_err'])) {
                    // Validated// Password recover
                    $verification = $this->userModel->recoverPassword($data['email']);
                    if($verification !== false) {
                        // Create link
                        $link = URLROOT . '/users/verifyRecover/' . $verification;
                        // Send link per mail
                        $subject = 'Password recovery';
                        $from = 'From: ' . SITENAME . ' <' . SUPPORTMAIL . '>\r\n';
                        $from .= 'Reply-To: ' . SUPPORTMAIL . '\r\n';
                        $from .= 'Content-Type: text/html\r\n';
                        $text = 'Please follow the link to create a new password<br /><a href="' . $link . '">' . $link . '</a>';
                        
                        try {
                            mail($data['email'], $subject, $text, $from);
                            // Flash message
                            flash('recover_password', 'Create new password: link send');
                        } catch(Exception $e) {
                            // Flash message
                            flash('recover_password', 'Temporary password not send');
                        }                        
                    } else {
                        // Flash message
                        flash('recover_password', 'Recover: Something went wrong..', 'alert alert-failure');
                    }
                    // Redirect                    
                    redirect('users/login');
                }
            } 
            // Set the view
            $view = strtolower(__CLASS__) . '/recover_password';
            // Load View
            $this->view($view, $data);
        }

        public function verifyRecover($verification = '') {
            if($this->isLoggedIn()) {
                redirect('pages/index');
            }
            // Check if verification is not empty
            if(empty($verification) && empty($_POST['verification'])) {
                // Redirect to index
                redirect('pages/index');
            }
            // Set the data
            $data = [
                'password' => '',
                'confirm_password' => '',
                'verification' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            if($verification == '') {
                $data['verification'] = $_POST['verification'];
            } else {
                $data['verification'] = $verification;
            }

            // Check for verification
            if($this->userModel->findVerification($data['verification'])) {
                // Check if verification is still valid
                if(!isValidVerification($data['verification'])) {
                    // Get verification row
                    $row = $this->userModel->getVerification($data['verification']);
                    // Delete verification
                    $this->userModel->deleteVerification($row->id);
                    // Flash message
                    flash('verifyRecoverFail', 'Verification does not exist', 'alert alert-failure');
                    redirect('users/login');
                }
                // Check for post
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Sanitize POST data
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    // Set the data
                    $data['password'] = ltrim($_POST['password']);
                    $data['confirm_password'] = ltrim($_POST['confirm_password']);
                    // Validate password
                    if(empty($data['password'])) {
                        $data['password_err'] = 'Please enter a password';
                    } elseif(strlen($data['password']) < 6) {
                        $data['password_err'] = 'Password must be at least 6 charackters';
                    }
                    // Validate confirm password
                    if(empty($data['confirm_password'])) {
                        $data['confirm_password_err'] = 'Please retype the password';
                    } elseif($data['password'] !== $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                    // Check for errors
                    if(empty($data['password_err']) && empty($data['confirm_password_err'])) {
                        // Hash password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        // Get verification row
                        $row = $this->userModel->getVerification($data['verification']);
                        // Update password in database
                        if($this->userModel->updatePassword($row->email, $data['password'])) {
                            // Delete verification
                            $this->userModel->deleteVerification($row->id);
                            // Flash message
                            flash('verifyRecover', 'New password was created');
                            redirect('users/login');
                        } else {
                            // Flash message
                            flash('verifyRecoverFail', 'Recover: Something went wrong..', 'alert alert-failure');
                            redirect('users/verifyRecover/' . $data['verification']);
                        }                         
                    }                              
                } 
                // Set the view
                $view = strtolower(__CLASS__) . '/create_password';
                // Load View
                $this->view($view, $data);                
            } else {
                // Flash message
                flash('verifyRecover', 'Verification does not exist', 'alert alert-failure');
                redirect('users/login');
            }            
        }
    }