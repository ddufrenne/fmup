<?php
namespace FMUP\Environment;

use FMUP\Environment;

trait OptionalTrait
{
    private $environment;

    /**
     * Define environment
     * @param Environment|null $environment
     * @return $this
     */
    public function setEnvironment(Environment $environment = null)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return Environment
     */
    public function getEnvironment()
    {
        if (!$this->environment) {
            $this->environment = Environment::getInstance();
        }
        return $this->environment;
    }

    /**
     * Checks whether environment is defined
     * @return bool
     */
    public function hasEnvironment()
    {
        return (bool)$this->environment;
    }
}
