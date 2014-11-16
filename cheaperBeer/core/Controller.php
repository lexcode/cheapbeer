<?php

/**
 * Controller
 * */
class Controller {

    public $request;      // Objet Request 
    private $vars = array(); // Variables à passer à la vue
    public $layout = 'default';  // Layout à utiliser pour rendre la vue
    private $rendered = false;  // Si le rendu a été fait ou pas ?
    public $device = 'computer';
    public $lang = 'en';
    public $access = array();
    public $s = array();

    /**
     * Constructeur
     * @param $request Objet request de notre application
     * */
    function __construct($request = null) {

        $this->Session = new Session();


        $this->Form = new Form($request);
        // $this->Form = new Form($this);



        $obj = new stdClass();
        $obj->access = $this->access;
        $obj->lang = $this->lang;
        $obj->Session = $this->Session;
        $this->Auth = new Auth($obj, $request);
        $this->sh_cache = new Cache(CACHE, 5);
        $this->hr_cache = new Cache(CACHE, 60);
        //  $upload_handler = new UploadHandler();
        // debug(Router::$routes);
        // debug($this);
        require_once LIB . DS . 'Mobile_Detect.php';
        $detect = new Mobile_Detect;
        $this->device = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

        if ($request) {
            $this->request = $request;  // On stock la request dans l'instance	
           require ROOT.DS.'config'.DS.'hook.php'; 	
           
            $this->lang = trim(loadLang());
            $s = array();
            require LANG . DS . $this->lang . DS . 'default_layout.php';
            $this->s = $s;
        }

       
    }


       /**
     * Permet de rendre une vue
     * @param $view Fichier à rendre (chemin depuis view ou nom de la vue) 
     * */
    public function render($view) {
        //  debug($_SESSION['User']);
        //echo 'amen';
        if ($this->rendered) {
            return false;
        }

        extract($this->vars);
        //$this->is_connected();
        
        $cont = $this->request->controller;

        $file = LANG . $this->lang . DS . 'view_' . $cont . '.php';
        if (file_exists($file)) {
            require_once $file;
        }

        if (strpos($view, '/') === 0) {
            $view = ROOT . DS . 'view' . $view . '.php';
        } else {
            $view = ROOT . DS . 'view' . DS . $this->request->controller . DS . $view . '.php';
        }
        ob_start();
        require_once($view);
        $content_for_layout = ob_get_clean();
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            require ROOT . DS . 'view' . DS . 'layout' . DS . $this->layout . '.php';
        }
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') && isset($_POST['ajx']) &&($_POST['ajx'] == 'ajaxy')) {
            $a['success'] = $content_for_layout;
            echo $a['success'];
        }


        $this->rendered = true;
    }

    /**
     * Permet de passer une ou plusieurs variable à la vue
     * @param $key nom de la variable OU tableau de variables
     * @param $value Valeur de la variable
     * */
    public function set($key, $value = null) {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }

    /**
     * Permet de charger un model
     * */
    function loadModel($name) {
        if (!isset($this->$name)) {
            $file = ROOT . DS . 'model' . DS . $name . '.php';
            require_once($file);
            $this->$name = new $name();
            if (isset($this->Form)) {
                $this->$name->Form = $this->Form;
            }
        }
    }

    /**
     * Permet de gérer les erreurs 404
     * */
    function e404($message) {
        //  debug($this->request->params) ;
        header("HTTP/1.0 404 Not Found");

        $this->set('message', $message);
        $this->render('/errors/404');
        die();
    }

    /**
     * Permet d'appeller un controller depuis une vue
     * 
***/
function get_user_pseudo($id){
    $this->LoadModel('Client');
   return $this->Client->findFirst(array('conditions'=>array('id'=>$id),'fields'=>'pseudo'));
   
}
    /**
     * Redirect
     * */
    function redirect($url = null) {
        // $out1 = ob_get_contents();
//$this->rendered=true;
        //   var_dump($out1);
        if (!isset($url)) {
            header('Location : '. Router::url($url), TRUE, 301);
            exit;
        } else {
            //  debug($url) ; die() ;
            // http_redirect('http://localhost/cheaperBeer');
            header("Location :". Router::url($url) , TRUE, 301);
            // die();  
            //exit;
        }
    }

   
    public function notificate($type, $email, $data = array()) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email == false) {
            return false;
        }

        $subject = $this->s['n-' . $type];
        $mail = '';
        $mail = ROOT . DS . 'note' . DS . 'noti_' . $type . '.php';

        ob_start();
        require($mail);
        $body = ob_get_clean();

        ob_end_clean();

        // $this->set($d) ;
        //HEADER 
        $header = "MIME-Version: 1.0\r\n";
        $header.="Content-type: text/html; charset: UTF-8\r\n";
        $header.='From: Atttune <no-reply@simplewebagency.com> ' . "\r\n" .
                'Reply-To: Atttune <contact@simplewebagency.com> ' . "\r\n" .
                'X-Mailer: PHP ' . phpversion();

        $mailok = mail($email, $subject, $body, $header);
        if ($mailok) {
            $this->Session->setFlash($this->s['email_ok']);
            return true;
        } else {
            $this->Session->setFlash($this->s['email_fail']);
            return false;
        }
    }



    function t($term, $ll = null, $a = null, $b = null, $c = null, $d = null) {

        $file = '';

        $cont = $this->request->controller;

        $h = array();

        if (isset($ll)) {
            $file = LANG . $ll . DS . 'translate_' . $cont . '.php';
        } else {
            $file = LANG . $this->lang . DS . 'translate_' . $cont . '.php';
        }

        if (isset($a)) {
            $a = $a;
        }
        if (isset($b)) {
            $b = $b;
        }
        if (isset($c)) {
            $c = $c;
        }
        if (isset($d)) {
            $d = $d;
        }

        if (file_exists($file)) {
            require $file;
        } else {
            require LANG . 'en' . DS . 'translate_' . $cont . '.php';
        }

        return $h[$term];
    }

    
    public function pending_messages() {
        $a = $this->Session->user('id');

        if (empty($a)) {
            return false;
        } else {

            $this->loadModel('Message');

            $e = $this->Message->find(array('conditions' => array('id_other' => $a, 'view' => 0)));

            $n = count($e);
            return $n;
        }
    }

    
   
}

?>