<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191112144352 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE kompetensi_pekerjaan_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE kompetensi_prodi_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE link_and_match_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lisensi_pekerjaan_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE riwayat_penawaran_siswa_id_seq CASCADE');
        $this->addSql('CREATE TABLE kompetensi_diklat (id BIGSERIAL NOT NULL, diklat_id BIGINT NOT NULL, kompetensi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_647D29EA7AADDBC ON kompetensi_diklat (diklat_id)');
        $this->addSql('CREATE INDEX IDX_647D29EA6543E6FC ON kompetensi_diklat (kompetensi_id)');
        $this->addSql('ALTER TABLE kompetensi_diklat ADD CONSTRAINT FK_647D29EA7AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_diklat ADD CONSTRAINT FK_647D29EA6543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pengguna DROP CONSTRAINT pengguna_instansi_id_fkey');
        $this->addSql('SELECT setval(\'pengguna_id_seq\', (SELECT MAX(id) FROM pengguna))');
        $this->addSql('ALTER TABLE pengguna ALTER id SET DEFAULT nextval(\'pengguna_id_seq\')');
        $this->addSql('ALTER TABLE pengguna ADD CONSTRAINT FK_3C109A2A10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dosen DROP CONSTRAINT instansi_id');
        $this->addSql('CREATE SEQUENCE dosen_id_seq');
        $this->addSql('SELECT setval(\'dosen_id_seq\', (SELECT MAX(id) FROM dosen))');
        $this->addSql('ALTER TABLE dosen ALTER id SET DEFAULT nextval(\'dosen_id_seq\')');
        $this->addSql('ALTER TABLE dosen ADD CONSTRAINT FK_2DE2C47110675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT kompetensi_kompetensi_fungsi_kunci_id_fkey');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT kompetensi_kompetensi_fungsi_utama_id_fkey');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT kompetensi_kompetensi_tujuan_utama_id_fkey');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT kompetensi_kompetensi_unit_id_fkey');
        $this->addSql('ALTER TABLE kompetensi ALTER moda TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F12C90B1EA FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES kompetensi_tujuan_utama (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F1B03CEC44 FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES kompetensi_fungsi_kunci (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F1F4A8E0B2 FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES kompetensi_fungsi_utama (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT FK_C47776F13A3E13D7 FOREIGN KEY (kompetensi_unit_id) REFERENCES kompetensi_unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan DROP CONSTRAINT jabatan_fungsi_pekerjaan_fungsi_pekerjaan_id_fkey');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan DROP CONSTRAINT jabatan_fungsi_pekerjaan_jabatan_id_fkey');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT FK_992EB59CA7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT FK_992EB59C32694EC9 FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_program_studi DROP CONSTRAINT kompetensi_prodi_program_studi_id_fkey');
        $this->addSql('ALTER TABLE kompetensi_program_studi ADD CONSTRAINT FK_65519DF4369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_program_studi ADD CONSTRAINT FK_65519DF46543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65519DF46543E6FC ON kompetensi_program_studi (kompetensi_id)');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT lisensi_program_studi_lisensi_id_fkey');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT lisensi_program_studi_program_studi_id_fkey');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT FK_F15E046370621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT FK_F15E0463369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi DROP CONSTRAINT jabatan_fungsi_pekerjaan_lisen_jabatan_fungsi_pekerjaan_id_fkey');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi DROP CONSTRAINT jabatan_fungsi_pekerjaan_lisensi_lisensi_id_fkey');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id TYPE INT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id DROP DEFAULT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT FK_A1A42E53D72CD30F FOREIGN KEY (jabatan_fungsi_pekerjaan_id) REFERENCES jabatan_fungsi_pekerjaan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT FK_A1A42E5370621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feeder DROP CONSTRAINT feeder_pengguna_id_fkey');
        $this->addSql('ALTER TABLE feeder ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE feeder ADD CONSTRAINT FK_DB1A5EE6C58274CE FOREIGN KEY (pengguna_id) REFERENCES pengguna (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT sertifikat_pegawai_pegawai_id_fkey');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT sertifikat_pegawai_sertifikat_id_fkey');
        $this->addSql('SELECT setval(\'sertifikat_pegawai_id_seq\', (SELECT MAX(id) FROM sertifikat_pegawai))');
        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER id SET DEFAULT nextval(\'sertifikat_pegawai_id_seq\')');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT FK_4748B294998300D9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT FK_4748B294A2019E78 FOREIGN KEY (sertifikat_id) REFERENCES sertifikat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT FK_4748B2947AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4748B2947AADDBC ON sertifikat_pegawai (diklat_id)');
        $this->addSql('ALTER TABLE lisensi_kompetensi DROP CONSTRAINT lisensi_kompetensi_kompetensi_id_fkey');
        $this->addSql('ALTER TABLE lisensi_kompetensi DROP CONSTRAINT lisensi_kompetensi_lisensi_id_fkey');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT FK_3055FA586543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT FK_3055FA5870621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_studi DROP CONSTRAINT program_studi_instansi_id_fkey');
        $this->addSql('ALTER TABLE program_studi ADD CONSTRAINT FK_65A1F4DB10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT siswa_instansi_id_fkey');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT siswa_program_studi_id_fkey');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT FK_3202BD7D10675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT FK_3202BD7D369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT penawaran_siswa_instansi_id_fkey');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT penawaran_siswa_jabatan_id_fkey');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT penawaran_siswa_siswa_id_fkey');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A3410675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A34850D8FD8 FOREIGN KEY (siswa_id) REFERENCES siswa (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT FK_674A6A34A7400487 FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE data_diklat DROP CONSTRAINT data_diklat_diklat_id_fkey');
        $this->addSql('ALTER TABLE data_diklat ADD CONSTRAINT FK_501F654F7AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pegawai DROP CONSTRAINT pegawai_instansi_id_fkey');
        $this->addSql('ALTER TABLE pegawai ADD CONSTRAINT FK_9883574810675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan DROP CONSTRAINT jabatan_instansi_id_fkey');
        $this->addSql('ALTER TABLE jabatan ADD CONSTRAINT FK_947E725410675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diklat DROP CONSTRAINT diklat_instansi_id_fkey');
        $this->addSql('ALTER TABLE diklat ADD CONSTRAINT FK_30E1545610675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_diklat DROP CONSTRAINT kompetensi_diklat_diklat_id_fkey');
        $this->addSql('ALTER TABLE lisensi_diklat DROP CONSTRAINT lisensi_diklat_lisensi_id_fkey');
        $this->addSql('ALTER TABLE lisensi_diklat ADD CONSTRAINT FK_11B8C2E37AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_diklat ADD CONSTRAINT FK_11B8C2E370621ED8 FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fungsi_pekerjaan DROP CONSTRAINT fungsi_pekerjaan_instansi_id_fkey');
        $this->addSql('ALTER TABLE fungsi_pekerjaan ADD CONSTRAINT FK_4674135810675A27 FOREIGN KEY (instansi_id) REFERENCES instansi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT peserta_diklat_diklat_id_fkey');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT FK_4D53C1437AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT FK_4D53C143998300D9 FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4D53C143998300D9 ON peserta_diklat (pegawai_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE kompetensi_pekerjaan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE kompetensi_prodi_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE link_and_match_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lisensi_pekerjaan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE riwayat_penawaran_siswa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE kompetensi_diklat');
        $this->addSql('ALTER TABLE fungsi_pekerjaan DROP CONSTRAINT FK_4674135810675A27');
        $this->addSql('ALTER TABLE fungsi_pekerjaan ADD CONSTRAINT fungsi_pekerjaan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan DROP CONSTRAINT FK_992EB59CA7400487');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan DROP CONSTRAINT FK_992EB59C32694EC9');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT jabatan_fungsi_pekerjaan_fungsi_pekerjaan_id_fkey FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES fungsi_pekerjaan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan ADD CONSTRAINT jabatan_fungsi_pekerjaan_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dosen DROP CONSTRAINT FK_2DE2C47110675A27');
        $this->addSql('ALTER TABLE dosen ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE dosen ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diklat DROP CONSTRAINT FK_30E1545610675A27');
        $this->addSql('ALTER TABLE diklat ADD CONSTRAINT diklat_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi DROP CONSTRAINT FK_A1A42E53D72CD30F');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi DROP CONSTRAINT FK_A1A42E5370621ED8');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER id TYPE INT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id TYPE BIGINT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ALTER jabatan_fungsi_pekerjaan_id DROP DEFAULT');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT jabatan_fungsi_pekerjaan_lisen_jabatan_fungsi_pekerjaan_id_fkey FOREIGN KEY (jabatan_fungsi_pekerjaan_id) REFERENCES jabatan_fungsi_pekerjaan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan_fungsi_pekerjaan_lisensi ADD CONSTRAINT jabatan_fungsi_pekerjaan_lisensi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_studi DROP CONSTRAINT FK_65A1F4DB10675A27');
        $this->addSql('ALTER TABLE program_studi ADD CONSTRAINT program_studi_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feeder DROP CONSTRAINT FK_DB1A5EE6C58274CE');
        $this->addSql('ALTER TABLE feeder ALTER id TYPE INT');
        $this->addSql('ALTER TABLE feeder ADD CONSTRAINT feeder_pengguna_id_fkey FOREIGN KEY (pengguna_id) REFERENCES pengguna (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jabatan DROP CONSTRAINT FK_947E725410675A27');
        $this->addSql('ALTER TABLE jabatan ADD CONSTRAINT jabatan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_program_studi DROP CONSTRAINT FK_65519DF4369CA843');
        $this->addSql('ALTER TABLE kompetensi_program_studi DROP CONSTRAINT FK_65519DF46543E6FC');
        $this->addSql('DROP INDEX IDX_65519DF46543E6FC');
        $this->addSql('ALTER TABLE kompetensi_program_studi ADD CONSTRAINT kompetensi_prodi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT FK_F15E046370621ED8');
        $this->addSql('ALTER TABLE lisensi_program_studi DROP CONSTRAINT FK_F15E0463369CA843');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT lisensi_program_studi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_program_studi ADD CONSTRAINT lisensi_program_studi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE data_diklat DROP CONSTRAINT FK_501F654F7AADDBC');
        $this->addSql('ALTER TABLE data_diklat ADD CONSTRAINT data_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES diklat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT FK_3202BD7D10675A27');
        $this->addSql('ALTER TABLE siswa DROP CONSTRAINT FK_3202BD7D369CA843');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE siswa ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_kompetensi DROP CONSTRAINT FK_3055FA586543E6FC');
        $this->addSql('ALTER TABLE lisensi_kompetensi DROP CONSTRAINT FK_3055FA5870621ED8');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT lisensi_kompetensi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_kompetensi ADD CONSTRAINT lisensi_kompetensi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A3410675A27');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A34850D8FD8');
        $this->addSql('ALTER TABLE penawaran_siswa DROP CONSTRAINT FK_674A6A34A7400487');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT penawaran_siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT penawaran_siswa_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES jabatan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE penawaran_siswa ADD CONSTRAINT penawaran_siswa_siswa_id_fkey FOREIGN KEY (siswa_id) REFERENCES siswa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT FK_4D53C1437AADDBC');
        $this->addSql('ALTER TABLE peserta_diklat DROP CONSTRAINT FK_4D53C143998300D9');
        $this->addSql('DROP INDEX IDX_4D53C143998300D9');
        $this->addSql('ALTER TABLE peserta_diklat ADD CONSTRAINT peserta_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES diklat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_diklat DROP CONSTRAINT FK_11B8C2E37AADDBC');
        $this->addSql('ALTER TABLE lisensi_diklat DROP CONSTRAINT FK_11B8C2E370621ED8');
        $this->addSql('ALTER TABLE lisensi_diklat ADD CONSTRAINT kompetensi_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES diklat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lisensi_diklat ADD CONSTRAINT lisensi_diklat_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES lisensi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT FK_4748B294998300D9');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT FK_4748B294A2019E78');
        $this->addSql('ALTER TABLE sertifikat_pegawai DROP CONSTRAINT FK_4748B2947AADDBC');
        $this->addSql('DROP INDEX IDX_4748B2947AADDBC');
        $this->addSql('ALTER TABLE sertifikat_pegawai ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT sertifikat_pegawai_pegawai_id_fkey FOREIGN KEY (pegawai_id) REFERENCES pegawai (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sertifikat_pegawai ADD CONSTRAINT sertifikat_pegawai_sertifikat_id_fkey FOREIGN KEY (sertifikat_id) REFERENCES sertifikat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pegawai DROP CONSTRAINT FK_9883574810675A27');
        $this->addSql('ALTER TABLE pegawai ADD CONSTRAINT pegawai_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pengguna DROP CONSTRAINT FK_3C109A2A10675A27');
        $this->addSql('ALTER TABLE pengguna ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE pengguna ADD CONSTRAINT pengguna_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES instansi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F12C90B1EA');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F1B03CEC44');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F1F4A8E0B2');
        $this->addSql('ALTER TABLE kompetensi DROP CONSTRAINT FK_C47776F13A3E13D7');
        $this->addSql('ALTER TABLE kompetensi ALTER moda TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT kompetensi_kompetensi_fungsi_kunci_id_fkey FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES kompetensi_fungsi_kunci (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT kompetensi_kompetensi_fungsi_utama_id_fkey FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES kompetensi_fungsi_utama (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT kompetensi_kompetensi_tujuan_utama_id_fkey FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES kompetensi_tujuan_utama (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi ADD CONSTRAINT kompetensi_kompetensi_unit_id_fkey FOREIGN KEY (kompetensi_unit_id) REFERENCES kompetensi_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
