-- Adminer 4.7.3 PostgreSQL dump

DROP TABLE IF EXISTS "diklat";
DROP SEQUENCE IF EXISTS diklat_id_seq;
CREATE SEQUENCE diklat_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."diklat" (
    "id" bigint DEFAULT nextval('diklat_id_seq') NOT NULL,
    "instansi_id" bigint,
    "nama" character varying NOT NULL,
    CONSTRAINT "diklat_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "diklat_instansi_id_fkey" FOREIGN KEY (instansi_id) REFERENCES instansi(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "dosen";
DROP SEQUENCE IF EXISTS dosen_id_seq;
CREATE SEQUENCE dosen_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."dosen" (
    "id" bigint DEFAULT nextval('dosen_id_seq') NOT NULL,
    "instansi_id" bigint,
    "nip" character varying,
    "nama" character varying NOT NULL,
    "gelar_depan" character varying,
    "gelar_belakang" character varying,
    "tanggal_lahir" date,
    "no_ktp" character varying,
    "nidn" character varying,
    CONSTRAINT "dosen_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "dosen_instansi_id_fkey" FOREIGN KEY (instansi_id) REFERENCES instansi(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "instansi";
DROP SEQUENCE IF EXISTS instansi_id_seq;
CREATE SEQUENCE instansi_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."instansi" (
    "id" bigint DEFAULT nextval('instansi_id_seq') NOT NULL,
    "kode" character varying,
    "nama" character varying NOT NULL,
    "singkatan" character varying,
    "tipe" character varying NOT NULL,
    "moda" character varying NOT NULL,
    "alamat" character varying,
    CONSTRAINT "instansi_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "kompetensi";
DROP SEQUENCE IF EXISTS kompetensi_id_seq;
CREATE SEQUENCE kompetensi_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."kompetensi" (
    "id" integer DEFAULT nextval('kompetensi_id_seq') NOT NULL,
    "moda" character varying(30) NOT NULL,
    "kompetensi_tujuan_utama_id" bigint NOT NULL,
    "kompetensi_fungsi_kunci_id" bigint NOT NULL,
    "kompetensi_fungsi_utama_id" bigint NOT NULL,
    "kompetensi_unit_id" bigint NOT NULL,
    "tipe_kompetensi" character varying NOT NULL,
    CONSTRAINT "kompetensi_id" PRIMARY KEY ("id"),
    CONSTRAINT "kompetensi_id_fungsi_kunci_fkey" FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES kompetensi_fungsi_kunci(id) NOT DEFERRABLE,
    CONSTRAINT "kompetensi_id_tujuan_utama_fkey" FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES kompetensi_tujuan_utama(id) NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "kompetensi_fungsi_kunci";
DROP SEQUENCE IF EXISTS kompetensi_fungsi_kunci_id_seq;
CREATE SEQUENCE kompetensi_fungsi_kunci_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."kompetensi_fungsi_kunci" (
    "id" integer DEFAULT nextval('kompetensi_fungsi_kunci_id_seq') NOT NULL,
    "kode" character varying NOT NULL,
    "fungsi_kunci" text NOT NULL,
    CONSTRAINT "kompetensi_fungsi_kunci_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "kompetensi_fungsi_utama";
DROP SEQUENCE IF EXISTS kompetensi_fungsi_utama_id_seq;
CREATE SEQUENCE kompetensi_fungsi_utama_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."kompetensi_fungsi_utama" (
    "id" integer DEFAULT nextval('kompetensi_fungsi_utama_id_seq') NOT NULL,
    "kode" integer NOT NULL
) WITH (oids = false);


DROP TABLE IF EXISTS "kompetensi_tujuan_utama";
DROP SEQUENCE IF EXISTS kompetensi_tujuan_utama_id_seq;
CREATE SEQUENCE kompetensi_tujuan_utama_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."kompetensi_tujuan_utama" (
    "id" integer DEFAULT nextval('kompetensi_tujuan_utama_id_seq') NOT NULL,
    "kode" character varying NOT NULL,
    "tujuan_utama" text NOT NULL,
    CONSTRAINT "kompetensi_tujuan_utama_id" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "pengguna";
DROP SEQUENCE IF EXISTS pengguna_id_seq;
CREATE SEQUENCE pengguna_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."pengguna" (
    "id" bigint DEFAULT nextval('pengguna_id_seq') NOT NULL,
    "instansi_id" bigint,
    "email" character varying NOT NULL,
    "password" character varying NOT NULL,
    "otoritas" character varying NOT NULL,
    "aktif" character varying NOT NULL,
    "hapus" character varying NOT NULL,
    "nama" character varying,
    "foto" character varying,
    "bahasa" character varying NOT NULL,
    CONSTRAINT "pengguna_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "pengguna_instansi_id_fkey" FOREIGN KEY (instansi_id) REFERENCES instansi(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "program_studi";
DROP SEQUENCE IF EXISTS program_studi_id_seq;
CREATE SEQUENCE program_studi_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."program_studi" (
    "id" bigint DEFAULT nextval('program_studi_id_seq') NOT NULL,
    "instansi_id" bigint NOT NULL,
    "kode" character varying,
    "nama" character varying NOT NULL,
    "jenjang" character varying NOT NULL,
    CONSTRAINT "program_studi_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "program_studi_instansi_id_fkey" FOREIGN KEY (instansi_id) REFERENCES instansi(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


DROP TABLE IF EXISTS "siswa";
DROP SEQUENCE IF EXISTS siswa_id_seq;
CREATE SEQUENCE siswa_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."siswa" (
    "id" bigint DEFAULT nextval('siswa_id_seq') NOT NULL,
    "program_studi_id" bigint NOT NULL,
    "kode" character varying,
    "nama" character varying NOT NULL,
    "periode_masuk" character varying,
    "tahun_kurikulum" character varying,
    "tanggal_lahir" date,
    "kelas" character varying,
    "ipk" character varying,
    CONSTRAINT "siswa_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "siswa_program_studi_id_fkey" FOREIGN KEY (program_studi_id) REFERENCES program_studi(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);


-- 2019-10-02 15:35:53.0253+07
