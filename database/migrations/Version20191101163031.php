<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191101163031 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE instansi ADD udid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD sk_pendirian VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD tgl_sk_pendirian DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD sk_operasional VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD tgl_sk_operasional DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD telepon VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD faksimile VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD status_milik VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD pembina VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD bentuk_pendidikan VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE instansi ADD last_update DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD udid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD nim VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD tempat_lahir VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD alamat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD telepon VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD handphone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD agama VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD ibu_kandung VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD kewarganegaraan VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD wna BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD penerima_kps BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD jenis_tinggal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD tgl_masuk DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD tgl_keluar DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD smt_mulai BIGINT NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD smt_tempuh BIGINT NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD sks BIGINT NOT NULL');
        $this->addSql('ALTER TABLE siswa ADD no_ijazah VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD tgl_sk_yudisium DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD jenis_daftar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD jenis_keluar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE siswa ADD last_update DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ADD udid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program_studi ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE program_studi ADD visi VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE program_studi ADD misi VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE program_studi ADD last_update DATE DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE instansi DROP udid');
        $this->addSql('ALTER TABLE instansi DROP sk_pendirian');
        $this->addSql('ALTER TABLE instansi DROP tgl_sk_pendirian');
        $this->addSql('ALTER TABLE instansi DROP sk_operasional');
        $this->addSql('ALTER TABLE instansi DROP tgl_sk_operasional');
        $this->addSql('ALTER TABLE instansi DROP status');
        $this->addSql('ALTER TABLE instansi DROP telepon');
        $this->addSql('ALTER TABLE instansi DROP faksimile');
        $this->addSql('ALTER TABLE instansi DROP website');
        $this->addSql('ALTER TABLE instansi DROP email');
        $this->addSql('ALTER TABLE instansi DROP status_milik');
        $this->addSql('ALTER TABLE instansi DROP pembina');
        $this->addSql('ALTER TABLE instansi DROP bentuk_pendidikan');
        $this->addSql('ALTER TABLE instansi DROP last_update');
        $this->addSql('ALTER TABLE program_studi DROP udid');
        $this->addSql('ALTER TABLE program_studi DROP status');
        $this->addSql('ALTER TABLE program_studi DROP visi');
        $this->addSql('ALTER TABLE program_studi DROP misi');
        $this->addSql('ALTER TABLE program_studi DROP last_update');
        $this->addSql('ALTER TABLE siswa DROP udid');
        $this->addSql('ALTER TABLE siswa DROP nim');
        $this->addSql('ALTER TABLE siswa DROP tempat_lahir');
        $this->addSql('ALTER TABLE siswa DROP alamat');
        $this->addSql('ALTER TABLE siswa DROP telepon');
        $this->addSql('ALTER TABLE siswa DROP handphone');
        $this->addSql('ALTER TABLE siswa DROP email');
        $this->addSql('ALTER TABLE siswa DROP agama');
        $this->addSql('ALTER TABLE siswa DROP ibu_kandung');
        $this->addSql('ALTER TABLE siswa DROP kewarganegaraan');
        $this->addSql('ALTER TABLE siswa DROP wna');
        $this->addSql('ALTER TABLE siswa DROP penerima_kps');
        $this->addSql('ALTER TABLE siswa DROP jenis_tinggal');
        $this->addSql('ALTER TABLE siswa DROP tgl_masuk');
        $this->addSql('ALTER TABLE siswa DROP tgl_keluar');
        $this->addSql('ALTER TABLE siswa DROP smt_mulai');
        $this->addSql('ALTER TABLE siswa DROP smt_tempuh');
        $this->addSql('ALTER TABLE siswa DROP sks');
        $this->addSql('ALTER TABLE siswa DROP no_ijazah');
        $this->addSql('ALTER TABLE siswa DROP tgl_sk_yudisium');
        $this->addSql('ALTER TABLE siswa DROP jenis_daftar');
        $this->addSql('ALTER TABLE siswa DROP jenis_keluar');
        $this->addSql('ALTER TABLE siswa DROP last_update');
    }
}
