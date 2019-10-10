--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

-- Started on 2019-10-10 15:56:01

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
ALTER TABLE ONLY public.kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_program_studi_id_fkey;
ALTER TABLE ONLY public.kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_kompetensi_id_fkey;
ALTER TABLE ONLY public.kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_kompetensi_id_fkey;
ALTER TABLE ONLY public.kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_diklat_id_fkey;
ALTER TABLE ONLY public.kompetensi_pekerjaan DROP CONSTRAINT relasi_job_kompetensi_lisensi_id_fkey;
ALTER TABLE ONLY public.kompetensi_pekerjaan DROP CONSTRAINT relasi_job_kompetensi_kompetensi_id_fkey;
ALTER TABLE ONLY public.kompetensi_pekerjaan DROP CONSTRAINT relasi_job_kompetensi_fungsi_pekerjaan_id_fkey;
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
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT instansi_id;
ALTER TABLE ONLY public.fungsi_pekerjaan DROP CONSTRAINT fungsi_pekerjaan_instansi_id_fkey;
ALTER TABLE ONLY public.feeder DROP CONSTRAINT feeder_pengguna_id_fkey;
ALTER TABLE ONLY public.data_diklat DROP CONSTRAINT data_diklat_diklat_id_fkey;
ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_id;
ALTER TABLE ONLY public.sertifikat DROP CONSTRAINT sertifikat_id;
ALTER TABLE ONLY public.kompetensi_prodi DROP CONSTRAINT relasi_kompetensi_prodi_id;
ALTER TABLE ONLY public.kompetensi_diklat DROP CONSTRAINT relasi_kompetensi_diklat_id;
ALTER TABLE ONLY public.kompetensi_pekerjaan DROP CONSTRAINT relasi_job_kompetensi_id;
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
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_id;
ALTER TABLE ONLY public.data_diklat DROP CONSTRAINT data_diklat_id;
ALTER TABLE public.siswa ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.program_studi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pengguna ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.instansi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.diklat ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.siswa_id_seq;
DROP TABLE public.siswa;
DROP TABLE public.sertifikat;
DROP SEQUENCE public.sertifikat_id_seq;
DROP SEQUENCE public.program_studi_id_seq;
DROP TABLE public.program_studi;
DROP SEQUENCE public.pengguna_id_seq;
DROP TABLE public.pengguna;
DROP TABLE public.penawaran_siswa;
DROP SEQUENCE public.penawaran_siswa_id_seq;
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
DROP TABLE public.kompetensi_prodi;
DROP SEQUENCE public.relasi_kompetensi_prodi_id_seq;
DROP TABLE public.kompetensi_pekerjaan;
DROP SEQUENCE public.relasi_job_kompetensi_id_seq;
DROP TABLE public.kompetensi_fungsi_utama;
DROP SEQUENCE public.kompetensi_fungsi_utama_id_seq;
DROP TABLE public.kompetensi_fungsi_kunci;
DROP SEQUENCE public.kompetensi_fungsi_kunci_id_seq;
DROP TABLE public.kompetensi_diklat;
DROP SEQUENCE public.relasi_kompetensi_diklat_id_seq;
DROP TABLE public.kompetensi;
DROP SEQUENCE public.kompetensi_id_seq;
DROP TABLE public.jabatan;
DROP SEQUENCE public.jabatan_id_seq;
DROP SEQUENCE public.instansi_id_seq;
DROP TABLE public.instansi;
DROP TABLE public.fungsi_pekerjaan;
DROP SEQUENCE public.fungsi_pekerjaan_id_seq;
DROP TABLE public.feeder;
DROP SEQUENCE public.feeder_id_seq;
DROP SEQUENCE public.diklat_id_seq;
DROP TABLE public.diklat;
DROP TABLE public.data_diklat;
DROP SEQUENCE public.data_diklat_id_seq;
--
-- TOC entry 196 (class 1259 OID 17443)
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
-- TOC entry 197 (class 1259 OID 17445)
-- Name: data_diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.data_diklat (
    id bigint DEFAULT nextval('public.data_diklat_id_seq'::regclass) NOT NULL,
    diklat_id bigint NOT NULL,
    tanggal_mulai date NOT NULL,
    tanggal_selesai date NOT NULL,
    target_jumlah_peserta bigint,
    realisasi_jumlah_peserta bigint,
    sk_buka character varying,
    sk_tutup character varying,
    angkatan bigint,
    tahun bigint,
    lama_diklat bigint,
    tempat character varying
);


ALTER TABLE public.data_diklat OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 17452)
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
-- TOC entry 199 (class 1259 OID 17458)
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
-- TOC entry 3106 (class 0 OID 0)
-- Dependencies: 199
-- Name: diklat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diklat_id_seq OWNED BY public.diklat.id;


--
-- TOC entry 200 (class 1259 OID 17460)
-- Name: feeder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.feeder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.feeder_id_seq OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 17462)
-- Name: feeder; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.feeder (
    id integer DEFAULT nextval('public.feeder_id_seq'::regclass) NOT NULL,
    pengguna_id bigint NOT NULL,
    nama_file character varying NOT NULL,
    status character varying NOT NULL,
    created_at date NOT NULL
);


ALTER TABLE public.feeder OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 17469)
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
-- TOC entry 203 (class 1259 OID 17471)
-- Name: fungsi_pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fungsi_pekerjaan (
    id bigint DEFAULT nextval('public.fungsi_pekerjaan_id_seq'::regclass) NOT NULL,
    instansi_id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL
);


ALTER TABLE public.fungsi_pekerjaan OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 17478)
-- Name: instansi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.instansi (
    id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL,
    singkatan character varying,
    tipe character varying,
    moda character varying,
    alamat character varying,
    foto character varying,
    deskripsi character varying
);


ALTER TABLE public.instansi OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 17484)
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
-- TOC entry 3107 (class 0 OID 0)
-- Dependencies: 205
-- Name: instansi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instansi_id_seq OWNED BY public.instansi.id;


--
-- TOC entry 206 (class 1259 OID 17486)
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
-- TOC entry 207 (class 1259 OID 17488)
-- Name: jabatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jabatan (
    id bigint DEFAULT nextval('public.jabatan_id_seq'::regclass) NOT NULL,
    instansi_id bigint NOT NULL,
    nama character varying NOT NULL
);


ALTER TABLE public.jabatan OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 17495)
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
-- TOC entry 209 (class 1259 OID 17497)
-- Name: kompetensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi (
    id bigint DEFAULT nextval('public.kompetensi_id_seq'::regclass) NOT NULL,
    moda character varying(30) NOT NULL,
    kompetensi_tujuan_utama_id bigint NOT NULL,
    kompetensi_fungsi_kunci_id bigint NOT NULL,
    kompetensi_fungsi_utama_id bigint NOT NULL,
    kompetensi_unit_id bigint NOT NULL,
    tipe_kompetensi character varying NOT NULL
);


ALTER TABLE public.kompetensi OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 17604)
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
-- TOC entry 235 (class 1259 OID 17606)
-- Name: kompetensi_diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_diklat (
    id bigint DEFAULT nextval('public.relasi_kompetensi_diklat_id_seq'::regclass) NOT NULL,
    diklat_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.kompetensi_diklat OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 17504)
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
-- TOC entry 211 (class 1259 OID 17506)
-- Name: kompetensi_fungsi_kunci; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_kunci (
    id bigint DEFAULT nextval('public.kompetensi_fungsi_kunci_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    fungsi_kunci text NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_kunci OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 17513)
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
-- TOC entry 213 (class 1259 OID 17515)
-- Name: kompetensi_fungsi_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_utama (
    id bigint DEFAULT nextval('public.kompetensi_fungsi_utama_id_seq'::regclass) NOT NULL,
    kode integer NOT NULL,
    fungsi_utama text NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_utama OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 17595)
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
-- TOC entry 233 (class 1259 OID 17597)
-- Name: kompetensi_pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_pekerjaan (
    id bigint DEFAULT nextval('public.relasi_job_kompetensi_id_seq'::regclass) NOT NULL,
    fungsi_pekerjaan_id bigint NOT NULL,
    lisensi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL,
    pendidikan_minimal character varying,
    ipk_minimal character varying,
    keterangan character varying
);


ALTER TABLE public.kompetensi_pekerjaan OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 17610)
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
-- TOC entry 237 (class 1259 OID 17612)
-- Name: kompetensi_prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_prodi (
    id bigint DEFAULT nextval('public.relasi_kompetensi_prodi_id_seq'::regclass) NOT NULL,
    program_studi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.kompetensi_prodi OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 17522)
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
-- TOC entry 215 (class 1259 OID 17524)
-- Name: kompetensi_tujuan_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_tujuan_utama (
    id bigint DEFAULT nextval('public.kompetensi_tujuan_utama_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    tujuan_utama text NOT NULL
);


ALTER TABLE public.kompetensi_tujuan_utama OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 17531)
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
-- TOC entry 217 (class 1259 OID 17533)
-- Name: kompetensi_unit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_unit (
    id bigint DEFAULT nextval('public.kompetensi_unit_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    kompetensi text NOT NULL
);


ALTER TABLE public.kompetensi_unit OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 17540)
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
-- TOC entry 219 (class 1259 OID 17542)
-- Name: lisensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi (
    id bigint DEFAULT nextval('public.lisensi_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    nama character varying NOT NULL,
    bab character varying NOT NULL,
    moda character varying NOT NULL
);


ALTER TABLE public.lisensi OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 17549)
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
-- TOC entry 221 (class 1259 OID 17551)
-- Name: lisensi_pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi_pekerjaan (
    id bigint DEFAULT nextval('public.lisensi_pekerjaan_id_seq'::regclass) NOT NULL,
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
-- TOC entry 222 (class 1259 OID 17558)
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
-- TOC entry 223 (class 1259 OID 17560)
-- Name: lisensi_program_studi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi_program_studi (
    id bigint DEFAULT nextval('public.lisensi_program_studi_id_seq'::regclass) NOT NULL,
    lisensi_id bigint NOT NULL,
    program_studi_id bigint NOT NULL
);


ALTER TABLE public.lisensi_program_studi OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 17564)
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
-- TOC entry 225 (class 1259 OID 17566)
-- Name: pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pegawai (
    id bigint DEFAULT nextval('public.pegawai_id_seq'::regclass) NOT NULL,
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
-- TOC entry 226 (class 1259 OID 17573)
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.penawaran_siswa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.penawaran_siswa_id_seq OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17575)
-- Name: penawaran_siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.penawaran_siswa (
    id bigint DEFAULT nextval('public.penawaran_siswa_id_seq'::regclass) NOT NULL,
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
-- TOC entry 228 (class 1259 OID 17579)
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
-- TOC entry 229 (class 1259 OID 17585)
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
-- TOC entry 3108 (class 0 OID 0)
-- Dependencies: 229
-- Name: pengguna_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengguna_id_seq OWNED BY public.pengguna.id;


--
-- TOC entry 230 (class 1259 OID 17587)
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
-- TOC entry 231 (class 1259 OID 17593)
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
-- TOC entry 3109 (class 0 OID 0)
-- Dependencies: 231
-- Name: program_studi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.program_studi_id_seq OWNED BY public.program_studi.id;


--
-- TOC entry 238 (class 1259 OID 17616)
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
-- TOC entry 239 (class 1259 OID 17618)
-- Name: sertifikat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sertifikat (
    id bigint DEFAULT nextval('public.sertifikat_id_seq'::regclass) NOT NULL,
    pegawai_id bigint NOT NULL,
    nama character varying NOT NULL,
    masa_berlaku date NOT NULL
);


ALTER TABLE public.sertifikat OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 17625)
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
-- TOC entry 241 (class 1259 OID 17631)
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
-- TOC entry 3110 (class 0 OID 0)
-- Dependencies: 241
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- TOC entry 2837 (class 2604 OID 17633)
-- Name: diklat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat ALTER COLUMN id SET DEFAULT nextval('public.diklat_id_seq'::regclass);


--
-- TOC entry 2840 (class 2604 OID 17634)
-- Name: instansi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi ALTER COLUMN id SET DEFAULT nextval('public.instansi_id_seq'::regclass);


--
-- TOC entry 2852 (class 2604 OID 17635)
-- Name: pengguna id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna ALTER COLUMN id SET DEFAULT nextval('public.pengguna_id_seq'::regclass);


--
-- TOC entry 2853 (class 2604 OID 17636)
-- Name: program_studi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi ALTER COLUMN id SET DEFAULT nextval('public.program_studi_id_seq'::regclass);


--
-- TOC entry 2858 (class 2604 OID 17637)
-- Name: siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa ALTER COLUMN id SET DEFAULT nextval('public.siswa_id_seq'::regclass);


--
-- TOC entry 3056 (class 0 OID 17445)
-- Dependencies: 197
-- Data for Name: data_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.data_diklat (id, diklat_id, tanggal_mulai, tanggal_selesai, target_jumlah_peserta, realisasi_jumlah_peserta, sk_buka, sk_tutup, angkatan, tahun, lama_diklat, tempat) FROM stdin;
\.


--
-- TOC entry 3057 (class 0 OID 17452)
-- Dependencies: 198
-- Data for Name: diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diklat (id, instansi_id, nama, tipe) FROM stdin;
\.


--
-- TOC entry 3060 (class 0 OID 17462)
-- Dependencies: 201
-- Data for Name: feeder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.feeder (id, pengguna_id, nama_file, status, created_at) FROM stdin;
\.


--
-- TOC entry 3062 (class 0 OID 17471)
-- Dependencies: 203
-- Data for Name: fungsi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fungsi_pekerjaan (id, instansi_id, kode, nama) FROM stdin;
\.


--
-- TOC entry 3063 (class 0 OID 17478)
-- Dependencies: 204
-- Data for Name: instansi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instansi (id, kode, nama, singkatan, tipe, moda, alamat, foto, deskripsi) FROM stdin;
\.


--
-- TOC entry 3066 (class 0 OID 17488)
-- Dependencies: 207
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jabatan (id, instansi_id, nama) FROM stdin;
\.


--
-- TOC entry 3068 (class 0 OID 17497)
-- Dependencies: 209
-- Data for Name: kompetensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi (id, moda, kompetensi_tujuan_utama_id, kompetensi_fungsi_kunci_id, kompetensi_fungsi_utama_id, kompetensi_unit_id, tipe_kompetensi) FROM stdin;
\.


--
-- TOC entry 3094 (class 0 OID 17606)
-- Dependencies: 235
-- Data for Name: kompetensi_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_diklat (id, diklat_id, kompetensi_id) FROM stdin;
\.


--
-- TOC entry 3070 (class 0 OID 17506)
-- Dependencies: 211
-- Data for Name: kompetensi_fungsi_kunci; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_kunci (id, kode, fungsi_kunci) FROM stdin;
\.


--
-- TOC entry 3072 (class 0 OID 17515)
-- Dependencies: 213
-- Data for Name: kompetensi_fungsi_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_utama (id, kode, fungsi_utama) FROM stdin;
\.


--
-- TOC entry 3092 (class 0 OID 17597)
-- Dependencies: 233
-- Data for Name: kompetensi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_pekerjaan (id, fungsi_pekerjaan_id, lisensi_id, kompetensi_id, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- TOC entry 3096 (class 0 OID 17612)
-- Dependencies: 237
-- Data for Name: kompetensi_prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_prodi (id, program_studi_id, kompetensi_id) FROM stdin;
\.


--
-- TOC entry 3074 (class 0 OID 17524)
-- Dependencies: 215
-- Data for Name: kompetensi_tujuan_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_tujuan_utama (id, kode, tujuan_utama) FROM stdin;
\.


--
-- TOC entry 3076 (class 0 OID 17533)
-- Dependencies: 217
-- Data for Name: kompetensi_unit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_unit (id, kode, kompetensi) FROM stdin;
\.


--
-- TOC entry 3078 (class 0 OID 17542)
-- Dependencies: 219
-- Data for Name: lisensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi (id, kode, nama, bab, moda) FROM stdin;
\.


--
-- TOC entry 3080 (class 0 OID 17551)
-- Dependencies: 221
-- Data for Name: lisensi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_pekerjaan (id, jabatan_id, fungsi_pekerjaan_id, lisensi_id, kode, kepala, nama, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- TOC entry 3082 (class 0 OID 17560)
-- Dependencies: 223
-- Data for Name: lisensi_program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_program_studi (id, lisensi_id, program_studi_id) FROM stdin;
\.


--
-- TOC entry 3084 (class 0 OID 17566)
-- Dependencies: 225
-- Data for Name: pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pegawai (id, sekolah_id, instansi_id, sertifikat_id, kode, nama, "no_KTP", jenis_kelamin, tempat_lahir, tanggal_lahir, bahasa, kewarganegaraan) FROM stdin;
\.


--
-- TOC entry 3086 (class 0 OID 17575)
-- Dependencies: 227
-- Data for Name: penawaran_siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.penawaran_siswa (id, instansi_id, siswa_id, jabatan_id, status, tanggal_input, tanggal_update, sudah_diemail, tanggal_email) FROM stdin;
\.


--
-- TOC entry 3087 (class 0 OID 17579)
-- Dependencies: 228
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengguna (id, instansi_id, email, password, otoritas, aktif, hapus, nama, foto, bahasa) FROM stdin;
\.


--
-- TOC entry 3089 (class 0 OID 17587)
-- Dependencies: 230
-- Data for Name: program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.program_studi (id, instansi_id, kode, nama, jenjang) FROM stdin;
\.


--
-- TOC entry 3098 (class 0 OID 17618)
-- Dependencies: 239
-- Data for Name: sertifikat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sertifikat (id, pegawai_id, nama, masa_berlaku) FROM stdin;
\.


--
-- TOC entry 3099 (class 0 OID 17625)
-- Dependencies: 240
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, instansi_id, program_studi_id, kode, nama, periode_masuk, tahun_kurikulum, tanggal_lahir, kelas, ipk, no_ktp, status, tahun_lulus) FROM stdin;
\.


--
-- TOC entry 3111 (class 0 OID 0)
-- Dependencies: 196
-- Name: data_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.data_diklat_id_seq', 1, false);


--
-- TOC entry 3112 (class 0 OID 0)
-- Dependencies: 199
-- Name: diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diklat_id_seq', 1, false);


--
-- TOC entry 3113 (class 0 OID 0)
-- Dependencies: 200
-- Name: feeder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.feeder_id_seq', 1, false);


--
-- TOC entry 3114 (class 0 OID 0)
-- Dependencies: 202
-- Name: fungsi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fungsi_pekerjaan_id_seq', 1, false);


--
-- TOC entry 3115 (class 0 OID 0)
-- Dependencies: 205
-- Name: instansi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instansi_id_seq', 1, false);


--
-- TOC entry 3116 (class 0 OID 0)
-- Dependencies: 206
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jabatan_id_seq', 1, false);


--
-- TOC entry 3117 (class 0 OID 0)
-- Dependencies: 210
-- Name: kompetensi_fungsi_kunci_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_kunci_id_seq', 1, false);


--
-- TOC entry 3118 (class 0 OID 0)
-- Dependencies: 212
-- Name: kompetensi_fungsi_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_utama_id_seq', 1, false);


--
-- TOC entry 3119 (class 0 OID 0)
-- Dependencies: 208
-- Name: kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_id_seq', 1, false);


--
-- TOC entry 3120 (class 0 OID 0)
-- Dependencies: 214
-- Name: kompetensi_tujuan_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_tujuan_utama_id_seq', 1, false);


--
-- TOC entry 3121 (class 0 OID 0)
-- Dependencies: 216
-- Name: kompetensi_unit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_unit_id_seq', 1, false);


--
-- TOC entry 3122 (class 0 OID 0)
-- Dependencies: 218
-- Name: lisensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_id_seq', 1, false);


--
-- TOC entry 3123 (class 0 OID 0)
-- Dependencies: 220
-- Name: lisensi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_pekerjaan_id_seq', 1, false);


--
-- TOC entry 3124 (class 0 OID 0)
-- Dependencies: 222
-- Name: lisensi_program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_program_studi_id_seq', 1, false);


--
-- TOC entry 3125 (class 0 OID 0)
-- Dependencies: 224
-- Name: pegawai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pegawai_id_seq', 1, false);


--
-- TOC entry 3126 (class 0 OID 0)
-- Dependencies: 226
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.penawaran_siswa_id_seq', 1, false);


--
-- TOC entry 3127 (class 0 OID 0)
-- Dependencies: 229
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, false);


--
-- TOC entry 3128 (class 0 OID 0)
-- Dependencies: 231
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 1, false);


--
-- TOC entry 3129 (class 0 OID 0)
-- Dependencies: 232
-- Name: relasi_job_kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_job_kompetensi_id_seq', 1, false);


--
-- TOC entry 3130 (class 0 OID 0)
-- Dependencies: 234
-- Name: relasi_kompetensi_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_diklat_id_seq', 1, false);


--
-- TOC entry 3131 (class 0 OID 0)
-- Dependencies: 236
-- Name: relasi_kompetensi_prodi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_prodi_id_seq', 1, false);


--
-- TOC entry 3132 (class 0 OID 0)
-- Dependencies: 238
-- Name: sertifikat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sertifikat_id_seq', 1, false);


--
-- TOC entry 3133 (class 0 OID 0)
-- Dependencies: 241
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 1, false);


--
-- TOC entry 2860 (class 2606 OID 17639)
-- Name: data_diklat data_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_diklat
    ADD CONSTRAINT data_diklat_id PRIMARY KEY (id);


--
-- TOC entry 2862 (class 2606 OID 17641)
-- Name: diklat diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_id PRIMARY KEY (id);


--
-- TOC entry 2864 (class 2606 OID 17643)
-- Name: feeder feeder_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_id PRIMARY KEY (id);


--
-- TOC entry 2866 (class 2606 OID 17645)
-- Name: fungsi_pekerjaan fungsi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_id PRIMARY KEY (id);


--
-- TOC entry 2868 (class 2606 OID 17647)
-- Name: instansi instansi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi
    ADD CONSTRAINT instansi_id PRIMARY KEY (id);


--
-- TOC entry 2870 (class 2606 OID 17649)
-- Name: jabatan jabatan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_id PRIMARY KEY (id);


--
-- TOC entry 2874 (class 2606 OID 17651)
-- Name: kompetensi_fungsi_kunci kompetensi_fungsi_kunci_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_kunci
    ADD CONSTRAINT kompetensi_fungsi_kunci_id PRIMARY KEY (id);


--
-- TOC entry 2876 (class 2606 OID 17653)
-- Name: kompetensi_fungsi_utama kompetensi_fungsi_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_utama
    ADD CONSTRAINT kompetensi_fungsi_utama_id PRIMARY KEY (id);


--
-- TOC entry 2872 (class 2606 OID 17655)
-- Name: kompetensi kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_id PRIMARY KEY (id);


--
-- TOC entry 2878 (class 2606 OID 17657)
-- Name: kompetensi_tujuan_utama kompetensi_tujuan_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_tujuan_utama
    ADD CONSTRAINT kompetensi_tujuan_utama_id PRIMARY KEY (id);


--
-- TOC entry 2880 (class 2606 OID 17659)
-- Name: kompetensi_unit kompetensi_unit_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_unit
    ADD CONSTRAINT kompetensi_unit_id PRIMARY KEY (id);


--
-- TOC entry 2882 (class 2606 OID 17661)
-- Name: lisensi lisensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi
    ADD CONSTRAINT lisensi_id PRIMARY KEY (id);


--
-- TOC entry 2884 (class 2606 OID 17663)
-- Name: lisensi_pekerjaan lisensi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_id PRIMARY KEY (id);


--
-- TOC entry 2886 (class 2606 OID 17665)
-- Name: lisensi_program_studi lisensi_program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_id PRIMARY KEY (id);


--
-- TOC entry 2888 (class 2606 OID 17667)
-- Name: pegawai pegawai_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_id PRIMARY KEY (id);


--
-- TOC entry 2890 (class 2606 OID 17669)
-- Name: penawaran_siswa penawaran_siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_id PRIMARY KEY (id);


--
-- TOC entry 2892 (class 2606 OID 17671)
-- Name: pengguna pengguna_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_id PRIMARY KEY (id);


--
-- TOC entry 2894 (class 2606 OID 17673)
-- Name: program_studi program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_id PRIMARY KEY (id);


--
-- TOC entry 2896 (class 2606 OID 17675)
-- Name: kompetensi_pekerjaan relasi_job_kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_pekerjaan
    ADD CONSTRAINT relasi_job_kompetensi_id PRIMARY KEY (id);


--
-- TOC entry 2898 (class 2606 OID 17677)
-- Name: kompetensi_diklat relasi_kompetensi_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_id PRIMARY KEY (id);


--
-- TOC entry 2900 (class 2606 OID 17679)
-- Name: kompetensi_prodi relasi_kompetensi_prodi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_id PRIMARY KEY (id);


--
-- TOC entry 2902 (class 2606 OID 17681)
-- Name: sertifikat sertifikat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_id PRIMARY KEY (id);


--
-- TOC entry 2904 (class 2606 OID 17683)
-- Name: siswa siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_id PRIMARY KEY (id);


--
-- TOC entry 2905 (class 2606 OID 17825)
-- Name: data_diklat data_diklat_diklat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_diklat
    ADD CONSTRAINT data_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES public.diklat(id);


--
-- TOC entry 2906 (class 2606 OID 17684)
-- Name: feeder feeder_pengguna_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_pengguna_id_fkey FOREIGN KEY (pengguna_id) REFERENCES public.pengguna(id);


--
-- TOC entry 2907 (class 2606 OID 17689)
-- Name: fungsi_pekerjaan fungsi_pekerjaan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2923 (class 2606 OID 17694)
-- Name: program_studi instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- TOC entry 2922 (class 2606 OID 17699)
-- Name: pengguna instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- TOC entry 2908 (class 2606 OID 17704)
-- Name: jabatan jabatan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2909 (class 2606 OID 17709)
-- Name: kompetensi kompetensi_fungsi_kunci_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_kunci_id FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES public.kompetensi_fungsi_kunci(id) NOT VALID;


--
-- TOC entry 2910 (class 2606 OID 17714)
-- Name: kompetensi kompetensi_fungsi_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_utama_id FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES public.kompetensi_fungsi_utama(id) NOT VALID;


--
-- TOC entry 2911 (class 2606 OID 17719)
-- Name: kompetensi kompetensi_tujuan_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_tujuan_utama_id FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES public.kompetensi_tujuan_utama(id) NOT VALID;


--
-- TOC entry 2912 (class 2606 OID 17724)
-- Name: kompetensi kompetensi_unit_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_unit_id FOREIGN KEY (kompetensi_unit_id) REFERENCES public.kompetensi_unit(id) NOT VALID;


--
-- TOC entry 2913 (class 2606 OID 17729)
-- Name: lisensi_pekerjaan lisensi_pekerjaan_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- TOC entry 2914 (class 2606 OID 17734)
-- Name: lisensi_program_studi lisensi_program_studi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- TOC entry 2915 (class 2606 OID 17739)
-- Name: lisensi_program_studi lisensi_program_studi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- TOC entry 2916 (class 2606 OID 17744)
-- Name: pegawai pegawai_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2917 (class 2606 OID 17749)
-- Name: pegawai pegawai_sekolah_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sekolah_id_fkey FOREIGN KEY (sekolah_id) REFERENCES public.instansi(id);


--
-- TOC entry 2918 (class 2606 OID 17754)
-- Name: pegawai pegawai_sertifikat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sertifikat_id_fkey FOREIGN KEY (sertifikat_id) REFERENCES public.sertifikat(id);


--
-- TOC entry 2919 (class 2606 OID 17759)
-- Name: penawaran_siswa penawaran_siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2920 (class 2606 OID 17764)
-- Name: penawaran_siswa penawaran_siswa_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- TOC entry 2921 (class 2606 OID 17769)
-- Name: penawaran_siswa penawaran_siswa_siswa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_siswa_id_fkey FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- TOC entry 2924 (class 2606 OID 17774)
-- Name: kompetensi_pekerjaan relasi_job_kompetensi_fungsi_pekerjaan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_pekerjaan
    ADD CONSTRAINT relasi_job_kompetensi_fungsi_pekerjaan_id_fkey FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES public.fungsi_pekerjaan(id);


--
-- TOC entry 2925 (class 2606 OID 17779)
-- Name: kompetensi_pekerjaan relasi_job_kompetensi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_pekerjaan
    ADD CONSTRAINT relasi_job_kompetensi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2926 (class 2606 OID 17784)
-- Name: kompetensi_pekerjaan relasi_job_kompetensi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_pekerjaan
    ADD CONSTRAINT relasi_job_kompetensi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- TOC entry 2927 (class 2606 OID 17789)
-- Name: kompetensi_diklat relasi_kompetensi_diklat_diklat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES public.diklat(id);


--
-- TOC entry 2928 (class 2606 OID 17794)
-- Name: kompetensi_diklat relasi_kompetensi_diklat_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2929 (class 2606 OID 17799)
-- Name: kompetensi_prodi relasi_kompetensi_prodi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- TOC entry 2930 (class 2606 OID 17804)
-- Name: kompetensi_prodi relasi_kompetensi_prodi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- TOC entry 2931 (class 2606 OID 17809)
-- Name: sertifikat sertifikat_pegawai_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_pegawai_id_fkey FOREIGN KEY (pegawai_id) REFERENCES public.pegawai(id);


--
-- TOC entry 2932 (class 2606 OID 17814)
-- Name: siswa siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- TOC entry 2933 (class 2606 OID 17819)
-- Name: siswa siswa_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


-- Completed on 2019-10-10 15:56:06

--
-- PostgreSQL database dump complete
--

