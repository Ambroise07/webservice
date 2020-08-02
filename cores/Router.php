<?php

namespace App;

use AltoRouter;
use App\Helpers\Json;
use Exception;

class Router
{
    /**
     * router.
     *
     * @var AltoRouter
     */
    private $router;
    /**
     * viewPath.
     *
     * @var string
     */
    private $viewPath;

    private $layoutsPath = 'public_html/layouts/index.php';
    private $adminLayoutsPath = 'public_html/adminlayouts/index.php';

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    /**
     * url.
     *
     * @param string $name
     * @param array  $param
     *
     * @return string
     */
    public function url(string $name, array $param = []): string
    {
        return $this->router->generate($name, $param);
    }

    /**
     * get method for router.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    /**
     * post routing.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }
public function getpost(string $url, string $view, ?string $name = null): self{
    $this->router->map('GET|POST', $url, $view, $name);

    return $this;
}
    public function run(): self
    {
        $match = $this->router->match();
        try{
            $view = $match['target'];
            $params = $match['params'];
        }catch(Exception $e){
            echo Json::message(true,'Vous avez une erreur dans votre url');
            exit;
        }
        
        $fileview = $this->viewPath.DIRECTORY_SEPARATOR.$view.'.php';
        if (in_array('admins', explode('/', $view))) {
            /** @var Router */
            //dd(in_array('admins',explode('/',$view)));
            $router = $this;
            if(!file_exists($fileview)){
                echo Json::message(true,'La page que vous demandé n\'existe pas');
                exit;
            }
            ob_start();
            require_once $fileview;
            $contentsadmin = ob_get_clean();
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR.$this->adminLayoutsPath;

            return $this;
            exit;
        }
        if (!in_array('ajaxs', explode('/', $view))) {
            /** @var Router */
            $router = $this;
            ob_start();
            require_once $fileview;
            $contents = ob_get_clean();
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR.$this->layoutsPath;
        } else {
            require_once $this->$fileview;
        }

        return $this;
    }
}
