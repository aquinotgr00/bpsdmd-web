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
    username character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    authority character varying(13) NOT NULL,
    photo character varying(100),
    org integer
);


ALTER TABLE public.datauser OWNER TO postgres;

--
-- Name: datauser_iduser_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.datauser_iduser_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.datauser_iduser_seq OWNER TO postgres;

--
-- Name: datauser_iduser_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.datauser_iduser_seq OWNED BY public.datauser.iduser;


--
-- Name: dataorg idorg; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dataorg ALTER COLUMN idorg SET DEFAULT nextval('public.dataorg_idorg_seq'::regclass);


--
-- Name: datauser iduser; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datauser ALTER COLUMN iduser SET DEFAULT nextval('public.datauser_iduser_seq'::regclass);


--
-- Data for Name: dataorg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dataorg (idorg, name, type) FROM stdin;
1	Supplier	supply
2	Demand	demand
\.


--
-- Data for Name: datauser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.datauser (iduser, username, password, authority, photo, org) FROM stdin;
1	bpsdm	$2y$10$Js9k4Py85tVJxfdc/IPLxOlpQ/YbyQjlHlBgoWtlOWEEJAER52YVy	administrator	NULL	\N
2	supply	$2y$10$mlNvPePmSQPjLH7PDrOwNunbfI.6rs8WndIZhxCqSACjEucEwgcfu	supply	NULL	1
3	demand	$2y$10$HAx40TtTUo6i/QuzZOL4AOZwFCkwjjme.SGxmeRYVbY2/OeuXSsIS	demand	NULL	2
\.


--
-- Name: dataorg_idorg_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dataorg_idorg_seq', 7, true);


--
-- Name: datauser_iduser_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.datauser_iduser_seq', 6, true);


--
-- Name: dataorg dataorg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dataorg
    ADD CONSTRAINT dataorg_pkey PRIMARY KEY (idorg);


--
-- Name: datauser datauser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datauser
    ADD CONSTRAINT datauser_pkey PRIMARY KEY (iduser);


--
-- PostgreSQL database dump complete
--

