<?php
/**
 * HtmlCompress.php
 * @author: jmoulin@castelis.com
 */

namespace FMUP\Dispatcher\Plugin;

/**
 * Class HtmlCompress
 * This is a POST processor.
 * This plugin will reduce html page size to one line by deleting useless indentations improving its download
 * @package FMUP\Dispatcher\Plugin
 */
class HtmlCompress extends \FMUP\Dispatcher\Plugin
{
    protected $name = 'HtmlCompress';

    public function handle()
    {
        $this->getResponse()->setBody(preg_replace('~>[^<]+<~', '><', $this->getResponse()->getBody()));
    }
}
