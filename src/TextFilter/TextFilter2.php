<?php

namespace chvi17\TextFilter;

/**
 * Filter and format text content.
 */
class TextFilter2
{
    // currently not used, maybe at a later stage
    // private $filters = [
    //     "bbcode"    => "bbcode2html",
    //     "link"      => "makeClickable",
    //     "markdown"  => "markdown",
    //     "nl2br"     => "nl2br",
    // ];

    /**
     * Call each filter on the text and return the processed text.
     *
     * @param string $text   The text to filter.
     * @param array $filter  array with filters to use.
     *
     * @return string with the formatted text.
     */
    public function parse($text, $filter) {
        $formattedText = $text;
        foreach ($filter as $rule) {
            switch ($rule) {
                case "bbcode":
                    $formattedText = $this->bbcode2html($formattedText);
                break;
                case "markdown":
                    $formattedText = $this->markdown($formattedText);
                break;
                case "nl2br":
                    $formattedText = $this->nl2br($formattedText);
                break;
                case "link":
                    $formattedText = $this->makeClickable($formattedText);
                break;
                default:
                    //echo("default, rule:" . $rule . "received");
                break;
            }
        }
        return $formattedText;
    }

    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string text The text to be converted.
     *
     * @returns string the formatted text.
     */
    private function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }

    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text the text that should be formatted.
     *
     * @return string the formatted text.
     */
    private function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href={$matches[0]}>{$matches[0]}</a>";
            },
            $text
        );
    }

    /**
     * Helper, Markdown formatting converting to HTML.
     *
     * @param string text The text to be converted.
     *
     * @return string the formatted text.
     */
    private function markdown($text)
    {
        return \Michelf\Markdown::defaultTransform($text);
    }

    /**
     * For convenience access to nl2br formatting of text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    private function nl2br($text) {
        return nl2br($text);
    }
}
