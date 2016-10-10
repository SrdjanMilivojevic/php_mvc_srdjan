<?php

final class View
{
    /**
     *  Path to cached view files
     */
    const CACHE_PATH = BASE_PATH . 'app/views/cache/';

    /**
     *  Path to blade view files
     */
    const VIEW_PATH = BASE_PATH . 'app/views/';

    /**
     * Variables for the view.
     * @var array
     */
    protected $data;

    /**
     * Compile Blade.
     *
     * @param  string $view
     */
    public function show($view)
    {
        $this->data(['title' => ucfirst($view)]);

        echo Container::blade(self::CACHE_PATH, self::VIEW_PATH)
            ->make($view, $this->data)
            ->render();
    }

    /**
     * Add the data to the data array property.
     *
     * @param array $data [add future variables for the view]
     * @return static
     */
    public function data(array $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        return $this;
    }
}
