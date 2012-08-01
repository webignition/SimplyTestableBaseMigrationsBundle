<?php

namespace Application\Migrations;

use SimplyTestable\BaseMigrationsBundle\Migration\BaseMigration,
    Doctrine\DBAL\Schema\Schema;

class Version19700101150000_TestBaseMigrationNoStatements extends BaseMigration
{
    public function up(Schema $schema)
    {        
        parent::up($schema);
    }
   

    public function down(Schema $schema)
    {    
        $this->addCommonStatement("DROP TABLE JobTaskTypes");      
        
        parent::down($schema);
    }
}
