<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191112144746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE kompetensi_diklat_id_seq1 CASCADE');
        $this->addSql('CREATE SEQUENCE kompetensi_program_studi_id_seq');
        $this->addSql('SELECT setval(\'kompetensi_program_studi_id_seq\', (SELECT MAX(id) FROM kompetensi_program_studi))');
        $this->addSql('ALTER TABLE kompetensi_program_studi ALTER id SET DEFAULT nextval(\'kompetensi_program_studi_id_seq\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE kompetensi_diklat_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE kompetensi_program_studi ALTER id DROP DEFAULT');
    }
}
