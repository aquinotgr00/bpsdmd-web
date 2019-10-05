--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

-- Started on 2019-10-04 20:57:59

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
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_instansi_id_fkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_instansi_id_fkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_sekolah_id_fkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_instansi_id_fkey;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT dosen_instansi_id_fkey;
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_instansi_id_fkey;
ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_pkey;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_pkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_pkey;
ALTER TABLE ONLY public.pegawai DROP CONSTRAINT pegawai_pkey;
ALTER TABLE ONLY public.instansi DROP CONSTRAINT instansi_pkey;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT dosen_pkey;
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_pkey;
ALTER TABLE public.siswa ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.sertifikat ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.program_studi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pengguna ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pegawai ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.instansi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.dosen ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.diklat ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.siswa_id_seq;
DROP TABLE public.siswa;
DROP SEQUENCE public.sertifikat_id_seq;
DROP TABLE public.sertifikat;
DROP SEQUENCE public.program_studi_id_seq;
DROP TABLE public.program_studi;
DROP SEQUENCE public.pengguna_id_seq;
DROP TABLE public.pengguna;
DROP SEQUENCE public.pegawai_id_seq;
DROP TABLE public.pegawai;
DROP SEQUENCE public.instansi_id_seq;
DROP TABLE public.instansi;
DROP SEQUENCE public.dosen_id_seq;
DROP TABLE public.dosen;
DROP SEQUENCE public.diklat_id_seq;
DROP TABLE public.diklat;
SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 25343)
-- Name: diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diklat (
    id bigint NOT NULL,
    instansi_id bigint,
    nama character varying NOT NULL
);


ALTER TABLE public.diklat OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 25349)
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
-- TOC entry 2908 (class 0 OID 0)
-- Dependencies: 197
-- Name: diklat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diklat_id_seq OWNED BY public.diklat.id;


--
-- TOC entry 198 (class 1259 OID 25351)
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
    nidn character varying
);


ALTER TABLE public.dosen OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 25357)
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
-- TOC entry 2909 (class 0 OID 0)
-- Dependencies: 199
-- Name: dosen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dosen_id_seq OWNED BY public.dosen.id;


--
-- TOC entry 200 (class 1259 OID 25359)
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
    foto character varying
);


ALTER TABLE public.instansi OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 25365)
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
-- TOC entry 2910 (class 0 OID 0)
-- Dependencies: 201
-- Name: instansi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.instansi_id_seq OWNED BY public.instansi.id;


--
-- TOC entry 208 (class 1259 OID 25475)
-- Name: pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pegawai (
    id bigint NOT NULL,
    sekolah_id bigint NOT NULL,
    instansi_id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL,
    no_ktp character varying,
    jenis_kelamin character varying,
    tempat_lahir character varying,
    tanggal_lahir date,
    bahasa character varying,
    kewarganegaraan character varying
);


ALTER TABLE public.pegawai OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 25504)
-- Name: pegawai_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pegawai_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pegawai_id_seq OWNER TO postgres;

--
-- TOC entry 2911 (class 0 OID 0)
-- Dependencies: 210
-- Name: pegawai_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pegawai_id_seq OWNED BY public.pegawai.id;


--
-- TOC entry 202 (class 1259 OID 25367)
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
-- TOC entry 203 (class 1259 OID 25373)
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
-- TOC entry 2912 (class 0 OID 0)
-- Dependencies: 203
-- Name: pengguna_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengguna_id_seq OWNED BY public.pengguna.id;


--
-- TOC entry 204 (class 1259 OID 25375)
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
-- TOC entry 205 (class 1259 OID 25381)
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
-- TOC entry 2913 (class 0 OID 0)
-- Dependencies: 205
-- Name: program_studi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.program_studi_id_seq OWNED BY public.program_studi.id;


--
-- TOC entry 209 (class 1259 OID 25481)
-- Name: sertifikat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sertifikat (
    id bigint NOT NULL,
    pegawai_id bigint NOT NULL,
    nama character varying NOT NULL,
    masa_berlaku date NOT NULL
);


ALTER TABLE public.sertifikat OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 25507)
-- Name: sertifikat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sertifikat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sertifikat_id_seq OWNER TO postgres;

--
-- TOC entry 2914 (class 0 OID 0)
-- Dependencies: 211
-- Name: sertifikat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sertifikat_id_seq OWNED BY public.sertifikat.id;


--
-- TOC entry 206 (class 1259 OID 25383)
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
    ipk character varying
);


ALTER TABLE public.siswa OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 25389)
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
-- TOC entry 2915 (class 0 OID 0)
-- Dependencies: 207
-- Name: siswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.siswa_id_seq OWNED BY public.siswa.id;


--
-- TOC entry 2735 (class 2604 OID 25391)
-- Name: diklat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat ALTER COLUMN id SET DEFAULT nextval('public.diklat_id_seq'::regclass);


--
-- TOC entry 2736 (class 2604 OID 25392)
-- Name: dosen id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen ALTER COLUMN id SET DEFAULT nextval('public.dosen_id_seq'::regclass);


--
-- TOC entry 2737 (class 2604 OID 25393)
-- Name: instansi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi ALTER COLUMN id SET DEFAULT nextval('public.instansi_id_seq'::regclass);


--
-- TOC entry 2741 (class 2604 OID 25506)
-- Name: pegawai id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai ALTER COLUMN id SET DEFAULT nextval('public.pegawai_id_seq'::regclass);


--
-- TOC entry 2738 (class 2604 OID 25394)
-- Name: pengguna id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna ALTER COLUMN id SET DEFAULT nextval('public.pengguna_id_seq'::regclass);


--
-- TOC entry 2739 (class 2604 OID 25395)
-- Name: program_studi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi ALTER COLUMN id SET DEFAULT nextval('public.program_studi_id_seq'::regclass);


--
-- TOC entry 2742 (class 2604 OID 25509)
-- Name: sertifikat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat ALTER COLUMN id SET DEFAULT nextval('public.sertifikat_id_seq'::regclass);


--
-- TOC entry 2740 (class 2604 OID 25396)
-- Name: siswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa ALTER COLUMN id SET DEFAULT nextval('public.siswa_id_seq'::regclass);


--
-- TOC entry 2887 (class 0 OID 25343)
-- Dependencies: 196
-- Data for Name: diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diklat (id, instansi_id, nama) FROM stdin;
\.


--
-- TOC entry 2889 (class 0 OID 25351)
-- Dependencies: 198
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen (id, instansi_id, nip, nama, gelar_depan, gelar_belakang, tanggal_lahir, no_ktp, nidn) FROM stdin;
\.


--
-- TOC entry 2891 (class 0 OID 25359)
-- Dependencies: 200
-- Data for Name: instansi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instansi (id, kode, nama, singkatan, tipe, moda, alamat, foto) FROM stdin;
1	\N	PELNI	\N	demand	air	\N	\N
2	\N	KAI	\N	demand	darat	\N	\N
\.


--
-- TOC entry 2899 (class 0 OID 25475)
-- Dependencies: 208
-- Data for Name: pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pegawai (id, sekolah_id, instansi_id, kode, nama, no_ktp, jenis_kelamin, tempat_lahir, tanggal_lahir, bahasa, kewarganegaraan) FROM stdin;
\.


--
-- TOC entry 2893 (class 0 OID 25367)
-- Dependencies: 202
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengguna (id, instansi_id, email, password, otoritas, aktif, hapus, nama, foto, bahasa) FROM stdin;
\.


--
-- TOC entry 2895 (class 0 OID 25375)
-- Dependencies: 204
-- Data for Name: program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.program_studi (id, instansi_id, kode, nama, jenjang) FROM stdin;
\.


--
-- TOC entry 2900 (class 0 OID 25481)
-- Dependencies: 209
-- Data for Name: sertifikat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sertifikat (id, pegawai_id, nama, masa_berlaku) FROM stdin;
\.


--
-- TOC entry 2897 (class 0 OID 25383)
-- Dependencies: 206
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, instansi_id, program_studi_id, kode, nama, periode_masuk, tahun_kurikulum, tanggal_lahir, kelas, ipk) FROM stdin;
\.


--
-- TOC entry 2916 (class 0 OID 0)
-- Dependencies: 197
-- Name: diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diklat_id_seq', 1, false);


--
-- TOC entry 2917 (class 0 OID 0)
-- Dependencies: 199
-- Name: dosen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_seq', 1, false);


--
-- TOC entry 2918 (class 0 OID 0)
-- Dependencies: 201
-- Name: instansi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instansi_id_seq', 1, true);


--
-- TOC entry 2919 (class 0 OID 0)
-- Dependencies: 210
-- Name: pegawai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pegawai_id_seq', 2, true);


--
-- TOC entry 2920 (class 0 OID 0)
-- Dependencies: 203
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, true);


--
-- TOC entry 2921 (class 0 OID 0)
-- Dependencies: 205
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 1, false);


--
-- TOC entry 2922 (class 0 OID 0)
-- Dependencies: 211
-- Name: sertifikat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sertifikat_id_seq', 1, false);


--
-- TOC entry 2923 (class 0 OID 0)
-- Dependencies: 207
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 1, true);


--
-- TOC entry 2744 (class 2606 OID 25398)
-- Name: diklat diklat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_pkey PRIMARY KEY (id);


--
-- TOC entry 2746 (class 2606 OID 25400)
-- Name: dosen dosen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_pkey PRIMARY KEY (id);


--
-- TOC entry 2748 (class 2606 OID 25402)
-- Name: instansi instansi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi
    ADD CONSTRAINT instansi_pkey PRIMARY KEY (id);


--
-- TOC entry 2756 (class 2606 OID 25498)
-- Name: pegawai pegawai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_pkey PRIMARY KEY (id);


--
-- TOC entry 2750 (class 2606 OID 25404)
-- Name: pengguna pengguna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_pkey PRIMARY KEY (id);


--
-- TOC entry 2752 (class 2606 OID 25406)
-- Name: program_studi program_studi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_pkey PRIMARY KEY (id);


--
-- TOC entry 2754 (class 2606 OID 25408)
-- Name: siswa siswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (id);


--
-- TOC entry 2757 (class 2606 OID 25409)
-- Name: diklat diklat_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2758 (class 2606 OID 25414)
-- Name: dosen dosen_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2764 (class 2606 OID 25492)
-- Name: pegawai pegawai_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2763 (class 2606 OID 25487)
-- Name: pegawai pegawai_sekolah_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pegawai_sekolah_id_fkey FOREIGN KEY (sekolah_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2759 (class 2606 OID 25419)
-- Name: pengguna pengguna_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2760 (class 2606 OID 25424)
-- Name: program_studi program_studi_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2765 (class 2606 OID 25499)
-- Name: sertifikat sertifikat_pegawai_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sertifikat
    ADD CONSTRAINT sertifikat_pegawai_id_fkey FOREIGN KEY (pegawai_id) REFERENCES public.pegawai(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2761 (class 2606 OID 25429)
-- Name: siswa siswa_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2762 (class 2606 OID 25434)
-- Name: siswa siswa_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2019-10-04 20:58:05

--
-- PostgreSQL database dump complete
--

