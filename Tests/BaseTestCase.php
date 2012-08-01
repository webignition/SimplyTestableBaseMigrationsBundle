<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase {    
    
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
        
        $this->runConsole("doctrine:database:drop", array("--force" => true));
        $this->runConsole("doctrine:database:create");
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
}
