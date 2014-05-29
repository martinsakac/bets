<?php

abstract class Controller {

    protected $data = array();

    protected $view = "";

	protected $pageHeader = array('pageTitle' => '', 'keyWords' => '', 'description' => '');

    public function vypisview() {
        if ($this->view) {
            extract($this->data);
            require("views/" . $this->view . ".phtml");
        }
    }
	
	// Přesměruje na dané URL
	public function redirectTo($url) {
		header("Location: /$url");
		header("Connection: close");
        exit;
	}

	// Hlavní metoda controlleru
    abstract function process($parametry);

}