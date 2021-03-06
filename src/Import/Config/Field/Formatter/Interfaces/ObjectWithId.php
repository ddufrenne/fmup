<?php
namespace FMUP\Import\Config\Field\Formatter\Interfaces;

/**
 * Object with id
 * Interface ObjectWithId
 * @package FMUP\Import\Config\Field\Formatter\Interfaces
 */
interface ObjectWithId
{
    /**
     * return id from object
     * @return int
     */
    public function getId();
}
