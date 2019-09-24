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

ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_org_id_fkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_org_id_fkey;
ALTER TABLE ONLY public.program_studi DROP CONSTRAINT program_studi_pkey;
ALTER TABLE ONLY public.pengguna DROP CONSTRAINT pengguna_pkey;
ALTER TABLE ONLY public.organisasi DROP CONSTRAINT organisasi_pkey;
ALTER TABLE public.program_studi ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pengguna ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.organisasi ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.program_studi_id_seq;
DROP TABLE public.program_studi;
DROP SEQUENCE public.pengguna_id_seq;
DROP TABLE public.pengguna;
DROP SEQUENCE public.organisasi_id_seq;
DROP TABLE public.organisasi;
SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: organisasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.organisasi (
    id bigint NOT NULL,
    kode character varying,
    nama character varying NOT NULL,
    singkatan character varying,
    tipe character varying NOT NULL,
    moda character varying,
    alamat character varying
);


ALTER TABLE public.organisasi OWNER TO postgres;

--
-- Name: organisasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.organisasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.organisasi_id_seq OWNER TO postgres;

--
-- Name: organisasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.organisasi_id_seq OWNED BY public.organisasi.id;


--
-- Name: pengguna; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengguna (
    id bigint NOT NULL,
    org_id bigint,
    email character varying NOT NULL,
    password character varying NOT NULL,
    otoritas character varying NOT NULL,
    aktif character varying NOT NULL,
    hapus character varying NOT NULL,
    nama character varying,
    foto character varying
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
    org_id bigint NOT NULL,
    kode character varying,
    nama character varying,
    jenjang character varying
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
-- Name: organisasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.organisasi ALTER COLUMN id SET DEFAULT nextval('public.organisasi_id_seq'::regclass);


--
-- Name: pengguna id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna ALTER COLUMN id SET DEFAULT nextval('public.pengguna_id_seq'::regclass);


--
-- Name: program_studi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi ALTER COLUMN id SET DEFAULT nextval('public.program_studi_id_seq'::regclass);


--
-- Data for Name: organisasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.organisasi (id, kode, nama, singkatan, tipe, moda, alamat) FROM stdin;
\.


--
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengguna (id, org_id, email, password, otoritas, aktif, hapus, nama, foto) FROM stdin;
\.


--
-- Data for Name: program_studi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.program_studi (id, org_id, kode, nama, jenjang) FROM stdin;
\.


--
-- Name: organisasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.organisasi_id_seq', 5, true);


--
-- Name: pengguna_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengguna_id_seq', 1, true);


--
-- Name: program_studi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.program_studi_id_seq', 1, false);


--
-- Name: organisasi organisasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.organisasi
    ADD CONSTRAINT organisasi_pkey PRIMARY KEY (id);


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
-- Name: pengguna pengguna_org_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengguna
    ADD CONSTRAINT pengguna_org_id_fkey FOREIGN KEY (org_id) REFERENCES public.organisasi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: program_studi program_studi_org_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.program_studi
    ADD CONSTRAINT program_studi_org_id_fkey FOREIGN KEY (org_id) REFERENCES public.organisasi(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

