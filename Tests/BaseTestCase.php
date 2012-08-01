<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase {
    
//    const FIXTURES_DATA_RELATIVE_PATH = '/Fixtures/Data';

//    /**
//     *
//     * @var Symfony\Bundle\FrameworkBundle\Client
//     */
//    protected $client;
//
//    /**
//     *
//     * @var appTestDebugProjectContainer
//     */
//    protected $container;
    
    
    /**
     *
     * @var Symfony\Bundle\FrameworkBundle\Console\Application
     */
    private $application;
    

    public function setUp() {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $this->application = new Application($kernel);
        $this->application->setAutoExit(false);
        $this->setupDatabase();
    }
    

    protected function runConsole($command, Array $options = array()) {
        $args = array(
            'app/console',
            $command,
            '-e',
            'test',
            '-q',
            '-n'
        );        
        
        foreach ($options as $key => $value) {
            $args[] = $key;
            
            if (!is_null($value) && !is_bool($value)) {
                $args[] = $value;
            }
        }


        $input = new ArgvInput($args);                 
        return $this->application->run($input);
    }
    
    protected function setupDatabase() {
        $this->runConsole("doctrine:database:drop", array("--force" => true));
        $this->runConsole("doctrine:database:create");
    }    

//    /**
//     * Builds a Controller object and the request to satisfy it. Attaches the request
//     * to the object and to the container.
//     *
//     * @param string The full path to the Controller class.
//     * @param array An array of parameters to pass into the request.
//     * @return \Symfony\Bundle\FrameworkBundle\Controller\Controller The built Controller object.
//     */
//    protected function createController($controllerClass, array $parameters = array(), array $query = array()) {
//        $request = $this->createWebRequest();
//        $request->request->add($parameters);
//        $request->query->add($query);
//
//        $this->container->set('request', $request);
//
//        $controller = new $controllerClass;
//        $controller->setContainer($this->container);
//
//        return($controller);
//    }
//
//    /**
//     * Creates a new Request object and hydrates it with the proper values to make
//     * a valid web request.
//     *
//     * @return \Symfony\Component\HttpFoundation\Request The hydrated Request object.
//     */
//    protected function createWebRequest() {
//        $request = new \Symfony\Component\HttpFoundation\Request;
//        $request->server->set('REMOTE_ADDR', '127.0.0.1');
//
//        return $request;
//    }
//    
//    
//    /**
//     *
//     * @param string $testName
//     * @return string
//     */
//    protected function getFixturesDataPath($testName) {
//        return __DIR__ . self::FIXTURES_DATA_RELATIVE_PATH . '/' . str_replace('\\', DIRECTORY_SEPARATOR, get_class($this)) . '/' . $testName;
//    }    

}