<?php
namespace SimplyTestable\BaseMigrationsBundle\Migration;

use Doctrine\DBAL\Schema\Schema;

abstract class EntityModificationMigration extends BaseMigration {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;
    
    
    /**
     *
     * @return \Doctrine\ORM\EntityManager 
     */
    protected function getEntityManager() {
        if (is_null($this->entityManager)) {
            $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        }
        
        return $this->entityManager;
    }
    
    public function up(Schema $schema) {
        $this->addSql("SELECT 1 + 1");
    }
    
    public function down(Schema $schema) {
        $this->addSql("SELECT 1 + 1");
    }
}