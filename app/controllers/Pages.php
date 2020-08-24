<?php
    class Pages extends Controller {
        public function __construct() {

        }

        public function index() {            
            // Set the data
            $data = [
                'title' => 'SharePosts',
                'description' => 'Simple social network built on the PHP-MVC framework'
            ];
            // Set the view
            $view = strtolower(__CLASS__) . '/index';
            // Load View
            $this->view($view, $data);    
        }

        public function about() {    
            // Set the data
            $data = [
                'title' => 'About',
                'description' => 'App to share posts with other users'
            ];
            // Set the view
            $view = strtolower(__CLASS__) . '/about';
            // Load View
            $this->view($view, $data);
        }
    }