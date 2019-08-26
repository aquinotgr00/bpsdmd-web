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
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: dataorg; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dataorg (
    idorg integer NOT NULL,
    name character varying(100) NOT NULL,
    type character varying(6) NOT NULL
);


ALTER TABLE public.dataorg OWNER TO postgres;

--
-- Name: dataorg_idorg_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dataorg_idorg_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dataorg_idorg_seq OWNER TO postgres;

--
-- Name: dataorg_idorg_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dataorg_idorg_seq OWNED BY public.dataorg.idorg;


--
-- Name: datauser; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datauser (
    iduser integer NOT NULL,
    username character varying(100),
    password character varying(100),
    authority character varying(100),
    org integer,
    photo character varying(200),
    name character varying(255)
);


ALTER TABLE public.datauser OWNER TO postgres;

--
-- Name: supply_files; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.supply_files (
    id integer NOT NULL,
    file_name character varying(255),
    uploaded_by integer,
    created_at date,
    org_id integer,
    path character varying(255)
);


ALTER TABLE public.supply_files OWNER TO postgres;

--
-- Name: supply_files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.supply_files_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.supply_files_id_seq OWNER TO postgres;

--
-- Name: supply_files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.supply_files_id_seq OWNED BY public.supply_files.id;


--
-- Name: supply_files id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supply_files ALTER COLUMN id SET DEFAULT nextval('public.supply_files_id_seq'::regclass);


--
-- Data for Name: dataorg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dataorg (idorg, name, type) FROM stdin;
1	coba	supply
2	asdasd	supply
\.


--
-- Data for Name: datauser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.datauser (iduser, username, password, authority, org, photo, name) FROM stdin;
1   bpsdm   $2y$10$Js9k4Py85tVJxfdc/IPLxOlpQ/YbyQjlHlBgoWtlOWEEJAER52YVy    administrator   NULL    \N
2   supply  $2y$10$mlNvPePmSQPjLH7PDrOwNunbfI.6rs8WndIZhxCqSACjEucEwgcfu    supply  NULL    1
3   demand  $2y$10$HAx40TtTUo6i/QuzZOL4AOZwFCkwjjme.SGxmeRYVbY2/OeuXSsIS    demand  NULL    2
\.


--
-- Data for Name: supply_files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.supply_files (id, file_name, uploaded_by, created_at, org_id, path) FROM stdin;
2	25082019_coba.xlsx	3	2019-08-01	1	coba
3	25082019_coba.xlsx	3	2019-08-01	1	coba
\.


--
-- Name: dataorg_idorg_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dataorg_idorg_seq', 1, false);


--
-- Name: supply_files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.supply_files_id_seq', 3, true);


--
-- Name: supply_files supply_files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supply_files
    ADD CONSTRAINT supply_files_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
