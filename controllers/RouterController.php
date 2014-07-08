<?php

class RouterController extends Controller {
	
    protected $controller;
	
	private function dashesToCamelCase($text) {
		$sentence = str_replace('-', ' ', $text);
		$sentence = ucwords($sentence);
		$sentence = str_replace(' ', '', $sentence);
		return $sentence;
	}
	
	private function parseURL($url) {
        $parsedURL = parse_url($url);
		$parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = rtrim($parsedURL["path"], "/");
		$parsedURL["path"] = trim($parsedURL["path"]);
		$splitPath = explode("/", $parsedURL["path"]);
        return $splitPath;
	}

    public function process($params) {

		$parsedURL = $this->parseURL($params[0]);

        // len na LOCALHOSTE --> odstranujeme meno projektu !!!!!!!!
        array_shift($parsedURL);

        // kontroler je 1. parametr URL
        // TODO - na produkcii odstranit bets/
		if (empty($parsedURL)) {
//            $this->redirectTo('bets/intro');
            $controllerClass = 'IntroController';
        }
        else {
            $controllerClass = $this->dashesToCamelCase(array_shift($parsedURL)) . 'Controller';
        }

        // TODO - na produkcii odstranit bets/
        if (file_exists("controllers/" . $controllerClass . ".php")) {
            $this->controller = new $controllerClass;
        }
        else {
            $this->redirectTo('bets/error');
        }

        $this->controller->process($parsedURL);

        $this->data['pageTitle'] = $this->controller->pageHeader['pageTitle'];
        $this->data['keyWords'] = $this->controller->pageHeader['keyWords'];
        $this->data['description'] = $this->controller->pageHeader['description'];

        $this->view = 'layout'; //test koment
    }

}