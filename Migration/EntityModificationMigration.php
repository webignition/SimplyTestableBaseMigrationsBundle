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
        if (!$this->hasStatements()) {
            $this->addCommonStatement("SELECT 1 + 1");
        }
        
        parent::up($schema);
    }
    
    public function down(Schema $schema) {
        if (!$this->hasStatements()) {
            $this->addCommonStatement("SELECT 1 + 1");
        }
        
        parent::down($schema);
    }
}