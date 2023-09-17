<?php

namespace Rtcoder\CliTypo;

use Exception;

class CliFormat
{

    /**
     * Get bordered text
     *
     * @param string $text text to show
     * @param string $border character used to border text
     * @param string|null $sideBorder character used to border text on left and right sides
     * @return string bordered text
     */
    public function bordered(string $text, string $border = "*", string $sideBorder = null): string
    {
        if (is_null($sideBorder)) {
            $sideBorder = $border;
        }
        $countOfChars = strlen($text);

        $emptyText = str_repeat(" ", ceil((strlen($text) - 2) / 2));

        $string = str_repeat($border, $countOfChars * 2);

        if ($countOfChars % 2 != 0) {
            $string .= $border;
        }

        $string .= "\n";
        $string .= $sideBorder . $emptyText . $text . $emptyText . $sideBorder . "\n";

        $string .= str_repeat($border, $countOfChars * 2);

        if ($countOfChars % 2 != 0) {
            $string .= $border;
        }

        $string .= "\n";

        return $string;
    }

    /**
     * Get text with time
     *
     * @param string $text text to show
     * @param string $time_format format of time ex. H:i:s
     * @return string formatted text with time
     */
    public function with_time(string $text, string $time_format = "H:i:s"): string
    {
        return "[" . date($time_format, time()) . "] " . $text;
    }

    /**
     * Get text with date
     *
     * @param string $text text to show
     * @param string $date_format format of date ex. d.m.Y
     * @return string formatted text with date
     */
    public function with_date(string $text, string $date_format = "d.m.Y"): string
    {
        return "[" . date($date_format, time()) . "] " . $text;
    }

    /**
     * Get text with date and time
     *
     * @param string $text text to show
     * @param string $date_format format of datetime ex. d.m.Y H:i:s
     * @return string formatted text with datetime
     */
    public function with_datetime(string $text, string $date_format = "d.m.Y H:i:s"): string
    {
        return "[" . date($date_format, time()) . "] " . $text;
    }

    /**
     * Get formatted progress bar
     *
     * @param int $percentage percents of progress
     * @return string formatted progress bar
     */
    public function percentage(int $percentage): string
    {
        if ($percentage > 100) {
            $percentage = 100;
        }
        if ($percentage < 0) {
            $percentage = 0;
        }

        $empty = "░";
        $filled = "▓";

        $progressBar = str_repeat($filled, $percentage);

        $progressBar .= str_repeat($empty, 100 - $percentage);

        return $progressBar . " " . $percentage . "%";
    }

    /**
     * Get indicator text (index / sum)
     *
     * @param int $index current index
     * @param int $sum max sum
     * @return string formatted indicator text
     */
    public function indicator(int $index, int $sum): string
    {
        return "(" . $index . " / " . $sum . ")";
    }


    /**
     * Show line with padding (name and value)
     *
     * @param string $name name of element in line
     * @param string $value value of element in line
     * @param int $padding count of padding before value, after name
     * @param string $limiter character of padding
     * @return string formatted line
     */
    public function list_item(string $name, string $value, int $padding = 10, string $limiter = "."): string
    {
        $countOfLetters = strlen($name);
        $output = $name . " ";

        $output .= str_repeat($limiter, ($padding - $countOfLetters));

        $output .= " " . $value;

        return $output;
    }

    /**
     * Get color of text
     *
     * @param string $text text to colorize
     * @param string $foreground color of foreground
     * @param string|null $background color of background
     * @return string colorized text
     * @throws Exception
     */
    public function colorize(string $text, string $foreground, string $background = null): string
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            return $text;
        }

        if (!array_key_exists($foreground, CliText::$foreground_colors)) {
            throw new Exception('Invalid CLI foreground color: ' . $foreground);
        }

        if ($background !== null and !array_key_exists($background, CliText::$background_colors)) {
            throw new Exception('Invalid CLI background color: ' . $background);
        }

        $string = "\033[" . CliText::$foreground_colors[$foreground] . "m";

        if ($background !== null) {
            $string .= "\033[" . CliText::$background_colors[$background] . "m";
        }

        $string .= $text . "\033[0m";

        return $string;
    }

    /**
     * Dumps information about a variable
     *
     * @param mixed $data variable to dump
     * @return void
     */
    public function dump(mixed $data): void
    {
        var_dump($data);
    }

    /**
     * Get formatted json string
     *
     * @param string $json json string to print
     * @return string formatted json
     */
    public function json(string $json): string
    {
        $tabCount = 0;
        $result = '';
        $inQuote = false;
        $ignoreNext = false;

        $tab = "    ";
        $newline = "\n";

        for ($i = 0; $i < strlen($json); $i++) {
            $char = $json[$i];
            if ($ignoreNext) {
                $result .= $char;
                $ignoreNext = false;
            } else {
                switch ($char) {
                    case '{':
                        $tabCount++;
                        $result .= $char . $newline . str_repeat($tab, $tabCount);
                        break;
                    case '}':
                        $tabCount--;
                        $result = trim($result) . $newline . str_repeat($tab, $tabCount) . $char;
                        break;
                    case ',':
                        $result .= $char . $newline . str_repeat($tab, $tabCount);
                        break;
                    case '"':
                        $inQuote = !$inQuote;
                        $result .= $char;
                        break;
                    case '\\':
                        if ($inQuote) {
                            $ignoreNext = true;
                        }
                        $result .= $char;
                        break;
                    default:
                        $result .= $char;
                }
            }
        }
        return $result;
    }

    /**
     * Get text with attention
     *
     * @param string $text text to flank
     * @param string $limiter character of flank
     * @param int $count count of characters in flank
     * @return string
     */
    public function flank(string $text, string $limiter = "!", int $count = 1): string
    {

        $output = str_repeat($limiter, $count);

        $output .= " " . $text . " ";

        $output .= str_repeat($limiter, $count);

        return $output;
    }
}
