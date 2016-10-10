<?php

final class FlashMessages
{
    /**
     * Construct session.
     */
    public function __construct()
    {
        session_start();

        // Create the session array if it doesn't already exist
        if (!isset($_SESSION['flash_message'])) {
            $_SESSION['flash_message'] = [
                'type' => null,
                'message' => null,
            ];
        }
    }

    /**
     * Enables printing object as a string
     *
     * @return string
     */
    public function __toString()
    {
        $result = $this->show();
        return $result ? $result : '';
    }

    /**
     * Enables calling flash msessage types as functions.
     *
     * @param  string $name
     * @param  array $param
     * @return redirect
     */
    public function __call($name, $param)
    {
        return $this->add($param[0], $name);
    }

    /**
     * Save flash message to session.
     *
     * @param $type
     * @param $message
     */
    public function add($message, $type)
    {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    /**
     * Recall flash message from session and display.
     *
     * @return string|boolean
     */
    public function show()
    {
        if (!is_null($_SESSION['flash_message']['type'])) {

            $type = $_SESSION['flash_message']['type'];

            $message = $_SESSION['flash_message']['message'];

            unset($_SESSION['flash_message']); // unset flash_message key

            return '<div id="flash" class="alert alert-' . $type . '" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>' . $message . '</div>';
        }
    }
}
