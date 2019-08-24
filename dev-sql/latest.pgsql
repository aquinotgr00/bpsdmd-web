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
-- Name: datauser; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datauser (
    iduser integer NOT NULL,
    username character varying(100),
    password character varying(100),
    authority character varying(100),
    org integer,
    photo character varying(200)
);


ALTER TABLE public.datauser OWNER TO postgres;

--
-- Data for Name: datauser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.datauser (iduser, username, password, authority, org, photo) FROM stdin;
1	bpsdm	$2y$10$our.1DOtnH9SvBJ.0zCX4u8rqlrBHqeDWKmsx.vunHYsrmPDa5QcO	administrator	\N	NULL
\.


--
-- PostgreSQL database dump complete
--

