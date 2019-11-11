<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191106153031 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE kompetensi_lisensi_pekerjaan_id_seq CASCADE');
        $this->addSql('CREATE TABLE jabatan_fungsi_pekerjaan (id BIGSERIAL NOT NULL, jabatan_id BIGINT NOT NULL, fungsi_pekerjaan_id BIGINT NOT NULL, kepala VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_992EB59CA7400487 ON jabatan_fungsi_pekerjaan (jabatan_id)');
        $this->addSql('CREATE INDEX IDX_992EB59C32694EC9 ON jabatan_fungsi_pekerjaan (fungsi_pekerjaan_id)');
        $this->addSql('CREATE TABLE jabatan_fungsi_pekerjaan_lisensi (id BIGSERIAL NOT NULL, jabatan_fungsi_pekerjaan_id BIGINT NOT NULL, lisensi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A1A42E53D72CD30F ON jabatan_fungsi_pekerjaan_lisensi (jabatan_fungsi_pekerjaan_id)');
        $this->addSql('CREATE INDEX IDX_A1A42E5370621ED8 ON jabatan_fungsi_pekerjaan_lisensi (lisensi_id)');
        $this->addSql('CREATE TABLE lisensi_kompetensi (id BIGSERIAL NOT NULL, kompetensi_id BIGINT NOT NULL, lisensi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3055FA586543E6FC ON lisensi_kompetensi (kompetensi_id)');
        $this->addSql('CREATE INDEX IDX_3055FA5870621ED8 ON lisensi_kompetensi (lisensi_id)');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT FK_992EB59CA7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT FK_992EB59C32694EC9 FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT FK_A1A42E53D72CD30F FOREIGN KEY (jabatan_fungsi_pekerjaan_id) REFERENCES jabatan_fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT FK_A1A42E5370621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT FK_3055FA586543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT FK_3055FA5870621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE kompetensi_lisensi_pekerjaan');
        $this->addSql('ALTER TABLE jabatan ADD pendidikan_minimal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jabatan ADD ipk_minimal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jabatan ADD pengalaman_minimal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE jabatan ADD usia_minimal VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi DROP CONSTRAINT FK_A1A42E53D72CD30F');
        $this->addSql('CREATE SEQUENCE kompetensi_lisensi_pekerjaan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE kompetensi_lisensi_pekerjaan (id BIGSERIAL NOT NULL, jabatan_id BIGINT NOT NULL, fungsi_pekerjaan_id BIGINT NOT NULL, kompetensi_id BIGINT NOT NULL, lisensi_id BIGINT NOT NULL, kode VARCHAR(255) NOT NULL, kepala VARCHAR(255) NOT NULL, nama VARCHAR(255) NOT NULL, pendidikan_minimal VARCHAR(255) NOT NULL, ipk_minimal VARCHAR(255) NOT NULL, keterangan VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4a8bba5832694ec9 ON kompetensi_lisensi_pekerjaan (fungsi_pekerjaan_id)');
        $this->addSql('CREATE INDEX idx_4a8bba586543e6fc ON kompetensi_lisensi_pekerjaan (kompetensi_id)');
        $this->addSql('CREATE INDEX idx_4a8bba5870621ed8 ON kompetensi_lisensi_pekerjaan (lisensi_id)');
        $this->addSql('CREATE INDEX idx_4a8bba58a7400487 ON kompetensi_lisensi_pekerjaan (jabatan_id)');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT fk_4a8bba58a7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT fk_4a8bba5832694ec9 FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT fk_4a8bba586543e6fc FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_lisensi_pekerjaan ADD CONSTRAINT fk_4a8bba5870621ed8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE jabatan_fungsi_pekerjaan');
        $this->addSql('DROP TABLE jabatan_fungsi_pekerjaan_lisensi');
        $this->addSql('DROP TABLE lisensi_kompetensi');
        $this->addSql('ALTER TABLE jabatan DROP pendidikan_minimal');
        $this->addSql('ALTER TABLE jabatan DROP ipk_minimal');
        $this->addSql('ALTER TABLE jabatan DROP pengalaman_minimal');
        $this->addSql('ALTER TABLE jabatan DROP usia_minimal');
    }
}
