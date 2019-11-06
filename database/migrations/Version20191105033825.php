<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191105033825 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE program_studi ADD kompetensi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ALTER visi DROP NOT NULL');
        $this->addSql('ALTER TABLE program_studi ALTER misi DROP NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE program_studi DROP kompetensi');
        $this->addSql('ALTER TABLE program_studi ALTER visi SET NOT NULL');
        $this->addSql('ALTER TABLE program_studi ALTER misi SET NOT NULL');
    }
}
// stage
