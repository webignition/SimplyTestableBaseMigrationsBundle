<?php

namespace SimplyTestable\BaseMigrationsBundle\Tests;

class EntityMigrationTest extends BaseTestCase
{
    public function testEntityModificationMigration()
    {        
        $this->runExpectedSuccessfulMigration(ucfirst(__FUNCTION__));
    }

}