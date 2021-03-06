<?php
/**
 * Plugin.php
 * @author: jmoulin@castelis.com
 */

namespace FMUPTests\Dispatcher;

class PluginMockPlugin extends \FMUP\Dispatcher\Plugin
{
    protected $name = 'TestUnit';

    public function handle()
    {
        // TODO: Implement handle() method.
    }
}

class PluginTest extends \PHPUnit_Framework_TestCase
{
    public function testSetGetRequest()
    {
        $request = $this->getMockBuilder(\FMUP\Request\Cli::class)->getMock();
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        /** @var \FMUP\Request $request */
        $this->assertSame($plugin, $plugin->setRequest($request));
        $this->assertSame($request, $plugin->getRequest());
    }

    public function testSetGetResponse()
    {
        $response = $this->getMockBuilder(\FMUP\Response::class)->getMock();
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        /** @var \FMUP\Response $response */
        $this->assertSame($plugin, $plugin->setResponse($response));
        $this->assertSame($response, $plugin->getResponse());
    }

    public function testGetResponseWhenNotSet()
    {
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        $this->expectException(\FMUP\Exception::class);
        $this->expectExceptionMessage('Response not set');
        $plugin->getResponse();
    }

    public function testGetRequestWhenNotSet()
    {
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        $this->expectException(\FMUP\Exception::class);
        $this->expectExceptionMessage('Request not set');
        $plugin->getRequest();
    }

    public function testCanHandle()
    {
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        $this->assertTrue($plugin->canHandle());
    }

    public function testGetName()
    {
        $plugin = $this->getMockBuilder(\FMUP\Dispatcher\Plugin::class)->setMethods(array('handle'))->getMock();
        /** @var \FMUP\Dispatcher\Plugin $plugin */
        $this->assertNull($plugin->getName());
        $plugin = new PluginMockPlugin();
        $this->assertSame('TestUnit', $plugin->getName());
    }
}
