<?php

/*
|------------------------------------------------------------------
| Global helper functions
|------------------------------------------------------------------
|
| Here we have a set of global functions that
| acts like a facades.
|
 */
if (!function_exists('view')) {
    /**
     * Shows the view
     *
     * @param  string $view
     * @param  array  $data
     * @return object
     */
    function view($view, $data = [])
    {
        return Container::view()->data($data)->show($view);
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirects to provided url
     *
     * @param  string $to [description]
     */
    function redirect($to = '')
    {
        if ($to === '/' || $to == '') {
            $to = BASE_URL;
        }

        header("Location: " . $to);
        die;
    }
}

if (!function_exists('flash')) {
    /**
     * Sets the flash messages and outputs them {!! flash() !!}
     * @return object [instance of FlashMessages]
     */
    function flash()
    {
        return new FlashMessages;
    }
}

if (!function_exists('paginate')) {
    /**
     * Constructs Paginator object
     *
     * @param  int    $perPage
     * @param  object $collection
     * @return object
     */
    function paginate($perPage = null, $collection = null)
    {
        return new Paginator($perPage, $collection);
    }
}
