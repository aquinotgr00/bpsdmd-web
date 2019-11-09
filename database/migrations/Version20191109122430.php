<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191109122430 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT fk_4d53c143de60e87f');
        $this->addSql('ALTER TABLE kabupaten DROP CONSTRAINT fk_f88809d4c3703970');
        $this->addSql('DROP SEQUENCE provinsi_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE kabupaten_id_seq CASCADE');
        $this->addSql('DROP TABLE kabupaten');
        $this->addSql('DROP TABLE provinsi');
        $this->addSql('ALTER TABLE sertifikat DROP CONSTRAINT fk_ef95f27998300d9');
        $this->addSql('DROP INDEX idx_ef95f27998300d9');
        $this->addSql('ALTER TABLE sertifikat DROP pegawai_id');
        $this->addSql('ALTER TABLE sertifikat DROP masa_berlaku');
        $this->addSql('DROP INDEX idx_4d53c143de60e87f');
        $this->addSql('ALTER TABLE peserta_diklat DROP kabupaten_id');
        $this->addSql('ALTER TABLE siswa ALTER wna TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE siswa ALTER wna DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE provinsi_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE kabupaten_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE kabupaten (id BIGSERIAL NOT NULL, provinsi_id BIGINT DEFAULT NULL, nama VARCHAR(255) NOT NULL, kode VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f88809d4c3703970 ON kabupaten (provinsi_id)');
        $this->addSql('CREATE TABLE provinsi (id BIGSERIAL NOT NULL, nama VARCHAR(255) NOT NULL, kode VARCHAR(255) NOT NULL, singkatan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE kabupaten ADD CONSTRAINT fk_f88809d4c3703970 FOREIGN KEY (provinsi_id) REFERENCES provinsi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa ALTER wna TYPE BOOLEAN');
        $this->addSql('ALTER TABLE siswa ALTER wna DROP DEFAULT');
        $this->addSql('ALTER TABLE sertifikat ADD pegawai_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD masa_berlaku DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE sertifikat ADD CONSTRAINT fk_ef95f27998300d9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ef95f27998300d9 ON sertifikat (pegawai_id)');
        $this->addSql('ALTER TABLE peserta_diklat ADD kabupaten_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT fk_4d53c143de60e87f FOREIGN KEY (kabupaten_id) REFERENCES kabupaten (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4d53c143de60e87f ON peserta_diklat (kabupaten_id)');
    }
}
