<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

class BaseMigrationTest extends BaseTestCase
{
    public function testBaseMigrationNoStatements()
    {        
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'up', 1);
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'dowm', 1);
    }
    
    public function testBaseMigrationMysqlStatementsOnly()
    {
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'up', 5);
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'down', 5);
    }    
    
    public function testBaseMigrationSqliteStatementsOnly()
    {
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'up', 1);
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'down', 1);
    }
    
    public function testBaseMigrationSeparateMySqlAndSqliteStatements()
    {        
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'up', 0);
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__), 'down', 0);
    }    
    
    private function runExpectedFailedMigration($name, $direction, $expectedResponse) {
        $this->assertEquals($expectedResponse, $this->runConsole("doctrine:migrations:execute", array(
            "--no-interaction" => true,
            "19700101150000_" . $name => true,
            '--' . $direction => true
        )));        
    }
}