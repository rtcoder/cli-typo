<?php

namespace Rtcoder\CliTypo;

use Exception;

class CliText
{

    public static array $foreground_colors = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37',
    ];
    public static array $background_colors = [
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_gray' => '47',
    ];

    /**
     * Show empty line
     * @return void
     */
    public function empty_line(): void
    {
        $text = "\n";
        fwrite(STDOUT, $text . PHP_EOL);
    }

    /**
     * Show text end move caret to begin
     *
     * @param string $text
     * @param bool $end_line
     * @return void
     */
    public function write_back_caret(string $text = '', bool $end_line = FALSE): void
    {
        // Append a newline if $end_line is TRUE
        $text = $end_line ? $text . PHP_EOL : $text;
        fwrite(STDOUT, "\r\033[K" . $text);
    }

    /**
     * Show colorized text
     *
     * @param string $text text to colorize
     * @param string $foreground color of foreground
     * @param string|null $background color of background
     * @throws Exception
     * @return void
     */
    public function color(string $text, string $foreground, string $background = null): void
    {
        $this->write(CliTypo::format()->colorize($text, $foreground, $background));
    }

    /**
     * Show text
     *
     * @param string $text text to show
     * @return void
     */
    public function write(string $text = ""): void
    {
        if (is_array($text)) {
            foreach ($text as $line) {
                $this->write($line);
            }
        } else {
            fwrite(STDOUT, $text . PHP_EOL);
        }
    }
}
