<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191105033253 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE penawaran_siswa ALTER jabatan_id DROP NOT NULL');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_input TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_input DROP DEFAULT');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_update TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_update DROP DEFAULT');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_email TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_email DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER jabatan_id SET NOT NULL');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_input TYPE DATE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_input DROP DEFAULT');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_update TYPE DATE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_update DROP DEFAULT');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_email TYPE DATE');
        $this->addSql('ALTER TABLE penawaran_siswa ALTER tanggal_email DROP DEFAULT');
    }
}
// stage
