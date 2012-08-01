<?php

namespace Application\Migrations;

use SimplyTestable\BaseMigrationsBundle\Migration\BaseMigration,
    Doctrine\DBAL\Schema\Schema;

class Version19700101150000_TestBaseMigrationSeparateMySqlAndSqliteStatements extends BaseMigration
{
    public function up(Schema $schema)
    {
        $this->statements['mysql'] = array(
            'SELECT 1 + 1'
        );
        
        $this->statements['sqlite'] = array(
            'SELECT 1 + 1'
        );
        
        parent::up($schema);
    }
   

    public function down(Schema $schema)
    {   
        $this->statements['mysql'] = array(
            'SELECT 1 + 1'
        );
        
        $this->statements['sqlite'] = array(
            'SELECT 1 + 1'
        );        
        
        parent::down($schema);
    }
}
