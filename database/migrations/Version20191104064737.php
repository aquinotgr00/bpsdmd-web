<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191104064737 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE kompetensi_lisensi_pekerjaan (id BIGSERIAL NOT NULL, jabatan_id BIGINT NOT NULL, fungsi_pekerjaan_id BIGINT NOT NULL, kompetensi_id BIGINT NOT NULL, lisensi_id BIGINT NOT NULL, kode VARCHAR(255) NOT NULL, kepala VARCHAR(255) NOT NULL, nama VARCHAR(255) NOT NULL, pendidikan_minimal VARCHAR(255) NOT NULL, ipk_minimal VARCHAR(255) NOT NULL, keterangan VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A8BBA58A7400487 ON kompetensi_lisensi_pekerjaan (jabatan_id)');
        $this->addSql('CREATE INDEX IDX_4A8BBA5832694EC9 ON kompetensi_lisensi_pekerjaan (fungsi_pekerjaan_id)');
        $this->addSql('CREATE INDEX IDX_4A8BBA586543E6FC ON kompetensi_lisensi_pekerjaan (kompetensi_id)');
        $this->addSql('CREATE INDEX IDX_4A8BBA5870621ED8 ON kompetensi_lisensi_pekerjaan (lisensi_id)');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT FK_4A8BBA58A7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT FK_4A8BBA5832694EC9 FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT FK_4A8BBA586543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT FK_4A8BBA5870621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_studi ADD tgl_berdiri DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ADD sk_selenggara VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ADD tgl_sk_pendirian DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ADD sks_lulus BIGINT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE kompetensi_lisensi_pekerjaan');
        $this->addSql('ALTER TABLE program_studi DROP tgl_berdiri');
        $this->addSql('ALTER TABLE program_studi DROP sk_selenggara');
        $this->addSql('ALTER TABLE program_studi DROP tgl_sk_pendirian');
        $this->addSql('ALTER TABLE program_studi DROP sks_lulus');
    }
}
