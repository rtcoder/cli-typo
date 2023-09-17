<?php

namespace Rtcoder\CliTypo;

class CliTypo
{

    /**
     * Get alert functions
     * @return CliAlert
     */
    public static function alert(): CliAlert
    {
        return new CliAlert();
    }

    /**
     * Get text functions
     * @return CliText
     */
    public static function text(): CliText
    {
        return new CliText();
    }

    /**
     * Get component functions
     * @return CliComponent
     */
    public static function component(): CliComponent
    {
        return new CliComponent();
    }

    /**
     * Get format functions
     * @return CliFormat
     */
    public static function format(): CliFormat
    {
        return new CliFormat();
    }

}
