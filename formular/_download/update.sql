--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10881130)
-- Name: inspection_form; Type: TABLE; Schema: public; Owner: ivan
--

DROP TABLE inspection_form;
CREATE TABLE inspection_form (
    id serial NOT NULL,
    id_form character varying(255) NOT NULL,
    objekt integer NOT NULL,
    kontrola character varying(255) NOT NULL,
    kont_vykonal character varying(255) NOT NULL,
    veduci_posty character varying(255) NOT NULL,
    inspector integer NOT NULL,
    typ character varying(255) NOT NULL,
    poc_zon character varying(50) NOT NULL,
    poc_pouz_zon character varying(50) NOT NULL,
    komunikator boolean NOT NULL,
    zalozny_zdroj character varying(255) NOT NULL,
    istenie_psn character varying(255) NOT NULL,
    samostatne_z_rozvadzaca boolean NOT NULL,
    prenos_na_pco boolean NOT NULL,
    stav_prenosu_na_pco boolean NOT NULL,
    tel_linka character varying(255) NOT NULL,
    km_typ_komunikator character varying(255) NOT NULL,
    gsm_typ character varying(255) NOT NULL,
    radio_typ character varying(255) NOT NULL,
    iny_typ character varying(255) NOT NULL,
    statna_policia boolean NOT NULL,
    mestska_policia boolean NOT NULL,
    sbs character varying(255),
    rozvody_pod_omietkou text NOT NULL,
    rozvody_pvc_zlab text NOT NULL,
    rozvody_podhlad text NOT NULL,
    rozvody_ine text NOT NULL,
    stav_psn text NOT NULL,
    zavady text NOT NULL,
    poznamky text NOT NULL,
    sbs_tf boolean
);


--
-- TOC entry 5 (OID 10881130)
-- Name: inspection_form; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form FROM PUBLIC;
GRANT ALL ON TABLE inspection_form TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- TOC entry 7 (OID 10881130)
-- Name: inspection_form_id_seq; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form_id_seq FROM PUBLIC;
GRANT SELECT,UPDATE ON TABLE inspection_form_id_seq TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 9 (OID 10881130)
-- Name: inspection_form; Type: TABLE DATA; Schema: public; Owner: ivan
--

INSERT INTO inspection_form VALUES (4, 'form 345-A3', 1, 'pondelok', 'tankista', 'Meno a kontakt veduceho posty', 3, 'HOMEWORLD typ', '10 zon', '2 pouzite zony', true, '15', 'istenie OK', true, false, false, 'PCO tel', 'KM typ', 'GSM', 'Radio', 'iny -  tankistov', true, false, 'superb SBS', 'pod omietou', 'pvc zlab', 'podhlad', 'ine', 'stav psn', 'zavady', 'poznamkuy', NULL);
INSERT INTO inspection_form VALUES (6, '', 169, 'kont', 'kont vykonal', 'mano a kont posty', 0, 'TYP', 'POCET ZON', 'POCET POUZ ZON', true, 'zalozny zdroj', 'istenie PSn', false, false, false, '', '', '', '', '', false, false, '', '', '', '', '', '', '', '', false);
INSERT INTO inspection_form VALUES (7, '', 169, 'kont', 'kont vykonal', 'mano a kont posty', 0, 'TYP', 'POCET ZON', 'POCET POUZ ZON', true, 'zalozny zdroj', 'istenie PSn', true, true, true, 'tel lnk', 'KM typ', 'GSM', 'Radio', 'iny -  tankistov', false, false, 'nazov sbs', 'sdf', 'dfs', 'sdf', 'dfsadfs', 'dsfd', 'sfdf', 's', true);
INSERT INTO inspection_form VALUES (5, 'sdf', 2, 'f', 'sd', '', 4, 'dfa', 'dsf', '', false, '', '', false, false, false, '', '', '', '', '', false, false, '', 'dfsa', 'fsda', '', 'dfs', 'sdfa', 'sdf', 'fsd', true);
INSERT INTO inspection_form VALUES (8, 'asdf', 169, 'kont', 'kont vykonal', 'mano a kont posty', 0, 'TYP', 'POCET ZON', 'POCET POUZ ZON', true, '', '', true, true, true, '', '', '', '', '', false, false, '', '', '', '', '', '', '', '', false);
INSERT INTO inspection_form VALUES (9, 'asdf', 169, 'kont', 'kont vykonal', 'mano a kont posty', 0, 'TYP', 'POCET ZON', 'POCET POUZ ZON', false, '', '', true, false, true, '', '', '', '', '', false, false, '', '', '', '', '', '', '', '', false);


--
-- TOC entry 8 (OID 10881136)
-- Name: inspection_form_pkey; Type: CONSTRAINT; Schema: public; Owner: ivan
--

ALTER TABLE ONLY inspection_form
    ADD CONSTRAINT inspection_form_pkey PRIMARY KEY (id);


--
-- TOC entry 6 (OID 10881128)
-- Name: inspection_form_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ivan
--

SELECT pg_catalog.setval('inspection_form_id_seq', 9, true);


--
-- TOC entry 4 (OID 10881130)
-- Name: COLUMN inspection_form.sbs_tf; Type: COMMENT; Schema: public; Owner: ivan
--

COMMENT ON COLUMN inspection_form.sbs_tf IS 'ci pouzili SBS, pole SBS je nazov SBS';


--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10880876)
-- Name: inspection_form_sireny; Type: TABLE; Schema: public; Owner: ivan
--

DROP TABLE inspection_form_sireny;
CREATE TABLE inspection_form_sireny (
    id serial NOT NULL,
    "key" integer NOT NULL,
    id_sirena character varying(255),
    cislo character varying(255),
    umiestnenie character varying(255),
    typ character varying(255),
    zalohovana boolean,
    funkcnost boolean,
    status smallint
);


--
-- TOC entry 4 (OID 10880876)
-- Name: inspection_form_sireny; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form_sireny FROM PUBLIC;
GRANT ALL ON TABLE inspection_form_sireny TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- TOC entry 6 (OID 10880876)
-- Name: inspection_form_snimace1_id_seq; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form_snimace1_id_seq FROM PUBLIC;
GRANT SELECT,UPDATE ON TABLE inspection_form_snimace1_id_seq TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 8 (OID 10880876)
-- Name: inspection_form_sireny; Type: TABLE DATA; Schema: public; Owner: ivan
--



--
-- TOC entry 7 (OID 10880882)
-- Name: inspection_form_sireny_pkey; Type: CONSTRAINT; Schema: public; Owner: ivan
--

ALTER TABLE ONLY inspection_form_sireny
    ADD CONSTRAINT inspection_form_sireny_pkey PRIMARY KEY (id);


--
-- TOC entry 5 (OID 10880874)
-- Name: inspection_form_snimace1_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ivan
--

SELECT pg_catalog.setval('inspection_form_snimace1_id_seq', 74, true);


--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10880766)
-- Name: inspection_form_snimace; Type: TABLE; Schema: public; Owner: ivan
--

DROP TABLE inspection_form_snimace;
CREATE TABLE inspection_form_snimace (
    id serial NOT NULL,
    "key" integer NOT NULL,
    id_snimac character varying(255),
    cislo character varying(255),
    adresa text,
    popis text,
    typ character varying(255),
    funkcnost boolean,
    poloha boolean,
    status smallint
);


--
-- TOC entry 4 (OID 10880766)
-- Name: inspection_form_snimace; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form_snimace FROM PUBLIC;
GRANT ALL ON TABLE inspection_form_snimace TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- TOC entry 6 (OID 10880766)
-- Name: inspection_form_snimace_id_seq; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspection_form_snimace_id_seq FROM PUBLIC;
GRANT SELECT,UPDATE ON TABLE inspection_form_snimace_id_seq TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 8 (OID 10880766)
-- Name: inspection_form_snimace; Type: TABLE DATA; Schema: public; Owner: ivan
--

INSERT INTO inspection_form_snimace VALUES (34, 69717300, '11', 'ad', 'fs', 'dsf', 'dfsa', true, false, 1);
INSERT INTO inspection_form_snimace VALUES (35, 69717300, 'sdf', 'df', 'sadf', 'dfds', 'asdf', true, true, 1);
INSERT INTO inspection_form_snimace VALUES (36, 69717300, 'dfs', 'dfsa', 'sfdsf', 'dfs', 'sdfs', false, true, 1);


--
-- TOC entry 7 (OID 10880772)
-- Name: inspection_form_snimace_pkey; Type: CONSTRAINT; Schema: public; Owner: ivan
--

ALTER TABLE ONLY inspection_form_snimace
    ADD CONSTRAINT inspection_form_snimace_pkey PRIMARY KEY (id);


--
-- TOC entry 5 (OID 10880764)
-- Name: inspection_form_snimace_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ivan
--

SELECT pg_catalog.setval('inspection_form_snimace_id_seq', 109, true);


--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10878775)
-- Name: inspector; Type: TABLE; Schema: public; Owner: ivan
--


DROP TABLE inspector;
CREATE TABLE inspector (
    id serial NOT NULL,
    inspector character varying(255) NOT NULL
);


--
-- TOC entry 4 (OID 10878775)
-- Name: inspector; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspector FROM PUBLIC;
GRANT ALL ON TABLE inspector TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- TOC entry 6 (OID 10878775)
-- Name: inspector_id_seq; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspector_id_seq FROM PUBLIC;
GRANT SELECT,UPDATE ON TABLE inspector_id_seq TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 7 (OID 10878775)
-- Name: inspector; Type: TABLE DATA; Schema: public; Owner: ivan
--

INSERT INTO inspector VALUES (1, 'Čunderlíková Viera - 0903 780712');
INSERT INTO inspector VALUES (2, 'Fiala Jaroslav - 0902 924283');
INSERT INTO inspector VALUES (3, 'Ing. Hrubá Anna - 0902 546199');
INSERT INTO inspector VALUES (4, 'TÁM Jozef - 0903 229637');
INSERT INTO inspector VALUES (5, 'Kováčik Ivan - 0902 924280');
INSERT INTO inspector VALUES (6, 'Tomáš Jedlička - 0903 504771');
INSERT INTO inspector VALUES (7, 'Veronika Truchlá - 0903 556294');
INSERT INTO inspector VALUES (8, 'Mačák Ján - 0903 629331');
INSERT INTO inspector VALUES (9, 'Koťo Mikuláš - 0903 654049');
INSERT INTO inspector VALUES (10, 'Karoli Jaroslav - 0903 654056');


--
-- TOC entry 5 (OID 10878773)
-- Name: inspector_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ivan
--

SELECT pg_catalog.setval('inspector_id_seq', 6, true);


--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10883412)
-- Name: inspector_object_connection; Type: TABLE; Schema: public; Owner: ivan
--

DROP TABLE inspector_object_connection;
CREATE TABLE inspector_object_connection (
    id_object integer,
    id_inspector integer
);


--
-- TOC entry 4 (OID 10883412)
-- Name: inspector_object_connection; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE inspector_object_connection FROM PUBLIC;
GRANT ALL ON TABLE inspector_object_connection TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 5 (OID 10883412)
-- Name: inspector_object_connection; Type: TABLE DATA; Schema: public; Owner: ivan
--

INSERT INTO inspector_object_connection VALUES (1, 1);
INSERT INTO inspector_object_connection VALUES (2, 1);
INSERT INTO inspector_object_connection VALUES (3, 1);
INSERT INTO inspector_object_connection VALUES (4, 1);
INSERT INTO inspector_object_connection VALUES (5, 1);
INSERT INTO inspector_object_connection VALUES (6, 1);
INSERT INTO inspector_object_connection VALUES (7, 1);
INSERT INTO inspector_object_connection VALUES (8, 1);
INSERT INTO inspector_object_connection VALUES (9, 1);
INSERT INTO inspector_object_connection VALUES (10, 1);
INSERT INTO inspector_object_connection VALUES (11, 1);
INSERT INTO inspector_object_connection VALUES (12, 1);
INSERT INTO inspector_object_connection VALUES (13, 1);
INSERT INTO inspector_object_connection VALUES (14, 1);
INSERT INTO inspector_object_connection VALUES (15, 1);
INSERT INTO inspector_object_connection VALUES (16, 1);
INSERT INTO inspector_object_connection VALUES (17, 1);
INSERT INTO inspector_object_connection VALUES (18, 1);
INSERT INTO inspector_object_connection VALUES (19, 1);
INSERT INTO inspector_object_connection VALUES (20, 1);
INSERT INTO inspector_object_connection VALUES (21, 1);
INSERT INTO inspector_object_connection VALUES (22, 1);
INSERT INTO inspector_object_connection VALUES (23, 1);
INSERT INTO inspector_object_connection VALUES (24, 1);
INSERT INTO inspector_object_connection VALUES (25, 1);
INSERT INTO inspector_object_connection VALUES (26, 1);
INSERT INTO inspector_object_connection VALUES (27, 1);
INSERT INTO inspector_object_connection VALUES (28, 1);
INSERT INTO inspector_object_connection VALUES (29, 1);
INSERT INTO inspector_object_connection VALUES (30, 1);
INSERT INTO inspector_object_connection VALUES (31, 1);
INSERT INTO inspector_object_connection VALUES (32, 1);
INSERT INTO inspector_object_connection VALUES (33, 1);
INSERT INTO inspector_object_connection VALUES (34, 1);
INSERT INTO inspector_object_connection VALUES (35, 1);
INSERT INTO inspector_object_connection VALUES (36, 1);
INSERT INTO inspector_object_connection VALUES (37, 1);
INSERT INTO inspector_object_connection VALUES (38, 1);
INSERT INTO inspector_object_connection VALUES (39, 1);
INSERT INTO inspector_object_connection VALUES (40, 1);
INSERT INTO inspector_object_connection VALUES (41, 1);
INSERT INTO inspector_object_connection VALUES (42, 1);
INSERT INTO inspector_object_connection VALUES (43, 1);
INSERT INTO inspector_object_connection VALUES (44, 1);
INSERT INTO inspector_object_connection VALUES (45, 1);
INSERT INTO inspector_object_connection VALUES (46, 1);
INSERT INTO inspector_object_connection VALUES (47, 1);
INSERT INTO inspector_object_connection VALUES (48, 1);
INSERT INTO inspector_object_connection VALUES (49, 1);
INSERT INTO inspector_object_connection VALUES (50, 1);
INSERT INTO inspector_object_connection VALUES (51, 1);
INSERT INTO inspector_object_connection VALUES (52, 1);
INSERT INTO inspector_object_connection VALUES (53, 1);
INSERT INTO inspector_object_connection VALUES (54, 1);
INSERT INTO inspector_object_connection VALUES (55, 1);
INSERT INTO inspector_object_connection VALUES (56, 1);
INSERT INTO inspector_object_connection VALUES (57, 1);
INSERT INTO inspector_object_connection VALUES (58, 1);
INSERT INTO inspector_object_connection VALUES (59, 2);
INSERT INTO inspector_object_connection VALUES (60, 2);
INSERT INTO inspector_object_connection VALUES (61, 2);
INSERT INTO inspector_object_connection VALUES (62, 2);
INSERT INTO inspector_object_connection VALUES (63, 2);
INSERT INTO inspector_object_connection VALUES (64, 2);
INSERT INTO inspector_object_connection VALUES (65, 2);
INSERT INTO inspector_object_connection VALUES (66, 2);
INSERT INTO inspector_object_connection VALUES (67, 2);
INSERT INTO inspector_object_connection VALUES (68, 2);
INSERT INTO inspector_object_connection VALUES (69, 2);
INSERT INTO inspector_object_connection VALUES (70, 2);
INSERT INTO inspector_object_connection VALUES (71, 2);
INSERT INTO inspector_object_connection VALUES (72, 2);
INSERT INTO inspector_object_connection VALUES (73, 2);
INSERT INTO inspector_object_connection VALUES (74, 2);
INSERT INTO inspector_object_connection VALUES (75, 2);
INSERT INTO inspector_object_connection VALUES (76, 2);
INSERT INTO inspector_object_connection VALUES (77, 2);
INSERT INTO inspector_object_connection VALUES (78, 2);
INSERT INTO inspector_object_connection VALUES (79, 2);
INSERT INTO inspector_object_connection VALUES (80, 2);
INSERT INTO inspector_object_connection VALUES (81, 2);
INSERT INTO inspector_object_connection VALUES (82, 2);
INSERT INTO inspector_object_connection VALUES (83, 2);
INSERT INTO inspector_object_connection VALUES (84, 2);
INSERT INTO inspector_object_connection VALUES (85, 2);
INSERT INTO inspector_object_connection VALUES (86, 2);
INSERT INTO inspector_object_connection VALUES (87, 2);
INSERT INTO inspector_object_connection VALUES (88, 2);
INSERT INTO inspector_object_connection VALUES (89, 0);
INSERT INTO inspector_object_connection VALUES (90, 0);
INSERT INTO inspector_object_connection VALUES (91, 2);
INSERT INTO inspector_object_connection VALUES (92, 2);
INSERT INTO inspector_object_connection VALUES (93, 2);
INSERT INTO inspector_object_connection VALUES (94, 2);
INSERT INTO inspector_object_connection VALUES (95, 2);
INSERT INTO inspector_object_connection VALUES (96, 2);
INSERT INTO inspector_object_connection VALUES (97, 2);
INSERT INTO inspector_object_connection VALUES (98, 2);
INSERT INTO inspector_object_connection VALUES (99, 2);
INSERT INTO inspector_object_connection VALUES (100, 2);
INSERT INTO inspector_object_connection VALUES (101, 2);
INSERT INTO inspector_object_connection VALUES (102, 2);
INSERT INTO inspector_object_connection VALUES (103, 2);
INSERT INTO inspector_object_connection VALUES (104, 2);
INSERT INTO inspector_object_connection VALUES (105, 2);
INSERT INTO inspector_object_connection VALUES (106, 2);
INSERT INTO inspector_object_connection VALUES (107, 2);
INSERT INTO inspector_object_connection VALUES (108, 2);
INSERT INTO inspector_object_connection VALUES (109, 2);
INSERT INTO inspector_object_connection VALUES (110, 2);
INSERT INTO inspector_object_connection VALUES (111, 2);
INSERT INTO inspector_object_connection VALUES (112, 2);
INSERT INTO inspector_object_connection VALUES (113, 2);
INSERT INTO inspector_object_connection VALUES (114, 2);
INSERT INTO inspector_object_connection VALUES (115, 2);
INSERT INTO inspector_object_connection VALUES (116, 2);
INSERT INTO inspector_object_connection VALUES (117, 2);
INSERT INTO inspector_object_connection VALUES (118, 2);
INSERT INTO inspector_object_connection VALUES (119, 2);
INSERT INTO inspector_object_connection VALUES (120, 2);
INSERT INTO inspector_object_connection VALUES (121, 2);
INSERT INTO inspector_object_connection VALUES (122, 2);
INSERT INTO inspector_object_connection VALUES (123, 2);
INSERT INTO inspector_object_connection VALUES (124, 2);
INSERT INTO inspector_object_connection VALUES (125, 2);
INSERT INTO inspector_object_connection VALUES (126, 2);
INSERT INTO inspector_object_connection VALUES (127, 2);
INSERT INTO inspector_object_connection VALUES (128, 2);
INSERT INTO inspector_object_connection VALUES (129, 2);
INSERT INTO inspector_object_connection VALUES (130, 2);
INSERT INTO inspector_object_connection VALUES (131, 2);
INSERT INTO inspector_object_connection VALUES (132, 2);
INSERT INTO inspector_object_connection VALUES (133, 2);
INSERT INTO inspector_object_connection VALUES (134, 2);
INSERT INTO inspector_object_connection VALUES (135, 2);
INSERT INTO inspector_object_connection VALUES (136, 2);
INSERT INTO inspector_object_connection VALUES (137, 2);
INSERT INTO inspector_object_connection VALUES (138, 2);
INSERT INTO inspector_object_connection VALUES (139, 2);
INSERT INTO inspector_object_connection VALUES (140, 2);
INSERT INTO inspector_object_connection VALUES (141, 2);
INSERT INTO inspector_object_connection VALUES (142, 2);
INSERT INTO inspector_object_connection VALUES (143, 2);
INSERT INTO inspector_object_connection VALUES (144, 2);
INSERT INTO inspector_object_connection VALUES (145, 2);
INSERT INTO inspector_object_connection VALUES (146, 2);
INSERT INTO inspector_object_connection VALUES (147, 2);
INSERT INTO inspector_object_connection VALUES (148, 2);
INSERT INTO inspector_object_connection VALUES (149, 2);
INSERT INTO inspector_object_connection VALUES (150, 2);
INSERT INTO inspector_object_connection VALUES (151, 2);
INSERT INTO inspector_object_connection VALUES (152, 2);
INSERT INTO inspector_object_connection VALUES (153, 2);
INSERT INTO inspector_object_connection VALUES (154, 2);
INSERT INTO inspector_object_connection VALUES (155, 2);
INSERT INTO inspector_object_connection VALUES (156, 2);
INSERT INTO inspector_object_connection VALUES (157, 2);
INSERT INTO inspector_object_connection VALUES (158, 2);
INSERT INTO inspector_object_connection VALUES (159, 2);
INSERT INTO inspector_object_connection VALUES (160, 2);
INSERT INTO inspector_object_connection VALUES (161, 2);
INSERT INTO inspector_object_connection VALUES (162, 2);
INSERT INTO inspector_object_connection VALUES (163, 2);
INSERT INTO inspector_object_connection VALUES (164, 2);
INSERT INTO inspector_object_connection VALUES (165, 2);
INSERT INTO inspector_object_connection VALUES (166, 2);
INSERT INTO inspector_object_connection VALUES (167, 2);
INSERT INTO inspector_object_connection VALUES (168, 2);
INSERT INTO inspector_object_connection VALUES (169, 2);
INSERT INTO inspector_object_connection VALUES (170, 2);
INSERT INTO inspector_object_connection VALUES (171, 2);
INSERT INTO inspector_object_connection VALUES (172, 2);
INSERT INTO inspector_object_connection VALUES (173, 2);
INSERT INTO inspector_object_connection VALUES (174, 2);
INSERT INTO inspector_object_connection VALUES (175, 2);
INSERT INTO inspector_object_connection VALUES (176, 2);
INSERT INTO inspector_object_connection VALUES (177, 2);
INSERT INTO inspector_object_connection VALUES (178, 2);
INSERT INTO inspector_object_connection VALUES (179, 2);
INSERT INTO inspector_object_connection VALUES (180, 2);
INSERT INTO inspector_object_connection VALUES (181, 2);
INSERT INTO inspector_object_connection VALUES (182, 2);
INSERT INTO inspector_object_connection VALUES (183, 2);
INSERT INTO inspector_object_connection VALUES (184, 2);
INSERT INTO inspector_object_connection VALUES (185, 2);
INSERT INTO inspector_object_connection VALUES (186, 2);
INSERT INTO inspector_object_connection VALUES (187, 2);
INSERT INTO inspector_object_connection VALUES (188, 2);
INSERT INTO inspector_object_connection VALUES (189, 2);
INSERT INTO inspector_object_connection VALUES (190, 2);
INSERT INTO inspector_object_connection VALUES (191, 2);
INSERT INTO inspector_object_connection VALUES (192, 2);
INSERT INTO inspector_object_connection VALUES (193, 2);
INSERT INTO inspector_object_connection VALUES (194, 2);
INSERT INTO inspector_object_connection VALUES (195, 2);
INSERT INTO inspector_object_connection VALUES (196, 2);
INSERT INTO inspector_object_connection VALUES (197, 2);
INSERT INTO inspector_object_connection VALUES (198, 2);
INSERT INTO inspector_object_connection VALUES (199, 2);
INSERT INTO inspector_object_connection VALUES (200, 2);
INSERT INTO inspector_object_connection VALUES (201, 2);
INSERT INTO inspector_object_connection VALUES (202, 2);
INSERT INTO inspector_object_connection VALUES (203, 2);
INSERT INTO inspector_object_connection VALUES (204, 2);
INSERT INTO inspector_object_connection VALUES (205, 2);
INSERT INTO inspector_object_connection VALUES (206, 2);
INSERT INTO inspector_object_connection VALUES (207, 2);
INSERT INTO inspector_object_connection VALUES (208, 2);
INSERT INTO inspector_object_connection VALUES (209, 2);
INSERT INTO inspector_object_connection VALUES (210, 2);
INSERT INTO inspector_object_connection VALUES (211, 2);
INSERT INTO inspector_object_connection VALUES (212, 2);
INSERT INTO inspector_object_connection VALUES (213, 2);
INSERT INTO inspector_object_connection VALUES (214, 2);
INSERT INTO inspector_object_connection VALUES (215, 2);
INSERT INTO inspector_object_connection VALUES (216, 3);
INSERT INTO inspector_object_connection VALUES (217, 3);
INSERT INTO inspector_object_connection VALUES (218, 3);
INSERT INTO inspector_object_connection VALUES (219, 3);
INSERT INTO inspector_object_connection VALUES (220, 3);
INSERT INTO inspector_object_connection VALUES (221, 3);
INSERT INTO inspector_object_connection VALUES (222, 3);
INSERT INTO inspector_object_connection VALUES (223, 3);
INSERT INTO inspector_object_connection VALUES (224, 3);
INSERT INTO inspector_object_connection VALUES (225, 3);
INSERT INTO inspector_object_connection VALUES (226, 3);
INSERT INTO inspector_object_connection VALUES (227, 3);
INSERT INTO inspector_object_connection VALUES (228, 3);
INSERT INTO inspector_object_connection VALUES (229, 3);
INSERT INTO inspector_object_connection VALUES (230, 3);
INSERT INTO inspector_object_connection VALUES (231, 3);
INSERT INTO inspector_object_connection VALUES (232, 3);
INSERT INTO inspector_object_connection VALUES (233, 3);
INSERT INTO inspector_object_connection VALUES (234, 3);
INSERT INTO inspector_object_connection VALUES (235, 3);
INSERT INTO inspector_object_connection VALUES (236, 3);
INSERT INTO inspector_object_connection VALUES (237, 3);
INSERT INTO inspector_object_connection VALUES (238, 3);
INSERT INTO inspector_object_connection VALUES (239, 3);
INSERT INTO inspector_object_connection VALUES (240, 3);
INSERT INTO inspector_object_connection VALUES (241, 3);
INSERT INTO inspector_object_connection VALUES (242, 3);
INSERT INTO inspector_object_connection VALUES (243, 3);
INSERT INTO inspector_object_connection VALUES (244, 3);
INSERT INTO inspector_object_connection VALUES (245, 3);
INSERT INTO inspector_object_connection VALUES (246, 3);
INSERT INTO inspector_object_connection VALUES (247, 3);
INSERT INTO inspector_object_connection VALUES (248, 3);
INSERT INTO inspector_object_connection VALUES (249, 3);
INSERT INTO inspector_object_connection VALUES (250, 3);
INSERT INTO inspector_object_connection VALUES (251, 3);
INSERT INTO inspector_object_connection VALUES (252, 3);
INSERT INTO inspector_object_connection VALUES (253, 3);
INSERT INTO inspector_object_connection VALUES (254, 3);
INSERT INTO inspector_object_connection VALUES (255, 3);
INSERT INTO inspector_object_connection VALUES (256, 3);
INSERT INTO inspector_object_connection VALUES (257, 3);
INSERT INTO inspector_object_connection VALUES (258, 3);
INSERT INTO inspector_object_connection VALUES (259, 3);
INSERT INTO inspector_object_connection VALUES (260, 3);
INSERT INTO inspector_object_connection VALUES (261, 3);
INSERT INTO inspector_object_connection VALUES (262, 3);
INSERT INTO inspector_object_connection VALUES (263, 3);
INSERT INTO inspector_object_connection VALUES (264, 3);
INSERT INTO inspector_object_connection VALUES (265, 3);
INSERT INTO inspector_object_connection VALUES (266, 3);
INSERT INTO inspector_object_connection VALUES (267, 3);
INSERT INTO inspector_object_connection VALUES (268, 3);
INSERT INTO inspector_object_connection VALUES (269, 3);
INSERT INTO inspector_object_connection VALUES (270, 3);
INSERT INTO inspector_object_connection VALUES (271, 3);
INSERT INTO inspector_object_connection VALUES (272, 3);
INSERT INTO inspector_object_connection VALUES (273, 3);
INSERT INTO inspector_object_connection VALUES (274, 3);
INSERT INTO inspector_object_connection VALUES (275, 3);
INSERT INTO inspector_object_connection VALUES (276, 3);
INSERT INTO inspector_object_connection VALUES (277, 3);
INSERT INTO inspector_object_connection VALUES (278, 3);
INSERT INTO inspector_object_connection VALUES (279, 3);
INSERT INTO inspector_object_connection VALUES (280, 3);
INSERT INTO inspector_object_connection VALUES (281, 3);
INSERT INTO inspector_object_connection VALUES (282, 3);
INSERT INTO inspector_object_connection VALUES (283, 3);
INSERT INTO inspector_object_connection VALUES (284, 3);
INSERT INTO inspector_object_connection VALUES (285, 3);
INSERT INTO inspector_object_connection VALUES (286, 3);
INSERT INTO inspector_object_connection VALUES (287, 0);
INSERT INTO inspector_object_connection VALUES (288, 0);
INSERT INTO inspector_object_connection VALUES (289, 3);
INSERT INTO inspector_object_connection VALUES (290, 3);
INSERT INTO inspector_object_connection VALUES (291, 3);
INSERT INTO inspector_object_connection VALUES (292, 3);
INSERT INTO inspector_object_connection VALUES (293, 3);
INSERT INTO inspector_object_connection VALUES (294, 3);
INSERT INTO inspector_object_connection VALUES (295, 3);
INSERT INTO inspector_object_connection VALUES (296, 3);
INSERT INTO inspector_object_connection VALUES (297, 3);
INSERT INTO inspector_object_connection VALUES (298, 3);
INSERT INTO inspector_object_connection VALUES (299, 3);
INSERT INTO inspector_object_connection VALUES (300, 3);
INSERT INTO inspector_object_connection VALUES (301, 3);
INSERT INTO inspector_object_connection VALUES (302, 3);
INSERT INTO inspector_object_connection VALUES (303, 3);
INSERT INTO inspector_object_connection VALUES (304, 3);
INSERT INTO inspector_object_connection VALUES (305, 3);
INSERT INTO inspector_object_connection VALUES (306, 3);
INSERT INTO inspector_object_connection VALUES (307, 3);
INSERT INTO inspector_object_connection VALUES (308, 3);
INSERT INTO inspector_object_connection VALUES (309, 3);
INSERT INTO inspector_object_connection VALUES (310, 3);
INSERT INTO inspector_object_connection VALUES (311, 3);
INSERT INTO inspector_object_connection VALUES (312, 3);
INSERT INTO inspector_object_connection VALUES (313, 3);
INSERT INTO inspector_object_connection VALUES (314, 3);
INSERT INTO inspector_object_connection VALUES (315, 3);
INSERT INTO inspector_object_connection VALUES (316, 3);
INSERT INTO inspector_object_connection VALUES (317, 3);
INSERT INTO inspector_object_connection VALUES (318, 3);
INSERT INTO inspector_object_connection VALUES (319, 3);
INSERT INTO inspector_object_connection VALUES (320, 3);
INSERT INTO inspector_object_connection VALUES (321, 3);
INSERT INTO inspector_object_connection VALUES (322, 3);
INSERT INTO inspector_object_connection VALUES (323, 3);
INSERT INTO inspector_object_connection VALUES (324, 3);
INSERT INTO inspector_object_connection VALUES (325, 3);
INSERT INTO inspector_object_connection VALUES (326, 3);
INSERT INTO inspector_object_connection VALUES (327, 3);
INSERT INTO inspector_object_connection VALUES (328, 3);
INSERT INTO inspector_object_connection VALUES (329, 3);
INSERT INTO inspector_object_connection VALUES (330, 3);
INSERT INTO inspector_object_connection VALUES (331, 3);
INSERT INTO inspector_object_connection VALUES (332, 3);
INSERT INTO inspector_object_connection VALUES (333, 3);
INSERT INTO inspector_object_connection VALUES (334, 3);
INSERT INTO inspector_object_connection VALUES (335, 3);
INSERT INTO inspector_object_connection VALUES (336, 3);
INSERT INTO inspector_object_connection VALUES (337, 3);
INSERT INTO inspector_object_connection VALUES (338, 3);
INSERT INTO inspector_object_connection VALUES (339, 3);
INSERT INTO inspector_object_connection VALUES (340, 4);
INSERT INTO inspector_object_connection VALUES (341, 4);
INSERT INTO inspector_object_connection VALUES (342, 4);
INSERT INTO inspector_object_connection VALUES (343, 4);
INSERT INTO inspector_object_connection VALUES (344, 4);
INSERT INTO inspector_object_connection VALUES (345, 4);
INSERT INTO inspector_object_connection VALUES (346, 4);
INSERT INTO inspector_object_connection VALUES (347, 4);
INSERT INTO inspector_object_connection VALUES (348, 4);
INSERT INTO inspector_object_connection VALUES (349, 4);
INSERT INTO inspector_object_connection VALUES (350, 4);
INSERT INTO inspector_object_connection VALUES (351, 4);
INSERT INTO inspector_object_connection VALUES (352, 4);
INSERT INTO inspector_object_connection VALUES (353, 4);
INSERT INTO inspector_object_connection VALUES (354, 4);
INSERT INTO inspector_object_connection VALUES (355, 4);
INSERT INTO inspector_object_connection VALUES (356, 4);
INSERT INTO inspector_object_connection VALUES (357, 4);
INSERT INTO inspector_object_connection VALUES (358, 4);
INSERT INTO inspector_object_connection VALUES (359, 4);
INSERT INTO inspector_object_connection VALUES (360, 4);
INSERT INTO inspector_object_connection VALUES (361, 4);
INSERT INTO inspector_object_connection VALUES (362, 4);
INSERT INTO inspector_object_connection VALUES (363, 4);
INSERT INTO inspector_object_connection VALUES (364, 4);
INSERT INTO inspector_object_connection VALUES (365, 4);
INSERT INTO inspector_object_connection VALUES (366, 4);
INSERT INTO inspector_object_connection VALUES (367, 4);
INSERT INTO inspector_object_connection VALUES (368, 4);
INSERT INTO inspector_object_connection VALUES (369, 4);
INSERT INTO inspector_object_connection VALUES (370, 4);
INSERT INTO inspector_object_connection VALUES (371, 4);
INSERT INTO inspector_object_connection VALUES (372, 4);
INSERT INTO inspector_object_connection VALUES (373, 4);
INSERT INTO inspector_object_connection VALUES (374, 4);
INSERT INTO inspector_object_connection VALUES (375, 4);
INSERT INTO inspector_object_connection VALUES (376, 4);
INSERT INTO inspector_object_connection VALUES (377, 4);
INSERT INTO inspector_object_connection VALUES (378, 4);
INSERT INTO inspector_object_connection VALUES (379, 4);
INSERT INTO inspector_object_connection VALUES (380, 4);
INSERT INTO inspector_object_connection VALUES (381, 4);
INSERT INTO inspector_object_connection VALUES (382, 4);
INSERT INTO inspector_object_connection VALUES (383, 4);
INSERT INTO inspector_object_connection VALUES (384, 4);
INSERT INTO inspector_object_connection VALUES (385, 4);
INSERT INTO inspector_object_connection VALUES (386, 4);
INSERT INTO inspector_object_connection VALUES (387, 4);
INSERT INTO inspector_object_connection VALUES (388, 4);
INSERT INTO inspector_object_connection VALUES (389, 4);
INSERT INTO inspector_object_connection VALUES (390, 4);
INSERT INTO inspector_object_connection VALUES (391, 4);
INSERT INTO inspector_object_connection VALUES (392, 4);
INSERT INTO inspector_object_connection VALUES (393, 4);
INSERT INTO inspector_object_connection VALUES (394, 4);
INSERT INTO inspector_object_connection VALUES (395, 4);
INSERT INTO inspector_object_connection VALUES (396, 4);
INSERT INTO inspector_object_connection VALUES (397, 5);
INSERT INTO inspector_object_connection VALUES (398, 5);
INSERT INTO inspector_object_connection VALUES (399, 5);
INSERT INTO inspector_object_connection VALUES (400, 5);
INSERT INTO inspector_object_connection VALUES (401, 5);
INSERT INTO inspector_object_connection VALUES (402, 5);
INSERT INTO inspector_object_connection VALUES (403, 5);
INSERT INTO inspector_object_connection VALUES (404, 5);
INSERT INTO inspector_object_connection VALUES (405, 5);
INSERT INTO inspector_object_connection VALUES (406, 5);
INSERT INTO inspector_object_connection VALUES (407, 5);
INSERT INTO inspector_object_connection VALUES (408, 5);
INSERT INTO inspector_object_connection VALUES (409, 5);
INSERT INTO inspector_object_connection VALUES (410, 5);
INSERT INTO inspector_object_connection VALUES (411, 5);
INSERT INTO inspector_object_connection VALUES (412, 5);
INSERT INTO inspector_object_connection VALUES (413, 5);
INSERT INTO inspector_object_connection VALUES (414, 5);
INSERT INTO inspector_object_connection VALUES (415, 5);
INSERT INTO inspector_object_connection VALUES (416, 5);
INSERT INTO inspector_object_connection VALUES (417, 5);
INSERT INTO inspector_object_connection VALUES (418, 5);
INSERT INTO inspector_object_connection VALUES (419, 5);
INSERT INTO inspector_object_connection VALUES (420, 5);
INSERT INTO inspector_object_connection VALUES (421, 5);
INSERT INTO inspector_object_connection VALUES (422, 5);
INSERT INTO inspector_object_connection VALUES (423, 5);
INSERT INTO inspector_object_connection VALUES (424, 5);
INSERT INTO inspector_object_connection VALUES (425, 5);
INSERT INTO inspector_object_connection VALUES (426, 5);
INSERT INTO inspector_object_connection VALUES (427, 5);
INSERT INTO inspector_object_connection VALUES (428, 5);
INSERT INTO inspector_object_connection VALUES (429, 5);
INSERT INTO inspector_object_connection VALUES (430, 5);
INSERT INTO inspector_object_connection VALUES (431, 5);
INSERT INTO inspector_object_connection VALUES (432, 5);
INSERT INTO inspector_object_connection VALUES (433, 5);
INSERT INTO inspector_object_connection VALUES (434, 5);
INSERT INTO inspector_object_connection VALUES (435, 5);
INSERT INTO inspector_object_connection VALUES (436, 5);
INSERT INTO inspector_object_connection VALUES (437, 5);
INSERT INTO inspector_object_connection VALUES (438, 5);
INSERT INTO inspector_object_connection VALUES (439, 5);
INSERT INTO inspector_object_connection VALUES (440, 5);
INSERT INTO inspector_object_connection VALUES (441, 5);
INSERT INTO inspector_object_connection VALUES (442, 5);
INSERT INTO inspector_object_connection VALUES (443, 5);
INSERT INTO inspector_object_connection VALUES (444, 5);
INSERT INTO inspector_object_connection VALUES (445, 5);
INSERT INTO inspector_object_connection VALUES (446, 5);
INSERT INTO inspector_object_connection VALUES (447, 5);
INSERT INTO inspector_object_connection VALUES (448, 5);
INSERT INTO inspector_object_connection VALUES (449, 5);
INSERT INTO inspector_object_connection VALUES (450, 5);
INSERT INTO inspector_object_connection VALUES (451, 5);
INSERT INTO inspector_object_connection VALUES (452, 5);
INSERT INTO inspector_object_connection VALUES (453, 5);
INSERT INTO inspector_object_connection VALUES (454, 5);
INSERT INTO inspector_object_connection VALUES (455, 5);
INSERT INTO inspector_object_connection VALUES (456, 5);
INSERT INTO inspector_object_connection VALUES (457, 5);
INSERT INTO inspector_object_connection VALUES (458, 5);
INSERT INTO inspector_object_connection VALUES (459, 5);
INSERT INTO inspector_object_connection VALUES (460, 5);
INSERT INTO inspector_object_connection VALUES (461, 5);
INSERT INTO inspector_object_connection VALUES (462, 5);
INSERT INTO inspector_object_connection VALUES (463, 5);
INSERT INTO inspector_object_connection VALUES (464, 5);
INSERT INTO inspector_object_connection VALUES (465, 5);
INSERT INTO inspector_object_connection VALUES (466, 5);
INSERT INTO inspector_object_connection VALUES (467, 5);
INSERT INTO inspector_object_connection VALUES (468, 5);
INSERT INTO inspector_object_connection VALUES (469, 5);
INSERT INTO inspector_object_connection VALUES (470, 5);
INSERT INTO inspector_object_connection VALUES (471, 5);
INSERT INTO inspector_object_connection VALUES (472, 5);
INSERT INTO inspector_object_connection VALUES (473, 5);
INSERT INTO inspector_object_connection VALUES (474, 5);
INSERT INTO inspector_object_connection VALUES (475, 5);
INSERT INTO inspector_object_connection VALUES (476, 5);
INSERT INTO inspector_object_connection VALUES (477, 5);
INSERT INTO inspector_object_connection VALUES (478, 5);
INSERT INTO inspector_object_connection VALUES (479, 5);
INSERT INTO inspector_object_connection VALUES (480, 5);
INSERT INTO inspector_object_connection VALUES (481, 5);
INSERT INTO inspector_object_connection VALUES (482, 5);
INSERT INTO inspector_object_connection VALUES (483, 5);
INSERT INTO inspector_object_connection VALUES (484, 5);
INSERT INTO inspector_object_connection VALUES (485, 5);
INSERT INTO inspector_object_connection VALUES (486, 5);
INSERT INTO inspector_object_connection VALUES (487, 5);
INSERT INTO inspector_object_connection VALUES (488, 5);
INSERT INTO inspector_object_connection VALUES (489, 5);
INSERT INTO inspector_object_connection VALUES (490, 5);
INSERT INTO inspector_object_connection VALUES (491, 5);
INSERT INTO inspector_object_connection VALUES (492, 5);
INSERT INTO inspector_object_connection VALUES (493, 5);
INSERT INTO inspector_object_connection VALUES (494, 6);
INSERT INTO inspector_object_connection VALUES (495, 6);
INSERT INTO inspector_object_connection VALUES (496, 6);
INSERT INTO inspector_object_connection VALUES (497, 6);
INSERT INTO inspector_object_connection VALUES (498, 6);
INSERT INTO inspector_object_connection VALUES (499, 6);
INSERT INTO inspector_object_connection VALUES (500, 6);
INSERT INTO inspector_object_connection VALUES (501, 6);
INSERT INTO inspector_object_connection VALUES (502, 6);
INSERT INTO inspector_object_connection VALUES (503, 6);
INSERT INTO inspector_object_connection VALUES (504, 6);
INSERT INTO inspector_object_connection VALUES (505, 6);
INSERT INTO inspector_object_connection VALUES (506, 6);
INSERT INTO inspector_object_connection VALUES (507, 6);
INSERT INTO inspector_object_connection VALUES (508, 6);
INSERT INTO inspector_object_connection VALUES (509, 6);
INSERT INTO inspector_object_connection VALUES (510, 6);
INSERT INTO inspector_object_connection VALUES (511, 6);
INSERT INTO inspector_object_connection VALUES (512, 6);
INSERT INTO inspector_object_connection VALUES (513, 6);
INSERT INTO inspector_object_connection VALUES (514, 6);
INSERT INTO inspector_object_connection VALUES (515, 6);
INSERT INTO inspector_object_connection VALUES (516, 6);
INSERT INTO inspector_object_connection VALUES (517, 6);
INSERT INTO inspector_object_connection VALUES (518, 6);
INSERT INTO inspector_object_connection VALUES (519, 6);
INSERT INTO inspector_object_connection VALUES (520, 6);
INSERT INTO inspector_object_connection VALUES (521, 6);
INSERT INTO inspector_object_connection VALUES (522, 6);
INSERT INTO inspector_object_connection VALUES (523, 6);
INSERT INTO inspector_object_connection VALUES (524, 6);
INSERT INTO inspector_object_connection VALUES (525, 6);
INSERT INTO inspector_object_connection VALUES (526, 6);
INSERT INTO inspector_object_connection VALUES (527, 6);
INSERT INTO inspector_object_connection VALUES (528, 6);
INSERT INTO inspector_object_connection VALUES (529, 6);
INSERT INTO inspector_object_connection VALUES (530, 6);
INSERT INTO inspector_object_connection VALUES (531, 6);
INSERT INTO inspector_object_connection VALUES (532, 6);
INSERT INTO inspector_object_connection VALUES (533, 6);
INSERT INTO inspector_object_connection VALUES (534, 6);
INSERT INTO inspector_object_connection VALUES (535, 6);
INSERT INTO inspector_object_connection VALUES (536, 6);
INSERT INTO inspector_object_connection VALUES (537, 6);
INSERT INTO inspector_object_connection VALUES (538, 6);
INSERT INTO inspector_object_connection VALUES (539, 6);
INSERT INTO inspector_object_connection VALUES (540, 6);
INSERT INTO inspector_object_connection VALUES (541, 6);
INSERT INTO inspector_object_connection VALUES (542, 6);
INSERT INTO inspector_object_connection VALUES (543, 6);
INSERT INTO inspector_object_connection VALUES (544, 6);
INSERT INTO inspector_object_connection VALUES (545, 6);
INSERT INTO inspector_object_connection VALUES (546, 6);
INSERT INTO inspector_object_connection VALUES (547, 6);
INSERT INTO inspector_object_connection VALUES (548, 6);
INSERT INTO inspector_object_connection VALUES (549, 6);
INSERT INTO inspector_object_connection VALUES (550, 6);
INSERT INTO inspector_object_connection VALUES (551, 6);
INSERT INTO inspector_object_connection VALUES (552, 6);
INSERT INTO inspector_object_connection VALUES (553, 6);
INSERT INTO inspector_object_connection VALUES (554, 6);
INSERT INTO inspector_object_connection VALUES (555, 6);
INSERT INTO inspector_object_connection VALUES (556, 6);
INSERT INTO inspector_object_connection VALUES (557, 6);
INSERT INTO inspector_object_connection VALUES (558, 6);
INSERT INTO inspector_object_connection VALUES (559, 6);
INSERT INTO inspector_object_connection VALUES (560, 6);
INSERT INTO inspector_object_connection VALUES (561, 6);
INSERT INTO inspector_object_connection VALUES (562, 6);
INSERT INTO inspector_object_connection VALUES (563, 6);
INSERT INTO inspector_object_connection VALUES (564, 6);
INSERT INTO inspector_object_connection VALUES (565, 6);
INSERT INTO inspector_object_connection VALUES (566, 6);
INSERT INTO inspector_object_connection VALUES (567, 6);
INSERT INTO inspector_object_connection VALUES (568, 6);
INSERT INTO inspector_object_connection VALUES (569, 6);
INSERT INTO inspector_object_connection VALUES (570, 6);
INSERT INTO inspector_object_connection VALUES (571, 6);
INSERT INTO inspector_object_connection VALUES (572, 6);
INSERT INTO inspector_object_connection VALUES (573, 6);
INSERT INTO inspector_object_connection VALUES (574, 6);
INSERT INTO inspector_object_connection VALUES (575, 6);
INSERT INTO inspector_object_connection VALUES (576, 6);
INSERT INTO inspector_object_connection VALUES (577, 6);
INSERT INTO inspector_object_connection VALUES (578, 6);
INSERT INTO inspector_object_connection VALUES (579, 6);
INSERT INTO inspector_object_connection VALUES (580, 6);
INSERT INTO inspector_object_connection VALUES (581, 6);
INSERT INTO inspector_object_connection VALUES (582, 6);
INSERT INTO inspector_object_connection VALUES (583, 6);
INSERT INTO inspector_object_connection VALUES (584, 6);
INSERT INTO inspector_object_connection VALUES (585, 6);
INSERT INTO inspector_object_connection VALUES (586, 6);
INSERT INTO inspector_object_connection VALUES (587, 6);
INSERT INTO inspector_object_connection VALUES (588, 6);
INSERT INTO inspector_object_connection VALUES (589, 6);
INSERT INTO inspector_object_connection VALUES (590, 6);
INSERT INTO inspector_object_connection VALUES (591, 6);
INSERT INTO inspector_object_connection VALUES (592, 6);
INSERT INTO inspector_object_connection VALUES (593, 6);
INSERT INTO inspector_object_connection VALUES (594, 6);
INSERT INTO inspector_object_connection VALUES (595, 6);
INSERT INTO inspector_object_connection VALUES (596, 6);
INSERT INTO inspector_object_connection VALUES (597, 6);
INSERT INTO inspector_object_connection VALUES (598, 6);
INSERT INTO inspector_object_connection VALUES (599, 6);
INSERT INTO inspector_object_connection VALUES (600, 6);
INSERT INTO inspector_object_connection VALUES (601, 6);
INSERT INTO inspector_object_connection VALUES (602, 6);
INSERT INTO inspector_object_connection VALUES (603, 6);
INSERT INTO inspector_object_connection VALUES (604, 6);
INSERT INTO inspector_object_connection VALUES (605, 6);
INSERT INTO inspector_object_connection VALUES (606, 6);
INSERT INTO inspector_object_connection VALUES (607, 6);
INSERT INTO inspector_object_connection VALUES (608, 6);
INSERT INTO inspector_object_connection VALUES (609, 7);
INSERT INTO inspector_object_connection VALUES (610, 7);
INSERT INTO inspector_object_connection VALUES (611, 7);
INSERT INTO inspector_object_connection VALUES (612, 7);
INSERT INTO inspector_object_connection VALUES (613, 7);
INSERT INTO inspector_object_connection VALUES (614, 7);
INSERT INTO inspector_object_connection VALUES (615, 7);
INSERT INTO inspector_object_connection VALUES (616, 7);
INSERT INTO inspector_object_connection VALUES (617, 7);
INSERT INTO inspector_object_connection VALUES (618, 7);
INSERT INTO inspector_object_connection VALUES (619, 7);
INSERT INTO inspector_object_connection VALUES (620, 7);
INSERT INTO inspector_object_connection VALUES (621, 7);
INSERT INTO inspector_object_connection VALUES (622, 7);
INSERT INTO inspector_object_connection VALUES (623, 7);
INSERT INTO inspector_object_connection VALUES (624, 7);
INSERT INTO inspector_object_connection VALUES (625, 7);
INSERT INTO inspector_object_connection VALUES (626, 7);
INSERT INTO inspector_object_connection VALUES (627, 7);
INSERT INTO inspector_object_connection VALUES (628, 7);
INSERT INTO inspector_object_connection VALUES (629, 7);
INSERT INTO inspector_object_connection VALUES (630, 7);
INSERT INTO inspector_object_connection VALUES (631, 7);
INSERT INTO inspector_object_connection VALUES (632, 7);
INSERT INTO inspector_object_connection VALUES (633, 7);
INSERT INTO inspector_object_connection VALUES (634, 7);
INSERT INTO inspector_object_connection VALUES (635, 7);
INSERT INTO inspector_object_connection VALUES (636, 7);
INSERT INTO inspector_object_connection VALUES (637, 7);
INSERT INTO inspector_object_connection VALUES (638, 7);
INSERT INTO inspector_object_connection VALUES (639, 7);
INSERT INTO inspector_object_connection VALUES (640, 7);
INSERT INTO inspector_object_connection VALUES (641, 7);
INSERT INTO inspector_object_connection VALUES (642, 7);
INSERT INTO inspector_object_connection VALUES (643, 7);
INSERT INTO inspector_object_connection VALUES (644, 7);
INSERT INTO inspector_object_connection VALUES (645, 7);
INSERT INTO inspector_object_connection VALUES (646, 7);
INSERT INTO inspector_object_connection VALUES (647, 7);
INSERT INTO inspector_object_connection VALUES (648, 7);
INSERT INTO inspector_object_connection VALUES (649, 7);
INSERT INTO inspector_object_connection VALUES (650, 7);
INSERT INTO inspector_object_connection VALUES (651, 7);
INSERT INTO inspector_object_connection VALUES (652, 7);
INSERT INTO inspector_object_connection VALUES (653, 7);
INSERT INTO inspector_object_connection VALUES (654, 7);
INSERT INTO inspector_object_connection VALUES (655, 7);
INSERT INTO inspector_object_connection VALUES (656, 7);
INSERT INTO inspector_object_connection VALUES (657, 7);
INSERT INTO inspector_object_connection VALUES (658, 7);
INSERT INTO inspector_object_connection VALUES (659, 7);
INSERT INTO inspector_object_connection VALUES (660, 7);
INSERT INTO inspector_object_connection VALUES (661, 7);
INSERT INTO inspector_object_connection VALUES (662, 7);
INSERT INTO inspector_object_connection VALUES (663, 7);
INSERT INTO inspector_object_connection VALUES (664, 7);
INSERT INTO inspector_object_connection VALUES (665, 7);
INSERT INTO inspector_object_connection VALUES (666, 7);
INSERT INTO inspector_object_connection VALUES (667, 7);
INSERT INTO inspector_object_connection VALUES (668, 7);
INSERT INTO inspector_object_connection VALUES (669, 7);
INSERT INTO inspector_object_connection VALUES (670, 7);
INSERT INTO inspector_object_connection VALUES (671, 7);
INSERT INTO inspector_object_connection VALUES (672, 7);
INSERT INTO inspector_object_connection VALUES (673, 7);
INSERT INTO inspector_object_connection VALUES (674, 7);
INSERT INTO inspector_object_connection VALUES (675, 7);
INSERT INTO inspector_object_connection VALUES (676, 7);
INSERT INTO inspector_object_connection VALUES (677, 7);
INSERT INTO inspector_object_connection VALUES (678, 7);
INSERT INTO inspector_object_connection VALUES (679, 8);
INSERT INTO inspector_object_connection VALUES (680, 8);
INSERT INTO inspector_object_connection VALUES (681, 8);
INSERT INTO inspector_object_connection VALUES (682, 8);
INSERT INTO inspector_object_connection VALUES (683, 8);
INSERT INTO inspector_object_connection VALUES (684, 8);
INSERT INTO inspector_object_connection VALUES (685, 8);
INSERT INTO inspector_object_connection VALUES (686, 8);
INSERT INTO inspector_object_connection VALUES (687, 8);
INSERT INTO inspector_object_connection VALUES (688, 8);
INSERT INTO inspector_object_connection VALUES (689, 8);
INSERT INTO inspector_object_connection VALUES (690, 8);
INSERT INTO inspector_object_connection VALUES (691, 8);
INSERT INTO inspector_object_connection VALUES (692, 8);
INSERT INTO inspector_object_connection VALUES (693, 8);
INSERT INTO inspector_object_connection VALUES (694, 8);
INSERT INTO inspector_object_connection VALUES (695, 8);
INSERT INTO inspector_object_connection VALUES (696, 8);
INSERT INTO inspector_object_connection VALUES (697, 8);
INSERT INTO inspector_object_connection VALUES (698, 8);
INSERT INTO inspector_object_connection VALUES (699, 8);
INSERT INTO inspector_object_connection VALUES (700, 8);
INSERT INTO inspector_object_connection VALUES (701, 8);
INSERT INTO inspector_object_connection VALUES (702, 8);
INSERT INTO inspector_object_connection VALUES (703, 8);
INSERT INTO inspector_object_connection VALUES (704, 8);
INSERT INTO inspector_object_connection VALUES (705, 8);
INSERT INTO inspector_object_connection VALUES (706, 8);
INSERT INTO inspector_object_connection VALUES (707, 8);
INSERT INTO inspector_object_connection VALUES (708, 8);
INSERT INTO inspector_object_connection VALUES (709, 8);
INSERT INTO inspector_object_connection VALUES (710, 8);
INSERT INTO inspector_object_connection VALUES (711, 8);
INSERT INTO inspector_object_connection VALUES (712, 8);
INSERT INTO inspector_object_connection VALUES (713, 8);
INSERT INTO inspector_object_connection VALUES (714, 8);
INSERT INTO inspector_object_connection VALUES (715, 8);
INSERT INTO inspector_object_connection VALUES (716, 8);
INSERT INTO inspector_object_connection VALUES (717, 8);
INSERT INTO inspector_object_connection VALUES (718, 8);
INSERT INTO inspector_object_connection VALUES (719, 8);
INSERT INTO inspector_object_connection VALUES (720, 8);
INSERT INTO inspector_object_connection VALUES (721, 8);
INSERT INTO inspector_object_connection VALUES (722, 8);
INSERT INTO inspector_object_connection VALUES (723, 8);
INSERT INTO inspector_object_connection VALUES (724, 8);
INSERT INTO inspector_object_connection VALUES (725, 8);
INSERT INTO inspector_object_connection VALUES (726, 8);
INSERT INTO inspector_object_connection VALUES (727, 8);
INSERT INTO inspector_object_connection VALUES (728, 8);
INSERT INTO inspector_object_connection VALUES (729, 8);
INSERT INTO inspector_object_connection VALUES (730, 8);
INSERT INTO inspector_object_connection VALUES (731, 8);
INSERT INTO inspector_object_connection VALUES (732, 8);
INSERT INTO inspector_object_connection VALUES (733, 8);
INSERT INTO inspector_object_connection VALUES (734, 8);
INSERT INTO inspector_object_connection VALUES (735, 8);
INSERT INTO inspector_object_connection VALUES (736, 8);
INSERT INTO inspector_object_connection VALUES (737, 8);
INSERT INTO inspector_object_connection VALUES (738, 8);
INSERT INTO inspector_object_connection VALUES (739, 8);
INSERT INTO inspector_object_connection VALUES (740, 8);
INSERT INTO inspector_object_connection VALUES (741, 8);
INSERT INTO inspector_object_connection VALUES (742, 8);
INSERT INTO inspector_object_connection VALUES (743, 8);
INSERT INTO inspector_object_connection VALUES (744, 8);
INSERT INTO inspector_object_connection VALUES (745, 8);
INSERT INTO inspector_object_connection VALUES (746, 8);
INSERT INTO inspector_object_connection VALUES (747, 8);
INSERT INTO inspector_object_connection VALUES (748, 8);
INSERT INTO inspector_object_connection VALUES (749, 8);
INSERT INTO inspector_object_connection VALUES (750, 8);
INSERT INTO inspector_object_connection VALUES (751, 8);
INSERT INTO inspector_object_connection VALUES (752, 8);
INSERT INTO inspector_object_connection VALUES (753, 8);
INSERT INTO inspector_object_connection VALUES (754, 8);
INSERT INTO inspector_object_connection VALUES (755, 8);
INSERT INTO inspector_object_connection VALUES (756, 8);
INSERT INTO inspector_object_connection VALUES (757, 8);
INSERT INTO inspector_object_connection VALUES (758, 8);
INSERT INTO inspector_object_connection VALUES (759, 8);
INSERT INTO inspector_object_connection VALUES (760, 8);
INSERT INTO inspector_object_connection VALUES (761, 8);
INSERT INTO inspector_object_connection VALUES (762, 8);
INSERT INTO inspector_object_connection VALUES (763, 8);
INSERT INTO inspector_object_connection VALUES (764, 8);
INSERT INTO inspector_object_connection VALUES (765, 8);
INSERT INTO inspector_object_connection VALUES (766, 8);
INSERT INTO inspector_object_connection VALUES (767, 8);
INSERT INTO inspector_object_connection VALUES (768, 8);
INSERT INTO inspector_object_connection VALUES (769, 8);
INSERT INTO inspector_object_connection VALUES (770, 8);
INSERT INTO inspector_object_connection VALUES (771, 8);
INSERT INTO inspector_object_connection VALUES (772, 8);
INSERT INTO inspector_object_connection VALUES (773, 8);
INSERT INTO inspector_object_connection VALUES (774, 8);
INSERT INTO inspector_object_connection VALUES (775, 8);
INSERT INTO inspector_object_connection VALUES (776, 8);
INSERT INTO inspector_object_connection VALUES (777, 8);
INSERT INTO inspector_object_connection VALUES (778, 8);
INSERT INTO inspector_object_connection VALUES (779, 8);
INSERT INTO inspector_object_connection VALUES (780, 8);
INSERT INTO inspector_object_connection VALUES (781, 8);
INSERT INTO inspector_object_connection VALUES (782, 8);
INSERT INTO inspector_object_connection VALUES (783, 8);
INSERT INTO inspector_object_connection VALUES (784, 9);
INSERT INTO inspector_object_connection VALUES (785, 9);
INSERT INTO inspector_object_connection VALUES (786, 9);
INSERT INTO inspector_object_connection VALUES (787, 9);
INSERT INTO inspector_object_connection VALUES (788, 9);
INSERT INTO inspector_object_connection VALUES (789, 9);
INSERT INTO inspector_object_connection VALUES (790, 9);
INSERT INTO inspector_object_connection VALUES (791, 9);
INSERT INTO inspector_object_connection VALUES (792, 9);
INSERT INTO inspector_object_connection VALUES (793, 9);
INSERT INTO inspector_object_connection VALUES (794, 9);
INSERT INTO inspector_object_connection VALUES (795, 9);
INSERT INTO inspector_object_connection VALUES (796, 9);
INSERT INTO inspector_object_connection VALUES (797, 9);
INSERT INTO inspector_object_connection VALUES (798, 9);
INSERT INTO inspector_object_connection VALUES (799, 9);
INSERT INTO inspector_object_connection VALUES (800, 9);
INSERT INTO inspector_object_connection VALUES (801, 9);
INSERT INTO inspector_object_connection VALUES (802, 9);
INSERT INTO inspector_object_connection VALUES (803, 9);
INSERT INTO inspector_object_connection VALUES (804, 9);
INSERT INTO inspector_object_connection VALUES (805, 9);
INSERT INTO inspector_object_connection VALUES (806, 9);
INSERT INTO inspector_object_connection VALUES (807, 9);
INSERT INTO inspector_object_connection VALUES (808, 9);
INSERT INTO inspector_object_connection VALUES (809, 9);
INSERT INTO inspector_object_connection VALUES (810, 9);
INSERT INTO inspector_object_connection VALUES (811, 9);
INSERT INTO inspector_object_connection VALUES (812, 9);
INSERT INTO inspector_object_connection VALUES (813, 9);
INSERT INTO inspector_object_connection VALUES (814, 9);
INSERT INTO inspector_object_connection VALUES (815, 9);
INSERT INTO inspector_object_connection VALUES (816, 9);
INSERT INTO inspector_object_connection VALUES (817, 9);
INSERT INTO inspector_object_connection VALUES (818, 9);
INSERT INTO inspector_object_connection VALUES (819, 9);
INSERT INTO inspector_object_connection VALUES (820, 9);
INSERT INTO inspector_object_connection VALUES (821, 9);
INSERT INTO inspector_object_connection VALUES (822, 9);
INSERT INTO inspector_object_connection VALUES (823, 9);
INSERT INTO inspector_object_connection VALUES (824, 9);
INSERT INTO inspector_object_connection VALUES (825, 9);
INSERT INTO inspector_object_connection VALUES (826, 9);
INSERT INTO inspector_object_connection VALUES (827, 9);
INSERT INTO inspector_object_connection VALUES (828, 9);
INSERT INTO inspector_object_connection VALUES (829, 9);
INSERT INTO inspector_object_connection VALUES (830, 9);
INSERT INTO inspector_object_connection VALUES (831, 9);
INSERT INTO inspector_object_connection VALUES (832, 9);
INSERT INTO inspector_object_connection VALUES (833, 9);
INSERT INTO inspector_object_connection VALUES (834, 9);
INSERT INTO inspector_object_connection VALUES (835, 9);
INSERT INTO inspector_object_connection VALUES (836, 9);
INSERT INTO inspector_object_connection VALUES (837, 9);
INSERT INTO inspector_object_connection VALUES (838, 9);
INSERT INTO inspector_object_connection VALUES (839, 9);
INSERT INTO inspector_object_connection VALUES (840, 9);
INSERT INTO inspector_object_connection VALUES (841, 10);
INSERT INTO inspector_object_connection VALUES (842, 10);
INSERT INTO inspector_object_connection VALUES (843, 10);
INSERT INTO inspector_object_connection VALUES (844, 10);
INSERT INTO inspector_object_connection VALUES (845, 10);
INSERT INTO inspector_object_connection VALUES (846, 10);
INSERT INTO inspector_object_connection VALUES (847, 10);
INSERT INTO inspector_object_connection VALUES (848, 10);
INSERT INTO inspector_object_connection VALUES (849, 10);
INSERT INTO inspector_object_connection VALUES (850, 10);
INSERT INTO inspector_object_connection VALUES (851, 10);
INSERT INTO inspector_object_connection VALUES (852, 10);
INSERT INTO inspector_object_connection VALUES (853, 10);
INSERT INTO inspector_object_connection VALUES (854, 10);
INSERT INTO inspector_object_connection VALUES (855, 10);
INSERT INTO inspector_object_connection VALUES (856, 10);
INSERT INTO inspector_object_connection VALUES (857, 10);
INSERT INTO inspector_object_connection VALUES (858, 10);
INSERT INTO inspector_object_connection VALUES (859, 10);
INSERT INTO inspector_object_connection VALUES (860, 10);
INSERT INTO inspector_object_connection VALUES (861, 10);
INSERT INTO inspector_object_connection VALUES (862, 10);
INSERT INTO inspector_object_connection VALUES (863, 10);
INSERT INTO inspector_object_connection VALUES (864, 10);
INSERT INTO inspector_object_connection VALUES (865, 10);
INSERT INTO inspector_object_connection VALUES (866, 10);
INSERT INTO inspector_object_connection VALUES (867, 10);
INSERT INTO inspector_object_connection VALUES (868, 10);
INSERT INTO inspector_object_connection VALUES (869, 10);
INSERT INTO inspector_object_connection VALUES (870, 10);
INSERT INTO inspector_object_connection VALUES (871, 10);
INSERT INTO inspector_object_connection VALUES (872, 10);
INSERT INTO inspector_object_connection VALUES (873, 10);
INSERT INTO inspector_object_connection VALUES (874, 10);
INSERT INTO inspector_object_connection VALUES (875, 10);
INSERT INTO inspector_object_connection VALUES (876, 10);
INSERT INTO inspector_object_connection VALUES (877, 10);
INSERT INTO inspector_object_connection VALUES (878, 10);
INSERT INTO inspector_object_connection VALUES (879, 10);
INSERT INTO inspector_object_connection VALUES (880, 10);
INSERT INTO inspector_object_connection VALUES (881, 10);
INSERT INTO inspector_object_connection VALUES (882, 10);
INSERT INTO inspector_object_connection VALUES (883, 10);
INSERT INTO inspector_object_connection VALUES (884, 10);
INSERT INTO inspector_object_connection VALUES (885, 10);
INSERT INTO inspector_object_connection VALUES (886, 10);
INSERT INTO inspector_object_connection VALUES (887, 10);
INSERT INTO inspector_object_connection VALUES (888, 10);
INSERT INTO inspector_object_connection VALUES (889, 10);
INSERT INTO inspector_object_connection VALUES (890, 10);
INSERT INTO inspector_object_connection VALUES (891, 10);
INSERT INTO inspector_object_connection VALUES (892, 10);
INSERT INTO inspector_object_connection VALUES (893, 10);
INSERT INTO inspector_object_connection VALUES (894, 10);
INSERT INTO inspector_object_connection VALUES (895, 10);
INSERT INTO inspector_object_connection VALUES (896, 10);
INSERT INTO inspector_object_connection VALUES (897, 10);
INSERT INTO inspector_object_connection VALUES (898, 10);
INSERT INTO inspector_object_connection VALUES (899, 10);
INSERT INTO inspector_object_connection VALUES (900, 10);
INSERT INTO inspector_object_connection VALUES (901, 10);
INSERT INTO inspector_object_connection VALUES (902, 10);
INSERT INTO inspector_object_connection VALUES (903, 10);
INSERT INTO inspector_object_connection VALUES (904, 10);
INSERT INTO inspector_object_connection VALUES (905, 10);
INSERT INTO inspector_object_connection VALUES (906, 10);
INSERT INTO inspector_object_connection VALUES (907, 10);
INSERT INTO inspector_object_connection VALUES (908, 10);
INSERT INTO inspector_object_connection VALUES (909, 10);
INSERT INTO inspector_object_connection VALUES (910, 10);
INSERT INTO inspector_object_connection VALUES (911, 10);
INSERT INTO inspector_object_connection VALUES (912, 10);
INSERT INTO inspector_object_connection VALUES (913, 10);
INSERT INTO inspector_object_connection VALUES (914, 10);
INSERT INTO inspector_object_connection VALUES (915, 10);
INSERT INTO inspector_object_connection VALUES (916, 10);
INSERT INTO inspector_object_connection VALUES (917, 10);
INSERT INTO inspector_object_connection VALUES (918, 10);
INSERT INTO inspector_object_connection VALUES (919, 10);
INSERT INTO inspector_object_connection VALUES (920, 10);
INSERT INTO inspector_object_connection VALUES (921, 10);
INSERT INTO inspector_object_connection VALUES (922, 10);
INSERT INTO inspector_object_connection VALUES (923, 10);
INSERT INTO inspector_object_connection VALUES (924, 10);
INSERT INTO inspector_object_connection VALUES (925, 10);
INSERT INTO inspector_object_connection VALUES (926, 10);
INSERT INTO inspector_object_connection VALUES (927, 10);
INSERT INTO inspector_object_connection VALUES (928, 10);
INSERT INTO inspector_object_connection VALUES (929, 10);
INSERT INTO inspector_object_connection VALUES (930, 10);
INSERT INTO inspector_object_connection VALUES (931, 10);
INSERT INTO inspector_object_connection VALUES (932, 10);
INSERT INTO inspector_object_connection VALUES (933, 10);
INSERT INTO inspector_object_connection VALUES (934, 10);
INSERT INTO inspector_object_connection VALUES (935, 10);
INSERT INTO inspector_object_connection VALUES (936, 10);
INSERT INTO inspector_object_connection VALUES (937, 10);
INSERT INTO inspector_object_connection VALUES (938, 10);
INSERT INTO inspector_object_connection VALUES (939, 10);
INSERT INTO inspector_object_connection VALUES (940, 10);
INSERT INTO inspector_object_connection VALUES (941, 10);
INSERT INTO inspector_object_connection VALUES (942, 10);
INSERT INTO inspector_object_connection VALUES (943, 10);
INSERT INTO inspector_object_connection VALUES (944, 10);
INSERT INTO inspector_object_connection VALUES (945, 10);
INSERT INTO inspector_object_connection VALUES (946, 10);
INSERT INTO inspector_object_connection VALUES (947, 10);
INSERT INTO inspector_object_connection VALUES (948, 10);
INSERT INTO inspector_object_connection VALUES (949, 10);
INSERT INTO inspector_object_connection VALUES (950, 10);
INSERT INTO inspector_object_connection VALUES (951, 10);
INSERT INTO inspector_object_connection VALUES (952, 10);
INSERT INTO inspector_object_connection VALUES (953, 10);
INSERT INTO inspector_object_connection VALUES (954, 10);
INSERT INTO inspector_object_connection VALUES (955, 10);
INSERT INTO inspector_object_connection VALUES (956, 10);
INSERT INTO inspector_object_connection VALUES (957, 10);
INSERT INTO inspector_object_connection VALUES (958, 10);
INSERT INTO inspector_object_connection VALUES (959, 10);
INSERT INTO inspector_object_connection VALUES (960, 10);
INSERT INTO inspector_object_connection VALUES (961, 10);
INSERT INTO inspector_object_connection VALUES (962, 10);
INSERT INTO inspector_object_connection VALUES (963, 10);
INSERT INTO inspector_object_connection VALUES (964, 10);
INSERT INTO inspector_object_connection VALUES (965, 10);
INSERT INTO inspector_object_connection VALUES (966, 10);
INSERT INTO inspector_object_connection VALUES (967, 10);
INSERT INTO inspector_object_connection VALUES (968, 10);
INSERT INTO inspector_object_connection VALUES (969, 10);
INSERT INTO inspector_object_connection VALUES (970, 10);
INSERT INTO inspector_object_connection VALUES (971, 10);
INSERT INTO inspector_object_connection VALUES (972, 10);
INSERT INTO inspector_object_connection VALUES (973, 10);


--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;

SET SESSION AUTHORIZATION 'ivan';

SET search_path = public, pg_catalog;

--
-- TOC entry 3 (OID 10878780)
-- Name: object; Type: TABLE; Schema: public; Owner: ivan
--

DROP TABLE object;
CREATE TABLE object (
    id serial NOT NULL,
    mesto character varying(255) NOT NULL,
    adresa_posty character varying(255) NOT NULL
);


--
-- TOC entry 4 (OID 10878780)
-- Name: object; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE object FROM PUBLIC;
GRANT ALL ON TABLE object TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- TOC entry 6 (OID 10878780)
-- Name: object_id_seq; Type: ACL; Schema: public; Owner: ivan
--

REVOKE ALL ON TABLE object_id_seq FROM PUBLIC;
GRANT SELECT,UPDATE ON TABLE object_id_seq TO apache;


SET SESSION AUTHORIZATION 'ivan';

--
-- Data for TOC entry 7 (OID 10878780)
-- Name: object; Type: TABLE DATA; Schema: public; Owner: ivan
--

INSERT INTO object VALUES (1, 'BRATISLAVA 1', 'Námestie SNP  35');
INSERT INTO object VALUES (2, 'BRATISLAVA 11', 'Západný rad  3');
INSERT INTO object VALUES (3, 'BRATISLAVA 111', 'Pribinova 25');
INSERT INTO object VALUES (4, 'BRATISLAVA 12', 'Tomášiková 54');
INSERT INTO object VALUES (5, 'BRATISLAVA 14', 'Predstaničné námestie 1');
INSERT INTO object VALUES (6, 'BRATISLAVA 15', 'Námestie slobody 6');
INSERT INTO object VALUES (7, 'BRATISLAVA 16', 'Fajnorovo nábrežie 1');
INSERT INTO object VALUES (8, 'BRATISLAVA 17', 'Blumentálska 4');
INSERT INTO object VALUES (9, 'BRATISLAVA 2', 'Tomašíkova 54');
INSERT INTO object VALUES (10, 'BRATISLAVA 211', 'Trojičné námestie 8');
INSERT INTO object VALUES (11, 'BRATISLAVA 212', 'Seberíniho 14');
INSERT INTO object VALUES (12, 'BRATISLAVA 213', 'Čiernovodská 2');
INSERT INTO object VALUES (13, 'BRATISLAVA 214', 'Uzbecká 4');
INSERT INTO object VALUES (14, 'BRATISLAVA 215', 'Listová 10');
INSERT INTO object VALUES (15, 'BRATISLAVA 22', 'Doležalova 7');
INSERT INTO object VALUES (16, 'BRATISLAVA 24', 'Mlynské Nivy 31 SAD');
INSERT INTO object VALUES (17, 'BRATISLAVA 25', 'Záhradnícka 95');
INSERT INTO object VALUES (18, 'BRATISLAVA 26', 'Prievozská 2/B');
INSERT INTO object VALUES (19, 'BRATISLAVA 28', 'Rajecká 9');
INSERT INTO object VALUES (20, 'BRATISLAVA 29', 'Tomašíkova 22');
INSERT INTO object VALUES (21, 'BRATISLAVA 3', 'Tomášikova 54');
INSERT INTO object VALUES (22, 'BRATISLAVA 31', 'Vajnorská (Polus City Center)');
INSERT INTO object VALUES (23, 'BRATISLAVA 32', 'Sibírska 17');
INSERT INTO object VALUES (24, 'BRATISLAVA 33', 'Biely kríž 6');
INSERT INTO object VALUES (25, 'BRATISLAVA 34', 'Kadnárova 53');
INSERT INTO object VALUES (26, 'BRATISLAVA 35', 'Čachtická 25');
INSERT INTO object VALUES (27, 'BRATISLAVA 36', 'Pod Lipami 2');
INSERT INTO object VALUES (28, 'BRATISLAVA 37', 'Jelšova 1');
INSERT INTO object VALUES (29, 'BRATISLAVA 38', 'Jarošova 1');
INSERT INTO object VALUES (30, 'BRATISLAVA 39', 'Bojnická 14');
INSERT INTO object VALUES (31, 'BRATISLAVA 315', 'Dopravná ul.57');
INSERT INTO object VALUES (32, 'BRATISLAVA 4', 'Karloveská 34');
INSERT INTO object VALUES (33, 'BRATISLAVA 42', 'Saratovská 3a');
INSERT INTO object VALUES (34, 'BRATISLAVA 43', 'Borská 1');
INSERT INTO object VALUES (35, 'BRATISLAVA 44', 'Ľ.Fullu 3');
INSERT INTO object VALUES (36, 'BRATISLAVA 45', 'Lamačská cesta 3');
INSERT INTO object VALUES (37, 'BRATISLAVA 46', 'Kremelská 39');
INSERT INTO object VALUES (38, 'BRATISLAVA 47', 'Malokarpatské nám. 7');
INSERT INTO object VALUES (39, 'BRATISLAVA 48', 'Gbelská 25');
INSERT INTO object VALUES (40, 'BRATISLAVA 49', 'Istrijská 26');
INSERT INTO object VALUES (41, 'BRATISLAVA 5', 'Vlastenecké nám.4');
INSERT INTO object VALUES (42, 'BRATISLAVA 51', 'Pečnianska 13');
INSERT INTO object VALUES (43, 'BRATISLAVA 52', 'Jiráskova 5-7');
INSERT INTO object VALUES (44, 'BRATISLAVA 53', 'Einsteinova Aupark');
INSERT INTO object VALUES (45, 'BRATISLAVA 55', 'Mamateyova 16');
INSERT INTO object VALUES (46, 'BRATISLAVA 56', 'Holíčska 11');
INSERT INTO object VALUES (47, 'BRATISLAVA 57', 'Jasovská 34');
INSERT INTO object VALUES (48, 'BRATISLAVA 59', 'Balkánska 102');
INSERT INTO object VALUES (49, 'Pofis, ', 'Námestie Slobody 6');
INSERT INTO object VALUES (50, 'Pofis predajňa, ', 'Odborárske nám.BA');
INSERT INTO object VALUES (51, 'CEaZLS, sklad tlačív, ', 'Kukučínova ul. BA');
INSERT INTO object VALUES (52, 'CEaZLS, Sklad cenín, ', 'Kukučínova ul. BA');
INSERT INTO object VALUES (53, 'CEaZLS, Sklad cenín 2, ', 'Kukučínova ul. BA');
INSERT INTO object VALUES (54, 'CEaZLS,Sklad logistiky ', 'Kukučínova ul. BA');
INSERT INTO object VALUES (55, 'CEaZLS, Predajňa', 'Kukučínova ul. BA');
INSERT INTO object VALUES (56, 'CEaZLS, (OU),BA', 'Bojnická 14, BA');
INSERT INTO object VALUES (57, 'CEaZLS, Logistické sl.', 'Bojnická 14, BA');
INSERT INTO object VALUES (58, 'Hybridná pošta', 'Tomášikova 54');
INSERT INTO object VALUES (59, 'ABRAHÁM', '185');
INSERT INTO object VALUES (60, 'BAKA', 'č.261');
INSERT INTO object VALUES (61, 'BERNOLÁKOVO', 'Viničná 1');
INSERT INTO object VALUES (62, 'BUDMERICE', 'Kpt.J.Rášu 537');
INSERT INTO object VALUES (63, 'ČASTÁ', 'Na vršku 4');
INSERT INTO object VALUES (64, 'DOLNÉ SALIBY', 'Hlavná 787');
INSERT INTO object VALUES (65, 'DOLNÝ ŠTÁL', 'č.480');
INSERT INTO object VALUES (66, 'DUNAJSKÁ LUŽNÁ', '274');
INSERT INTO object VALUES (67, 'DUNAJSKÁ STREDA 1', 'Hlavna 351/11');
INSERT INTO object VALUES (68, 'DUNAJSKÁ STREDA 3', 'Smetanov háj 282');
INSERT INTO object VALUES (69, 'GABČÍKOVO 1', 'Krátky rad 1085/6');
INSERT INTO object VALUES (70, 'GAJARY', 'Hlavná 67');
INSERT INTO object VALUES (71, 'GALANTA 1', 'Z.Kodálya 768/31');
INSERT INTO object VALUES (72, 'GALANTA 3 ', 'Česká ulica 1435/19');
INSERT INTO object VALUES (73, 'HAMULIAKOVO', '134');
INSERT INTO object VALUES (74, 'HOLICE NA OSTROVE', 'Hlavná 6');
INSERT INTO object VALUES (75, 'HORNÁ POTÔŇ', 'Hlavná ul.1');
INSERT INTO object VALUES (76, 'HORNÉ SALIBY', 'Dolnosalibská 430');
INSERT INTO object VALUES (77, 'HRUBÝ ŠÚR', 'Hlavná 209');
INSERT INTO object VALUES (78, 'CHORVÁTSKY GROB', 'Školská 956');
INSERT INTO object VALUES (79, 'IVÁNKA PRI DUNAJI', 'Štefánikova 14');
INSERT INTO object VALUES (80, 'JABLONOVÉ', '34');
INSERT INTO object VALUES (81, 'JAHODNÁ PRI DUNAJSKEJ STREDE', 'Hlavná č.303');
INSERT INTO object VALUES (82, 'JELKA', 'Hlavná 490');
INSERT INTO object VALUES (83, 'KAJAL', 'č. 20');
INSERT INTO object VALUES (84, 'KOSTOLIŠTE', '65');
INSERT INTO object VALUES (85, 'KUCHYŇA', 'Hlavná 207');
INSERT INTO object VALUES (86, 'LEHNICE', 'č. 20');
INSERT INTO object VALUES (87, 'LOZORNO', '632');
INSERT INTO object VALUES (88, 'MALACKY', 'Zámocká 1063');
INSERT INTO object VALUES (89, 'MALACKY 3', ';');
INSERT INTO object VALUES (90, 'MARIANKA', 'Školská 32');
INSERT INTO object VALUES (91, 'MATÚŠKOVO', 'Hlavná 545');
INSERT INTO object VALUES (92, 'MODRA 1', 'Dukelská 38');
INSERT INTO object VALUES (93, 'MOST PRI BRATISLAVE', 'Bratislavská 97');
INSERT INTO object VALUES (94, 'MOSTOVÁ', 'Hlavná 6');
INSERT INTO object VALUES (95, 'NEDED', 'Kostolecká 1148');
INSERT INTO object VALUES (96, 'NOVÁ DEDINKA', 'Hlavná 10/A');
INSERT INTO object VALUES (97, 'OKOČ', 'Hlavná č.763');
INSERT INTO object VALUES (98, 'ORECHOVÁ POTÔŇ', '281');
INSERT INTO object VALUES (99, 'PATA', 'Hlohovecká 67');
INSERT INTO object VALUES (100, 'PERNEK PRI MALACKÁCH', 'Kuchynská 94');
INSERT INTO object VALUES (101, 'PEZINOK 1', 'Holubyho 28, OC');
INSERT INTO object VALUES (102, 'PEZINOK 3', 'Griňava 89');
INSERT INTO object VALUES (103, 'PEZINOK 4', 'Suvorovova 1');
INSERT INTO object VALUES (104, 'PEZINOK 5', 'Myslenická 2/C-MOLO');
INSERT INTO object VALUES (105, 'RECA', 'Poštová 100');
INSERT INTO object VALUES (106, 'ROVINKA', 'Hlavná 44');
INSERT INTO object VALUES (107, 'SELICE', 'Sov. armády 286');
INSERT INTO object VALUES (108, 'SENEC', 'Bratislavská 1');
INSERT INTO object VALUES (109, 'SEREĎ 1', '1160');
INSERT INTO object VALUES (110, 'SLÁDKOVIČOVO', 'Fučiková 436');
INSERT INTO object VALUES (111, 'STUPAVA', 'Hlavná 44/A');
INSERT INTO object VALUES (112, 'SVÄTÝ JUR', 'Krajinská 59');
INSERT INTO object VALUES (113, 'ŠAĽA 1', 'Štúrová 1');
INSERT INTO object VALUES (114, 'ŠAĽA 5', 'Hollého 9');
INSERT INTO object VALUES (115, 'ŠAMORÍN', 'Hlavná ul.39');
INSERT INTO object VALUES (116, 'ŠENKVICE', 'Vinohradská 57');
INSERT INTO object VALUES (117, 'ŠOPORŇA', 'Komenského 1');
INSERT INTO object VALUES (118, 'ŠTVRTOK NA OSTROVE', 'Hlavná č.454');
INSERT INTO object VALUES (119, 'TOPOĽNÍKY', 'Hlavná 126');
INSERT INTO object VALUES (120, 'TRHOVÁ HRADSKÁ', 'Hlavná č.488/1');
INSERT INTO object VALUES (121, 'TRNOVEC NAD VÁHOM', 'Poštová 679');
INSERT INTO object VALUES (122, 'TRSTICE', 'Hlavná 669');
INSERT INTO object VALUES (123, 'VEĽKÉ BLAHOVO', 'Poštová 387');
INSERT INTO object VALUES (124, 'VEĽKÉ ÚĽANY', 'Hlavná 578');
INSERT INTO object VALUES (125, 'VEĽKÝ BIEL', 'Školská 5');
INSERT INTO object VALUES (126, 'VEĽKÝ MEDER', 'Komárňanská 5');
INSERT INTO object VALUES (127, 'VINOHRADY NAD VÁHOM', 'Prednohorská 169');
INSERT INTO object VALUES (128, 'VLČANY', 'Hlavná 2');
INSERT INTO object VALUES (129, 'VRAKÚŇ', 'Hlavná č.566');
INSERT INTO object VALUES (130, 'ZEMIANSKE SADY', 'Budova MŠ');
INSERT INTO object VALUES (131, 'ZLATÉ KLASY', 'č.17');
INSERT INTO object VALUES (132, 'ZOHOR', 'Struhárová 2');
INSERT INTO object VALUES (133, 'ŽIHÁREC', 'Hlavná 591');
INSERT INTO object VALUES (134, 'BOJNIČKY', 'č. 90');
INSERT INTO object VALUES (135, 'BOLERÁZ', 'č. 189');
INSERT INTO object VALUES (136, 'BORSKÝ MIKULÁŠ', 'ul. Komenského 423');
INSERT INTO object VALUES (137, 'BRESTOVANY', 'J. Nižnanského 63');
INSERT INTO object VALUES (138, 'BREZOVÁ POD BRADLOM', 'Nám. M. R. Štefánika 1');
INSERT INTO object VALUES (139, 'BRODSKÉ', 'SNP 85');
INSERT INTO object VALUES (140, 'BUČANY', 'č.268');
INSERT INTO object VALUES (141, 'CEROVÁ', 'č.290');
INSERT INTO object VALUES (142, 'CÍFER ', 'A. Hlinku 229/1');
INSERT INTO object VALUES (143, 'ČÁRY', 'č.163');
INSERT INTO object VALUES (144, 'ČERVENÍK', 'Kollárova č. 288/2');
INSERT INTO object VALUES (145, 'DOLNÁ KRUPÁ', 'č. 119');
INSERT INTO object VALUES (146, 'DOLNÉ TRHOVIŠTE', 'Kaštieľ č. 23');
INSERT INTO object VALUES (147, 'DOLNÝ LOPAŠOV', 'č.209');
INSERT INTO object VALUES (148, 'DRAHOVCE', 'Hlavná 428/126');
INSERT INTO object VALUES (149, 'GBELY', 'SNP 1503');
INSERT INTO object VALUES (150, 'HLOHOVEC 1', 'SNP 15');
INSERT INTO object VALUES (151, 'HLOHOVEC 3', 'Šulekova č. 35');
INSERT INTO object VALUES (152, 'HOLIČ 1', 'Nám. mieru 1');
INSERT INTO object VALUES (153, 'HRADIŠTE POD VRÁTNOM', 'č.80');
INSERT INTO object VALUES (154, 'HRNČIAROVCE NAD PARNOU', 'Sv. Martina 69');
INSERT INTO object VALUES (155, 'CHTELNICA', 'Námestie 1.mája 4');
INSERT INTO object VALUES (156, 'JABLONICA', 'č.681');
INSERT INTO object VALUES (157, 'JABLONKA ', 'č.51');
INSERT INTO object VALUES (158, 'JASLOVSKÉ BOHUNICE', '344');
INSERT INTO object VALUES (159, 'KOPČANY', 'Kollárova 318');
INSERT INTO object VALUES (160, 'KOŠARISKÁ', 'č.78');
INSERT INTO object VALUES (161, 'KRAKOVANY NA SLOVENSKU', 'č.406');
INSERT INTO object VALUES (162, 'KRIŽOVANY NAD DUDVÁHOM', 'č.1');
INSERT INTO object VALUES (163, 'KÚTY 1', 'Bratislavská 283');
INSERT INTO object VALUES (164, 'KÚTY 2', 'Železničná 837');
INSERT INTO object VALUES (165, 'LEOPOLDOV', 'Námestie sv.Ignáca 29');
INSERT INTO object VALUES (166, 'MADUNICE', 'Hviezdoslavova 364');
INSERT INTO object VALUES (167, 'MAJCICHOV', 'č. 14');
INSERT INTO object VALUES (168, 'MORAVSKÝ SVÄTÝ JÁN', 'Hlavná 425');
INSERT INTO object VALUES (169, 'MYJAVA 1', 'M.R.Štefánika nám. 563');
INSERT INTO object VALUES (170, 'OPOJ', 'č.9');
INSERT INTO object VALUES (171, 'OSTROV PRI PIEŠŤANOCH', 'Malé Orvište 57');
INSERT INTO object VALUES (172, 'PIEŠŤANY 1', 'Kukučínova 15');
INSERT INTO object VALUES (173, 'PIEŠŤANY 5', 'Staničná 20/34');
INSERT INTO object VALUES (174, 'PLAVECKÉ PODHRADIE', 'č.202');
INSERT INTO object VALUES (175, 'PLAVECKÝ MIKULÁŠ', 'č.266');
INSERT INTO object VALUES (176, 'RADOŠOVCE', 'č.328');
INSERT INTO object VALUES (177, 'ROHOV', 'č. 75');
INSERT INTO object VALUES (178, 'ROHOŽNÍK NA ZÁHORÍ', 'Obchodná č. 13');
INSERT INTO object VALUES (179, 'SENICA 1', 'Nám. oslobodenia č. 13');
INSERT INTO object VALUES (180, 'SILADICE', 'č. 33');
INSERT INTO object VALUES (181, 'SKALICA 1', 'Potočná č. 24');
INSERT INTO object VALUES (182, 'SKALICA 3', 'Vajanského 1');
INSERT INTO object VALUES (183, 'SMOLENICE ', 'SNP 103/56');
INSERT INTO object VALUES (184, 'SMRDÁKY', 'Areál kúpeľov č. 131');
INSERT INTO object VALUES (185, 'SOBOTIŠTE', 'č.291');
INSERT INTO object VALUES (186, 'STUDIENKA NA ZÁHORÍ', 'č.216');
INSERT INTO object VALUES (187, 'SUCHÁ NAD PARNOU', 'č. 552');
INSERT INTO object VALUES (188, 'ŠAŠTÍN STRÁŽE 1', 'Štúrova č. 559');
INSERT INTO object VALUES (189, 'ŠPAČINCE', 'Poštová 29');
INSERT INTO object VALUES (190, 'ŠTEFANOV', 'č.28');
INSERT INTO object VALUES (191, 'ŠÚROVCE', 'Krakovská 2');
INSERT INTO object VALUES (192, 'TRAKOVICE', 'č.40');
INSERT INTO object VALUES (193, 'TREBATICE', 'č.240');
INSERT INTO object VALUES (194, 'TRNAVA 1', 'Trojičné námestie 8');
INSERT INTO object VALUES (195, 'TRNAVA 10', 'Starohájska 1');
INSERT INTO object VALUES (196, 'TRNAVA 2', 'Dohnányho 17');
INSERT INTO object VALUES (197, 'TRNAVA 3', 'Veterná ul. 40');
INSERT INTO object VALUES (198, 'TRNAVA 6', 'J. Bottu 3');
INSERT INTO object VALUES (199, 'TRNAVA 8', 'Mozartova 1');
INSERT INTO object VALUES (200, 'TRNAVA 9', 'Limbova 11/363');
INSERT INTO object VALUES (201, 'TRSTÍN', 'č.352');
INSERT INTO object VALUES (202, 'UNÍN PRI SKALICI', 'č.405');
INSERT INTO object VALUES (203, 'VEĽKÉ KOSTOLANY', 'C. Majerníka 546');
INSERT INTO object VALUES (204, 'VEĽKÉ LEVÁRE ', 'Komenského 810');
INSERT INTO object VALUES (205, 'VESELÉ PRI PIEŠŤANOCH', 'č.346');
INSERT INTO object VALUES (206, 'VLČKOVCE', 'č.13');
INSERT INTO object VALUES (207, 'VODERADY PRI TRNAVE', 'č.154');
INSERT INTO object VALUES (208, 'VRÁDIŠTE', 'č.156');
INSERT INTO object VALUES (209, 'VRBOVCE', 'č. 333');
INSERT INTO object VALUES (210, 'VRBOVÉ', 'námestie Slobody 284/11');
INSERT INTO object VALUES (211, 'ZAVAR', 'Vetrová 1');
INSERT INTO object VALUES (212, 'ZÁVOD', 'Sokolská č.243');
INSERT INTO object VALUES (213, 'ZELENEČ PRI TRNAVE', 'Školská 225/6');
INSERT INTO object VALUES (214, 'POÚ', 'Dohnányho 17');
INSERT INTO object VALUES (215, 'SOČ Holič', 'Školská 3');
INSERT INTO object VALUES (216, 'ALEKŠINCE', '219');
INSERT INTO object VALUES (217, 'BÁB', 'Pracháreň 465');
INSERT INTO object VALUES (218, 'BÁTOVCE', '351');
INSERT INTO object VALUES (219, 'BELADICE', '219');
INSERT INTO object VALUES (220, 'BRANČ', 'Hlavné nám. č. 2');
INSERT INTO object VALUES (221, 'CABAJ-ČÁPOR', '422');
INSERT INTO object VALUES (222, 'ČATA', 'Jokaiho 23/261');
INSERT INTO object VALUES (223, 'DEMANDICE', '236');
INSERT INTO object VALUES (224, 'FARNÁ PRI HRONE', '578');
INSERT INTO object VALUES (225, 'HÁJSKE', '446');
INSERT INTO object VALUES (226, 'HORNÁ KRÁĽOVÁ', 'Hlavná 17');
INSERT INTO object VALUES (227, 'HORNÉ LEFANTOVCE', 'Poštová 357');
INSERT INTO object VALUES (228, 'HORNÉ SEMEROVCE', '151');
INSERT INTO object VALUES (229, 'HOSŤOVCE', '27');
INSERT INTO object VALUES (230, 'HRONSKÉ KĽAČANY', '572');
INSERT INTO object VALUES (231, 'IPEĽSKÝ SOKOLEC', '117');
INSERT INTO object VALUES (232, 'IVANKA PRI NITRE', 'Gergeľová 2');
INSERT INTO object VALUES (233, 'JAROK', 'Hlavná 284');
INSERT INTO object VALUES (234, 'JEDĽOVÉ KOSTOLANY', '129');
INSERT INTO object VALUES (235, 'JELENEC', 'Hlavná 92');
INSERT INTO object VALUES (236, 'KALNÁ NAD HRONOM', 'Červenej armády 58/17');
INSERT INTO object VALUES (237, 'KOLÍŇANY', '528');
INSERT INTO object VALUES (238, 'KOZÁROVCE', '909');
INSERT INTO object VALUES (239, 'LADICE', '219');
INSERT INTO object VALUES (240, 'LEHOTA PRI NITRE', '16');
INSERT INTO object VALUES (241, 'LEVICE 1', 'Námestie hrdinov 10/8');
INSERT INTO object VALUES (242, 'LEVICE 3', 'Pri Podlužianke 8/2953');
INSERT INTO object VALUES (243, 'LEVICE 5', 'Perecká 39');
INSERT INTO object VALUES (244, 'LUŽIANKY', 'Rastislavova 229');
INSERT INTO object VALUES (245, 'MOČENOK', 'Sv.Gorazda  1475');
INSERT INTO object VALUES (246, 'MOJMÍROVCE ', 'Hlavná 956');
INSERT INTO object VALUES (247, 'NITRA 1', 'Sládkovičova 2');
INSERT INTO object VALUES (248, 'NITRA 10', 'Dlhá 25');
INSERT INTO object VALUES (249, 'NITRA 11', 'Jurkovičova 35');
INSERT INTO object VALUES (250, 'NITRA 12', 'Dolnočermánska 91');
INSERT INTO object VALUES (251, 'NITRA 3', 'Štefánikova 50');
INSERT INTO object VALUES (252, 'NITRA 4', 'Štúrova 20');
INSERT INTO object VALUES (253, 'NITRA 5', 'Novozámocká 127');
INSERT INTO object VALUES (254, 'NITRIANSKE HRNČIAROVCE', 'Jelenecká 147');
INSERT INTO object VALUES (255, 'NOVÁ DEDINA PRI LEVICIACH', 'Opatová 416');
INSERT INTO object VALUES (256, 'NOVÉ SADY PRI NITRE', '122');
INSERT INTO object VALUES (257, 'PLÁŠŤOVCE', '636');
INSERT INTO object VALUES (258, 'PODHORANY PRI NITRE', '106');
INSERT INTO object VALUES (259, 'POHRANICE', '215');
INSERT INTO object VALUES (260, 'POHRONSKÝ RUSKOV', 'Hlavná 78');
INSERT INTO object VALUES (261, 'PUKANEC', 'Čierne blato 1/49');
INSERT INTO object VALUES (262, 'RIŠŇOVCE', '419');
INSERT INTO object VALUES (263, 'RYBNÍK NAD HRONOM', 'Hlavná 6');
INSERT INTO object VALUES (264, 'SANTOVKA', 'Parková 2');
INSERT INTO object VALUES (265, 'SKÝCOV', 'Školská 260');
INSERT INTO object VALUES (266, 'SLAŽANY', '91');
INSERT INTO object VALUES (267, 'STARÝ TEKOV', 'Tekovská  1');
INSERT INTO object VALUES (268, 'ŠAHY', 'SNP 19/290');
INSERT INTO object VALUES (269, 'ŠAROVCE', '454');
INSERT INTO object VALUES (270, 'TEKOVSKÉ LUŽANY', 'Poštová 99/553');
INSERT INTO object VALUES (271, 'TESÁRSKE MLYŇANY', '440');
INSERT INTO object VALUES (272, 'TLMAČE 1', 'Školská 18/42');
INSERT INTO object VALUES (273, 'TOPOLČIANKY', 'Hlavná 121');
INSERT INTO object VALUES (274, 'VEĽKÉ LUDINCE', '633');
INSERT INTO object VALUES (275, 'VEĽKÉ ZÁLUŽIE', 'Hlavná 859');
INSERT INTO object VALUES (276, 'VEĽKÝ CETÍN', '2');
INSERT INTO object VALUES (277, 'VEĽKÝ ĎUR', 'Hlavná 84/531');
INSERT INTO object VALUES (278, 'VEĽKÝ LAPÁŠ', '283');
INSERT INTO object VALUES (279, 'VOLKOVCE', 'P. O. Hviezdoslava 4 ');
INSERT INTO object VALUES (280, 'VRÁBLE', 'Hlavná 149');
INSERT INTO object VALUES (281, 'VÝČAPY-OPATOVCE', '471');
INSERT INTO object VALUES (282, 'ZBEHY', '167');
INSERT INTO object VALUES (283, 'ZLATÉ MORAVCE 1', 'nám.A.Hlinku 17');
INSERT INTO object VALUES (284, 'ŽELIEZOVCE', 'Nám.Sv. Jakuba1');
INSERT INTO object VALUES (285, 'ŽEMBEROVCE', 'SNP 40/97');
INSERT INTO object VALUES (286, 'ŽIRANY', '178');
INSERT INTO object VALUES (287, 'USES Nitra', 'Bolečkova');
INSERT INTO object VALUES (288, 'RPC Nitra', 'Cintorínska 11');
INSERT INTO object VALUES (289, 'BÁNOVCE NAD BEBRAVOU 1', 'Jesenského 70/2');
INSERT INTO object VALUES (290, 'BÁNOVCE NAD BEBRAVOU 4', 'Svatoplukova 1339/8');
INSERT INTO object VALUES (291, 'BECKOV', '1.mája č.7');
INSERT INTO object VALUES (292, 'BOBOT', '283');
INSERT INTO object VALUES (293, 'BOJNÁ', '128');
INSERT INTO object VALUES (294, 'BOŠANY', 'M.R.Štefanika 172');
INSERT INTO object VALUES (295, 'ČACHTICE', 'Malinovského 803');
INSERT INTO object VALUES (296, 'DRIETOMA', '194');
INSERT INTO object VALUES (297, 'HORNÁ STREDA', '119');
INSERT INTO object VALUES (298, 'HÔRKA NAD VÁHOM', '225');
INSERT INTO object VALUES (299, 'HRÁDOK NAD VÁHOM', '232');
INSERT INTO object VALUES (300, 'CHOCHOLNÁ-VELČICE', '312');
INSERT INTO object VALUES (301, 'CHYNORANY', 'Valentína Beniaka 221');
INSERT INTO object VALUES (302, 'KOSTOLNÉ', '277');
INSERT INTO object VALUES (303, 'KOVARCE', '498');
INSERT INTO object VALUES (304, 'KRAJNÉ', '52');
INSERT INTO object VALUES (305, 'MELČICE-LIESKOVÉ', '119');
INSERT INTO object VALUES (306, 'MORAVSKÉ LIESKOVÉ', '656');
INSERT INTO object VALUES (307, 'NEMŠOVÁ', 'J. PALU 1');
INSERT INTO object VALUES (308, 'NOVÁ BOŠÁCA', '77');
INSERT INTO object VALUES (309, 'NOVÉ MESTO NAD VÁHOM', 'Weiseho 17');
INSERT INTO object VALUES (310, 'PARTIZÁNSKE 1', 'Februarova 636/4');
INSERT INTO object VALUES (311, 'PARTIZÁNSKE 6', 'Malinovského 1489/3');
INSERT INTO object VALUES (312, 'PARTIZÁNSKE 7', 'Tesco: Nitrianska 1771/118');
INSERT INTO object VALUES (313, 'POTVORICE', '14');
INSERT INTO object VALUES (314, 'POVAŽANY', '187');
INSERT INTO object VALUES (315, 'PRAŠICE', '1.maja 150');
INSERT INTO object VALUES (316, 'PRESEĽANY', 'Dedinska 74');
INSERT INTO object VALUES (317, 'RADOŠINA', 'Školska 416');
INSERT INTO object VALUES (318, 'RYBANY', '373');
INSERT INTO object VALUES (319, 'SKAČANY', 'nam.SNP 446');
INSERT INTO object VALUES (320, 'SKALKA NAD VÁHOM', '1/97');
INSERT INTO object VALUES (321, 'SOBLAHOV', '366');
INSERT INTO object VALUES (322, 'SOLČANY', 'Hviezdoslavova 51');
INSERT INTO object VALUES (323, 'STARÁ TURÁ', 'M.R.Stefánika 364');
INSERT INTO object VALUES (324, 'TOPOĽČANY 1', 'Obchodná 1321/6');
INSERT INTO object VALUES (325, 'TOPOĽČANY 3', 'D.Jurkoviča 2830');
INSERT INTO object VALUES (326, 'TRENČIANSKA TEPLÁ', 'Zilinská 654/57');
INSERT INTO object VALUES (327, 'TRENČIANSKA TURNÁ', 'Oslobodenia 233');
INSERT INTO object VALUES (328, 'TRENČIANSKE STANKOVCE', '362');
INSERT INTO object VALUES (329, 'TRENČIANSKE TEPLICE', '17.novembra č 2');
INSERT INTO object VALUES (330, 'TRENČÍN 1', 'Mierové nám.21');
INSERT INTO object VALUES (331, 'TRENČÍN 4', 'Dlhé Hony 1159');
INSERT INTO object VALUES (332, 'TRENČÍN 5', 'Piešťanská 4');
INSERT INTO object VALUES (333, 'TRENČÍN 6', 'Záblatská  39');
INSERT INTO object VALUES (334, 'TRENČÍN 8', 'Generála Svobodu 1');
INSERT INTO object VALUES (335, 'UHROVEC', 'M.R.Štefanika 154/7');
INSERT INTO object VALUES (336, 'URMINCE', '492');
INSERT INTO object VALUES (337, 'VEĽKÉ RIPŇANY', '461');
INSERT INTO object VALUES (338, 'VEĽKÉ UHERCE', '434');
INSERT INTO object VALUES (339, 'Trenčianska Teplá OSC', ';');
INSERT INTO object VALUES (340, 'ANDOVCE', 'č. 5');
INSERT INTO object VALUES (341, 'BAJČ', 'č. 63');
INSERT INTO object VALUES (342, 'BÁNOV PRI NOVÝCH ZÁMKOCH', 'Hviezdoslava č. 32');
INSERT INTO object VALUES (343, 'BÁTOROVE KOSIHY', 'ul. 1. mája č.774');
INSERT INTO object VALUES (344, 'BEŠEŇOV', 'č. 275');
INSERT INTO object VALUES (345, 'BÍŇA', 'č. 107');
INSERT INTO object VALUES (346, 'ČIČOV', 'Veľkomederská č.53');
INSERT INTO object VALUES (347, 'DEDINKA', 'č. 97');
INSERT INTO object VALUES (348, 'DOLNÝ OHAJ', 'č. 109');
INSERT INTO object VALUES (349, 'DUBNÍK PRI NOVÝCH ZÁMKOCH', 'Hlavná č. 232');
INSERT INTO object VALUES (350, 'DULOVCE', 'Hlavná č. 33');
INSERT INTO object VALUES (351, 'DVORY NAD ŽITAVOU', 'Hlavné námestie č. 6');
INSERT INTO object VALUES (352, 'GBELCE', 'Novozámocká č. 10');
INSERT INTO object VALUES (353, 'HURBANOVO 1', 'Komárňanská č. 100');
INSERT INTO object VALUES (354, 'HURBANOVO 3', 'Školská č. 2');
INSERT INTO object VALUES (355, 'CHOTÍN', 'Hlavná č. 148');
INSERT INTO object VALUES (356, 'IMEĽ', 'Obchodná č. 2');
INSERT INTO object VALUES (357, 'IŽA', 'Hlavná č. 203');
INSERT INTO object VALUES (358, 'KAMENICA NAD HRONOM', 'č. 136');
INSERT INTO object VALUES (359, 'KAMENIČNÁ PRI KOMÁRNE', 'Hlavná č. 113');
INSERT INTO object VALUES (360, 'KAMENÍN', 'č. 635');
INSERT INTO object VALUES (361, 'KAMENNÝ MOST', 'č. 187');
INSERT INTO object VALUES (362, 'KOLÁROVO', 'Kostolné nám. č. 3');
INSERT INTO object VALUES (363, 'KOLTA', 'č.1');
INSERT INTO object VALUES (364, 'KOMÁRNO 1', 'Damjanichova č.3');
INSERT INTO object VALUES (365, 'KOMÁRNO 3', 'Budovateľská č.1');
INSERT INTO object VALUES (366, 'KOMÁRNO 5', 'Biskupa Királya č.3');
INSERT INTO object VALUES (367, 'KOMJATICE', 'Nitrianská č. 84');
INSERT INTO object VALUES (368, 'KRAVANY NAD DUNAJOM', 'Poštová č. 294');
INSERT INTO object VALUES (369, 'MARCELOVÁ', 'Pekárenská č. 12');
INSERT INTO object VALUES (370, 'MOJZESOVO', 'č. 494');
INSERT INTO object VALUES (371, 'MUŽLA', 'č. 711');
INSERT INTO object VALUES (372, 'NESVADY', 'Obchodná č. 15');
INSERT INTO object VALUES (373, 'NOVÉ ZÁMKY 1', 'Hlavné námestie č. 9');
INSERT INTO object VALUES (374, 'NOVÉ ZÁMKY 2', 'Námestie republiky č. 10');
INSERT INTO object VALUES (375, 'NOVÉ ZÁMKY 3', 'Bitúnková č. 8');
INSERT INTO object VALUES (376, 'PALÁRIKOVO', 'Mierová  č. 2');
INSERT INTO object VALUES (377, 'PODHÁJSKA', 'č. 322');
INSERT INTO object VALUES (378, 'PRIBETA', 'Obchodná č. 2');
INSERT INTO object VALUES (379, 'RASTISLAVICE', 'č. 27');
INSERT INTO object VALUES (380, 'RUBAŇ', 'č. 165');
INSERT INTO object VALUES (381, 'SALKA', 'č. 331');
INSERT INTO object VALUES (382, 'SEMEROVO', 'č. 555');
INSERT INTO object VALUES (383, 'SOKOLCE NA OSTROVE', 'č. 63');
INSERT INTO object VALUES (384, 'STREKOV PRI NOVÝCH ZÁMKOCH', 'Hlavná č. 59');
INSERT INTO object VALUES (385, 'SVÄTÝ PETER', 'Hlavná č. 2');
INSERT INTO object VALUES (386, 'SVODÍN', 'č. 7');
INSERT INTO object VALUES (387, 'ŠTÚROVO 1', 'Hlavná č. 58');
INSERT INTO object VALUES (388, 'ŠTÚROVO 2', 'Železničný rad č. 14');
INSERT INTO object VALUES (389, 'ŠTÚROVO 3', 'Továrenská č. 1');
INSERT INTO object VALUES (390, 'ŠURANY 1', 'M.R.Štefánika č. 5');
INSERT INTO object VALUES (391, 'TVRDOŠOVCE', 'Železničná č. 4');
INSERT INTO object VALUES (392, 'UĽANY NAD ŽITAVOU', 'Hlavná č. 199');
INSERT INTO object VALUES (393, 'VEĽKÉ LOVCE', 'č. 112');
INSERT INTO object VALUES (394, 'VEĽKÝ KÝR', 'Nám. Svätého Jána č. 1');
INSERT INTO object VALUES (395, 'ZEMIANSKA OLČA', 'Hlavná č. 33');
INSERT INTO object VALUES (396, 'ZLATNÁ NA OSTROVE', 'Bratislavská cesta č. 295');
INSERT INTO object VALUES (397, 'BANSKÁ BELÁ', '154');
INSERT INTO object VALUES (398, 'BANSKÁ ŠTIAVNICA 1', 'Kammerhofská   38');
INSERT INTO object VALUES (399, 'BELÁ PRI MARTINE', 'č.297');
INSERT INTO object VALUES (400, 'BLATNICA PRI MARTINE', 'č.1');
INSERT INTO object VALUES (401, 'BOJNICE', 'Sládkovičova 6');
INSERT INTO object VALUES (402, 'BYSTRIČANY', 'Dlhá 1');
INSERT INTO object VALUES (403, 'BYSTRIČKA', 'č.260');
INSERT INTO object VALUES (404, 'ČAVOJ', '31');
INSERT INTO object VALUES (405, 'ČEREŇANY', 'Na Hlodzi 70/2');
INSERT INTO object VALUES (406, 'DIVIACKA NOVÁ VES', 'č. 1');
INSERT INTO object VALUES (407, 'DIVIAKY NAD NITRICOU', '201');
INSERT INTO object VALUES (408, 'DOLNÉ VESTENICE', 'M.R.Štefánika 325/51');
INSERT INTO object VALUES (409, 'DRAŽKOVCE PRI MARTINE', 'č.334');
INSERT INTO object VALUES (410, 'DUBOVÉ PRI TURČIANSKYCH TEPLICIACH', 'Budova pož.zbrojnice č.65');
INSERT INTO object VALUES (411, 'HANDLOVÁ', 'Námestie  baníkov 22');
INSERT INTO object VALUES (412, 'HLINÍK NAD HRONOM', 'Soviet.armády 347');
INSERT INTO object VALUES (413, 'HODRUŠA-HÁMRE 1', '185');
INSERT INTO object VALUES (414, 'HODRUŠA-HÁMRE 3', '758');
INSERT INTO object VALUES (415, 'HORNÁ ŚTUBŃA', 'č.334');
INSERT INTO object VALUES (416, 'HORNÁ VES', '190');
INSERT INTO object VALUES (417, 'HORNÁ ŽDAŇA', '167');
INSERT INTO object VALUES (418, 'HORNÉ HÁMRE', '159');
INSERT INTO object VALUES (419, 'HRABIČOV', '189');
INSERT INTO object VALUES (420, 'HRONSKÁ DÚBRAVA', '155');
INSERT INTO object VALUES (421, 'HRONSKÝ BEŇADIK', 'Hlavná 349');
INSERT INTO object VALUES (422, 'CHRENOVEC-BRUSNO', 'č. 1');
INSERT INTO object VALUES (423, 'JANOVA LEHOTA', '201');
INSERT INTO object VALUES (424, 'JASTRABÁ', '122');
INSERT INTO object VALUES (425, 'KAMENEC POD VTÁČNIKOM', 'Ružičkova 593/55');
INSERT INTO object VALUES (426, 'KANIANKA', 'SNP č. 5');
INSERT INTO object VALUES (427, 'KĽAČNO', 'č.310');
INSERT INTO object VALUES (428, 'KLÁŠTOR POD ZNIEVOM', 'č.185');
INSERT INTO object VALUES (429, 'KOŠ', 'Víťazstva 791/41');
INSERT INTO object VALUES (430, 'KOŠŤANY NAD TURCOM', 'č.64');
INSERT INTO object VALUES (431, 'KREMNICA 1', 'Zechenterova 326');
INSERT INTO object VALUES (432, 'KRPEĽANY', 'Školská č.142/4');
INSERT INTO object VALUES (433, 'LAZANY PRI PRIEVIDZI', 'č. 1');
INSERT INTO object VALUES (434, 'LEHOTA POD VTÁČNIKOM', 'SNP 35/15');
INSERT INTO object VALUES (435, 'LOVČA', 'Gerometova 95');
INSERT INTO object VALUES (436, 'LOVČICA -TRUBÍN', '116');
INSERT INTO object VALUES (437, 'LUTILA', 'Štefánikova 84');
INSERT INTO object VALUES (438, 'MALÁ LEHOTA PRI NOVEJ BANI', '458');
INSERT INTO object VALUES (439, 'MALÝ ČEPČÍN', 'č.36');
INSERT INTO object VALUES (440, 'MARTIN 1', 'A. KMEŤA 11');
INSERT INTO object VALUES (441, 'MARTIN 3', 'Protifašistických bojovníkov 1706');
INSERT INTO object VALUES (442, 'MARTIN 4', 'Prieložtek 1');
INSERT INTO object VALUES (443, 'MARTIN 5', 'Zvolenská 10');
INSERT INTO object VALUES (444, 'MARTIN 8', 'Lipová ul. 32');
INSERT INTO object VALUES (445, 'MARTIN 9', 'Záturčianska 28');
INSERT INTO object VALUES (446, 'MOŠOVCE', 'Kollárovo námestie 314');
INSERT INTO object VALUES (447, 'NECPALY', 'č.168');
INSERT INTO object VALUES (448, 'NEDOŽERY', 'Nedožerského 105');
INSERT INTO object VALUES (449, 'NITRIANSKE PRAVNO', 'Dlhá  402/13');
INSERT INTO object VALUES (450, 'NITRIANSKE RUDNO', 'Poštová 300');
INSERT INTO object VALUES (451, 'NITRIANSKE SUČANY', '218');
INSERT INTO object VALUES (452, 'NOVÁ BAŇA', 'Nám. slobody 6');
INSERT INTO object VALUES (453, 'NOVÁKY', 'SNP 639/22');
INSERT INTO object VALUES (454, 'OPATOVCE NAD NITROU', 'č. 105');
INSERT INTO object VALUES (455, 'OSLANY', 'Školská 48');
INSERT INTO object VALUES (456, 'OSTRÝ GRÚŇ', '193');
INSERT INTO object VALUES (457, 'PODHORIE', '1');
INSERT INTO object VALUES (458, 'PRAVENEC', 'č. 271');
INSERT INTO object VALUES (459, 'PRENČOV', '187');
INSERT INTO object VALUES (460, 'PRÍBOVCE', 'č.270');
INSERT INTO object VALUES (461, 'PRIEVIDZA 1', 'Námestie Slobody č.5');
INSERT INTO object VALUES (462, 'PRIEVIDZA 3', 'Štefánikova 27');
INSERT INTO object VALUES (463, 'PRIEVIDZA 4', 'Bojnická cesta 26');
INSERT INTO object VALUES (464, 'PRIEVIDZA 5', 'Novackého 33');
INSERT INTO object VALUES (465, 'PRIEVIDZA 6', 'Mišúta 23');
INSERT INTO object VALUES (466, 'RÁZTOČNO', 'Morovnianska 461');
INSERT INTO object VALUES (467, 'RUDNO NAD HRONOM', '16');
INSERT INTO object VALUES (468, 'SEBEDRAŽIE', 'č. 471');
INSERT INTO object VALUES (469, 'SKLABIŇA PRI MARTINE', 'č.108');
INSERT INTO object VALUES (470, 'SKLENÉ', 'č.95');
INSERT INTO object VALUES (471, 'SKLENÉ TEPLICE', '123');
INSERT INTO object VALUES (472, 'SLOVENSKÉ PRAVNO', 'č.30');
INSERT INTO object VALUES (473, 'SUČANY', 'Hviezdoslavova 20');
INSERT INTO object VALUES (474, 'SVATÝ ANTON', '543');
INSERT INTO object VALUES (475, 'ŠTIAVNICKÉ BANE', 'Hlavná 3');
INSERT INTO object VALUES (476, 'TEKOVSKÁ BREZNICA', '566');
INSERT INTO object VALUES (477, 'TEKOVSKÉ NEMCE', '420');
INSERT INTO object VALUES (478, 'TRNAVÁ HORA', '63');
INSERT INTO object VALUES (479, 'TURANY NAD VÁHOM', 'Osloboditeľov');
INSERT INTO object VALUES (480, 'TURČEK', 'č.1');
INSERT INTO object VALUES (481, 'TURČIANSKA ŠTIAVNIČKA', 'Jána Kostru č.92/76');
INSERT INTO object VALUES (482, 'TURČIANSKE TEPLICE', 'Partizánska č.419/16');
INSERT INTO object VALUES (483, 'VALASKÁ BELÁ', 'č. 612');
INSERT INTO object VALUES (484, 'VEĽKÁ ČAUSA - Poštové stredisko', 'Veľká Čausa č. 83');
INSERT INTO object VALUES (485, 'VEĽKÁ LEHOTA pri N.BANI', '50');
INSERT INTO object VALUES (486, 'VEĽKÉ POLE', '1');
INSERT INTO object VALUES (487, 'VRÍCKO', 'č.141');
INSERT INTO object VALUES (488, 'VRÚTKY', 'l.čsl.brigády č.57');
INSERT INTO object VALUES (489, 'VYHNE', '100');
INSERT INTO object VALUES (490, 'ZEMIANSKE KOSTOĽANY', 'B. Nemcovej 406/58');
INSERT INTO object VALUES (491, 'ŽABOKREKY', 'č.144');
INSERT INTO object VALUES (492, 'ŽARNOVICA', 'Sládkovičova 12');
INSERT INTO object VALUES (493, 'ŽIAR NAD HRONOM 1', 'Námestie Matice slovenskej 17');
INSERT INTO object VALUES (494, 'BADÍN', 'Sládkovičova 4');
INSERT INTO object VALUES (495, 'BANSKÁ BYSTRICA 1', 'Horná 1');
INSERT INTO object VALUES (496, 'BANSKÁ BYSTRICA 11', 'Rudohorská 31');
INSERT INTO object VALUES (497, 'BANSKÁ BYSTRICA 3', 'Zvolenská cesta 34');
INSERT INTO object VALUES (498, 'BANSKÁ BYSTRICA 4', 'Kyjevské nám. 6');
INSERT INTO object VALUES (499, 'BANSKÁ BYSTRICA 5', 'Kalinčiaková 2');
INSERT INTO object VALUES (500, 'BANSKÁ BYSTRICA 6', 'Hronská ulica 2');
INSERT INTO object VALUES (501, 'BANSKÁ BYSTRICA 8', 'Horná 77');
INSERT INTO object VALUES (502, 'BANSKÁ BYSTRICA 9', 'Jaseňová 1');
INSERT INTO object VALUES (503, 'BEŇUŠ', 'Beňuš 355');
INSERT INTO object VALUES (504, 'BREZNO', 'Bozeny Nemcovej 29');
INSERT INTO object VALUES (505, 'BREZNO 3', '9.mája 57');
INSERT INTO object VALUES (506, 'BRUSNO', 'Brusno 534');
INSERT INTO object VALUES (507, 'BUDČA', 'ČSA 120');
INSERT INTO object VALUES (508, 'BZOVÍK', 'Bzovík 10');
INSERT INTO object VALUES (509, 'ČABRADSKÝ VRBOVOK', 'Čabr.Vrbovok 62');
INSERT INTO object VALUES (510, 'ČIERNY BALOG', 'Hlavná ul.48');
INSERT INTO object VALUES (511, 'DETVA 1', 'SNP 4');
INSERT INTO object VALUES (512, 'DETVA-SÍDLISKO', 'Tajovského 11');
INSERT INTO object VALUES (513, 'DETVIANSKA HUTA', 'D.Huta 103');
INSERT INTO object VALUES (514, 'DOBRÁ NIVA', 'kpt.Nálepku 49/3');
INSERT INTO object VALUES (515, 'DUDINCE', 'Okružná 212');
INSERT INTO object VALUES (516, 'HARMANEC', 'Harmanec 12');
INSERT INTO object VALUES (517, 'HEĽPA', 'Partizánska cesta 433/37');
INSERT INTO object VALUES (518, 'HONTIANSKE NEMCE', 'H.Nemce 130');
INSERT INTO object VALUES (519, 'HONTIANSKE TESÁRE', 'H.Tesáre 149');
INSERT INTO object VALUES (520, 'HORNÝ TISOVNÍK', 'H.Tisovník 77');
INSERT INTO object VALUES (521, 'HRIŇOVÁ', 'Partizánska 1378');
INSERT INTO object VALUES (522, 'HROCHOŤ', 'Hrochoť 343');
INSERT INTO object VALUES (523, 'JASENIE', 'Potočná 2');
INSERT INTO object VALUES (524, 'KOVÁČOVÁ PRI ZVOLENE', 'Kúpelná 212/26');
INSERT INTO object VALUES (525, 'KRIVÁŇ', 'Kriváň 2');
INSERT INTO object VALUES (526, 'KRUPINA', 'Svätotrojičné nám.1');
INSERT INTO object VALUES (527, 'LIESKOVEC', 'Stredisková 2746/2');
INSERT INTO object VALUES (528, 'LOM NAD RIMAVICOU', 'Lom nad Rimavicou 13');
INSERT INTO object VALUES (529, 'LOPEJ', 'Hámor 443/2');
INSERT INTO object VALUES (530, 'ĽUBIETOVÁ', 'Ľubietová 2');
INSERT INTO object VALUES (531, 'MICHALOVA', 'Trosky č.1');
INSERT INTO object VALUES (532, 'NEMECKÁ NAD HRONOM', 'SNP 164/32');
INSERT INTO object VALUES (533, 'OČOVÁ', 'SNP 346/69');
INSERT INTO object VALUES (534, 'PIESOK', 'Štiavnička 199/27');
INSERT INTO object VALUES (535, 'PLIEŠOVCE 1', 'nám.SNP 249/1');
INSERT INTO object VALUES (536, 'PODBREZOVA', 'Sládkovičova 78/14');
INSERT INTO object VALUES (537, 'POHRONSKÁ POLHORA', 'Hlavná 126/141');
INSERT INTO object VALUES (538, 'POLOMKA', 'SNP č.60');
INSERT INTO object VALUES (539, 'PONIKY', 'Nám.Štefana Žaryho 47');
INSERT INTO object VALUES (540, 'PREDAJNÁ', 'Borgondia 68');
INSERT INTO object VALUES (541, 'SELCE PRI BANSKEJ BYSTRICI', 'Selčianská cesta 132');
INSERT INTO object VALUES (542, 'SLATINSKÉ LAZY', 'Slatinské Lazy 108');
INSERT INTO object VALUES (543, 'SLIAČ', 'SNP 13');
INSERT INTO object VALUES (544, 'SLOVENSKÁ ĽUPČA', 'Czambelova 8');
INSERT INTO object VALUES (545, 'STARÉ HORY', 'Staré Hory 326');
INSERT INTO object VALUES (546, 'ŠUMIAC', 'Hviezdoslavova 328');
INSERT INTO object VALUES (547, 'TAJOV', 'Tajov 75');
INSERT INTO object VALUES (548, 'TELGÁRT', 'Telgárt 70');
INSERT INTO object VALUES (549, 'VALASKÁ', 'Nám.1.mája  460');
INSERT INTO object VALUES (550, 'VÍGĽAŠ', 'Malinovského 53/2');
INSERT INTO object VALUES (551, 'VLKANOVÁ', 'Vlkanovská ul. 143');
INSERT INTO object VALUES (552, 'ZVOLEN 1', 'Sladkovičova 2');
INSERT INTO object VALUES (553, 'ZVOLEN 2', 'T.G.Masaryka 5 101/5');
INSERT INTO object VALUES (554, 'ZVOLEN 3', 'Jesenského 40');
INSERT INTO object VALUES (555, 'ZVOLEN 6', 'Pražská 1388');
INSERT INTO object VALUES (556, 'ZVOLEN 7', 'Okružná 2471/131');
INSERT INTO object VALUES (557, 'ZVOLENSKÁ SLATINA', 'Školská 2');
INSERT INTO object VALUES (558, 'USES B. Bystrica', 'Zvolenská cesta BB');
INSERT INTO object VALUES (559, 'Stolárska dielňa Zvolen', 'Lieskovska cesta Zv');
INSERT INTO object VALUES (560, 'SP, a.s. Pošt. múzeum', 'Part.cesta 9 BB');
INSERT INTO object VALUES (561, 'BÁTKA', '6');
INSERT INTO object VALUES (562, 'BREZNIČKA', '206');
INSERT INTO object VALUES (563, 'BUŠINCE', 'Krtíšska 356/18');
INSERT INTO object VALUES (564, 'CINOBAŇA', '43');
INSERT INTO object VALUES (565, 'ČEBOVCE', 'Szedera Fabiana 36');
INSERT INTO object VALUES (566, 'DIVÍN', 'Nám.mieru 671\021');
INSERT INTO object VALUES (567, 'DOLNÁ STREHOVÁ', 'Hlavná č.52/75');
INSERT INTO object VALUES (568, 'DOLNÉ PLACHTINCE', '32');
INSERT INTO object VALUES (569, 'FIĽAKOVO', 'Biskupická 2');
INSERT INTO object VALUES (570, 'GEMERSKÁ VES', '186');
INSERT INTO object VALUES (571, 'GEMERSKÝ JABLONEC', '169');
INSERT INTO object VALUES (572, 'HALIČ', 'ul.Mieru 53');
INSERT INTO object VALUES (573, 'HNÚŠŤA 1', 'Rumunskej armády 194');
INSERT INTO object VALUES (574, 'JESENSKÉ', 'Sobotská 10');
INSERT INTO object VALUES (575, 'KALINOVO', 'Štefánikova 494/34');
INSERT INTO object VALUES (576, 'KLENOVEC', 'Klenovčok 3');
INSERT INTO object VALUES (577, 'KOKAVA NAD RIMAVICOU', 'Nám.1.mája 1350/33');
INSERT INTO object VALUES (578, 'LÁTKY', '37');
INSERT INTO object VALUES (579, 'LOVINOBAŇA', 'Štefanikova 16');
INSERT INTO object VALUES (580, 'LUČENEC 1', 'Novohradska 4');
INSERT INTO object VALUES (581, 'LUČENEC 3', 'Rúbanisko II');
INSERT INTO object VALUES (582, 'LUČENEC 4', 'Ľ.Podjavorinskej5364');
INSERT INTO object VALUES (583, 'MÁLINEC', '100');
INSERT INTO object VALUES (584, 'MODRÝ KAMEŇ', 'Lipové námestie č.293');
INSERT INTO object VALUES (585, 'MÝTNA', 'Zvolenská 45');
INSERT INTO object VALUES (586, 'NENINCE', 'Hlavná č.238');
INSERT INTO object VALUES (587, 'NOVÁ BAŠTA', '54');
INSERT INTO object VALUES (588, 'OŽĎANY', '160');
INSERT INTO object VALUES (589, 'PODREČANY', '190');
INSERT INTO object VALUES (590, 'POLTÁR', 'Železničná 3');
INSERT INTO object VALUES (591, 'PÔTOR', '96');
INSERT INTO object VALUES (592, 'RADZOVCE', '410');
INSERT INTO object VALUES (593, 'RAPOVCE', 'Hlavná ul.99');
INSERT INTO object VALUES (594, 'RIMAVSKÁ SEČ', 'Daxnerová 1');
INSERT INTO object VALUES (595, 'RIMAVSKÁ SOBOTA 1', 'Jánošíková 1');
INSERT INTO object VALUES (596, 'RIMAVSKÁ SOBOTA 3', 'J.Ušiaka 1');
INSERT INTO object VALUES (597, 'SLOVENSKÉ ĎARMOTY', '84');
INSERT INTO object VALUES (598, 'TISOVEC', 'Dr.Klementisa 1128');
INSERT INTO object VALUES (599, 'TOMÁŠOVCE', 'Partizánska 171/5');
INSERT INTO object VALUES (600, 'TORŇALA', 'Poštová 1');
INSERT INTO object VALUES (601, 'UTEKÁČ', '97');
INSERT INTO object VALUES (602, 'VEĽKÁ ČALOMIJA', '166');
INSERT INTO object VALUES (603, 'VEĽKÁ NAD IPĽOM', '122');
INSERT INTO object VALUES (604, 'VEĽKÁ VES NAD IPĽOM', 'Kultúrny dom');
INSERT INTO object VALUES (605, 'VEĽKÝ KRTÍŠ', 'nám.Škultétyho 1');
INSERT INTO object VALUES (606, 'VIDINÁ', 'Zvolenska 590');
INSERT INTO object VALUES (607, 'VINICA', 'Školská 407');
INSERT INTO object VALUES (608, 'ŽELOVCE', 'Zdravotná 255/11');
INSERT INTO object VALUES (609, 'BELÁ PRI VARÍNE', 'Oslobodenia č. 183');
INSERT INTO object VALUES (610, 'BELUŠA', 'Farská č. 1040');
INSERT INTO object VALUES (611, 'BOLEŠOV', 'č.89');
INSERT INTO object VALUES (612, 'BRVNIŠTE', 'č. 435');
INSERT INTO object VALUES (613, 'BYTČA 1', 'Eliáša Lániho 260/4');
INSERT INTO object VALUES (614, 'ČADCA 1', 'Námestie Slobody č.101');
INSERT INTO object VALUES (615, 'ČADCA 3', 'Staničná č. 191');
INSERT INTO object VALUES (616, 'ČADCA 4', 'Okružná ABC č.97');
INSERT INTO object VALUES (617, 'ČIERNE PRI ČADCI', 'Nižný Koniec/č.189');
INSERT INTO object VALUES (618, 'DLHÉ POLE', 'č. 180');
INSERT INTO object VALUES (619, 'DOHŇANY', 'č.68');
INSERT INTO object VALUES (620, 'DOLNÝ HRIČOV', 'č. 197');
INSERT INTO object VALUES (621, 'DUBNICA NAD VÁHOM 1', 'Bratislavská 432/7');
INSERT INTO object VALUES (622, 'ILAVA', 'Mierové námestie č. 3');
INSERT INTO object VALUES (623, 'KLOKOČOV PRI ČADCI', 'Ústredie / č. 962');
INSERT INTO object VALUES (624, 'KORŇA', 'Ústredie / č. 517');
INSERT INTO object VALUES (625, 'KOŠECA', 'č. 315');
INSERT INTO object VALUES (626, 'KOŠECKÉ PODHRADIE', 'č. 403');
INSERT INTO object VALUES (627, 'KRÁSNO NAD KYSUCOU', 'Karola Pagáča / č. 557');
INSERT INTO object VALUES (628, 'KYSUCKÉ NOVÉ MESTO 1', '1.mája / č. 23');
INSERT INTO object VALUES (629, 'KYSUCKÉ NOVÉ MESTO 4', 'ČSA / č. 1302');
INSERT INTO object VALUES (630, 'KYSUCKÝ LIESKOVEC', 'Nižný koniec / č. 23');
INSERT INTO object VALUES (631, 'LADCE', 'č. 174');
INSERT INTO object VALUES (632, 'LEDNICKÉ ROVNE', 'Schreiberova č.370');
INSERT INTO object VALUES (633, 'LIETAVSKÁ LÚČKA', 'Žilinská cesta 16/34');
INSERT INTO object VALUES (634, 'LÚKY', 'č. 87');
INSERT INTO object VALUES (635, 'MAKOV NA SLOVENSKU', 'Ústredie / č. 60');
INSERT INTO object VALUES (636, 'MOJTÍN', 'č. 242');
INSERT INTO object VALUES (637, 'NESLUŠA', 'Ústredie / č. 171');
INSERT INTO object VALUES (638, 'NOVÁ BYSTRICA PRI ČADCI', 'U Škorvagy / č. 696');
INSERT INTO object VALUES (639, 'NOVÁ DUBNICA', 'Trenčianska, 16');
INSERT INTO object VALUES (640, 'OŠČADNICA', 'Ústredie / č. 759');
INSERT INTO object VALUES (641, 'PLEVNÍK-DRIEŇOVÉ', 'č. 95');
INSERT INTO object VALUES (642, 'PODVYSOKÁ', 'Ústredie / č. 309');
INSERT INTO object VALUES (643, 'POVAŽSKÁ BYSTRICA 1', 'Sládkovičova 1128/48');
INSERT INTO object VALUES (644, 'POVAŽSKÁ BYSTRICA 3', 'Nemocničná, 979/23');
INSERT INTO object VALUES (645, 'POVAŽSKÁ BYSTRICA 4', 'Považské Podhradie, 21');
INSERT INTO object VALUES (646, 'POVAŽSKÁ BYSTRICA 5', 'Považská Teplá, 183');
INSERT INTO object VALUES (647, 'POVAŽSKÁ BYSTRICA 7', 'Považské Podhradie, 21');
INSERT INTO object VALUES (648, 'POVAŽSKÁ BYSTRICA 8', 'Rozkvet, 2040');
INSERT INTO object VALUES (649, 'PREDMIER', 'Bajzova 19');
INSERT INTO object VALUES (650, 'PRUSKÉ', 'č. 567');
INSERT INTO object VALUES (651, 'PÚCHOV 1', 'Štefánikova, 812/2');
INSERT INTO object VALUES (652, 'RAJEC NAD RAJČANKOU', 'nám.SNP 21');
INSERT INTO object VALUES (653, 'RAJECKÁ LESNÁ', 'č.73');
INSERT INTO object VALUES (654, 'RAJECKÉ TEPLICE', 'Školská 25');
INSERT INTO object VALUES (655, 'RAKOVÁ', 'U Vražľa / č. 1045');
INSERT INTO object VALUES (656, 'SKALITÉ', 'Ústredie / č. 106');
INSERT INTO object VALUES (657, 'SLÁVNICA', 'č. 209/1');
INSERT INTO object VALUES (658, 'STARÁ BYSTRICA', 'Ústredie / č. 535');
INSERT INTO object VALUES (659, 'STAŠKOV', 'Staškov / č. 25');
INSERT INTO object VALUES (660, 'SVRČINOVEC', 'Ústredie / č. 200');
INSERT INTO object VALUES (661, 'TEPLIČKA NAD VÁHOM', 'Školská 19');
INSERT INTO object VALUES (662, 'TERCHOVÁ', 'Sv.Martina 297');
INSERT INTO object VALUES (663, 'TURZOVKA', 'Rudolfa Jašíka / č. 178');
INSERT INTO object VALUES (664, 'VARÍN', 'Martinčekova 131');
INSERT INTO object VALUES (665, 'VYSOKÁ NAD KYSUCOU', 'Ústredie / č. 231');
INSERT INTO object VALUES (666, 'ZBOROV NAD BYSTRICOU', 'č. 224');
INSERT INTO object VALUES (667, 'ZLIECHOV', 'č. 233');
INSERT INTO object VALUES (668, 'ŽILINA 1', 'ul.Sládkovičova 169/14');
INSERT INTO object VALUES (669, 'ŽILINA 14', 'Brodno č. 114');
INSERT INTO object VALUES (670, 'ŽILINA 15', 'Jedlíkova 3429');
INSERT INTO object VALUES (671, 'ŽILINA 2', 'ul.Hviezdoslavova 3');
INSERT INTO object VALUES (672, 'ŽILINA 4', 'Závodie, ul.Závodského 170');
INSERT INTO object VALUES (673, 'ŽILINA 7', 'Borova ulica');
INSERT INTO object VALUES (674, 'ŽILINA 8', 'Poštová č.1/3049');
INSERT INTO object VALUES (675, 'ŽILINA 10', 'TESCO-ul.Košická');
INSERT INTO object VALUES (676, 'Žilina 12', 'ul.Hviezdoslavová');
INSERT INTO object VALUES (677, 'SOČ Žilina', 'Bytčická 30');
INSERT INTO object VALUES (678, 'USES Žilina', 'Bytčická 30');
INSERT INTO object VALUES (679, 'BOBROVNÍK', 'č.68');
INSERT INTO object VALUES (680, 'BREZA', 'č.113');
INSERT INTO object VALUES (681, 'DLHÁ NAD ORAVOU', 'č.207');
INSERT INTO object VALUES (682, 'DOLNÝ KUBÍN 1', 'Alej Slobody 2203');
INSERT INTO object VALUES (683, 'DOLNÝ KUBÍN 3', 'Mierová 4');
INSERT INTO object VALUES (684, 'DÚBRAVA PRI LIPTOVSKOM MIKULÁŠI', 'č.192');
INSERT INTO object VALUES (685, 'HRUŠTÍN', 'č.49');
INSERT INTO object VALUES (686, 'HUBOVÁ', 'č.79');
INSERT INTO object VALUES (687, 'KLIN', 'č.224');
INSERT INTO object VALUES (688, 'KRAĽOVANY', 'č.186');
INSERT INTO object VALUES (689, 'KRUŠETNICA', 'č.69');
INSERT INTO object VALUES (690, 'LIESEK', 'č.442');
INSERT INTO object VALUES (691, 'LIKAVKA', 'Hollého č. 1550');
INSERT INTO object VALUES (692, 'LIPTOVSKÁ LÚŽNA', 'č.626');
INSERT INTO object VALUES (693, 'LIPTOVSKÁ OSADA', 'č.309');
INSERT INTO object VALUES (694, 'LIPTOVSKÁ SIELNICA', 'č.75');
INSERT INTO object VALUES (695, 'LIPTOVSKÉ SLIAČE', 'číslo 900');
INSERT INTO object VALUES (696, 'LIPTOVSKÝ HRÁDOK 1', 'SNP 136');
INSERT INTO object VALUES (697, 'LIPTOVSKÝ JÁN', 'Kúpeľná 97');
INSERT INTO object VALUES (698, 'LIPTOVSKÝ MIKULÁŠ 1', 'M.M.Hodžu 3');
INSERT INTO object VALUES (699, 'LIPTOVSKÝ MIKULÁŠ 4', 'Smrečianska 677');
INSERT INTO object VALUES (700, 'LIPTOVSKÝ MIKULÁŠ 5', 'J.Matušku 9');
INSERT INTO object VALUES (701, 'LISKOVÁ', 'č.365');
INSERT INTO object VALUES (702, 'LOKCA', 'č.3');
INSERT INTO object VALUES (703, 'ĽUBOCHŇA', 'č.215');
INSERT INTO object VALUES (704, 'LUDROVÁ', 'č.391');
INSERT INTO object VALUES (705, 'MUTNÉ', 'č.194');
INSERT INTO object VALUES (706, 'NÁMESTOVO 1', 'Nám.A.Bernoláka 4');
INSERT INTO object VALUES (707, 'NIŽNÁ NAD ORAVOU', 'Nová Doba 506');
INSERT INTO object VALUES (708, 'ORAVSKÁ LESNÁ', 'č.291');
INSERT INTO object VALUES (709, 'ORAVSKÁ POLHORA', 'č.189');
INSERT INTO object VALUES (710, 'ORAVSKÝ PODZÁMOK', 'Lesnícka 24');
INSERT INTO object VALUES (711, 'PODBIEL', 'č.247');
INSERT INTO object VALUES (712, 'RABČA', 'č.334');
INSERT INTO object VALUES (713, 'RUŽOMBEROK 1', 'ul.A.Bernoláka  č.3');
INSERT INTO object VALUES (714, 'RUŽOMBEROK 3', 'Hlavná č.13/147');
INSERT INTO object VALUES (715, 'RUŽOMBEROK 4', 'Bystrická cesta 10 ');
INSERT INTO object VALUES (716, 'RUŽOMBEROK 5', 'Hrabovská 5270,Tesco');
INSERT INTO object VALUES (717, 'RUŽOMBEROK 6', 'A.Hlinku č.229/1');
INSERT INTO object VALUES (718, 'SUCHÁ HORA', 'č.250');
INSERT INTO object VALUES (719, 'SVÄTÝ KRÍŽ', 'č.152');
INSERT INTO object VALUES (720, 'TRSTENÁ', 'Železničiarov 267/9');
INSERT INTO object VALUES (721, 'TVRDOŠÍN 1', 'Vojtašákova 634/36');
INSERT INTO object VALUES (722, 'TVRDOŠÍN 3', 'Medvedzie č.193');
INSERT INTO object VALUES (723, 'VALASKÁ DUBOVÁ', 'č.52');
INSERT INTO object VALUES (724, 'VAŽEC', 'HLAVNA č.510');
INSERT INTO object VALUES (725, 'VÝCHODNÁ', 'č.127');
INSERT INTO object VALUES (726, 'ZÁKAMENNÉ', 'č.745');
INSERT INTO object VALUES (727, 'ZÁZRIVÁ', 'Ustredie 125');
INSERT INTO object VALUES (728, 'ZUBEREC', 'č.288');
INSERT INTO object VALUES (729, 'BATIZOVCE', '28');
INSERT INTO object VALUES (730, 'BYSTRANY PRI SPIŠSKEJ NOVEJ VSI', 'Bystrany pri SNV 56');
INSERT INTO object VALUES (731, 'GELNICA', 'Slovenská 40');
INSERT INTO object VALUES (732, 'HNIEZDNE', 'Školská č. 289');
INSERT INTO object VALUES (733, 'HRANOVNICA', 'Sládkovičova 399');
INSERT INTO object VALUES (734, 'HUNCOVCE', '32');
INSERT INTO object VALUES (735, 'JAVORINA', '           ');
INSERT INTO object VALUES (736, 'KEŽMAROK 1', 'Mučeníkov 2');
INSERT INTO object VALUES (737, 'KEŽMAROK 3', 'Tvarožnianska 232/9');
INSERT INTO object VALUES (738, 'KLUKNAVA', 'Kluknava 205');
INSERT INTO object VALUES (739, 'KROMPACHY', 'Hlavná 1');
INSERT INTO object VALUES (740, 'LEVOČA', 'nám. Majstra Pavla 42');
INSERT INTO object VALUES (741, 'ĽUBICA', 'Vrbovská 32');
INSERT INTO object VALUES (742, 'MARGECANY', 'Obchodná 6');
INSERT INTO object VALUES (743, 'MARKUŠOVCE', 'Michalská 20');
INSERT INTO object VALUES (744, 'MATEJOVCE', 'Smetanova 1494');
INSERT INTO object VALUES (745, 'MLYNČEKY', '57');
INSERT INTO object VALUES (746, 'NÁLEPKOVO', 'Nálepkovo 384');
INSERT INTO object VALUES (747, 'NOVÁ ĽUBOVŇA', 'č. 102');
INSERT INTO object VALUES (748, 'PLAVEČ NAD POPRADOM', 'Vajanského ul. č. 235');
INSERT INTO object VALUES (749, 'PLAVNICA', 'č. 93');
INSERT INTO object VALUES (750, 'PODOLÍNEC', 'Mariánske námestie č. 66');
INSERT INTO object VALUES (751, 'POPRAD 1', 'Mnoheľova 11');
INSERT INTO object VALUES (752, 'POPRAD 2', 'Wolkerova 479');
INSERT INTO object VALUES (753, 'POPRAD 5', 'Banícka');
INSERT INTO object VALUES (754, 'POPRAD 6', 'Podtatranská');
INSERT INTO object VALUES (755, 'POPRAD 8', 'Dostojevského 12');
INSERT INTO object VALUES (756, 'POPRAD 9', 'Novomestského 3918');
INSERT INTO object VALUES (757, 'PRAKOVCE', 'sídl. SNP 298, blok Strečno');
INSERT INTO object VALUES (758, 'RUDŇANY', 'Zapálenica 234');
INSERT INTO object VALUES (759, 'SMIŽANY', 'Tatranská 107');
INSERT INTO object VALUES (760, 'SMOLNÍK', 'nám. Červenej armády 1');
INSERT INTO object VALUES (761, 'SPIŠSKÁ BELÁ', 'Štefánikova 40');
INSERT INTO object VALUES (762, 'SPIŠSKÁ NOVÁ VES 1', 'Štefánikovo námestie 7');
INSERT INTO object VALUES (763, 'SPIŠSKÁ NOVÁ VES 3', 'Kožuchová 6');
INSERT INTO object VALUES (764, 'SPIŠSKÁ NOVÁ VES 5', 'Šafárikovo námestie 2');
INSERT INTO object VALUES (765, 'SPIŠSKÁ STARÁ VES', 'Štúrova 251');
INSERT INTO object VALUES (766, 'SPIŠSKÉ BYSTRÉ', 'Michalská 394');
INSERT INTO object VALUES (767, 'SPIŠSKÉ PODHRADIE', 'Mariánske námestie 1');
INSERT INTO object VALUES (768, 'SPIŠSKÉ VLACHY', 'SNP 34');
INSERT INTO object VALUES (769, 'SPIŠSKÝ HRHOV', 'Českoslov.armády 33');
INSERT INTO object VALUES (770, 'SPIŠSKÝ ŠTVRTOK', 'nám. Slobody 259/1');
INSERT INTO object VALUES (771, 'STARÁ ĽUBOVŇA', 'nám. Gen. Štefánika 4');
INSERT INTO object VALUES (772, 'STARÝ SMOKOVEC', '28');
INSERT INTO object VALUES (773, 'SVIT 1', 'Štúrova 86');
INSERT INTO object VALUES (774, 'ŠTÔLA', '63');
INSERT INTO object VALUES (775, 'ŠTRBA', 'SNP 307');
INSERT INTO object VALUES (776, 'ŠTRBSKÉ PLESO', '19');
INSERT INTO object VALUES (777, 'ŠVEDLÁR', 'Švedlár 87');
INSERT INTO object VALUES (778, 'TATRANSKÁ LOMNICA', 'IV/122');
INSERT INTO object VALUES (779, 'VEĽKÁ LOMNICA', 'Tatranská 357');
INSERT INTO object VALUES (780, 'VEĽKÝ LIPNÍK', 'č. 82');
INSERT INTO object VALUES (781, 'VRBOV', '135');
INSERT INTO object VALUES (782, 'VYŠNÉ RUŽBACHY', ';052');
INSERT INTO object VALUES (783, 'ŽDIAR', '261');
INSERT INTO object VALUES (784, 'BAČKOV', '100');
INSERT INTO object VALUES (785, 'BELÁ NAD CIROCHOU', 'Osloboditeľov 652');
INSERT INTO object VALUES (786, 'BORŠA', 'Ružová č.188');
INSERT INTO object VALUES (787, 'BRACOVCE', '275');
INSERT INTO object VALUES (788, 'BUDKOVCE', '229');
INSERT INTO object VALUES (789, 'CEJKOV', 'Hlavná 334');
INSERT INTO object VALUES (790, 'ČIERNA NAD TISOU', 'Železničná 13');
INSERT INTO object VALUES (791, 'DLHÉ NAD CIROCHOU', '187');
INSERT INTO object VALUES (792, 'HUMENNÉ 1', 'Nám.Slobody 19');
INSERT INTO object VALUES (793, 'HUMENNÉ 2', 'Družstevná 38');
INSERT INTO object VALUES (794, 'HUMENNÉ 3', 'Námestie Slobody 55');
INSERT INTO object VALUES (795, 'HUMENNÉ 4', 'SNP 2510/44');
INSERT INTO object VALUES (796, 'JOVSA', '27');
INSERT INTO object VALUES (797, 'KALUŽA', '6');
INSERT INTO object VALUES (798, 'KAMENICA NAD CIROCHOU', 'Osloboditeľov 53');
INSERT INTO object VALUES (799, 'KOŠKOVCE', '21');
INSERT INTO object VALUES (800, 'KRAĽOVSKÝ CHLMEC 1', 'M.R.Štefánika');
INSERT INTO object VALUES (801, 'KRČAVA', '198');
INSERT INTO object VALUES (802, 'LELES', 'Hlavná 62');
INSERT INTO object VALUES (803, 'LUKAČOVCE pri HUMENNOM', '101');
INSERT INTO object VALUES (804, 'MALČICE', 'Hlavná 172');
INSERT INTO object VALUES (805, 'MEDZILABORCE', 'A. Warholu 187/4');
INSERT INTO object VALUES (806, 'MICHAĽANY PRI TREBIŠOVE', 'Staničná');
INSERT INTO object VALUES (807, 'MICHALOVCE 1', 'Špitálska 1');
INSERT INTO object VALUES (808, 'MICHALOVCE 3', 'Pasáž  3');
INSERT INTO object VALUES (809, 'MICHALOVCE 5', 'Straňany nad Laborcom');
INSERT INTO object VALUES (810, 'NACINA VES', '137');
INSERT INTO object VALUES (811, 'NOVOSAD', 'Hraňská č.27');
INSERT INTO object VALUES (812, 'OHRADZANY', '164');
INSERT INTO object VALUES (813, 'OĽKA', '103');
INSERT INTO object VALUES (814, 'PARCHOVANY', '462');
INSERT INTO object VALUES (815, 'PAVLOVCE NAD UHOM', '387');
INSERT INTO object VALUES (816, 'PČOLINE', '121');
INSERT INTO object VALUES (817, 'PODHOROĎ', '110');
INSERT INTO object VALUES (818, 'POZDIŠOVCE', '375');
INSERT INTO object VALUES (819, 'RADVAŇ NAD LABORCOM', 'č. 41');
INSERT INTO object VALUES (820, 'SEČOVCE', 'Námestie Cyrila a Metoda 150');
INSERT INTO object VALUES (821, 'SLOVENSKÉ NOVÉ MESTO', '13');
INSERT INTO object VALUES (822, 'SNINA 1', 'Študentská 1442');
INSERT INTO object VALUES (823, 'SNINA 3', 'Komenského 2661/K11');
INSERT INTO object VALUES (824, 'SOBRANCE', 'Kpt. Nálepku 1');
INSERT INTO object VALUES (825, 'SOMOTOR', 'Obchodna 505');
INSERT INTO object VALUES (826, 'STAKČÍN', 'Švermova 143');
INSERT INTO object VALUES (827, 'STRÁŽSKE', 'Družstevná 508');
INSERT INTO object VALUES (828, 'STREDA NAD BODROGOM', 'Hlavná 217');
INSERT INTO object VALUES (829, 'ŠMIGOVEC', '37');
INSERT INTO object VALUES (830, 'TREBIŠOV 1', 'M.R.Štefánika  1832/3');
INSERT INTO object VALUES (831, 'TRHOVIŠTE', '121');
INSERT INTO object VALUES (832, 'UBĽA', '235');
INSERT INTO object VALUES (833, 'UDAVSKÉ', '30');
INSERT INTO object VALUES (834, 'ULIČ', '98');
INSERT INTO object VALUES (835, 'VEĽKÉ KAPUŠANY', 'Námestie Doboa 4');
INSERT INTO object VALUES (836, 'VEĽKÉ TRAKANY', '419');
INSERT INTO object VALUES (837, 'VOJANY', 'ul. Laborecka 1');
INSERT INTO object VALUES (838, 'VOJČICE', '414');
INSERT INTO object VALUES (839, 'VÝRAVA', '104');
INSERT INTO object VALUES (840, 'VYŠNÝ HRUŠOV', '21');
INSERT INTO object VALUES (841, 'BETLIAR', 'Nová 18');
INSERT INTO object VALUES (842, 'BIDOVCE', 'Bidovce 210');
INSERT INTO object VALUES (843, 'BOHDANOVCE PRI KOŠICIACH', 'Bohdanovce 142');
INSERT INTO object VALUES (844, 'BRZOTÍN', 'Brzotín 252');
INSERT INTO object VALUES (845, 'BUDIMÍR', 'Budimír 19');
INSERT INTO object VALUES (846, 'ČAŇA', 'Sídlisko 3');
INSERT INTO object VALUES (847, 'ČEČEJOVCE', 'Buzická 55');
INSERT INTO object VALUES (848, 'DOBŠINÁ', 'Námestie baníkov 381');
INSERT INTO object VALUES (849, 'DOBŠINSKÁ ĽADOVÁ JASKYŇA', '4');
INSERT INTO object VALUES (850, 'DRNAVA', '10');
INSERT INTO object VALUES (851, 'DRUŽSTEVNÁ PRI HORNÁDE', 'Hlavná 38');
INSERT INTO object VALUES (852, 'GEČA', '382');
INSERT INTO object VALUES (853, 'GEMERSKÁ HÔRKA', '151');
INSERT INTO object VALUES (854, 'HERĽANY', 'Herľany 69');
INSERT INTO object VALUES (855, 'HUCÍN', '76');
INSERT INTO object VALUES (856, 'JASOV', 'Jasov 100');
INSERT INTO object VALUES (857, 'JELŠAVA', 'Námestie republiky 60');
INSERT INTO object VALUES (858, 'KALŠA', 'Kalša 128');
INSERT INTO object VALUES (859, 'KECEROVCE', '92');
INSERT INTO object VALUES (860, 'KOŠICE 1', 'Poštová 20');
INSERT INTO object VALUES (861, 'KOŠICE 10', 'Tr. SNP 35');
INSERT INTO object VALUES (862, 'KOŠICE 11', 'Humenská 4');
INSERT INTO object VALUES (863, 'KOŠICE 12', 'Spišské námestie 3');
INSERT INTO object VALUES (864, 'KOŠICE 13', 'Americká trieda 18');
INSERT INTO object VALUES (865, 'KOŠICE 14', 'Mliečna 1');
INSERT INTO object VALUES (866, 'KOŠICE 15', 'Železiarenská 11');
INSERT INTO object VALUES (867, 'KOŠICE 16', 'Myslavská 400');
INSERT INTO object VALUES (868, 'KOŠICE 17-Barca', 'Pri pošte 7/600');
INSERT INTO object VALUES (869, 'KOŠICE 18-Krásna', 'Opátska 13');
INSERT INTO object VALUES (870, 'KOŠICE 2', 'Thurzova 3');
INSERT INTO object VALUES (871, 'KOŠICE 20', 'Ždiarska 15');
INSERT INTO object VALUES (872, 'KOŠICE 22', 'Trieda generála Svobodu 12');
INSERT INTO object VALUES (873, 'KOŠICE 23', 'Cottbuská 36');
INSERT INTO object VALUES (874, 'KOŠICE 3', 'Južná trieda 37');
INSERT INTO object VALUES (875, 'KOŠICE 4', 'Komenského 30');
INSERT INTO object VALUES (876, 'KOŠICE 5', 'Pri Prachárni 4');
INSERT INTO object VALUES (877, 'KOŠICE 6', 'Národná trieda 56');
INSERT INTO object VALUES (878, 'KOŠICE 7', 'Ostravská 2');
INSERT INTO object VALUES (879, 'KOŠICE 8', 'B.Nemcovej 27');
INSERT INTO object VALUES (880, 'KOŠICE 9', 'Podhradová');
INSERT INTO object VALUES (881, 'KOŠICE-ŽELEZIARNE', 'Vstupný areál U.S.S');
INSERT INTO object VALUES (882, 'KRÁSNOHORSKÁ DLHÁ LÚKA', 'č.d. 265');
INSERT INTO object VALUES (883, 'KRÁSNOHORSKÉ PODHRADIE', 'Hradná 155');
INSERT INTO object VALUES (884, 'KYSAK', 'Kysak 7');
INSERT INTO object VALUES (885, 'LUBENÍK', 'Lubeník 103');
INSERT INTO object VALUES (886, 'MEDZEV', 'SPH 39');
INSERT INTO object VALUES (887, 'MOLDAVA NAD BODVOU', 'Hlavná 65');
INSERT INTO object VALUES (888, 'MURÁŇ 1', 'Muráň 329');
INSERT INTO object VALUES (889, 'NIŽNÁ MYŠĽA', 'Obchodna 106');
INSERT INTO object VALUES (890, 'PLEŠIVEC', 'Okružná 374');
INSERT INTO object VALUES (891, 'POPROČ', 'Mieru 95');
INSERT INTO object VALUES (892, 'REVÚCA', 'Železničná 23');
INSERT INTO object VALUES (893, 'ROZHANOVCE', 'Družstevná 2/168');
INSERT INTO object VALUES (894, 'ROŽNAVA 1', 'Cučmianska dlhá 8');
INSERT INTO object VALUES (895, 'ROŽŇAVA 3', 'Šafárikova 62');
INSERT INTO object VALUES (896, 'RUSKOV', 'Ruskov 77');
INSERT INTO object VALUES (897, 'SEŇA', 'Sena 159');
INSERT INTO object VALUES (898, 'SIRK', '74');
INSERT INTO object VALUES (899, 'SLANEC', 'Park-Pod hradom (Kult.dom)');
INSERT INTO object VALUES (900, 'SLAVOŠOVCE', '268');
INSERT INTO object VALUES (901, 'ŠTÍTNIK', 'Družstevná 126');
INSERT INTO object VALUES (902, 'TURŇA NAD BODVOU', 'Turna n/B.118');
INSERT INTO object VALUES (903, 'VALALIKY', 'Kokšovská 15');
INSERT INTO object VALUES (904, 'VEĽKÁ IDA', 'Velka Ida 268');
INSERT INTO object VALUES (905, 'VLACHOVO', '34');
INSERT INTO object VALUES (906, 'ŽDAŇA', 'Ždaňa 85');
INSERT INTO object VALUES (907, 'RPC  Košice - Thurzova 2', ';');
INSERT INTO object VALUES (908, 'Dobšinská Ľadová Jaskyňa - Chata', ';');
INSERT INTO object VALUES (909, 'Výpočtové stredisko Rožňava', ';');
INSERT INTO object VALUES (910, 'Hromadný podaj KE 012', ';');
INSERT INTO object VALUES (911, 'Hybridná pošta  Košice', ';');
INSERT INTO object VALUES (912, 'ES - uzol Košice', ';');
INSERT INTO object VALUES (913, 'Stolárska dielňa - POČ Košice', ';');
INSERT INTO object VALUES (914, 'Košice 13 - registratúra', ';');
INSERT INTO object VALUES (915, 'BARDEJOV 1', 'Dlhý rad 14');
INSERT INTO object VALUES (916, 'BARDEJOV 3', 'sídl. Obrancov mieru');
INSERT INTO object VALUES (917, 'BARDEJOV 4', 'sídl. Vinbarg');
INSERT INTO object VALUES (918, 'BREZOVICA NAD TORYSOU', 'Brezovica 81');
INSERT INTO object VALUES (919, 'BYSTRÉ NAD TOPĽOU', 'sídlisko 304');
INSERT INTO object VALUES (920, 'CERNINA', 'Cernina 65');
INSERT INTO object VALUES (921, 'FINTICE', 'Grófske nádvorie 210/1');
INSERT INTO object VALUES (922, 'GIRALTOVCE', 'Hviezdoslavova 446');
INSERT INTO object VALUES (923, 'HANUŠOVCE NAD TOPĽOU', 'Slovenská 51');
INSERT INTO object VALUES (924, 'HAVAJ', 'Havaj 75');
INSERT INTO object VALUES (925, 'HERTNÍK', 'Hertník 102');
INSERT INTO object VALUES (926, 'CHMINIANSKA NOVÁ VES', 'Levočská 213');
INSERT INTO object VALUES (927, 'JAROVNICE', 'Jarovnice 64');
INSERT INTO object VALUES (928, 'KAPUŠANY PRI PREŠOVE', 'Poštová 365/1');
INSERT INTO object VALUES (929, 'KOKOŠOVCE', 'Kokošovce 76');
INSERT INTO object VALUES (930, 'KRAJNÁ POĽANA', 'Krajná Poľana 5');
INSERT INTO object VALUES (931, 'KRUŽĽOV', 'Kružľov 141');
INSERT INTO object VALUES (932, 'KUKOVÁ', 'Kuková 74');
INSERT INTO object VALUES (933, 'LEMEŠANY', 'Lemešany 103');
INSERT INTO object VALUES (934, 'LIPANY NAD TORYSOU', 'Krivianska 2');
INSERT INTO object VALUES (935, 'LIPOVCE PRI PREŠOVE', 'Lipovce 92');
INSERT INTO object VALUES (936, 'MALCOV', 'Malcov 130');
INSERT INTO object VALUES (937, 'MARHAŇ', 'Marhaň 130');
INSERT INTO object VALUES (938, 'MESTISKO', 'Mestisko 6');
INSERT INTO object VALUES (939, 'OKRUHLÉ', 'Okrúhle 131');
INSERT INTO object VALUES (940, 'PREŠOV 1', 'Masarykova 2');
INSERT INTO object VALUES (941, 'PREŠOV 2', 'Masarykova 23');
INSERT INTO object VALUES (942, 'PREŠOV 3', 'Sabinovská ul.');
INSERT INTO object VALUES (943, 'PREŠOV 4', 'sídlisko II - Centrál');
INSERT INTO object VALUES (944, 'PREŠOV 5', 'Švábska 32');
INSERT INTO object VALUES (945, 'PREŠOV 6', 'Bardejovská 45');
INSERT INTO object VALUES (946, 'PREŠOV 7', 'Námestie Kráľovnej pokoja');
INSERT INTO object VALUES (947, 'PREŠOV 8', 'sídlisko Sekčov - Opál');
INSERT INTO object VALUES (948, 'PREŠOV 9', 'Exnárova ul.');
INSERT INTO object VALUES (949, 'PREŠOV 10', 'Volgogradská 7A');
INSERT INTO object VALUES (950, 'RASLAVICE', 'Toplianska 153');
INSERT INTO object VALUES (951, 'SABINOV', 'Prešovská 1');
INSERT INTO object VALUES (952, 'SAČUROV', 'Sačurov 193');
INSERT INTO object VALUES (953, 'SEČOVSKÁ POLIANKA', 'Sečovská Polianka 535');
INSERT INTO object VALUES (954, 'SEDLICE PRI PREŠOVE', 'Sedlice 176');
INSERT INTO object VALUES (955, 'SEDLISKÁ', 'Sedliská 86');
INSERT INTO object VALUES (956, 'SLOVENSKÁ KAJŇA', 'Slovenská Kajňa 2');
INSERT INTO object VALUES (957, 'SOĽ', 'Soľ 107');
INSERT INTO object VALUES (958, 'STROPKOV', 'Hlavná 1737/61');
INSERT INTO object VALUES (959, 'SVIDNÍK', 'Stropkovská 633/1');
INSERT INTO object VALUES (960, 'ŠARIŠSKÉ MICHAĽANY', 'Čerešňová  12');
INSERT INTO object VALUES (961, 'ŠIROKÉ', 'Široké 118');
INSERT INTO object VALUES (962, 'TOVARNÉ', 'Továrne 124');
INSERT INTO object VALUES (963, 'TULČÍK', 'Tulčík 161');
INSERT INTO object VALUES (964, 'TURANY NAD ONDAVOU', 'Turany n/Ondavou 100');
INSERT INTO object VALUES (965, 'VECHEC', 'Vechec 133');
INSERT INTO object VALUES (966, 'VEĽKÝ ŠARIŠ', 'Východná 1');
INSERT INTO object VALUES (967, 'VRANOV NAD TOPĽOU 1', 'Námestie slobody 1');
INSERT INTO object VALUES (968, 'VRANOV NAD TOPĽOU 2', 'Školská 652');
INSERT INTO object VALUES (969, 'VRANOV NAD TOPĽOU 3', 'Čemernianska 398');
INSERT INTO object VALUES (970, 'VYŠNÝ ORLÍK', 'Vyšný Orlík 14');
INSERT INTO object VALUES (971, 'VYŠNÝ ŽIPOV', 'Vyšný Žipov 83');
INSERT INTO object VALUES (972, 'ZÁMUTOV', 'Zámutov 434');
INSERT INTO object VALUES (973, 'ZBOROV', 'Lesná 10');


--
-- TOC entry 5 (OID 10878778)
-- Name: object_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ivan
--

SELECT pg_catalog.setval('object_id_seq', 1, true);


