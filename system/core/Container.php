<?php

abstract class Container
{
    /**
     * Registered classes
     *
     * @var array
     */
    protected static $registry = [];

    /**
     * Registered controllers
     *
     * @var array
     */
    private static $controllers = [];

    /**
     * Configuration settings
     *
     * @var array
     */
    private static $config;

    /**
     * Folders for registry
     *
     * @var [type]
     */
    const CONTROLLERS = BASE_PATH . 'app/controllers/';

    /**
     * Enabled calling providers as a function
     *
     * @param  string $name
     * @param  array  $params
     * @return static
     */
    public static function __callStatic($name, $params = [])
    {
        return self::load($name, $params);
    }

    /**
     * Loads the class from registry or instantiates it
     *
     * @param  string $class
     * @param  array  $params
     * @return return value of the callback|bool|exeption obect
     */
    final public static function load($class, $params = [])
    {
        $class = ucfirst($class);

        if (strpos($class, 'Controller') || $class === 'Controller') {
            throw new \InvalidArgumentException('You can not load a controller into the controller!');
        }

        if (self::isInRegistry($class)) {
            return call_user_func_array(self::$registry[$class], $params);
        }

        return new $class;
    }

    /**
     * Bind dependencies manualy to the container
     *
     * @param  string  $name
     * @param  Closure $value
     */
    final protected static function bind($name, Closure $value)
    {
        $name = ucfirst($name);

        if (!self::isInRegistry($name)) {
            self::$registry[$name] = $value;
        }
    }

    /**
     * This will register controllers
     *
     * @param  array  $folders
     */
    final protected static function register()
    {
        $fileIterator = self::fileIterator(self::CONTROLLERS);

        // Loop trough each file
        foreach ($fileIterator as $file) {

            if (self::isClass($file->getFilename()) && $file->isReadable()) {

                $name = rtrim(rtrim($file->getFilename(), 'php'), '.');

                // Separate the controllers
                if (strpos($name, 'Controller') || $name === 'Controller') {

                    self::$controllers[] = $name;
                    continue;
                };
            }
        }
    }

    /**
     * Checks if key is a registered class
     *
     * @param  string
     * @return boolean
     */
    private static function isInRegistry($key)
    {
        return isset(self::$registry[$key]);
    }

    /**
     * Is string a controller name?
     *
     * @param  string
     * @return boolean
     */
    final protected function isController($name)
    {
        return in_array($name, self::$controllers);
    }

    /**
     * Gets the file iterator instance.
     *
     * @param  string $folder [path to foldr]
     * @return object         [instanceof RecursiveIteratorIterator]
     */
    private static function fileIterator($folder)
    {
        $directory = new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS);
        return new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
    }

    /**
     * Is string a class name?
     *
     * @param  string  $str
     * @return boolean
     */
    private static function isClass($str)
    {
        return ctype_upper($str[0]);
    }
}
