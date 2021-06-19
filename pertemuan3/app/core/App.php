<?php 

class App {
    public function __construct()
    {
        // Langkah 1.2: Kita panggil
        $url = $this->parseURL();
        var_dump($url);
    }

    // Langkah 1.1: Proses passing dari url
    public function parseURL()
    {
        if( isset($_GET['url']) ) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        };
    }
}