<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase {    
    
    const MIGRATION_NORMAL_FAILED_RESPONSE = 1;
    const MIGRATION_SUCCESSFUL_RESPONSE = 0;
    
    const VERBOSE_ENVIRONMENT_VARIABLE_NAME = 'ST_BASE_MIGRATIONS_VERBOSE';
    
    /**
     *
     * @var Symfony\Bundle\FrameworkBundle\Console\Application
     */
    private $application;
    

    public function setUp() {        
        $this->runConsole("doctrine:database:drop", array("--force" => true));
        $this->runConsole("doctrine:database:create");
    }
    
    
    private function boot() {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $this->application = new Application($kernel);
        $this->application->setAutoExit(false);        
    }
    
    
    /**
     *
     * @return boolean
     */
    private function isVerboseEnvironmentVariableSet() {
        return getenv(self::VERBOSE_ENVIRONMENT_VARIABLE_NAME) === 'true';
    }
    

    /**
     *
     * @param string $command Symfony console command name e.g. doctrine:migrations:status
     * @param array $options
     * @return int
     */
    protected function runConsole($command, Array $options = array()) {
        $this->boot();
        
        $args = array(
            'app/console',
            $command,
            '-e',
            'test'
        );
        
        if (!$this->isVerboseEnvironmentVariableSet()) {
            $args[] = '-q';
            $args[] = '-n';
        }       
        
        foreach ($options as $key => $value) {
            $args[] = $key;
            
            if (!is_null($value) && !is_bool($value)) {
                $args[] = $value;
            }
        }


        $input = new ArgvInput($args);                 
        return $this->application->run($input);
    }
    
    /**
     *
     * @param string $name Migration name - this is the name of the migration class without the leading 'Version'
     */
    protected function runExpectedFailedMigration($name) {
        $this->runMigrationUpDown($name, self::MIGRATION_NORMAL_FAILED_RESPONSE);
    }
    
    
    /**
     *
     * @param string $name Migration name - this is the name of the migration class without the leading 'Version'
     */
    protected function runExpectedSuccessfulMigration($name) {
        $this->runMigrationUpDown($name, self::MIGRATION_SUCCESSFUL_RESPONSE);
    }
    
    
    /**
     *
     * @param string $name Migration name - this is the name of the migration class without the leading 'Version'
     * @param int $expectedResponse 
     */
    private function runMigrationUpDown($name, $expectedResponse) {        
        $this->runMigrationWithExpectedResponse($name, 'up', $expectedResponse);
        $this->runMigrationWithExpectedResponse($name, 'down', $expectedResponse);
    }
    
    
    /**
     *
     * @param string $name Migration name - this is the name of the migration class without the leading 'Version'
     * @param string $direction 'up' or 'down'
     * @param int $expectedResponse
     */
    private function runMigrationWithExpectedResponse($name, $direction, $expectedResponse) {        
        $this->assertEquals($expectedResponse, $this->runConsole("doctrine:migrations:execute", array(
            "--no-interaction" => true,
            "19700101150000_" . $name => true,
            '--' . $direction => true
        )));        
    }    
}
