<?php
namespace FMUP\Import\Iterator;

/**
 * Remplie les valeurs d'une Config à partir d'une ligne du fichier
 *
 * @author csanz
 *
 */
class LineToConfigIterator extends \IteratorIterator
{
    private $config;

    public function __construct(\Iterator $fIterator, \FMUP\Import\Config $config)
    {
        parent::__construct($fIterator);
        $this->config = $config;
    }

    /**
     * @return \FMUP\Import\Config
     */
    public function current()
    {
        foreach (explode(';', (string)$this->getInnerIterator()->current()) as $key => $field) {
            $this->getConfig()->getField($key)->setValue($field);
        }
        return $this->getConfig();
    }

    /**
     * @return \FMUP\Import\Config
     */
    public function getConfig()
    {
        return $this->config;
    }
}
