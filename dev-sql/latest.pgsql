--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

-- Started on 2019-10-09 18:45:22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_program_studi_id_fkey;
ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_instansi_id_fkey;
ALTER TABLE ONLY public.sertifikat DROP CONSTRAINT sertifikat_pegawai_id_fkey;
ALTER TABLE ONLY public.relasi_kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_program_studi_id_fkey;
ALTER TABLE ONLY public.relasi_kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_kompetensi_id_fkey;
ALTER TABLE ONLY public.relasi_kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_kompetensi_id_fkey;
ALTER TABLE ONLY public.relasi_kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_diklat_id_fkey;
ALTER TABLE ONLY public.relasi_job_kompetensi DROP CONSTRAINT relasi_job_kompetensi_lisensi_id_fkey;
ALTER TABLE ONLY public.relasi_job_kompetensi DROP CONSTRAINT relasi_job_kompetensi_kompetensi_id_fkey;
ALTER TABLE ONLY public.relasi_job_kompetensi DROP CONSTRAINT relasi_job_kompetensi_fungsi_pekerjaan_id_fkey;
ALTER TABLE ONLY public.penawaran_siswa DROP CONSTRAINT penawaran_siswa_siswa_id_fkey;
ALTER TABLE ONLY public.penawaran_siswa DROP CONSTRAINT penawaran_siswa_jabatan_id_fkey;
ALTER TABLE ONLY public.penawaran_siswa DROP CONSTRAINT penawaran_siswa_instansi_id_fkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_sertifikat_id_fkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_sekolah_id_fkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_instansi_id_fkey;
ALTER TABLE ONLY public.lisensi_program_studi DROP CONSTRAINT lisensi_program_studi_program_studi_id_fkey;
ALTER TABLE ONLY public.lisensi_program_studi DROP CONSTRAINT lisensi_program_studi_lisensi_id_fkey;
ALTER TABLE ONLY public.lisensi_pekerjaan DROP CONSTRAINT lisensi_pekerjaan_jabatan_id_fkey;
ALTER TABLE ONLY public.kompetensi DROP CONSTRAINT kompetensi_unit_id;
ALTER TABLE ONLY public.kompetensi DROP CONSTRAINT kompetensi_tujuan_utama_id;
ALTER TABLE ONLY public.kompetensi DROP CONSTRAINT kompetensi_fungsi_utama_id;
ALTER TABLE ONLY public.kompetensi DROP CONSTRAINT kompetensi_fungsi_kunci_id;
ALTER TABLE ONLY public.jabatan DROP CONSTRAINT jabatan_instansi_id_fkey;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.fungsi_pekerjaan DROP CONSTRAINT fungsi_pekerjaan_instansi_id_fkey;
ALTER TABLE ONLY public.feeder DROP CONSTRAINT feeder_pengguna_id_fkey;
ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_id;
ALTER TABLE ONLY public.sertifikat DROP CONSTRAINT sertifikat_id;
ALTER TABLE ONLY public.relasi_kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_id;
ALTER TABLE ONLY public.relasi_kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_id;
ALTER TABLE ONLY public.relasi_job_kompetensi DROP CONSTRAINT relasi_job_kompetensi_id;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_id;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_id;
ALTER TABLE ONLY public.penawaran_siswa DROP CONSTRAINT penawaran_siswa_id;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_id;
ALTER TABLE ONLY public.lisensi_program_studi DROP CONSTRAINT lisensi_program_studi_id;
ALTER TABLE ONLY public.lisensi_pekerjaan DROP CONSTRAINT lisensi_pekerjaan_id;
ALTER TABLE ONLY public.lisensi DROP CONSTRAINT lisensi_id;
ALTER TABLE ONLY public.kompetensi_unit DROP CONSTRAINT kompetensi_unit_id;
ALTER TABLE ONLY public.kompetensi_tujuan_utama DROP CONSTRAINT kompetensi_tujuan_utama_id;
ALTER TABLE ONLY public.kompetensi DROP CONSTRAINT kompetensi_id;
ALTER TABLE ONLY public.kompetensi_fungsi_utama DROP CONSTRAINT kompetensi_fungsi_utama_id;
ALTER TABLE ONLY public.kompetensi_fungsi_kunci DROP CONSTRAINT kompetensi_fungsi_kunci_id;
ALTER TABLE ONLY public.jabatan DROP CONSTRAINT jabatan_id;
ALTER TABLE ONLY public.instansi DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.fungsi_pekerjaan DROP CONSTRAINT fungsi_pekerjaan_id;
ALTER TABLE ONLY public.feeder DROP CONSTRAINT feeder_id;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT dosen_id;
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_id;
ALTER TABLE ONLY public.data_diklat DROP CONSTRAINT data_diklat_id;
ALTER TABLE public.penawaran_siswa ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.feeder ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.siswa_id_seq;
DROP TABLE public.siswa;
DROP TABLE public.sertifikat;
DROP SEQUENCE public.sertifikat_id_seq;
DROP TABLE public.relasi_kompetensi_prodi;
DROP SEQUENCE public.relasi_kompetensi_prodi_id_seq;
DROP TABLE public.relasi_kompetensi_diklat;
DROP SEQUENCE public.relasi_kompetensi_diklat_id_seq;
DROP TABLE public.relasi_job_kompetensi;
DROP SEQUENCE public.relasi_job_kompetensi_id_seq;
DROP SEQUENCE public.program_studi_id_seq;
DROP TABLE public.program_studi;
DROP SEQUENCE public.pengguna_id_seq;
DROP TABLE public.pengguna;
DROP SEQUENCE public.penawaran_siswa_id_seq;
DROP TABLE public.penawaran_siswa;
DROP TABLE public.pegawai;
DROP SEQUENCE public.pegawai_id_seq;
DROP TABLE public.lisensi_program_studi;
DROP SEQUENCE public.lisensi_program_studi_id_seq;
DROP TABLE public.lisensi_pekerjaan;
DROP SEQUENCE public.lisensi_pekerjaan_id_seq;
DROP TABLE public.lisensi;
DROP SEQUENCE public.lisensi_id_seq;
DROP TABLE public.kompetensi_unit;
DROP SEQUENCE public.kompetensi_unit_id_seq;
DROP TABLE public.kompetensi_tujuan_utama;
DROP SEQUENCE public.kompetensi_tujuan_utama_id_seq;
DROP TABLE public.kompetensi_fungsi_utama;
DROP SEQUENCE public.kompetensi_fungsi_utama_id_seq;
DROP TABLE public.kompetensi_fungsi_kunci;
DROP SEQUENCE public.kompetensi_fungsi_kunci_id_seq;
DROP TABLE public.kompetensi;
DROP SEQUENCE public.kompetensi_id_seq;
DROP TABLE public.jabatan;
DROP SEQUENCE public.jabatan_id_seq;
DROP SEQUENCE public.instansi_id_seq;
DROP TABLE public.instansi;
DROP TABLE public.fungsi_pekerjaan;
DROP SEQUENCE public.fungsi_pekerjaan_id_seq;
DROP SEQUENCE public.feeder_id_seq;
DROP TABLE public.feeder;
DROP SEQUENCE public.dosen_id_seq;
DROP TABLE public.dosen;
DROP SEQUENCE public.diklat_id_seq;
DROP TABLE public.diklat;
DROP TABLE public.data_diklat;
DROP SEQUENCE public.data_diklat_id_seq;
--
-- TOC entry 238 (class 1259 OID 16898)
-- Name: data_diklat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.data_diklat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.data_diklat_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 239 (class 1259 OID 16900)
-- Name: data_diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.data_diklat (
    id integer DEFAULT nextval('public.data_diklat_id_seq'::regclass) NOT NULL,
    diklat_id bigint NOT NULL,
    tanggal_mulai date NOT NULL,
    tanggal_selesai date NOT NULL,
    target_jumlah_peserta bigint,
    realisasi_jumlah_peserta bigint,
    syarat_peserta text,
    target_peserta text,
    output_diklat text,
    outcome_siklat text
);


ALTER TABLE public.data_diklat OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16470)
-- Name: diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diklat (
    id bigint NOT NULL,
    instansi_id bigint,
    nama character varying NOT NULL,
    tipe character varying NOT NULL
);


ALTER TABLE public.diklat OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 16476)
-- Name: diklat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.diklat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diklat_id_seq OWNER TO postgres;

--
-- TOC entry 3111 (class 0 OID 0)
-- Dependencies: 198
-- Name: diklat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diklat_id_seq OWNED BY public.diklat.id;


--
-- TOC entry 199 (class 1259 OID 16490)
-- Name: dosen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dosen (
    id bigint NOT NULL,
    instansi_id bigint,
    kode character varying,
    nip character varying,
    nama character varying NOT NULL,
    gelar_depan character varying,
    gelar_belakang character varying,
    tanggal_lahir date,
    no_ktp character varying,
    nidn character varying
);


ALTER TABLE public.dosen OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 16441)
-- Name: dosen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dosen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dosen_id_seq OWNER TO postgres;

--
-- TOC entry 3112 (class 0 OID 0)
-- Dependencies: 196
-- Name: dosen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dosen_id_seq OWNED BY public.dosen.id;


--
-- TOC entry 241 (class 1259 OID 17043)
-- Name: feeder; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.feeder (
    id bigint NOT NULL,
    nama_file character varying NOT NULL,
    pengguna_id bigint NOT NULL,
    status character varying,
    created_at date
);


ALTER TABLE public.feeder OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 17041)
-- Name: feeder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.feeder_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.feeder_id_seq OWNER TO postgres;

--
-- TOC entry 3113 (class 0 OID 0)
-- Dependencies: 240
-- Name: feeder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.feeder_id_seq OWNED BY public.feeder.id;


--
-- TOC entry 226 (class 1259 OID 16846)
-- Name: fungsi_pekerjaan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fungsi_pekerjaan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.fungsi_pekerjaan_id_seq OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 16848)
-- Name: fungsi_pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fungsi_pekerjaan (
    id integer DEFAULT nextval('public.fungsi_pekerjaan_id_seq'::regclass) NOT NULL,
    instansi_id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL
);


ALTER TABLE public.fungsi_pekerjaan OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16496)
-- Name: instansi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.instansi (
    id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL,
    singkatan character varying,
    tipe character varying NOT NULL,
    moda character varying NOT NULL,
    alamat character varying,
    foto character varying,
    deskripsi character varying
);


ALTER TABLE public.instansi OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16502)
-- Name: instansi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.instansi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instansi_id_seq OWNER TO postgres;

--
-- TOC entry 3114 (class 0 OID 0)
-- Dependencies: 201
-- Name: instansi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instansi_id_seq OWNED BY public.instansi.id;


--
-- TOC entry 224 (class 1259 OID 16835)
-- Name: jabatan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jabatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.jabatan_id_seq OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16837)
-- Name: jabatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jabatan (
    id integer DEFAULT nextval('public.jabatan_id_seq'::regclass) NOT NULL,
    instansi_id bigint NOT NULL,
    nama character varying NOT NULL
);


ALTER TABLE public.jabatan OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16718)
-- Name: kompetensi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kompetensi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.kompetensi_id_seq OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16720)
-- Name: kompetensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi (
    id integer DEFAULT nextval('public.kompetensi_id_seq'::regclass) NOT NULL,
    moda character varying(30) NOT NULL,
    kompetensi_tujuan_utama_id bigint NOT NULL,
    kompetensi_fungsi_kunci_id bigint NOT NULL,
    kompetensi_fungsi_utama_id bigint NOT NULL,
    kompetensi_unit_id bigint NOT NULL,
    tipe_kompetensi character varying NOT NULL
);


ALTER TABLE public.kompetensi OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 16729)
-- Name: kompetensi_fungsi_kunci_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kompetensi_fungsi_kunci_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.kompetensi_fungsi_kunci_id_seq OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16731)
-- Name: kompetensi_fungsi_kunci; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_kunci (
    id integer DEFAULT nextval('public.kompetensi_fungsi_kunci_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    fungsi_kunci text NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_kunci OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 16740)
-- Name: kompetensi_fungsi_utama_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kompetensi_fungsi_utama_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.kompetensi_fungsi_utama_id_seq OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16742)
-- Name: kompetensi_fungsi_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_utama (
    id integer DEFAULT nextval('public.kompetensi_fungsi_utama_id_seq'::regclass) NOT NULL,
    kode integer NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_utama OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16746)
-- Name: kompetensi_tujuan_utama_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kompetensi_tujuan_utama_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.kompetensi_tujuan_utama_id_seq OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16748)
-- Name: kompetensi_tujuan_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_tujuan_utama (
    id integer DEFAULT nextval('public.kompetensi_tujuan_utama_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    tujuan_utama text NOT NULL
);


ALTER TABLE public.kompetensi_tujuan_utama OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16758)
-- Name: kompetensi_unit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kompetensi_unit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.kompetensi_unit_id_seq OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16760)
-- Name: kompetensi_unit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_unit (
    id integer DEFAULT nextval('public.kompetensi_unit_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    kompetensi text NOT NULL
);


ALTER TABLE public.kompetensi_unit OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16791)
-- Name: lisensi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lisensi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.lisensi_id_seq OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16793)
-- Name: lisensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi (
    id integer DEFAULT nextval('public.lisensi_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    induk bigint,
    nama character varying NOT NULL,
    bab character varying NOT NULL,
    moda character varying NOT NULL
);


ALTER TABLE public.lisensi OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 16857)
-- Name: lisensi_pekerjaan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lisensi_pekerjaan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.lisensi_pekerjaan_id_seq OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 16859)
-- Name: lisensi_pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi_pekerjaan (
    id integer DEFAULT nextval('public.lisensi_pekerjaan_id_seq'::regclass) NOT NULL,
    jabatan_id bigint NOT NULL,
    fungsi_pekerjaan_id bigint NOT NULL,
    lisensi_id bigint NOT NULL,
    kode character varying,
    kepala character varying,
    nama character varying NOT NULL,
    pendidikan_minimal character varying,
    ipk_minimal character varying,
    keterangan character varying
);


ALTER TABLE public.lisensi_pekerjaan OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 16868)
-- Name: lisensi_program_studi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lisensi_program_studi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.lisensi_program_studi_id_seq OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 16870)
-- Name: lisensi_program_studi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi_program_studi (
    id integer DEFAULT nextval('public.lisensi_program_studi_id_seq'::regclass) NOT NULL,
    lisensi_id bigint NOT NULL,
    program_studi_id bigint NOT NULL
);


ALTER TABLE public.lisensi_program_studi OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 16824)
-- Name: pegawai_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pegawai_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.pegawai_id_seq OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16826)
-- Name: pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pegawai (
    id integer DEFAULT nextval('public.pegawai_id_seq'::regclass) NOT NULL,
    sekolah_id bigint NOT NULL,
    instansi_id bigint NOT NULL,
    sertifikat_id bigint NOT NULL,
    kode character varying NOT NULL,
    nama character varying,
    "no_KTP" character varying NOT NULL,
    jenis_kelamin character varying,
    tempat_lahir character varying,
    tanggal_lahir date,
    bahasa character varying,
    kewarganegaraan character varying
);


ALTER TABLE public.pegawai OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 17059)
-- Name: penawaran_siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.penawaran_siswa (
    id integer NOT NULL,
    instansi_id bigint NOT NULL,
    siswa_id bigint NOT NULL,
    jabatan_id bigint NOT NULL,
    status boolean,
    tanggal_input timestamp without time zone,
    tanggal_update timestamp without time zone,
    sudah_diemail boolean,
    tanggal_email timestamp without time zone
);


ALTER TABLE public.penawaran_siswa OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 17057)
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.penawaran_siswa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.penawaran_siswa_id_seq OWNER TO postgres;

--
-- TOC entry 3115 (class 0 OID 0)
-- Dependencies: 242
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.penawaran_siswa_id_seq OWNED BY public.penawaran_siswa.id;


--
-- TOC entry 202 (class 1259 OID 16504)
-- Name: pengguna; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengguna (
    id bigint NOT NULL,
    instansi_id bigint,
    email character varying NOT NULL,
    password character varying NOT NULL,
    otoritas character varying NOT NULL,
    aktif character varying NOT NULL,
    hapus character varying NOT NULL,
    nama character varying,
    foto character varying,
    bahasa character varying NOT NULL
);


ALTER TABLE public.pengguna OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16510)
-- Name: pengguna_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengguna_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pengguna_id_seq OWNER TO postgres;

--
-- TOC entry 3116 (class 0 OID 0)
-- Dependencies: 203
-- Name: pengguna_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengguna_id_seq OWNED BY public.pengguna.id;


--
-- TOC entry 204 (class 1259 OID 16512)
-- Name: program_studi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.program_studi (
    id bigint NOT NULL,
    instansi_id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL,
    jenjang character varying NOT NULL
);


ALTER TABLE public.program_studi OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16518)
-- Name: program_studi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.program_studi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.program_studi_id_seq OWNER TO postgres;

--
-- TOC entry 3117 (class 0 OID 0)
-- Dependencies: 205
-- Name: program_studi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.program_studi_id_seq OWNED BY public.program_studi.id;


--
-- TOC entry 234 (class 1259 OID 16883)
-- Name: relasi_job_kompetensi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.relasi_job_kompetensi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.relasi_job_kompetensi_id_seq OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 16885)
-- Name: relasi_job_kompetensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_job_kompetensi (
    id integer DEFAULT nextval('public.relasi_job_kompetensi_id_seq'::regclass) NOT NULL,
    fungsi_pekerjaan_id bigint NOT NULL,
    lisensi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL,
    pendidikan_minimal character varying,
    ipk_minimal character varying,
    keterangan character varying
);


ALTER TABLE public.relasi_job_kompetensi OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 16892)
-- Name: relasi_kompetensi_diklat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.relasi_kompetensi_diklat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.relasi_kompetensi_diklat_id_seq OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 16894)
-- Name: relasi_kompetensi_diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_kompetensi_diklat (
    id integer DEFAULT nextval('public.relasi_kompetensi_diklat_id_seq'::regclass) NOT NULL,
    diklat_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.relasi_kompetensi_diklat OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 16876)
-- Name: relasi_kompetensi_prodi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.relasi_kompetensi_prodi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.relasi_kompetensi_prodi_id_seq OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 16878)
-- Name: relasi_kompetensi_prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_kompetensi_prodi (
    id integer DEFAULT nextval('public.relasi_kompetensi_prodi_id_seq'::regclass) NOT NULL,
    program_studi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.relasi_kompetensi_prodi OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 16813)
-- Name: sertifikat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sertifikat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.sertifikat_id_seq OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16815)
-- Name: sertifikat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sertifikat (
    id integer DEFAULT nextval('public.sertifikat_id_seq'::regclass) NOT NULL,
    pegawai_id bigint NOT NULL,
    nama character varying NOT NULL,
    masa_berlaku date NOT NULL
);


ALTER TABLE public.sertifikat OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16520)
-- Name: siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa (
    id bigint NOT NULL,
    instansi_id bigint NOT NULL,
    program_studi_id bigint,
    kode character varying,
    nama character varying NOT NULL,
    periode_masuk character varying,
    tahun_kurikulum character varying,
    tanggal_lahir date,
    kelas character varying,
    ipk character varying,
    no_ktp character varying,
    status character varying,
    tahun_lulus character varying
);


ALTER TABLE public.siswa OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16526)
-- Name: siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.siswa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.siswa_id_seq OWNER TO postgres;

--
-- TOC entry 3118 (class 0 OID 0)
-- Dependencies: 207
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- TOC entry 2858 (class 2604 OID 17046)
-- Name: feeder id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder ALTER COLUMN id SET DEFAULT nextval('public.feeder_id_seq'::regclass);


--
-- TOC entry 2859 (class 2604 OID 17062)
-- Name: penawaran_siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa ALTER COLUMN id SET DEFAULT nextval('public.penawaran_siswa_id_seq'::regclass);


--
-- TOC entry 3101 (class 0 OID 16900)
-- Dependencies: 239
-- Data for Name: data_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.data_diklat (id, diklat_id, tanggal_mulai, tanggal_selesai, target_jumlah_peserta, realisasi_jumlah_peserta, syarat_peserta, target_peserta, output_diklat, outcome_siklat) FROM stdin;
\.


--
-- TOC entry 3059 (class 0 OID 16470)
-- Dependencies: 197
-- Data for Name: diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diklat (id, instansi_id, nama, tipe) FROM stdin;
\.


--
-- TOC entry 3061 (class 0 OID 16490)
-- Dependencies: 199
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen (id, instansi_id, nip, nama, gelar_depan, gelar_belakang, tanggal_lahir, no_ktp, nidn) FROM stdin;
\.


--
-- TOC entry 3103 (class 0 OID 17043)
-- Dependencies: 241
-- Data for Name: feeder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.feeder (id, pengguna_id, nama_file, status, created_at) FROM stdin;
\.


--
-- TOC entry 3089 (class 0 OID 16848)
-- Dependencies: 227
-- Data for Name: fungsi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fungsi_pekerjaan (id, instansi_id, kode, nama) FROM stdin;
\.


--
-- TOC entry 3062 (class 0 OID 16496)
-- Dependencies: 200
-- Data for Name: instansi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instansi (id, kode, nama, singkatan, tipe, moda, alamat, foto, deskripsi) FROM stdin;
\.


--
-- TOC entry 3087 (class 0 OID 16837)
-- Dependencies: 225
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jabatan (id, instansi_id, nama) FROM stdin;
\.


--
-- TOC entry 3071 (class 0 OID 16720)
-- Dependencies: 209
-- Data for Name: kompetensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi (id, moda, kompetensi_tujuan_utama_id, kompetensi_fungsi_kunci_id, kompetensi_fungsi_utama_id, kompetensi_unit_id, tipe_kompetensi) FROM stdin;
\.


--
-- TOC entry 3073 (class 0 OID 16731)
-- Dependencies: 211
-- Data for Name: kompetensi_fungsi_kunci; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_kunci (id, kode, fungsi_kunci) FROM stdin;
\.


--
-- TOC entry 3075 (class 0 OID 16742)
-- Dependencies: 213
-- Data for Name: kompetensi_fungsi_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_utama (id, kode) FROM stdin;
\.


--
-- TOC entry 3077 (class 0 OID 16748)
-- Dependencies: 215
-- Data for Name: kompetensi_tujuan_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_tujuan_utama (id, kode, tujuan_utama) FROM stdin;
\.


--
-- TOC entry 3079 (class 0 OID 16760)
-- Dependencies: 217
-- Data for Name: kompetensi_unit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_unit (id, kode, kompetensi) FROM stdin;
\.


--
-- TOC entry 3081 (class 0 OID 16793)
-- Dependencies: 219
-- Data for Name: lisensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi (id, kode, induk, nama, bab, moda) FROM stdin;
\.


--
-- TOC entry 3091 (class 0 OID 16859)
-- Dependencies: 229
-- Data for Name: lisensi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_pekerjaan (id, jabatan_id, fungsi_pekerjaan_id, lisensi_id, kode, kepala, nama, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- TOC entry 3093 (class 0 OID 16870)
-- Dependencies: 231
-- Data for Name: lisensi_program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_program_studi (id, lisensi_id, program_studi_id) FROM stdin;
\.


--
-- TOC entry 3085 (class 0 OID 16826)
-- Dependencies: 223
-- Data for Name: pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pegawai (id, sekolah_id, instansi_id, sertifikat_id, kode, nama, "no_KTP", jenis_kelamin, tempat_lahir, tanggal_lahir, bahasa, kewarganegaraan) FROM stdin;
\.


--
-- TOC entry 3105 (class 0 OID 17059)
-- Dependencies: 243
-- Data for Name: penawaran_siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.penawaran_siswa (id, instansi_id, siswa_id, jabatan_id, status, tanggal_input, tanggal_update, sudah_diemail, tanggal_email) FROM stdin;
\.


--
-- TOC entry 3064 (class 0 OID 16504)
-- Dependencies: 202
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengguna (id, instansi_id, email, password, otoritas, aktif, hapus, nama, foto, bahasa) FROM stdin;
\.


--
-- TOC entry 3066 (class 0 OID 16512)
-- Dependencies: 204
-- Data for Name: program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.program_studi (id, instansi_id, kode, nama, jenjang) FROM stdin;
\.


--
-- TOC entry 3097 (class 0 OID 16885)
-- Dependencies: 235
-- Data for Name: relasi_job_kompetensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_job_kompetensi (id, fungsi_pekerjaan_id, lisensi_id, kompetensi_id, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- TOC entry 3099 (class 0 OID 16894)
-- Dependencies: 237
-- Data for Name: relasi_kompetensi_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_kompetensi_diklat (id, diklat_id, kompetensi_id) FROM stdin;
\.


--
-- TOC entry 3095 (class 0 OID 16878)
-- Dependencies: 233
-- Data for Name: relasi_kompetensi_prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_kompetensi_prodi (id, program_studi_id, kompetensi_id) FROM stdin;
\.


--
-- TOC entry 3083 (class 0 OID 16815)
-- Dependencies: 221
-- Data for Name: sertifikat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sertifikat (id, pegawai_id, nama, masa_berlaku) FROM stdin;
\.


--
-- TOC entry 3068 (class 0 OID 16520)
-- Dependencies: 206
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, instansi_id, program_studi_id, kode, nama, periode_masuk, tahun_kurikulum, tanggal_lahir, kelas, ipk, no_ktp, status, tahun_lulus) FROM stdin;
\.


--
-- TOC entry 3119 (class 0 OID 0)
-- Dependencies: 238
-- Name: data_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.data_diklat_id_seq', 1, false);


--
-- TOC entry 3120 (class 0 OID 0)
-- Dependencies: 198
-- Name: diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diklat_id_seq', 1, false);


--
-- TOC entry 3121 (class 0 OID 0)
-- Dependencies: 196
-- Name: dosen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_seq', 1, false);


--
-- TOC entry 3122 (class 0 OID 0)
-- Dependencies: 240
-- Name: feeder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.feeder_id_seq', 1, false);


--
-- TOC entry 3123 (class 0 OID 0)
-- Dependencies: 226
-- Name: fungsi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fungsi_pekerjaan_id_seq', 1, false);


--
-- TOC entry 3124 (class 0 OID 0)
-- Dependencies: 201
-- Name: instansi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instansi_id_seq', 1, false);


--
-- TOC entry 3125 (class 0 OID 0)
-- Dependencies: 224
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jabatan_id_seq', 1, false);


--
-- TOC entry 3126 (class 0 OID 0)
-- Dependencies: 210
-- Name: kompetensi_fungsi_kunci_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_kunci_id_seq', 1, false);


--
-- TOC entry 3127 (class 0 OID 0)
-- Dependencies: 212
-- Name: kompetensi_fungsi_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_utama_id_seq', 1, false);


--
-- TOC entry 3128 (class 0 OID 0)
-- Dependencies: 208
-- Name: kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_id_seq', 1, false);


--
-- TOC entry 3129 (class 0 OID 0)
-- Dependencies: 214
-- Name: kompetensi_tujuan_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_tujuan_utama_id_seq', 1, false);


--
-- TOC entry 3130 (class 0 OID 0)
-- Dependencies: 216
-- Name: kompetensi_unit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_unit_id_seq', 1, false);


--
-- TOC entry 3131 (class 0 OID 0)
-- Dependencies: 218
-- Name: lisensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_id_seq', 1, false);


--
-- TOC entry 3132 (class 0 OID 0)
-- Dependencies: 228
-- Name: lisensi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_pekerjaan_id_seq', 1, false);


--
-- TOC entry 3133 (class 0 OID 0)
-- Dependencies: 230
-- Name: lisensi_program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_program_studi_id_seq', 1, false);


--
-- TOC entry 3134 (class 0 OID 0)
-- Dependencies: 222
-- Name: pegawai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pegawai_id_seq', 1, false);


--
-- TOC entry 3135 (class 0 OID 0)
-- Dependencies: 242
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.penawaran_siswa_id_seq', 1, false);


--
-- TOC entry 3136 (class 0 OID 0)
-- Dependencies: 203
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, false);


--
-- TOC entry 3137 (class 0 OID 0)
-- Dependencies: 205
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 1, false);


--
-- TOC entry 3138 (class 0 OID 0)
-- Dependencies: 234
-- Name: relasi_job_kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_job_kompetensi_id_seq', 1, false);


--
-- TOC entry 3139 (class 0 OID 0)
-- Dependencies: 236
-- Name: relasi_kompetensi_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_diklat_id_seq', 1, false);


--
-- TOC entry 3140 (class 0 OID 0)
-- Dependencies: 232
-- Name: relasi_kompetensi_prodi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_prodi_id_seq', 1, false);


--
-- TOC entry 3141 (class 0 OID 0)
-- Dependencies: 220
-- Name: sertifikat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sertifikat_id_seq', 1, false);


--
-- TOC entry 3142 (class 0 OID 0)
-- Dependencies: 207
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 1, false);


--
-- TOC entry 2903 (class 2606 OID 16933)
-- Name: data_diklat data_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_diklat
    ADD CONSTRAINT data_diklat_id PRIMARY KEY (id);


--
-- TOC entry 2861 (class 2606 OID 16935)
-- Name: diklat diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_id PRIMARY KEY (id);


--
-- TOC entry 2863 (class 2606 OID 16926)
-- Name: dosen dosen_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_id PRIMARY KEY (id);


--
-- TOC entry 2905 (class 2606 OID 17051)
-- Name: feeder feeder_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_id PRIMARY KEY (id);


--
-- TOC entry 2891 (class 2606 OID 16856)
-- Name: fungsi_pekerjaan fungsi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_id PRIMARY KEY (id);


--
-- TOC entry 2865 (class 2606 OID 16912)
-- Name: instansi instansi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi
    ADD CONSTRAINT instansi_id PRIMARY KEY (id);


--
-- TOC entry 2889 (class 2606 OID 16845)
-- Name: jabatan jabatan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_id PRIMARY KEY (id);


--
-- TOC entry 2875 (class 2606 OID 16739)
-- Name: kompetensi_fungsi_kunci kompetensi_fungsi_kunci_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_kunci
    ADD CONSTRAINT kompetensi_fungsi_kunci_id PRIMARY KEY (id);


--
-- TOC entry 2877 (class 2606 OID 16780)
-- Name: kompetensi_fungsi_utama kompetensi_fungsi_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_utama
    ADD CONSTRAINT kompetensi_fungsi_utama_id PRIMARY KEY (id);


--
-- TOC entry 2873 (class 2606 OID 16728)
-- Name: kompetensi kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_id PRIMARY KEY (id);


--
-- TOC entry 2879 (class 2606 OID 16756)
-- Name: kompetensi_tujuan_utama kompetensi_tujuan_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_tujuan_utama
    ADD CONSTRAINT kompetensi_tujuan_utama_id PRIMARY KEY (id);


--
-- TOC entry 2881 (class 2606 OID 16768)
-- Name: kompetensi_unit kompetensi_unit_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_unit
    ADD CONSTRAINT kompetensi_unit_id PRIMARY KEY (id);


--
-- TOC entry 2883 (class 2606 OID 16801)
-- Name: lisensi lisensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi
    ADD CONSTRAINT lisensi_id PRIMARY KEY (id);


--
-- TOC entry 2893 (class 2606 OID 16867)
-- Name: lisensi_pekerjaan lisensi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_id PRIMARY KEY (id);


--
-- TOC entry 2895 (class 2606 OID 16875)
-- Name: lisensi_program_studi lisensi_program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_id PRIMARY KEY (id);


--
-- TOC entry 2887 (class 2606 OID 16834)
-- Name: pegawai pegawai_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_id PRIMARY KEY (id);


--
-- TOC entry 2907 (class 2606 OID 17064)
-- Name: penawaran_siswa penawaran_siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_id PRIMARY KEY (id);


--
-- TOC entry 2867 (class 2606 OID 16919)
-- Name: pengguna pengguna_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_id PRIMARY KEY (id);


--
-- TOC entry 2869 (class 2606 OID 16910)
-- Name: program_studi program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_id PRIMARY KEY (id);


--
-- TOC entry 2899 (class 2606 OID 16977)
-- Name: relasi_job_kompetensi relasi_job_kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_id PRIMARY KEY (id);


--
-- TOC entry 2901 (class 2606 OID 16994)
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_id PRIMARY KEY (id);


--
-- TOC entry 2897 (class 2606 OID 17006)
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_id PRIMARY KEY (id);


--
-- TOC entry 2885 (class 2606 OID 16823)
-- Name: sertifikat sertifikat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_id PRIMARY KEY (id);


--
-- TOC entry 2871 (class 2606 OID 17030)
-- Name: siswa siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_id PRIMARY KEY (id);


--
-- TOC entry 2933 (class 2606 OID 17052)
-- Name: feeder feeder_pengguna_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_pengguna_id_fkey FOREIGN KEY (pengguna_id) REFERENCES public.pengguna(id);


--
-- TOC entry 2922 (class 2606 OID 16936)
-- Name: fungsi_pekerjaan fungsi_pekerjaan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2910 (class 2606 OID 16913)
-- Name: program_studi instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- TOC entry 2909 (class 2606 OID 16920)
-- Name: pengguna instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- TOC entry 2908 (class 2606 OID 16927)
-- Name: dosen instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- TOC entry 2921 (class 2606 OID 16941)
-- Name: jabatan jabatan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2914 (class 2606 OID 16774)
-- Name: kompetensi kompetensi_fungsi_kunci_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_kunci_id FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES public.kompetensi_fungsi_kunci(id) NOT VALID;


--
-- TOC entry 2915 (class 2606 OID 16781)
-- Name: kompetensi kompetensi_fungsi_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_utama_id FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES public.kompetensi_fungsi_utama(id) NOT VALID;


--
-- TOC entry 2913 (class 2606 OID 16769)
-- Name: kompetensi kompetensi_tujuan_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_tujuan_utama_id FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES public.kompetensi_tujuan_utama(id) NOT VALID;


--
-- TOC entry 2916 (class 2606 OID 16786)
-- Name: kompetensi kompetensi_unit_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_unit_id FOREIGN KEY (kompetensi_unit_id) REFERENCES public.kompetensi_unit(id) NOT VALID;


--
-- TOC entry 2923 (class 2606 OID 16946)
-- Name: lisensi_pekerjaan lisensi_pekerjaan_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- TOC entry 2924 (class 2606 OID 16951)
-- Name: lisensi_program_studi lisensi_program_studi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- TOC entry 2925 (class 2606 OID 16956)
-- Name: lisensi_program_studi lisensi_program_studi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- TOC entry 2919 (class 2606 OID 16966)
-- Name: pegawai pegawai_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2918 (class 2606 OID 16961)
-- Name: pegawai pegawai_sekolah_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sekolah_id_fkey FOREIGN KEY (sekolah_id) REFERENCES public.instansi(id);


--
-- TOC entry 2920 (class 2606 OID 16971)
-- Name: pegawai pegawai_sertifikat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sertifikat_id_fkey FOREIGN KEY (sertifikat_id) REFERENCES public.sertifikat(id);


--
-- TOC entry 2934 (class 2606 OID 17065)
-- Name: penawaran_siswa penawaran_siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2936 (class 2606 OID 17075)
-- Name: penawaran_siswa penawaran_siswa_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- TOC entry 2935 (class 2606 OID 17070)
-- Name: penawaran_siswa penawaran_siswa_siswa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_siswa_id_fkey FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- TOC entry 2928 (class 2606 OID 16978)
-- Name: relasi_job_kompetensi relasi_job_kompetensi_fungsi_pekerjaan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_fungsi_pekerjaan_id_fkey FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES public.fungsi_pekerjaan(id);


--
-- TOC entry 2930 (class 2606 OID 16988)
-- Name: relasi_job_kompetensi relasi_job_kompetensi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2929 (class 2606 OID 16983)
-- Name: relasi_job_kompetensi relasi_job_kompetensi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- TOC entry 2931 (class 2606 OID 16995)
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_diklat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES public.diklat(id);


--
-- TOC entry 2932 (class 2606 OID 17000)
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2927 (class 2606 OID 17012)
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2926 (class 2606 OID 17007)
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- TOC entry 2917 (class 2606 OID 17024)
-- Name: sertifikat sertifikat_pegawai_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_pegawai_id_fkey FOREIGN KEY (pegawai_id) REFERENCES public.pegawai(id);


--
-- TOC entry 2911 (class 2606 OID 17031)
-- Name: siswa siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2912 (class 2606 OID 17036)
-- Name: siswa siswa_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


-- Completed on 2019-10-09 18:45:40

--
-- PostgreSQL database dump complete
--
