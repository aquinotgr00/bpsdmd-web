<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191116053151 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE dosen ADD foto VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id TYPE BIGINT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id TYPE INT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id DROP DEFAULT');
        $this->addSql('ALTER TABLE dosen DROP foto');
    }
}
