<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191118044807 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER masa_berlaku TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER masa_berlaku DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER masa_berlaku TYPE DATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER masa_berlaku DROP DEFAULT');
    }
}
