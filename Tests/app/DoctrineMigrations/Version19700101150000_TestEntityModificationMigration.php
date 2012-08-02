<?php

namespace Application\Migrations;

use SimplyTestable\BaseMigrationsBundle\Migration\EntityModificationMigration,
    Doctrine\DBAL\Schema\Schema;

class Version19700101150000_TestEntityModificationMigration extends EntityModificationMigration
{
    public function up(Schema $schema)
    {        
        parent::up($schema);
    }
   

    public function down(Schema $schema)
    {        
        parent::down($schema);
    }
}
