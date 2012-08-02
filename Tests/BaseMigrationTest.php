<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

class BaseMigrationTest extends BaseTestCase
{
    public function testBaseMigrationNoStatements()
    {               
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__));
    }
    
    public function testBaseMigrationMySqlStatementsOnly()
    {
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__));
    }    
    
    public function testBaseMigrationSqliteStatementsOnly()
    {
        $this->runExpectedFailedMigration(ucfirst(__FUNCTION__));        
    }
    
    public function testBaseMigrationSeparateMySqlAndSqliteStatements()
    {        
        $this->runExpectedSuccessfulMigration(ucfirst(__FUNCTION__));        
    }
}