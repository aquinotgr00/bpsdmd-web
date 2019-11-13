<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191112144823 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('SELECT setval(\'kompetensi_diklat_id_seq\', (SELECT MAX(id) FROM kompetensi_diklat))');
        $this->addSql('ALTER TABLE kompetensi_diklat ALTER id SET DEFAULT nextval(\'kompetensi_diklat_id_seq\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE kompetensi_diklat ALTER id DROP DEFAULT');
    }
}
