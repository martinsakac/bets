<?php

class RouterController extends Controller {
	
    protected $controller;
	
	// Metoda převede pomlčkovou variantu controlleru na název třídy
	private function dashesToCamelCase($text) {
		$sentence = str_replace('-', ' ', $text);
		$sentence = ucwords($sentence);
		$sentence = str_replace(' ', '', $sentence);
		return $sentence;
	}
	
	// Naparsuje URL adresu podle lomítek a vrátí pole parametrů
	private function parseURL($url) {
		// Naparsuje jednotlivé části URL adresy do asociativního pole
        $parsedURL = parse_url($url);
		// Odstranenie pociatocneho lomitka
		$parsedURL["path"] = ltrim($parsedURL["path"], "/");
		// Odstranění bílých znaků kolem adresy
		$parsedURL["path"] = trim($parsedURL["path"]);
		// Rozbití řetězce podle lomítek
		$rozdelenaCesta = explode("/", $parsedURL["path"]);
        return $rozdelenaCesta;
	}

    // Naparsování URL adresy a vytvoření příslušného controlleru
    public function process($params) {
		$parsedURL = $this->parseURL($params[0]);

        // len na LOCALHOSTE --> odstranujeme meno projektu !!!!!!!!
        array_shift($parsedURL);
        
		// kontroler je 1. parametr URL
		$controllerClass = $this->dashesToCamelCase(array_shift($parsedURL)) . 'Controller';
		
		echo($controllerClass);
		echo('<br />');
		print_r($parsedURL);
    }

}