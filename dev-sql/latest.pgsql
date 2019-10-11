--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

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

--
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
-- Name: diklat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diklat_id_seq OWNED BY public.diklat.id;


--
-- Name: dosen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dosen (
    id bigint NOT NULL,
    instansi_id bigint,
    nip character varying,
    nama character varying NOT NULL,
    gelar_depan character varying,
    gelar_belakang character varying,
    tanggal_lahir date,
    no_ktp character varying,
    nidn character varying,
    kode character varying,
    foto character varying
);


ALTER TABLE public.dosen OWNER TO postgres;

--
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
-- Name: dosen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dosen_id_seq OWNED BY public.dosen.id;


--
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
-- Name: instansi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instansi_id_seq OWNED BY public.instansi.id;


--
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
-- Name: jabatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jabatan (
    id bigint DEFAULT nextval('public.jabatan_id_seq'::regclass) NOT NULL,
    instansi_id bigint NOT NULL,
    nama character varying NOT NULL
);


ALTER TABLE public.jabatan OWNER TO postgres;

--
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
-- Name: kompetensi_fungsi_kunci; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_kunci (
    id bigint DEFAULT nextval('public.kompetensi_fungsi_kunci_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    fungsi_kunci text NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_kunci OWNER TO postgres;

--
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
-- Name: kompetensi_fungsi_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_fungsi_utama (
    id bigint DEFAULT nextval('public.kompetensi_fungsi_utama_id_seq'::regclass) NOT NULL,
    kode integer NOT NULL,
    fungsi_utama text NOT NULL
);


ALTER TABLE public.kompetensi_fungsi_utama OWNER TO postgres;

--
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
-- Name: kompetensi_tujuan_utama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_tujuan_utama (
    id bigint DEFAULT nextval('public.kompetensi_tujuan_utama_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    tujuan_utama text NOT NULL
);


ALTER TABLE public.kompetensi_tujuan_utama OWNER TO postgres;

--
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
-- Name: kompetensi_unit; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kompetensi_unit (
    id bigint DEFAULT nextval('public.kompetensi_unit_id_seq'::regclass) NOT NULL,
    kode character varying NOT NULL,
    kompetensi text NOT NULL
);


ALTER TABLE public.kompetensi_unit OWNER TO postgres;

--
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
-- Name: lisensi_program_studi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lisensi_program_studi (
    id bigint DEFAULT nextval('public.lisensi_program_studi_id_seq'::regclass) NOT NULL,
    lisensi_id bigint NOT NULL,
    program_studi_id bigint NOT NULL
);


ALTER TABLE public.lisensi_program_studi OWNER TO postgres;

--
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
-- Name: pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pegawai (
    id bigint DEFAULT nextval('public.pegawai_id_seq'::regclass) NOT NULL,
    sekolah_id bigint NOT NULL,
    instansi_id bigint NOT NULL,
    sertifikat_id bigint,
    kode character varying NOT NULL,
    nama character varying,
    no_ktp character varying NOT NULL,
    jenis_kelamin character varying,
    tempat_lahir character varying,
    tanggal_lahir date,
    bahasa character varying,
    kewarganegaraan character varying,
    foto character varying
);


ALTER TABLE public.pegawai OWNER TO postgres;

--
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
-- Name: pengguna_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengguna_id_seq OWNED BY public.pengguna.id;


--
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
-- Name: program_studi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.program_studi_id_seq OWNED BY public.program_studi.id;


--
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
-- Name: relasi_job_kompetensi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_job_kompetensi (
    id bigint DEFAULT nextval('public.relasi_job_kompetensi_id_seq'::regclass) NOT NULL,
    fungsi_pekerjaan_id bigint NOT NULL,
    lisensi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL,
    pendidikan_minimal character varying,
    ipk_minimal character varying,
    keterangan character varying
);


ALTER TABLE public.relasi_job_kompetensi OWNER TO postgres;

--
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
-- Name: relasi_kompetensi_diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_kompetensi_diklat (
    id bigint DEFAULT nextval('public.relasi_kompetensi_diklat_id_seq'::regclass) NOT NULL,
    diklat_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.relasi_kompetensi_diklat OWNER TO postgres;

--
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
-- Name: relasi_kompetensi_prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.relasi_kompetensi_prodi (
    id bigint DEFAULT nextval('public.relasi_kompetensi_prodi_id_seq'::regclass) NOT NULL,
    program_studi_id bigint NOT NULL,
    kompetensi_id bigint NOT NULL
);


ALTER TABLE public.relasi_kompetensi_prodi OWNER TO postgres;

--
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
    tahun_lulus character varying,
    foto character varying
);


ALTER TABLE public.siswa OWNER TO postgres;

--
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
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- Name: diklat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat ALTER COLUMN id SET DEFAULT nextval('public.diklat_id_seq'::regclass);


--
-- Name: dosen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen ALTER COLUMN id SET DEFAULT nextval('public.dosen_id_seq'::regclass);


--
-- Name: instansi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi ALTER COLUMN id SET DEFAULT nextval('public.instansi_id_seq'::regclass);


--
-- Name: pengguna id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna ALTER COLUMN id SET DEFAULT nextval('public.pengguna_id_seq'::regclass);


--
-- Name: program_studi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi ALTER COLUMN id SET DEFAULT nextval('public.program_studi_id_seq'::regclass);


--
-- Name: siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa ALTER COLUMN id SET DEFAULT nextval('public.siswa_id_seq'::regclass);


--
-- Data for Name: data_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.data_diklat (id, diklat_id, tanggal_mulai, tanggal_selesai, target_jumlah_peserta, realisasi_jumlah_peserta, sk_buka, sk_tutup, angkatan, tahun, lama_diklat, tempat) FROM stdin;
\.


--
-- Data for Name: diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diklat (id, instansi_id, nama, tipe) FROM stdin;
\.


--
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen (id, instansi_id, nip, nama, gelar_depan, gelar_belakang, tanggal_lahir, no_ktp, nidn, kode, foto) FROM stdin;
\.


--
-- Data for Name: feeder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.feeder (id, pengguna_id, nama_file, status, created_at) FROM stdin;
\.


--
-- Data for Name: fungsi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fungsi_pekerjaan (id, instansi_id, kode, nama) FROM stdin;
\.


--
-- Data for Name: instansi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instansi (id, kode, nama, singkatan, tipe, moda, alamat, foto, deskripsi) FROM stdin;
\.


--
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jabatan (id, instansi_id, nama) FROM stdin;
\.


--
-- Data for Name: kompetensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi (id, moda, kompetensi_tujuan_utama_id, kompetensi_fungsi_kunci_id, kompetensi_fungsi_utama_id, kompetensi_unit_id, tipe_kompetensi) FROM stdin;
\.


--
-- Data for Name: kompetensi_fungsi_kunci; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_kunci (id, kode, fungsi_kunci) FROM stdin;
\.


--
-- Data for Name: kompetensi_fungsi_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_fungsi_utama (id, kode, fungsi_utama) FROM stdin;
\.


--
-- Data for Name: kompetensi_tujuan_utama; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_tujuan_utama (id, kode, tujuan_utama) FROM stdin;
\.


--
-- Data for Name: kompetensi_unit; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kompetensi_unit (id, kode, kompetensi) FROM stdin;
\.


--
-- Data for Name: lisensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi (id, kode, nama, bab, moda) FROM stdin;
\.


--
-- Data for Name: lisensi_pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_pekerjaan (id, jabatan_id, fungsi_pekerjaan_id, lisensi_id, kode, kepala, nama, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- Data for Name: lisensi_program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lisensi_program_studi (id, lisensi_id, program_studi_id) FROM stdin;
\.


--
-- Data for Name: pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pegawai (id, sekolah_id, instansi_id, sertifikat_id, kode, nama, no_ktp, jenis_kelamin, tempat_lahir, tanggal_lahir, bahasa, kewarganegaraan, foto) FROM stdin;
\.


--
-- Data for Name: penawaran_siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.penawaran_siswa (id, instansi_id, siswa_id, jabatan_id, status, tanggal_input, tanggal_update, sudah_diemail, tanggal_email) FROM stdin;
\.


--
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengguna (id, instansi_id, email, password, otoritas, aktif, hapus, nama, foto, bahasa) FROM stdin;
\.


--
-- Data for Name: program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.program_studi (id, instansi_id, kode, nama, jenjang) FROM stdin;
\.


--
-- Data for Name: relasi_job_kompetensi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_job_kompetensi (id, fungsi_pekerjaan_id, lisensi_id, kompetensi_id, pendidikan_minimal, ipk_minimal, keterangan) FROM stdin;
\.


--
-- Data for Name: relasi_kompetensi_diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_kompetensi_diklat (id, diklat_id, kompetensi_id) FROM stdin;
\.


--
-- Data for Name: relasi_kompetensi_prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.relasi_kompetensi_prodi (id, program_studi_id, kompetensi_id) FROM stdin;
\.


--
-- Data for Name: sertifikat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sertifikat (id, pegawai_id, nama, masa_berlaku) FROM stdin;
\.


--
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, instansi_id, program_studi_id, kode, nama, periode_masuk, tahun_kurikulum, tanggal_lahir, kelas, ipk, no_ktp, status, tahun_lulus, foto) FROM stdin;
\.


--
-- Name: data_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.data_diklat_id_seq', 1, false);


--
-- Name: diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diklat_id_seq', 1, true);


--
-- Name: dosen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_seq', 3, true);


--
-- Name: feeder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.feeder_id_seq', 2, true);


--
-- Name: fungsi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fungsi_pekerjaan_id_seq', 1, false);


--
-- Name: instansi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instansi_id_seq', 5, true);


--
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jabatan_id_seq', 1, false);


--
-- Name: kompetensi_fungsi_kunci_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_kunci_id_seq', 1, false);


--
-- Name: kompetensi_fungsi_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_fungsi_utama_id_seq', 1, false);


--
-- Name: kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_id_seq', 1, false);


--
-- Name: kompetensi_tujuan_utama_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_tujuan_utama_id_seq', 1, false);


--
-- Name: kompetensi_unit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kompetensi_unit_id_seq', 1, false);


--
-- Name: lisensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_id_seq', 1, true);


--
-- Name: lisensi_pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_pekerjaan_id_seq', 1, false);


--
-- Name: lisensi_program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lisensi_program_studi_id_seq', 1, false);


--
-- Name: pegawai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pegawai_id_seq', 4, true);


--
-- Name: penawaran_siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.penawaran_siswa_id_seq', 1, false);


--
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, false);


--
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 6, true);


--
-- Name: relasi_job_kompetensi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_job_kompetensi_id_seq', 1, false);


--
-- Name: relasi_kompetensi_diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_diklat_id_seq', 1, false);


--
-- Name: relasi_kompetensi_prodi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.relasi_kompetensi_prodi_id_seq', 1, false);


--
-- Name: sertifikat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sertifikat_id_seq', 1, false);


--
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 10, true);


--
-- Name: data_diklat data_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_diklat
    ADD CONSTRAINT data_diklat_id PRIMARY KEY (id);


--
-- Name: diklat diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_id PRIMARY KEY (id);


--
-- Name: feeder feeder_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_id PRIMARY KEY (id);


--
-- Name: fungsi_pekerjaan fungsi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_id PRIMARY KEY (id);


--
-- Name: instansi instansi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi
    ADD CONSTRAINT instansi_pkey PRIMARY KEY (id);


--
-- Name: jabatan jabatan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_id PRIMARY KEY (id);


--
-- Name: kompetensi_fungsi_kunci kompetensi_fungsi_kunci_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_kunci
    ADD CONSTRAINT kompetensi_fungsi_kunci_id PRIMARY KEY (id);


--
-- Name: kompetensi_fungsi_utama kompetensi_fungsi_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_fungsi_utama
    ADD CONSTRAINT kompetensi_fungsi_utama_id PRIMARY KEY (id);


--
-- Name: kompetensi kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_id PRIMARY KEY (id);


--
-- Name: kompetensi_tujuan_utama kompetensi_tujuan_utama_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_tujuan_utama
    ADD CONSTRAINT kompetensi_tujuan_utama_id PRIMARY KEY (id);


--
-- Name: kompetensi_unit kompetensi_unit_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi_unit
    ADD CONSTRAINT kompetensi_unit_id PRIMARY KEY (id);


--
-- Name: lisensi lisensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi
    ADD CONSTRAINT lisensi_id PRIMARY KEY (id);


--
-- Name: lisensi_pekerjaan lisensi_pekerjaan_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_id PRIMARY KEY (id);


--
-- Name: lisensi_program_studi lisensi_program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_id PRIMARY KEY (id);


--
-- Name: pegawai pegawai_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_id PRIMARY KEY (id);


--
-- Name: penawaran_siswa penawaran_siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_id PRIMARY KEY (id);


--
-- Name: pengguna pengguna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_pkey PRIMARY KEY (id);


--
-- Name: program_studi program_studi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_id PRIMARY KEY (id);


--
-- Name: relasi_job_kompetensi relasi_job_kompetensi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_id PRIMARY KEY (id);


--
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_id PRIMARY KEY (id);


--
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_id PRIMARY KEY (id);


--
-- Name: sertifikat sertifikat_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_id PRIMARY KEY (id);


--
-- Name: siswa siswa_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_id PRIMARY KEY (id);


--
-- Name: feeder feeder_pengguna_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feeder
    ADD CONSTRAINT feeder_pengguna_id_fkey FOREIGN KEY (pengguna_id) REFERENCES public.pengguna(id);


--
-- Name: fungsi_pekerjaan fungsi_pekerjaan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fungsi_pekerjaan
    ADD CONSTRAINT fungsi_pekerjaan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- Name: program_studi instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- Name: pengguna instansi_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT instansi_id FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) NOT VALID;


--
-- Name: jabatan jabatan_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- Name: kompetensi kompetensi_fungsi_kunci_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_kunci_id FOREIGN KEY (kompetensi_fungsi_kunci_id) REFERENCES public.kompetensi_fungsi_kunci(id) NOT VALID;


--
-- Name: kompetensi kompetensi_fungsi_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_fungsi_utama_id FOREIGN KEY (kompetensi_fungsi_utama_id) REFERENCES public.kompetensi_fungsi_utama(id) NOT VALID;


--
-- Name: kompetensi kompetensi_tujuan_utama_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_tujuan_utama_id FOREIGN KEY (kompetensi_tujuan_utama_id) REFERENCES public.kompetensi_tujuan_utama(id) NOT VALID;


--
-- Name: kompetensi kompetensi_unit_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kompetensi
    ADD CONSTRAINT kompetensi_unit_id FOREIGN KEY (kompetensi_unit_id) REFERENCES public.kompetensi_unit(id) NOT VALID;


--
-- Name: lisensi_pekerjaan lisensi_pekerjaan_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_pekerjaan
    ADD CONSTRAINT lisensi_pekerjaan_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- Name: lisensi_program_studi lisensi_program_studi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- Name: lisensi_program_studi lisensi_program_studi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lisensi_program_studi
    ADD CONSTRAINT lisensi_program_studi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- Name: pegawai pegawai_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- Name: pegawai pegawai_sekolah_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sekolah_id_fkey FOREIGN KEY (sekolah_id) REFERENCES public.instansi(id);


--
-- Name: pegawai pegawai_sertifikat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sertifikat_id_fkey FOREIGN KEY (sertifikat_id) REFERENCES public.sertifikat(id);


--
-- Name: penawaran_siswa penawaran_siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- Name: penawaran_siswa penawaran_siswa_jabatan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_jabatan_id_fkey FOREIGN KEY (jabatan_id) REFERENCES public.jabatan(id);


--
-- Name: penawaran_siswa penawaran_siswa_siswa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penawaran_siswa
    ADD CONSTRAINT penawaran_siswa_siswa_id_fkey FOREIGN KEY (siswa_id) REFERENCES public.siswa(id);


--
-- Name: pengguna pengguna_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: relasi_job_kompetensi relasi_job_kompetensi_fungsi_pekerjaan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_fungsi_pekerjaan_id_fkey FOREIGN KEY (fungsi_pekerjaan_id) REFERENCES public.fungsi_pekerjaan(id);


--
-- Name: relasi_job_kompetensi relasi_job_kompetensi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- Name: relasi_job_kompetensi relasi_job_kompetensi_lisensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_job_kompetensi
    ADD CONSTRAINT relasi_job_kompetensi_lisensi_id_fkey FOREIGN KEY (lisensi_id) REFERENCES public.lisensi(id);


--
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_diklat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_diklat_id_fkey FOREIGN KEY (diklat_id) REFERENCES public.diklat(id);


--
-- Name: relasi_kompetensi_diklat relasi_kompetensi_diklat_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_diklat
    ADD CONSTRAINT relasi_kompetensi_diklat_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_kompetensi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_kompetensi_id_fkey FOREIGN KEY (kompetensi_id) REFERENCES public.kompetensi(id);


--
-- Name: relasi_kompetensi_prodi relasi_kompetensi_prodi_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.relasi_kompetensi_prodi
    ADD CONSTRAINT relasi_kompetensi_prodi_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- Name: sertifikat sertifikat_pegawai_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_pegawai_id_fkey FOREIGN KEY (pegawai_id) REFERENCES public.pegawai(id);


--
-- Name: siswa siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id);


--
-- Name: siswa siswa_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id);


--
-- PostgreSQL database dump complete
--

