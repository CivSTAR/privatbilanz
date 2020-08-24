<?php
    class Balances extends Controller {
        public function __construct() {
            // Only allow access to logged in User
            if(!isLoggedIn()) {
                redirect('pages/index');
            }
            // Load models
            $this->userModel = $this->model('User');
            $this->balanceModel = $this->model('Balance');    
        }

        public function index() {
            // Set the data
            $data = $this->getData();
            // Set the view
            $view = strtolower(__CLASS__) . '/index';
            // Load View
            $this->view($view, $data);
        }

        public function add() {
            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Set the data
                $data = $this->getData();
                // Catch variables
                $title = trim($_POST['title']);
                $value = trim($_POST['value']);
                $value = str_replace(',', '.', $value);
                // Validate title
                if(empty($title)) {
                    $data['title_err'] = 'Please enter a desciption';
                }
                // Validate value
                if(empty($value)) {
                    $data['value_err'] = 'Please enter a value';
                } elseif(!is_numeric($value)) {
                    $data['value_err'] = 'Please enter a valid number';
                }
                // Check for error
                if(empty($data['title_err']) && empty($data['value_err'])) {
                    // Shorten title if necessary
                    if(strlen($title) > 30) {
                        $title = substr($title, 0, 30);
                    }
                    // Success
                    if($this->balanceModel->add($_POST['side'], $_POST['type'], $title, $value)) {
                        // Add Successful
                        // Flash message
                        flash('message_add', 'New item added');
                    } else {
                        // Failure
                        // Flash message
                        flash('message_add', 'Add: Something went wrong..', 'alert alert-failure');
                    }
                    redirect('balances');
                } else {
                    // Failure
                    $data['title'] = $title;
                    $data['value'] = $value;
                    // Set the view
                    $view = strtolower(__CLASS__) . '/index';
                    // Load View
                    $this->view($view, $data);
                }
            } else {
                redirect('balances');
            }
        }

        public function edit($id) {
            // Check if id exists
            if($this->balanceModel->findItemById($id)) {
                // Check if item belongs to user
                if($this->balanceModel->itemBelongsToUser($id)) {
                    // Set the data
                    $data = [
                        'id' => $id,
                        'title' => '',
                        'value' => '',
                        'title_err' => '',
                        'value_err' => ''
                    ];
                    // Check for post
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Process form
                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                        // Catch variables
                        $data['title'] = trim($_POST['title']);
                        $data['value'] = trim($_POST['value']);
                        $data['value'] = str_replace(',', '.', $data['value']);
                        // Validate title
                        if(empty($data['title'])) {
                            $data['title_err'] = 'Please enter a desciption';
                        }
                        // Validate value
                        if(empty($data['value'])) {
                            $data['value_err'] = 'Please enter a value';
                        } elseif(!is_numeric($data['value'])) {
                            $data['value_err'] = 'Please enter a valid number';
                        }
                        // Check for error
                        if(empty($data['title_err']) && empty($data['value_err'])) {
                            // Shorten title if necessary
                            if(strlen($data['title']) > 30) {
                                $data['title'] = substr($data['title'], 0, 30);
                            }
                            // Success
                            if($this->balanceModel->edit($id, $data['title'], $data['value'])) {
                                // Edit Successful
                                // Flash message
                                flash('message_add', 'Item edit successful');
                            } else {
                                // Failure
                                // Flash message
                                flash('message_add', 'Edit: Something went wrong..', 'alert alert-failure');
                            }
                            redirect('balances');
                        } else {
                            // Failure
                            // Set the view
                            $view = strtolower(__CLASS__) . '/edit';
                            // Load View
                            $this->view($view, $data);
                        }
                    } else {
                        // Get item
                        $item = $this->balanceModel->getItemById($id);
                        $data['title'] = $item->title;
                        $data['value'] = $item->value;
                        // Set the view
                        $view = strtolower(__CLASS__) . '/edit';
                        // Load View
                        $this->view($view, $data);
                    }    
                } else {
                    redirect('balances');
                }
            } else {
                redirect('balances');
            }
        }

        public function delete($id) {
            // Check if id exists
            if($this->balanceModel->findItemById($id)) {
                // Check if item belongs to user
                if($this->balanceModel->itemBelongsToUser($id)) {
                    // Delete item
                    if($this->balanceModel->itemDelete($id)) {
                        // Delete Successful
                        // Flash message
                        flash('message_add', 'Item deleted');
                    } else {
                        // Failure
                        // Flash message
                        flash('message_add', 'Delete: Something went wrong..', 'alert alert-failure');
                    }
                }
            }                   
            redirect('balances');       
        }

        function getData() {
            // Set the data
            $data = [
                'shortActiva' => '',
                'midAcitva' => '',
                'longActiva' => '',
                'shortPassiva' => '',
                'midPassiva' => '',
                'longPassiva' => '',
                'sumActiva' => '',
                'sumPassiva' => '',
                'equity' => '', 
                'title_err' => '',
                'value_err' => ''
            ];
            // Get Activa
            $data['shortActiva'] = $this->balanceModel->getShortActiva();
            $data['midActiva'] = $this->balanceModel->getMidActiva();
            $data['longActiva'] = $this->balanceModel->getLongActiva();
            // Get Passiva
            $data['shortPassiva'] = $this->balanceModel->getShortPassiva();
            $data['midPassiva'] = $this->balanceModel->getMidPassiva();
            $data['longPassiva'] = $this->balanceModel->getLongPassiva();
            // Get Sums
            $data['sumActiva'] = $this->balanceModel->getSumActiva();
            $data['sumPassiva'] = $this->balanceModel->getSumPassiva();
            // Calculate equity
            $data['equity'] = $data['sumActiva']->value - $data['sumPassiva']->value;

            return $data;
        }
    }

?>