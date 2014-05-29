<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 29.5.2014
 * Time: 22:32
 */

class ErrorController extends Controller{

    function process($params) {
        header("HTTP/1.0 404 Not Found");
        $this->pageHeader['pageTitle'] = 'Error 404';
        $this->view = 'error';
    }
}