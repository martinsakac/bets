<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 8.7.2014
 * Time: 21:03
 */

class IntroController extends Controller{

    function process($params) {
        $this->pageHeader = array(
            'pageTitle' => 'Intro',
            'keyWords' => 'bets',
            'description' => 'Introduction to Bets!'
        );

        $this->view = 'intro';
    }

} 