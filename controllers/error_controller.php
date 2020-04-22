<?php
class ErrorController extends Controller {
    function __construct($page) {
        try {
            parent::__construct();
            $this->view->msg = "the page [$page] does not exist.";
        } catch (Exception $e) {
            
            $this->view->msg = $e->getMessage();
        }
        
        header("Content-Type: text/html; charset=utf-8");
        $this->view->render('error/index');
    }
}