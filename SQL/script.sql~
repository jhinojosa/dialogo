--
-- PostgreSQL database dump
--

-- Dumped from database version 9.0.4
-- Dumped by pg_dump version 9.0.1
-- Started on 2011-07-20 03:17:43

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 1972 (class 1262 OID 16393)
-- Name: dialogo; Type: DATABASE; Schema: -; Owner: dialogo
--


SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;



SET search_path = public, pg_catalog;

--
-- TOC entry 1579 (class 1259 OID 57655)
-- Dependencies: 5
-- Name: seq_acta_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_acta_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1556 (class 1259 OID 16394)
-- Dependencies: 1863 5
-- Name: acta; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE acta (
    n_id_acta numeric DEFAULT nextval('seq_acta_dialogo_id'::regclass) NOT NULL,
    n_id_dialogo numeric NOT NULL,
    x_id_usuario character varying(100) NOT NULL,
    x_texto_acta character varying(51200),
    d_fecha_modificacion date
);



--
-- TOC entry 1580 (class 1259 OID 57658)
-- Dependencies: 5
-- Name: seq_balance_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_balance_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1569 (class 1259 OID 16648)
-- Dependencies: 1876 5
-- Name: balance; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE balance (
    n_id_balance numeric DEFAULT nextval('seq_balance_dialogo_id'::regclass) NOT NULL,
    n_id_dialogo numeric NOT NULL,
    n_id_movida_dialogo numeric NOT NULL,
    n_porcentaje_balance numeric(32,2),
    n_porcentaje_tolerancia numeric
);



--
-- TOC entry 1583 (class 1259 OID 57667)
-- Dependencies: 5
-- Name: seq_correccion_movida_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_correccion_movida_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1557 (class 1259 OID 16405)
-- Dependencies: 1864 5
-- Name: correccion_movida; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE correccion_movida (
    n_id_correccion_movida numeric DEFAULT nextval('seq_correccion_movida_id'::regclass) NOT NULL,
    n_id_movida_dialogo numeric NOT NULL,
    n_id_intervencion numeric NOT NULL,
    x_id_usuario character varying(100)
);



--
-- TOC entry 1570 (class 1259 OID 24840)
-- Dependencies: 5
-- Name: seq_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1558 (class 1259 OID 16414)
-- Dependencies: 1865 1866 5
-- Name: dialogo; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE dialogo (
    n_id_dialogo numeric DEFAULT nextval('seq_dialogo_id'::regclass) NOT NULL,
    x_id_usuario_creador character varying(100) NOT NULL,
    x_id_usuario_facilitador character varying(100) NOT NULL,
    x_titulo_dialogo character varying(1000),
    d_fecha_creacion date,
    n_dialogo_desbalanceado numeric(1,0) DEFAULT 0
);


--
-- TOC entry 1572 (class 1259 OID 33037)
-- Dependencies: 5
-- Name: seq_intervencion_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_intervencion_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 1559 (class 1259 OID 16425)
-- Dependencies: 1867 5
-- Name: intervencion; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE intervencion (
    n_id_intervencion numeric DEFAULT nextval('seq_intervencion_id'::regclass) NOT NULL,
    n_id_respuesta numeric,
    x_id_usuario character varying(100) NOT NULL,
    n_id_movida numeric,
    n_id_movida_original numeric NOT NULL,
    n_id_dialogo numeric NOT NULL,
    x_texto_intervencion character varying,
    d_fecha_creacion timestamp(0) without time zone,
    x_texto_respuesta character varying
);


--
-- TOC entry 1582 (class 1259 OID 57664)
-- Dependencies: 5
-- Name: seq_maestro_categoria_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_maestro_categoria_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1560 (class 1259 OID 16439)
-- Dependencies: 1868 5
-- Name: maestro_categoria; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE maestro_categoria (
    n_id_categoria numeric DEFAULT nextval('seq_maestro_categoria_id'::regclass) NOT NULL,
    x_id_usuario character varying(100),
    x_nombre_categoria character varying(200),
    x_descripcion_categoria character varying(500),
	n_movida_crear_dialogo numeric DEFAULT 0,
    d_fecha_creacion date
);



--
-- TOC entry 1571 (class 1259 OID 33035)
-- Dependencies: 5
-- Name: seq_maestro_det_cat_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_maestro_det_cat_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 1561 (class 1259 OID 16449)
-- Dependencies: 1869 5
-- Name: maestro_det_categoria; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE maestro_det_categoria (
    n_id_det_cat numeric DEFAULT nextval('seq_maestro_det_cat_id'::regclass) NOT NULL,
    n_id_movida numeric NOT NULL,
    n_id_categoria numeric NOT NULL
);



--
-- TOC entry 1584 (class 1259 OID 57670)
-- Dependencies: 5
-- Name: seq_maestro_movida_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_maestro_movida_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1562 (class 1259 OID 16460)
-- Dependencies: 1870 5
-- Name: maestro_movida; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE maestro_movida (
    n_id_movida numeric DEFAULT nextval('seq_maestro_movida_id'::regclass) NOT NULL,
    x_id_usuario character varying(100) NOT NULL,
    x_nombre_movida character varying(200),
    x_icono_movida character varying(255),
    x_descripcion_movida character varying(500),
    n_eje_movida numeric,
    d_fecha_creacion date
);


--
-- TOC entry 1975 (class 0 OID 0)
-- Dependencies: 1562
-- Name: COLUMN maestro_movida.n_eje_movida; Type: COMMENT; Schema: public; Owner: dialogo
--

COMMENT ON COLUMN maestro_movida.n_eje_movida IS '0: Buscar entender. 1: Darse a entender';


--
-- TOC entry 1585 (class 1259 OID 57673)
-- Dependencies: 5
-- Name: seq_maestro_regla_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_maestro_regla_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1563 (class 1259 OID 16470)
-- Dependencies: 1871 5
-- Name: maestro_regla; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE maestro_regla (
    n_id_regla numeric DEFAULT nextval('seq_maestro_regla_id'::regclass) NOT NULL,
    x_id_usuario character varying(100) NOT NULL,
    x_texto_regla character varying(51200),
    d_fecha_creacion date
);



--
-- TOC entry 1581 (class 1259 OID 57661)
-- Dependencies: 5
-- Name: seq_marcador_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_marcador_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1564 (class 1259 OID 16480)
-- Dependencies: 1872 5
-- Name: marcador; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE marcador (
    n_id_marcador numeric DEFAULT nextval('seq_marcador_id'::regclass) NOT NULL,
    x_id_usuario character varying(100) NOT NULL,
    n_id_intervencion numeric NOT NULL
);



--
-- TOC entry 1573 (class 1259 OID 33040)
-- Dependencies: 5
-- Name: seq_movida_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_movida_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1565 (class 1259 OID 16491)
-- Dependencies: 1873 5
-- Name: movida_dialogo; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE movida_dialogo (
    n_id_movida_dialogo numeric DEFAULT nextval('seq_movida_dialogo_id'::regclass) NOT NULL,
    n_id_dialogo numeric NOT NULL,
    x_nombre_movida character varying(200),
    x_descripcion_movida character varying(500),
    x_icono_movida character varying(255),
    n_eje_movida numeric
);



--
-- TOC entry 1976 (class 0 OID 0)
-- Dependencies: 1565
-- Name: COLUMN movida_dialogo.n_eje_movida; Type: COMMENT; Schema: public; Owner: dialogo
--

COMMENT ON COLUMN movida_dialogo.n_eje_movida IS '0: Buscar entender. 1: Darse a entender';


--
-- TOC entry 1578 (class 1259 OID 49463)
-- Dependencies: 5
-- Name: seq_nota_intervencion_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_nota_intervencion_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1566 (class 1259 OID 16501)
-- Dependencies: 1874 5
-- Name: nota_intervencion; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE nota_intervencion (
    n_id_nota numeric DEFAULT nextval('seq_nota_intervencion_id'::regclass) NOT NULL,
    n_id_intervencion numeric NOT NULL,
    x_id_usuario character varying(100) NOT NULL,
    x_contenido_nota character varying(5000)
);



--
-- TOC entry 1575 (class 1259 OID 33045)
-- Dependencies: 5
-- Name: seq_regla_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_regla_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1567 (class 1259 OID 16512)
-- Dependencies: 1875 5
-- Name: regla_dialogo; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE regla_dialogo (
    n_id_regla_dialogo numeric DEFAULT nextval('seq_regla_dialogo_id'::regclass) NOT NULL,
    n_id_dialogo numeric NOT NULL,
    x_texto_regla_dialogo character varying(51200),
    d_fecha_creacion date
);



--
-- TOC entry 1577 (class 1259 OID 49440)
-- Dependencies: 5
-- Name: seq_restriccion_dialogo_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_restriccion_dialogo_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1576 (class 1259 OID 49432)
-- Dependencies: 1877 5
-- Name: restriccion_dialogo; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE restriccion_dialogo (
    n_id_restriccion numeric(1,0) DEFAULT nextval('seq_restriccion_dialogo_id'::regclass) NOT NULL,
    n_id_dialogo numeric(1,0),
    x_id_usuario character varying
);



--
-- TOC entry 1977 (class 0 OID 0)
-- Dependencies: 1576
-- Name: TABLE restriccion_dialogo; Type: COMMENT; Schema: public; Owner: dialogo
--

COMMENT ON TABLE restriccion_dialogo IS 'Almacena los usuarios que pueden tener acceso a un diálogo, si no hay asociaciones, cualquiera puede acceder a éste.';


--
-- TOC entry 1574 (class 1259 OID 33043)
-- Dependencies: 5
-- Name: seq_maestromovida_id; Type: SEQUENCE; Schema: public; Owner: dialogo
--

CREATE SEQUENCE seq_maestromovida_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- TOC entry 1568 (class 1259 OID 16522)
-- Dependencies: 5
-- Name: usuario; Type: TABLE; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE TABLE usuario (
    x_id_usuario character varying(100) NOT NULL,
    x_email_usuario character varying(255),
    x_password character varying(33),
	x_nombre_completo character varying(100),
    n_codigo_rol integer
);



--
-- TOC entry 1881 (class 2606 OID 16401)
-- Dependencies: 1556 1556
-- Name: pk_acta; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY acta
    ADD CONSTRAINT pk_acta PRIMARY KEY (n_id_acta);


--
-- TOC entry 1940 (class 2606 OID 16655)
-- Dependencies: 1569 1569
-- Name: pk_balance; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY balance
    ADD CONSTRAINT pk_balance PRIMARY KEY (n_id_balance);


--
-- TOC entry 1885 (class 2606 OID 16412)
-- Dependencies: 1557 1557
-- Name: pk_correccion_movida; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY correccion_movida
    ADD CONSTRAINT pk_correccion_movida PRIMARY KEY (n_id_correccion_movida);


--
-- TOC entry 1890 (class 2606 OID 16421)
-- Dependencies: 1558 1558
-- Name: pk_dialogo; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY dialogo
    ADD CONSTRAINT pk_dialogo PRIMARY KEY (n_id_dialogo);


--
-- TOC entry 1896 (class 2606 OID 16432)
-- Dependencies: 1559 1559
-- Name: pk_intervencion; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT pk_intervencion PRIMARY KEY (n_id_intervencion);


--
-- TOC entry 1902 (class 2606 OID 16446)
-- Dependencies: 1560 1560
-- Name: pk_maestro_categoria; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY maestro_categoria
    ADD CONSTRAINT pk_maestro_categoria PRIMARY KEY (n_id_categoria);


--
-- TOC entry 1907 (class 2606 OID 16456)
-- Dependencies: 1561 1561
-- Name: pk_maestro_det_categoria; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY maestro_det_categoria
    ADD CONSTRAINT pk_maestro_det_categoria PRIMARY KEY (n_id_det_cat);


--
-- TOC entry 1911 (class 2606 OID 16467)
-- Dependencies: 1562 1562
-- Name: pk_maestro_movida; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY maestro_movida
    ADD CONSTRAINT pk_maestro_movida PRIMARY KEY (n_id_movida);


--
-- TOC entry 1915 (class 2606 OID 16477)
-- Dependencies: 1563 1563
-- Name: pk_maestro_regla; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY maestro_regla
    ADD CONSTRAINT pk_maestro_regla PRIMARY KEY (n_id_regla);


--
-- TOC entry 1920 (class 2606 OID 16487)
-- Dependencies: 1564 1564
-- Name: pk_marcador; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY marcador
    ADD CONSTRAINT pk_marcador PRIMARY KEY (n_id_marcador);


--
-- TOC entry 1924 (class 2606 OID 16498)
-- Dependencies: 1565 1565
-- Name: pk_movida_dialogo; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY movida_dialogo
    ADD CONSTRAINT pk_movida_dialogo PRIMARY KEY (n_id_movida_dialogo);


--
-- TOC entry 1929 (class 2606 OID 16508)
-- Dependencies: 1566 1566
-- Name: pk_nota_intervencion; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY nota_intervencion
    ADD CONSTRAINT pk_nota_intervencion PRIMARY KEY (n_id_nota);


--
-- TOC entry 1932 (class 2606 OID 16519)
-- Dependencies: 1567 1567
-- Name: pk_regla_dialogo; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY regla_dialogo
    ADD CONSTRAINT pk_regla_dialogo PRIMARY KEY (n_id_regla_dialogo);


--
-- TOC entry 1935 (class 2606 OID 16529)
-- Dependencies: 1568 1568
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (x_id_usuario);


--
-- TOC entry 1942 (class 2606 OID 49439)
-- Dependencies: 1576 1576
-- Name: restriccion_dialogo_pkey; Type: CONSTRAINT; Schema: public; Owner: dialogo; Tablespace: 
--

ALTER TABLE ONLY restriccion_dialogo
    ADD CONSTRAINT restriccion_dialogo_pkey PRIMARY KEY (n_id_restriccion);


--
-- TOC entry 1878 (class 1259 OID 16402)
-- Dependencies: 1556
-- Name: acta_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX acta_pk ON acta USING btree (n_id_acta);


--
-- TOC entry 1937 (class 1259 OID 16656)
-- Dependencies: 1569
-- Name: balance_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX balance_pk ON balance USING btree (n_id_balance);


--
-- TOC entry 1903 (class 1259 OID 16458)
-- Dependencies: 1561
-- Name: categoria_detalla_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX categoria_detalla_fk ON maestro_det_categoria USING btree (n_id_categoria);


--
-- TOC entry 1883 (class 1259 OID 16413)
-- Dependencies: 1557
-- Name: correccion_movida_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX correccion_movida_pk ON correccion_movida USING btree (n_id_correccion_movida);


--
-- TOC entry 1899 (class 1259 OID 16448)
-- Dependencies: 1560
-- Name: creador_categoria_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX creador_categoria_fk ON maestro_categoria USING btree (x_id_usuario);


--
-- TOC entry 1886 (class 1259 OID 16424)
-- Dependencies: 1558
-- Name: creador_dialogo_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX creador_dialogo_fk ON dialogo USING btree (x_id_usuario_facilitador);


--
-- TOC entry 1908 (class 1259 OID 16469)
-- Dependencies: 1562
-- Name: creador_movida_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX creador_movida_fk ON maestro_movida USING btree (x_id_usuario);


--
-- TOC entry 1925 (class 1259 OID 16511)
-- Dependencies: 1566
-- Name: creador_nota_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX creador_nota_fk ON nota_intervencion USING btree (x_id_usuario);


--
-- TOC entry 1912 (class 1259 OID 16479)
-- Dependencies: 1563
-- Name: creador_regla_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX creador_regla_fk ON maestro_regla USING btree (x_id_usuario);


--
-- TOC entry 1904 (class 1259 OID 16459)
-- Dependencies: 1561
-- Name: detalle_tiene_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX detalle_tiene_fk ON maestro_det_categoria USING btree (n_id_movida);


--
-- TOC entry 1879 (class 1259 OID 16403)
-- Dependencies: 1556
-- Name: dialogo_asocia_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX dialogo_asocia_fk ON acta USING btree (n_id_dialogo);


--
-- TOC entry 1887 (class 1259 OID 16422)
-- Dependencies: 1558
-- Name: dialogo_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX dialogo_pk ON dialogo USING btree (n_id_dialogo);


--
-- TOC entry 1891 (class 1259 OID 16434)
-- Dependencies: 1559
-- Name: dialogo_posee_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX dialogo_posee_fk ON intervencion USING btree (n_id_dialogo);


--
-- TOC entry 1938 (class 1259 OID 16657)
-- Dependencies: 1569
-- Name: dialogo_tiene_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX dialogo_tiene_fk ON balance USING btree (n_id_dialogo);


--
-- TOC entry 1930 (class 1259 OID 16521)
-- Dependencies: 1567
-- Name: dialogo_tiene_reglas_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX dialogo_tiene_reglas_fk ON regla_dialogo USING btree (n_id_dialogo);


--
-- TOC entry 1892 (class 1259 OID 16433)
-- Dependencies: 1559
-- Name: intervencion_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX intervencion_pk ON intervencion USING btree (n_id_intervencion);


--
-- TOC entry 1916 (class 1259 OID 16489)
-- Dependencies: 1564
-- Name: intervencion_posee_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX intervencion_posee_fk ON marcador USING btree (n_id_intervencion);


--
-- TOC entry 1900 (class 1259 OID 16447)
-- Dependencies: 1560
-- Name: maestro_categoria_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX maestro_categoria_pk ON maestro_categoria USING btree (n_id_categoria);


--
-- TOC entry 1905 (class 1259 OID 16457)
-- Dependencies: 1561
-- Name: maestro_det_categoria_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX maestro_det_categoria_pk ON maestro_det_categoria USING btree (n_id_det_cat);


--
-- TOC entry 1909 (class 1259 OID 16468)
-- Dependencies: 1562
-- Name: maestro_movida_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX maestro_movida_pk ON maestro_movida USING btree (n_id_movida);


--
-- TOC entry 1913 (class 1259 OID 16478)
-- Dependencies: 1563
-- Name: maestro_regla_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX maestro_regla_pk ON maestro_regla USING btree (n_id_regla);


--
-- TOC entry 1917 (class 1259 OID 16490)
-- Dependencies: 1564
-- Name: marcador_creador_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX marcador_creador_fk ON marcador USING btree (x_id_usuario);


--
-- TOC entry 1918 (class 1259 OID 16488)
-- Dependencies: 1564
-- Name: marcador_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX marcador_pk ON marcador USING btree (n_id_marcador);


--
-- TOC entry 1888 (class 1259 OID 16423)
-- Dependencies: 1558
-- Name: mediador_dialogo_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX mediador_dialogo_fk ON dialogo USING btree (x_id_usuario_creador);


--
-- TOC entry 1893 (class 1259 OID 16436)
-- Dependencies: 1559
-- Name: movida_corregida_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX movida_corregida_fk ON intervencion USING btree (n_id_movida);


--
-- TOC entry 1894 (class 1259 OID 16438)
-- Dependencies: 1559
-- Name: movida_definida_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX movida_definida_fk ON intervencion USING btree (n_id_movida_original);


--
-- TOC entry 1921 (class 1259 OID 16499)
-- Dependencies: 1565
-- Name: movida_dialogo_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX movida_dialogo_pk ON movida_dialogo USING btree (n_id_movida_dialogo);


--
-- TOC entry 1922 (class 1259 OID 16500)
-- Dependencies: 1565
-- Name: movidas_posibles_dialogo_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX movidas_posibles_dialogo_fk ON movida_dialogo USING btree (n_id_dialogo);


--
-- TOC entry 1926 (class 1259 OID 16510)
-- Dependencies: 1566
-- Name: nota_de_intervencion_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX nota_de_intervencion_fk ON nota_intervencion USING btree (n_id_intervencion);


--
-- TOC entry 1927 (class 1259 OID 16509)
-- Dependencies: 1566
-- Name: nota_intervencion_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX nota_intervencion_pk ON nota_intervencion USING btree (n_id_nota);


--
-- TOC entry 1933 (class 1259 OID 16520)
-- Dependencies: 1567
-- Name: regla_dialogo_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX regla_dialogo_pk ON regla_dialogo USING btree (n_id_regla_dialogo);


--
-- TOC entry 1897 (class 1259 OID 16437)
-- Dependencies: 1559
-- Name: respuesta_a_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX respuesta_a_fk ON intervencion USING btree (n_id_respuesta);


--
-- TOC entry 1898 (class 1259 OID 16435)
-- Dependencies: 1559
-- Name: usuario_intervencion_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX usuario_intervencion_fk ON intervencion USING btree (x_id_usuario);


--
-- TOC entry 1936 (class 1259 OID 16530)
-- Dependencies: 1568
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (x_id_usuario);


--
-- TOC entry 1882 (class 1259 OID 16404)
-- Dependencies: 1556
-- Name: usuario_registra_fk; Type: INDEX; Schema: public; Owner: dialogo; Tablespace: 
--

CREATE INDEX usuario_registra_fk ON acta USING btree (x_id_usuario);


--
-- TOC entry 1943 (class 2606 OID 16532)
-- Dependencies: 1889 1558 1556
-- Name: fk_acta_dialogo_a_dialogo; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY acta
    ADD CONSTRAINT fk_acta_dialogo_a_dialogo FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1944 (class 2606 OID 16537)
-- Dependencies: 1934 1556 1568
-- Name: fk_acta_usuario_r_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY acta
    ADD CONSTRAINT fk_acta_usuario_r_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1966 (class 2606 OID 16658)
-- Dependencies: 1565 1923 1569
-- Name: fk_balance_balance_a_movida_d; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY balance
    ADD CONSTRAINT fk_balance_balance_a_movida_d FOREIGN KEY (n_id_movida_dialogo) REFERENCES movida_dialogo(n_id_movida_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1967 (class 2606 OID 16663)
-- Dependencies: 1558 1889 1569
-- Name: fk_balance_dialogo_t_dialogo; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY balance
    ADD CONSTRAINT fk_balance_dialogo_t_dialogo FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1947 (class 2606 OID 16668)
-- Dependencies: 1568 1934 1557
-- Name: fk_correcci_fk_creado_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY correccion_movida
    ADD CONSTRAINT fk_correcci_fk_creado_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1946 (class 2606 OID 16547)
-- Dependencies: 1565 1557 1923
-- Name: fk_correcci_tipo_de_m_movida_d; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY correccion_movida
    ADD CONSTRAINT fk_correcci_tipo_de_m_movida_d FOREIGN KEY (n_id_movida_dialogo) REFERENCES movida_dialogo(n_id_movida_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1945 (class 2606 OID 16542)
-- Dependencies: 1895 1557 1559
-- Name: fk_correccion_intervencion; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY correccion_movida
    ADD CONSTRAINT fk_correccion_intervencion FOREIGN KEY (n_id_intervencion) REFERENCES intervencion(n_id_intervencion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1961 (class 2606 OID 16617)
-- Dependencies: 1564 1934 1568
-- Name: fk_creador_marcador; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY marcador
    ADD CONSTRAINT fk_creador_marcador FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1963 (class 2606 OID 16627)
-- Dependencies: 1566 1934 1568
-- Name: fk_creador_nota; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY nota_intervencion
    ADD CONSTRAINT fk_creador_nota FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1948 (class 2606 OID 16552)
-- Dependencies: 1558 1568 1934
-- Name: fk_dialogo_creador_d_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY dialogo
    ADD CONSTRAINT fk_dialogo_creador_d_usuario FOREIGN KEY (x_id_usuario_facilitador) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1949 (class 2606 OID 16557)
-- Dependencies: 1558 1568 1934
-- Name: fk_dialogo_mediador__usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY dialogo
    ADD CONSTRAINT fk_dialogo_mediador__usuario FOREIGN KEY (x_id_usuario_creador) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1950 (class 2606 OID 16562)
-- Dependencies: 1558 1559 1889
-- Name: fk_interven_dialogo_p_dialogo; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT fk_interven_dialogo_p_dialogo FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1951 (class 2606 OID 16567)
-- Dependencies: 1565 1559 1923
-- Name: fk_interven_movida_co_movida_d; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT fk_interven_movida_co_movida_d FOREIGN KEY (n_id_movida) REFERENCES movida_dialogo(n_id_movida_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1952 (class 2606 OID 16572)
-- Dependencies: 1559 1565 1923
-- Name: fk_interven_movida_de_movida_d; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT fk_interven_movida_de_movida_d FOREIGN KEY (n_id_movida_original) REFERENCES movida_dialogo(n_id_movida_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1954 (class 2606 OID 16582)
-- Dependencies: 1559 1934 1568
-- Name: fk_interven_usuario_i_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT fk_interven_usuario_i_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1956 (class 2606 OID 16592)
-- Dependencies: 1561 1560 1901
-- Name: fk_maestro__categoria_maestro_; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY maestro_det_categoria
    ADD CONSTRAINT fk_maestro__categoria_maestro_ FOREIGN KEY (n_id_categoria) REFERENCES maestro_categoria(n_id_categoria) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1955 (class 2606 OID 16587)
-- Dependencies: 1934 1568 1560
-- Name: fk_maestro__creador_c_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY maestro_categoria
    ADD CONSTRAINT fk_maestro__creador_c_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1958 (class 2606 OID 16602)
-- Dependencies: 1568 1562 1934
-- Name: fk_maestro__creador_m_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY maestro_movida
    ADD CONSTRAINT fk_maestro__creador_m_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1959 (class 2606 OID 16607)
-- Dependencies: 1934 1568 1563
-- Name: fk_maestro__creador_r_usuario; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY maestro_regla
    ADD CONSTRAINT fk_maestro__creador_r_usuario FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1957 (class 2606 OID 16597)
-- Dependencies: 1562 1910 1561
-- Name: fk_maestro__detalle_t_maestro_; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY maestro_det_categoria
    ADD CONSTRAINT fk_maestro__detalle_t_maestro_ FOREIGN KEY (n_id_movida) REFERENCES maestro_movida(n_id_movida) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1960 (class 2606 OID 16612)
-- Dependencies: 1564 1559 1895
-- Name: fk_marcador_intervencion; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY marcador
    ADD CONSTRAINT fk_marcador_intervencion FOREIGN KEY (n_id_intervencion) REFERENCES intervencion(n_id_intervencion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1962 (class 2606 OID 16622)
-- Dependencies: 1565 1889 1558
-- Name: fk_movida_d_movidas_p_dialogo; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY movida_dialogo
    ADD CONSTRAINT fk_movida_d_movidas_p_dialogo FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1964 (class 2606 OID 16632)
-- Dependencies: 1895 1559 1566
-- Name: fk_nota_int_nota_de_i_interven; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY nota_intervencion
    ADD CONSTRAINT fk_nota_int_nota_de_i_interven FOREIGN KEY (n_id_intervencion) REFERENCES intervencion(n_id_intervencion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1965 (class 2606 OID 16637)
-- Dependencies: 1558 1567 1889
-- Name: fk_regla_di_dialogo_t_dialogo; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY regla_dialogo
    ADD CONSTRAINT fk_regla_di_dialogo_t_dialogo FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1953 (class 2606 OID 16577)
-- Dependencies: 1895 1559 1559
-- Name: fk_respuesta_int; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY intervencion
    ADD CONSTRAINT fk_respuesta_int FOREIGN KEY (n_id_respuesta) REFERENCES intervencion(n_id_intervencion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1968 (class 2606 OID 49448)
-- Dependencies: 1889 1576 1558
-- Name: restriccion_dialogo_fk; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY restriccion_dialogo
    ADD CONSTRAINT restriccion_dialogo_fk FOREIGN KEY (n_id_dialogo) REFERENCES dialogo(n_id_dialogo);


--
-- TOC entry 1969 (class 2606 OID 49458)
-- Dependencies: 1934 1576 1568
-- Name: restriccion_dialogo_fk1; Type: FK CONSTRAINT; Schema: public; Owner: dialogo
--

ALTER TABLE ONLY restriccion_dialogo
    ADD CONSTRAINT restriccion_dialogo_fk1 FOREIGN KEY (x_id_usuario) REFERENCES usuario(x_id_usuario);


--
-- TOC entry 1974 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2011-07-20 03:17:45

--
-- PostgreSQL database dump complete
--

