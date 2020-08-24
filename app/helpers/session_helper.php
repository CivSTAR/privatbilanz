<?php
    session_start();

    // Flash message helper
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        if(!empty($name)) {
            if(!empty($message)) {
                // Unset name and name_class in SESSION
                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                if(!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }
                // Set variables
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif(empty($message) && !empty($_SESSION[$name])) {
                // Create output
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
                // Unset name and name_class in SESSION
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
