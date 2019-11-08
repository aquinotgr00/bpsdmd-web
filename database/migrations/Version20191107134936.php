<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191107134936 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sertifikat DROP CONSTRAINT fk_ef95f27998300d9');
        $this->addSql('DROP INDEX idx_ef95f27998300d9');
        $this->addSql('ALTER TABLE sertifikat DROP pegawai_id');
        $this->addSql('ALTER TABLE sertifikat DROP masa_berlaku');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sertifikat ADD pegawai_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD masa_berlaku DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD CONSTRAINT fk_ef95f27998300d9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ef95f27998300d9 ON sertifikat (pegawai_id)');
    }
}
