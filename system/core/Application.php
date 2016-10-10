<?php

final class Application extends Container
{
    use ParseUrl;

    /**
     * Controller
     *
     * @var string|object
     */
    private $controller;

    /**
     * Action
     *
     * @var string
     */
    private $action;

    /**
     * Parameters
     *
     * @var array
     */
    private $params = [];

    /**
     * Construct the application
     */
    public function __construct()
    {
        // Configure
        $this->config = $GLOBALS['config'];

        if (!is_string($this->config['urlPrefix'])) {
            throw new \Exception('Prefix must be a string!');
        }
        $this->pagingPrefix = trim($this->config['urlPrefix']);

        $defaultRouting = $this->config['routes'];
        // Get the default controller and action
        foreach ($defaultRouting as $controller => $action) {
            $this->controller = $controller;
            $this->action = $action;
        }

        // Here we will register controllers
        $this->register();

        // Manual bindings to the container
        require BASE_PATH . 'config/di.php';

        // Start the application !
        $this->run();
    }

    /**
     * Run the application
     *
     * @return return value of the action
     */
    private function run()
    {
        $url = $this->urlParseArray();

        // First check if any uri segment is set
        if (isset($url[0])) {
            $ifController = ucfirst($url[0]) . 'Controller';
            // Is uri segment 1 controller ?
            if ($this->isController($ifController)) {
                $this->controller = $ifController;
                unset($url[0]);
                // If it is: Check if uri segment 2 is set. Is it an action ?
                if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                    $this->action = $url[1];
                    unset($url[1]);
                }
                // If not: Is uri segment 1 an action ?
            } elseif (!$this->isController($ifController) && method_exists($this->controller, $url[0])) {
                $this->action = $url[0];
                unset($url[0]);
            }

            // If non of these: parameters are in array
            $this->params = $url ? array_values($url) : [];
        }

        // Instantiate the controller
        $this->controller = new $this->controller;

        // Call the action of the provided controller and forward the parameters
        return call_user_func_array([$this->controller, $this->action], $this->params);
    }
}
