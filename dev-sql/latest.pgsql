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

ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_program_studi_id_fkey;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_instansi_id_fkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_instansi_id_fkey;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT dosen_instansi_id_fkey;
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_instansi_id_fkey;
ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_pkey;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_pkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_pkey;
ALTER TABLE ONLY public.instansi DROP CONSTRAINT instansi_pkey;
ALTER TABLE ONLY public.dosen DROP CONSTRAINT dosen_pkey;
ALTER TABLE ONLY public.diklat DROP CONSTRAINT diklat_pkey;
ALTER TABLE public.siswa ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.program_studi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pengguna ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.instansi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.dosen ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.diklat ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.siswa_id_seq;
DROP TABLE public.siswa;
DROP SEQUENCE public.program_studi_id_seq;
DROP TABLE public.program_studi;
DROP SEQUENCE public.pengguna_id_seq;
DROP TABLE public.pengguna;
DROP SEQUENCE public.instansi_id_seq;
DROP TABLE public.instansi;
DROP SEQUENCE public.dosen_id_seq;
DROP TABLE public.dosen;
DROP SEQUENCE public.diklat_id_seq;
DROP TABLE public.diklat;
SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: diklat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diklat (
    id bigint NOT NULL,
    instansi_id bigint,
    nama character varying NOT NULL
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
    nidn character varying
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
-- Name: siswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.siswa (
    id bigint NOT NULL,
    program_studi_id bigint NOT NULL,
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
-- Data for Name: diklat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diklat (id, instansi_id, nama) FROM stdin;
\.


--
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen (id, instansi_id, nip, nama, gelar_depan, gelar_belakang, tanggal_lahir, no_ktp, nidn) FROM stdin;
\.


--
-- Data for Name: instansi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.instansi (id, kode, nama, singkatan, tipe, moda, alamat, foto) FROM stdin;
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
-- Data for Name: siswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.siswa (id, program_studi_id, kode, nama, periode_masuk, tahun_kurikulum, tanggal_lahir, kelas, ipk) FROM stdin;
\.


--
-- Name: diklat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diklat_id_seq', 1, false);


--
-- Name: dosen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_seq', 1, false);


--
-- Name: instansi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.instansi_id_seq', 1, true);


--
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, true);


--
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 1, false);


--
-- Name: siswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.siswa_id_seq', 1, false);


--
-- Name: diklat diklat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_pkey PRIMARY KEY (id);


--
-- Name: dosen dosen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_pkey PRIMARY KEY (id);


--
-- Name: instansi instansi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.instansi
    ADD CONSTRAINT instansi_pkey PRIMARY KEY (id);


--
-- Name: pengguna pengguna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_pkey PRIMARY KEY (id);


--
-- Name: program_studi program_studi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_pkey PRIMARY KEY (id);


--
-- Name: siswa siswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (id);


--
-- Name: diklat diklat_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diklat
    ADD CONSTRAINT diklat_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: dosen dosen_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pengguna pengguna_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: program_studi program_studi_instansi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_instansi_id_fkey FOREIGN KEY (instansi_id) REFERENCES public.instansi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: siswa siswa_program_studi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_program_studi_id_fkey FOREIGN KEY (program_studi_id) REFERENCES public.program_studi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

