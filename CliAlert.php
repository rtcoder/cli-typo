<?php

namespace Rtcoder\CliTypo;

use Exception;

class CliAlert
{

    /**
     * Show error message
     *
     * Font color: white
     * Background color: red
     *
     * @param string $text text to show
     * @throws Exception
     * @return void
     */
    public function error(string $text): void
    {
        CliTypo::text()->color($text, "white", "red");
    }

    /**
     * Show warning message
     *
     * Font color: white
     * Background color: orange
     *
     * @param string $text text to show
     * @throws Exception
     * @return void
     */
    public function warning(string $text): void
    {
        CliTypo::text()->color($text, "white", "yellow");
    }

    /**
     * Show success message
     *
     * Font color: white
     * Background color: green
     *
     * @param string $text text to show
     * @throws Exception
     * @return void
     */
    public function success(string $text): void
    {
        CliTypo::text()->color($text, "white", "green");
    }

    /**
     * Show info message
     *
     * Font color: white
     * Background color: blue
     *
     * @param string $text text to show
     * @throws Exception
     * @return void
     */
    public function info(string $text): void
    {
        CliTypo::text()->color($text, "white", "blue");
    }

}
