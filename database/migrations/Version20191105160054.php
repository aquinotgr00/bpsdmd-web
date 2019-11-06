<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191105160054 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sertifikat ADD pegawai_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD masa_berlaku DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD CONSTRAINT FK_EF95F27998300D9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EF95F27998300D9 ON sertifikat (pegawai_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sertifikat DROP CONSTRAINT FK_EF95F27998300D9');
        $this->addSql('DROP INDEX IDX_EF95F27998300D9');
        $this->addSql('ALTER TABLE sertifikat DROP pegawai_id');
        $this->addSql('ALTER TABLE sertifikat DROP masa_berlaku');
    }
}
// stage
