<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191031144445 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE instansi (id BIGSERIAL NOT NULL, kode VARCHAR(255) DEFAULT NULL, nama VARCHAR(255) NOT NULL, singkatan VARCHAR(255) DEFAULT NULL, tipe VARCHAR(255) DEFAULT NULL, moda VARCHAR(255) DEFAULT NULL, alamat VARCHAR(255) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, deskripsi VARCHAR(255) DEFAULT NULL, akreditasi VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pengguna (id BIGSERIAL NOT NULL, instansi_id BIGINT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, otoritas VARCHAR(255) NOT NULL, aktif INT NOT NULL, hapus INT NOT NULL, nama VARCHAR(255) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, bahasa VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3C109A2A10675A27 ON pengguna (instansi_id)');
        $this->addSql('CREATE TABLE kompetensi_fungsi_kunci (id BIGSERIAL NOT NULL, kode VARCHAR(255) NOT NULL, fungsi_kunci VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dosen (id BIGSERIAL NOT NULL, instansi_id BIGINT DEFAULT NULL, kode VARCHAR(255) DEFAULT NULL, nip VARCHAR(255) DEFAULT NULL, nama VARCHAR(255) NOT NULL, gelar_depan VARCHAR(255) DEFAULT NULL, gelar_belakang VARCHAR(255) DEFAULT NULL, tanggal_lahir DATE DEFAULT NULL, no_ktp VARCHAR(255) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, nidn VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2DE2C47110675A27 ON dosen (instansi_id)');
        $this->addSql('CREATE TABLE kompetensi (id BIGSERIAL NOT NULL, kompetensi_tujuan_utama_id BIGINT NOT NULL, kompetensi_fungsi_kunci_id BIGINT NOT NULL, kompetensi_fungsi_utama_id BIGINT NOT NULL, kompetensi_unit_id BIGINT NOT NULL, moda VARCHAR(255) NOT NULL, tipe VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C47776F12C90B1EA ON kompetensi (kompetensi_tujuan_utama_id)');
        $this->addSql('CREATE INDEX IDX_C47776F1B03CEC44 ON kompetensi (kompetensi_fungsi_kunci_id)');
        $this->addSql('CREATE INDEX IDX_C47776F1F4A8E0B2 ON kompetensi (kompetensi_fungsi_utama_id)');
        $this->addSql('CREATE INDEX IDX_C47776F13A3E13D7 ON kompetensi (kompetensi_unit_id)');
        $this->addSql('CREATE TABLE sertifikat (id BIGSERIAL NOT NULL, nama VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lisensi_program_studi (id BIGSERIAL NOT NULL, lisensi_id BIGINT NOT NULL, program_studi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F15E046370621ED8 ON lisensi_program_studi (lisensi_id)');
        $this->addSql('CREATE INDEX IDX_F15E0463369CA843 ON lisensi_program_studi (program_studi_id)');
        $this->addSql('CREATE TABLE feeder (id BIGSERIAL NOT NULL, pengguna_id BIGINT NOT NULL, nama_file VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, created_at DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB1A5EE6C58274CE ON feeder (pengguna_id)');
        $this->addSql('CREATE TABLE sertifikat_pegawai (id BIGSERIAL NOT NULL, pegawai_id BIGINT NOT NULL, sertifikat_id BIGINT NOT NULL, masa_berlaku DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4748B294998300D9 ON sertifikat_pegawai (pegawai_id)');
        $this->addSql('CREATE INDEX IDX_4748B294A2019E78 ON sertifikat_pegawai (sertifikat_id)');
        $this->addSql('CREATE TABLE kompetensi_fungsi_utama (id BIGSERIAL NOT NULL, kode VARCHAR(255) NOT NULL, fungsi_utama VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE provinsi (id BIGSERIAL NOT NULL, nama VARCHAR(255) NOT NULL, kode VARCHAR(255) NOT NULL, singkatan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE program_studi (id BIGSERIAL NOT NULL, instansi_id BIGINT DEFAULT NULL, kode VARCHAR(255) DEFAULT NULL, nama VARCHAR(255) NOT NULL, jenjang VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65A1F4DB10675A27 ON program_studi (instansi_id)');
        $this->addSql('CREATE TABLE siswa (id BIGSERIAL NOT NULL, instansi_id BIGINT NOT NULL, program_studi_id BIGINT DEFAULT NULL, kode VARCHAR(255) DEFAULT NULL, nama VARCHAR(255) NOT NULL, periode_masuk VARCHAR(255) DEFAULT NULL, tahun_kurikulum VARCHAR(255) DEFAULT NULL, tanggal_lahir DATE DEFAULT NULL, kelas VARCHAR(255) DEFAULT NULL, ipk VARCHAR(255) DEFAULT NULL, no_ktp VARCHAR(255) DEFAULT NULL, jenis_kelamin VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, tahun_lulus VARCHAR(255) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3202BD7D10675A27 ON siswa (instansi_id)');
        $this->addSql('CREATE INDEX IDX_3202BD7D369CA843 ON siswa (program_studi_id)');
        $this->addSql('CREATE TABLE kompetensi_tujuan_utama (id BIGSERIAL NOT NULL, kode VARCHAR(255) NOT NULL, tujuan_utama VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE penawaran_siswa (id BIGSERIAL NOT NULL, instansi_id BIGINT NOT NULL, siswa_id BIGINT NOT NULL, jabatan_id BIGINT NOT NULL, status INT DEFAULT NULL, tanggal_input DATE DEFAULT NULL, tanggal_update DATE DEFAULT NULL, sudah_diemail INT DEFAULT NULL, tanggal_email DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_674A6A3410675A27 ON penawaran_siswa (instansi_id)');
        $this->addSql('CREATE INDEX IDX_674A6A34850D8FD8 ON penawaran_siswa (siswa_id)');
        $this->addSql('CREATE INDEX IDX_674A6A34A7400487 ON penawaran_siswa (jabatan_id)');
        $this->addSql('CREATE TABLE data_diklat (id BIGSERIAL NOT NULL, diklat_id BIGINT NOT NULL, tanggal_mulai DATE NOT NULL, tanggal_selesai DATE NOT NULL, target_jumlah_peserta INT DEFAULT NULL, realisasi_jumlah_peserta INT DEFAULT NULL, sk_buka VARCHAR(255) DEFAULT NULL, sk_tutup VARCHAR(255) DEFAULT NULL, angkatan INT DEFAULT NULL, tahun INT DEFAULT NULL, lama_diklat INT DEFAULT NULL, tempat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_501F654F7AADDBC ON data_diklat (diklat_id)');
        $this->addSql('CREATE TABLE lisensi (id BIGSERIAL NOT NULL, kode VARCHAR(255) NOT NULL, nama VARCHAR(255) NOT NULL, bab VARCHAR(255) NOT NULL, moda VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pegawai (id BIGSERIAL NOT NULL, sekolah_id BIGINT NOT NULL, instansi_id BIGINT NOT NULL, kode VARCHAR(255) NOT NULL, nama VARCHAR(255) NOT NULL, no_ktp VARCHAR(255) NOT NULL, jenis_kelamin VARCHAR(255) DEFAULT NULL, tempat_lahir VARCHAR(255) DEFAULT NULL, tanggal_lahir DATE DEFAULT NULL, bahasa VARCHAR(255) DEFAULT NULL, kewarganegaraan VARCHAR(255) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98835748A48940F5 ON pegawai (sekolah_id)');
        $this->addSql('CREATE INDEX IDX_9883574810675A27 ON pegawai (instansi_id)');
        $this->addSql('CREATE TABLE jabatan (id BIGSERIAL NOT NULL, instansi_id BIGINT NOT NULL, nama VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_947E725410675A27 ON jabatan (instansi_id)');
        $this->addSql('CREATE TABLE diklat (id BIGSERIAL NOT NULL, instansi_id BIGINT DEFAULT NULL, nama VARCHAR(255) NOT NULL, tipe VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_30E1545610675A27 ON diklat (instansi_id)');
        $this->addSql('CREATE TABLE fungsi_pekerjaan (id BIGSERIAL NOT NULL, instansi_id BIGINT NOT NULL, kode VARCHAR(255) DEFAULT NULL, nama VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4674135810675A27 ON fungsi_pekerjaan (instansi_id)');
        $this->addSql('CREATE TABLE peserta_diklat (id BIGSERIAL NOT NULL, diklat_id BIGINT NOT NULL, pegawai_id BIGINT NOT NULL, kabupaten_id BIGINT NOT NULL, latar_belakang VARCHAR(255) NOT NULL, lulus BOOLEAN NOT NULL, sertifikat_kompetensi VARCHAR(255) NOT NULL, sertifikat_pelatihan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4D53C1437AADDBC ON peserta_diklat (diklat_id)');
        $this->addSql('CREATE INDEX IDX_4D53C143998300D9 ON peserta_diklat (pegawai_id)');
        $this->addSql('CREATE INDEX IDX_4D53C143DE60E87F ON peserta_diklat (kabupaten_id)');
        $this->addSql('CREATE TABLE kabupaten (id BIGSERIAL NOT NULL, provinsi_id BIGINT DEFAULT NULL, nama VARCHAR(255) NOT NULL, kode VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F88809D4C3703970 ON kabupaten (provinsi_id)');
        $this->addSql('CREATE TABLE kompetensi_unit (id BIGSERIAL NOT NULL, kode VARCHAR(255) NOT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pengguna ADD CONSTRAINT FK_3C109A2A10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dosen ADD CONSTRAINT FK_2DE2C47110675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F12C90B1EA FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES kompetensi_tujuan_utama (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F1B03CEC44 FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES kompetensi_fungsi_kunci (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F1F4A8E0B2 FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES kompetensi_fungsi_utama (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F13A3E13D7 FOREIGN KEY (kompetensi_unit_id) REFERENCES kompetensi_unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT FK_F15E046370621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT FK_F15E0463369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feeder ADD CONSTRAINT FK_DB1A5EE6C58274CE FOREIGN KEY (pengguna_id) REFERENCES pengguna (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT FK_4748B294998300D9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT FK_4748B294A2019E78 FOREIGN KEY (sertifikat_id) REFERENCES sertifikat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_studi ADD CONSTRAINT FK_65A1F4DB10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT FK_3202BD7D10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT FK_3202BD7D369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A3410675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A34850D8FD8 FOREIGN KEY (siswa_id) REFERENCES siswa (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A34A7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE data_diklat ADD CONSTRAINT FK_501F654F7AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pegawai ADD CONSTRAINT FK_98835748A48940F5 FOREIGN KEY (sekolah_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pegawai ADD CONSTRAINT FK_9883574810675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan ADD CONSTRAINT FK_947E725410675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diklat ADD CONSTRAINT FK_30E1545610675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fungsi_pekerjaan ADD CONSTRAINT FK_4674135810675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT FK_4D53C1437AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT FK_4D53C143998300D9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT FK_4D53C143DE60E87F FOREIGN KEY (kabupaten_id) REFERENCES kabupaten (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kabupaten ADD CONSTRAINT FK_F88809D4C3703970 FOREIGN KEY (provinsi_id) REFERENCES provinsi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pengguna DROP CONSTRAINT FK_3C109A2A10675A27');
        $this->addSql('ALTER TABLE dosen DROP CONSTRAINT FK_2DE2C47110675A27');
        $this->addSql('ALTER TABLE program_studi DROP CONSTRAINT FK_65A1F4DB10675A27');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT FK_3202BD7D10675A27');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A3410675A27');
        $this->addSql('ALTER TABLE pegawai DROP CONSTRAINT FK_98835748A48940F5');
        $this->addSql('ALTER TABLE pegawai DROP CONSTRAINT FK_9883574810675A27');
        $this->addSql('ALTER TABLE jabatan DROP CONSTRAINT FK_947E725410675A27');
        $this->addSql('ALTER TABLE diklat DROP CONSTRAINT FK_30E1545610675A27');
        $this->addSql('ALTER TABLE fungsi_pekerjaan DROP CONSTRAINT FK_4674135810675A27');
        $this->addSql('ALTER TABLE feeder DROP CONSTRAINT FK_DB1A5EE6C58274CE');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F1B03CEC44');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT FK_4748B294A2019E78');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F1F4A8E0B2');
        $this->addSql('ALTER TABLE kabupaten DROP CONSTRAINT FK_F88809D4C3703970');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT FK_F15E0463369CA843');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT FK_3202BD7D369CA843');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A34850D8FD8');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F12C90B1EA');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT FK_F15E046370621ED8');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT FK_4748B294998300D9');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT FK_4D53C143998300D9');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A34A7400487');
        $this->addSql('ALTER TABLE data_diklat DROP CONSTRAINT FK_501F654F7AADDBC');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT FK_4D53C1437AADDBC');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT FK_4D53C143DE60E87F');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F13A3E13D7');
        $this->addSql('DROP TABLE instansi');
        $this->addSql('DROP TABLE pengguna');
        $this->addSql('DROP TABLE kompetensi_fungsi_kunci');
        $this->addSql('DROP TABLE dosen');
        $this->addSql('DROP TABLE kompetensi');
        $this->addSql('DROP TABLE sertifikat');
        $this->addSql('DROP TABLE lisensi_program_studi');
        $this->addSql('DROP TABLE feeder');
        $this->addSql('DROP TABLE sertifikat_pegawai');
        $this->addSql('DROP TABLE kompetensi_fungsi_utama');
        $this->addSql('DROP TABLE provinsi');
        $this->addSql('DROP TABLE program_studi');
        $this->addSql('DROP TABLE siswa');
        $this->addSql('DROP TABLE kompetensi_tujuan_utama');
        $this->addSql('DROP TABLE penawaran_siswa');
        $this->addSql('DROP TABLE data_diklat');
        $this->addSql('DROP TABLE lisensi');
        $this->addSql('DROP TABLE pegawai');
        $this->addSql('DROP TABLE jabatan');
        $this->addSql('DROP TABLE diklat');
        $this->addSql('DROP TABLE fungsi_pekerjaan');
        $this->addSql('DROP TABLE peserta_diklat');
        $this->addSql('DROP TABLE kabupaten');
        $this->addSql('DROP TABLE kompetensi_unit');
    }
}
