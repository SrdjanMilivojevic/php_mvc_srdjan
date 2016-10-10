<?php

abstract class CoreController
{
    /**
     * For accessing class as property: $this->class;
     *
     * @param  string $class  [class name]
     * @return redirect to Container::load()
     */
    final public function __get($class)
    {
        return Container::load($class);
    }

    /**
     * Loads and constructs the View class.
     *
     * @param  string $view
     * @param  array $data
     * @return View::show()
     */
    final protected function view($view, $data = [])
    {
        return $this->view->data($data)->show($view);
    }

    /**
     * Redirects to provided url.
     *
     * @param  string $to
     */
    final protected function redirect($to = '')
    {
        if ($to === '/' || $to == '') {
            $to = BASE_URL;
        }

        header("Location: " . $to);
        die;
    }
}
