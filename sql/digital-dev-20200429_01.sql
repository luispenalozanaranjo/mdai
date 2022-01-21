-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: mdai_db
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almacen_datos`
--

DROP TABLE IF EXISTS `almacen_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen_datos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_datos`
--

LOCK TABLES `almacen_datos` WRITE;
/*!40000 ALTER TABLE `almacen_datos` DISABLE KEYS */;
INSERT INTO `almacen_datos` VALUES (1,'observaciones','Observaciones','text'),(2,'tipo_envio','Tipo de envio','text'),(3,'chilexpress','Nº comprobante Chilexpress','text'),(4,'recibido','Recibido','text'),(5,'asignado','Asignado','select'),(6,'autoriza','Autoriza','text'),(7,'visado_carpeta','Visado carpeta','text'),(8,'retiro_mdai','Retiro MDAI','text'),(9,'responsable','Nombre Responsable','text'),(10,'stock_manual','Stock Manual','text'),(11,'recepcionado','Recepcionado','text'),(12,'promesa_entregada','Promesa entregada','text'),(13,'orden_escrituracion','Orden de escrituración','text'),(14,'recepcion_escrituracion','Recepción orden escrituración','text'),(15,'carpeta_entregada','Carpeta entregada a abogado','text'),(16,'carpeta_revisada','Carpeta revisada por abogado','text'),(17,'enviado_notaria','Enviado a Notaria','text'),(18,'recepcionado_notaria','Recepcionado de Notaria','text'),(19,'instruccion_notarial','Instrucción notarial','text'),(20,'nombre_notaria','Nombre notaria','text'),(21,'envio_escritura','Envio Escritura a Notaria','text'),(22,'recepcion_escritura','Recepción Escritura Notaria','text'),(23,'firma_escritura','Firma escritura (Representante-Cliente-Banco)','text'),(24,'representante1','Representante 1','select'),(25,'representante2','Representante 2','select'),(26,'comprador','Comprador','text'),(27,'firma_revision_abogado','Firma revisión Abogado Banco Alzante','text'),(28,'firma_revision_banco','Firma revisión Banco Financiante Comprador','text'),(29,'firma_apoderado','Firma apoderado Banco Alzante','text'),(30,'copia_notaria','Solicitar copia a Notaria','text'),(31,'notificar_creacion_carpeta','Notificar creación carpeta serviu (Área Finanzas)','text'),(32,'num_caratura','Nº Caratula','text'),(33,'solicitud_carpeta','Solicitud de carpeta Serviu a Finanzas','text'),(34,'cobro_instrucciones','Cobro de instrucciones notariales','text'),(35,'entrega_escritura','Entrega escritura cliente','text'),(36,'entrega_escritura_mdai','Entrega escritura MDA','text'),(37,'notificacion_pago','Notificación de pago','text'),(38,'contactar_cliente','Contactar a cliente','text'),(39,'notificacion_constructura','Notificación a constructora','text'),(40,'entrega_acta','Entrega acta digital','text'),(41,'entrega_sin_observaciones','Entrega sin observaciones','text'),(42,'entregada_reparos','Entregada con reparos','text'),(43,'disconforme','Disconforme','text'),(44,'seleccion_nueva_unidad','Seleccion nueva unidad','text'),(45,'generar_nueva_cotizacion','Generar nueva cotizacion','text'),(46,'solicitar_pre_aprobacion_bancaria','Solicitar pre aprobacion bancaria','text'),(47,'cambio_unidad_tipo','Mayor o menor valor','text'),(48,'cliente_firma','Cliente firma documentacion','text'),(49,'envio_comprobante_email','Envio comprobante por email','text'),(50,'solicitud_informacion','Solicitud información','text'),(51,'aprobacion_bancaria','Aprobación bancaria','text'),(52,'constatacion_renuncia','Constatacion de renuncia','text'),(53,'fotocopia_carnet','Fotocopia carnet - firmada ambos lados + huella','text'),(54,'cliente_desiste','Cliente desiste / Cliente no desiste','text'),(55,'tiene_gops','Con GOPS / Sin GOPS','text'),(56,'constatacion_fisica','Constatación fisica','text'),(57,'notificacion_renuncia','1 notificación de renuncia','text'),(58,'copia_resciliacion','2 copias resciliación','text'),(59,'de_notificar_finanzas_devolucion','Notificar a finanzas (So si hay devolución','text'),(60,'devolucion_cliente','Devolucion a cliente','text'),(61,'devolucion_cliente_fecha','Fecha devolucion a cliente','text'),(62,'estado_escrituracion','Estado escrituración','text'),(63,'orden_escrituracion_banco','Orden de escrituración Banco','text'),(64,'ejecutivo_nombre','Nombre ejecutivo','text'),(65,'ejecutivo_email','Email ejecutivo','text'),(66,'ejecutivo_telefono','Teléfono ejecutivo','text'),(67,'envio_correo_cliente','Envío correo cliente','text'),(68,'entidad_1','Entidad 1','text'),(69,'entidad_1_fecha','Entidad 1 - Fecha de envío','text'),(70,'entidad_1_estado','Entidad 1 - Estado','text'),(71,'entidad_2','Entidad 2','text'),(72,'entidad_2_fecha','Entidad 2 - Fecha de envío','text'),(73,'entidad_2_estado','Entidad 2 - Estado','text'),(74,'entidad_3','Entidad 3','text'),(75,'entidad_3_fecha','Entidad 3 - Fecha de envío','text'),(76,'entidad_3_estado','Entidad 3 - Estado','text'),(77,'pis_1','pis 1','text'),(78,'pis_2','pis 2','text'),(79,'pis_3','pis 3','text'),(80,'pis_4','pis 4','text'),(81,'pis_5','pis 5','text'),(82,'tasacion','tasacion','text'),(83,'titulos','titulos','text'),(84,'notariales','notariales','text'),(85,'escrituracion','escrituracion','text'),(86,'bienes_raices','bienes_raices','text'),(87,'impuesto_credito','impuesto_credito','text'),(88,'iva','iva','text'),(89,'entidades','entidades','select'),(90,'administracion','administracion','text'),(91,'seguros','seguros','text'),(92,'gastos_varios','gastos_varios','text'),(93,'total_gastos_op','total_gastos_op','text'),(94,'diferencia_por_pagar','diferencia_por_pagar','text'),(95,'credito_enlace_0','credito_enlace_0','text'),(96,'credito_enlace_1','credito_enlace_1','text'),(97,'credito_enlace_2','credito_enlace_2','text'),(98,'credito_enlace_3','credito_enlace_3','text'),(99,'credito_enlace_4','credito_enlace_4','text'),(100,'credito_enlace_5','credito_enlace_5','text'),(101,'credito_enlace_6','credito_enlace_6','text'),(102,'credito_enlace_7','credito_enlace_7','text'),(103,'credito_enlace_8','credito_enlace_8','text'),(104,'credito_enlace_9','credito_enlace_9','text'),(105,'otros_creditos_0','otros_creditos_0','text'),(106,'otros_creditos_1','otros_creditos_1','text'),(107,'otros_creditos_2','otros_creditos_2','text'),(108,'otros_creditos_3','otros_creditos_3','text'),(109,'otros_creditos_4','otros_creditos_4','text'),(110,'otros_creditos_5','otros_creditos_5','text'),(111,'otros_creditos_6','otros_creditos_6','text'),(112,'otros_creditos_7','otros_creditos_7','text'),(113,'otros_creditos_8','otros_creditos_8','text'),(114,'otros_creditos_9','otros_creditos_9','text'),(115,'suma_total_0','suma_total_0','text'),(116,'suma_total_1','suma_total_1','text'),(117,'suma_total_2','suma_total_2','text'),(118,'suma_total_3','suma_total_3','text'),(119,'suma_total_4','suma_total_4','text'),(120,'suma_total_5','suma_total_5','text'),(121,'suma_total_6','suma_total_6','text'),(122,'suma_total_7','suma_total_7','text'),(123,'suma_total_8','suma_total_8','text'),(124,'suma_total_9','suma_total_9','text'),(125,'estado_0','estado_0','text'),(126,'estado_1','estado_1','text'),(127,'estado_2','estado_2','text'),(128,'estado_3','estado_3','text'),(129,'estado_4','estado_4','text'),(130,'estado_5','estado_5','text'),(131,'estado_6','estado_6','text'),(132,'estado_7','estado_7','text'),(133,'estado_8','estado_8','text'),(134,'estado_9','estado_9','text'),(135,'observaciones_0','observaciones_0','text'),(136,'observaciones_1','observaciones_1','text'),(137,'observaciones_2','observaciones_2','text'),(138,'observaciones_3','observaciones_3','text'),(139,'observaciones_4','observaciones_4','text'),(140,'observaciones_5','observaciones_5','text'),(141,'observaciones_6','observaciones_6','text'),(142,'observaciones_7','observaciones_7','text'),(143,'observaciones_8','observaciones_8','text'),(144,'observaciones_9','observaciones_9','text'),(145,'diferencia_por_pagar','diferencia_por_pagar','text'),(146,'diferencia_favor_mda','diferencia_favor_mda','text'),(147,'privado_monto_pagado','privado_monto_pagado','text'),(148,'monto_pagado_entidad','monto_pagado_entidad','text'),(149,'monto_pagado_financiadora_comprador','monto_pagado_financiadora_comprador','text');
/*!40000 ALTER TABLE `almacen_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Legal'),(2,'Operaciones'),(3,'Finanzas'),(4,'Asistente Social'),(5,'Tecnologia'),(6,'Comercial');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora_contacto`
--

DROP TABLE IF EXISTS `bitacora_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora_contacto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fec_recepcion_doc` date DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `accion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `opp` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bitacora_contacto_opp_foreign` (`opp`),
  CONSTRAINT `bitacora_contacto_opp_foreign` FOREIGN KEY (`opp`) REFERENCES `data` (`opp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora_contacto`
--

LOCK TABLES `bitacora_contacto` WRITE;
/*!40000 ALTER TABLE `bitacora_contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Abogado'),(2,'Analista Control de Gestión'),(3,'Analista Finanzas'),(4,'Analista Riesgo'),(5,'Asistente Social'),(6,'Community Manager'),(7,'Ejecutivo Procesos'),(8,'Ejecutivo TI'),(9,'Ejecutivo Ventas'),(10,'Gerente Comercial'),(11,'Gerente Finanzas'),(12,'Jefe Comercial'),(13,'Jefe Control de Gestión'),(14,'Jefe de Canales'),(15,'Jefe Procesos y Operaciones'),(16,'Subgerente Comercial'),(17,'Subgerente Finanzas'),(18,'Supervisor de Riesgo'),(19,'Test');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data` (
  `opp` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_proyecto` bigint(20) unsigned NOT NULL,
  `id_etapa` bigint(20) unsigned NOT NULL,
  `ejecutivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_opp` datetime NOT NULL,
  `lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serviu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio_lista_opp` int(11) NOT NULL,
  `precio_final_opp` double(8,2) NOT NULL,
  `descuento_unidad` double(8,2) NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rut_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `primer_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `segundo_nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comuna_cliente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `canal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unidad_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_unidad_principal` double(8,2) DEFAULT NULL,
  `descuento_unidad_principal` double(8,2) DEFAULT NULL,
  `estacionamiento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_estacionamiento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descuento_estacionamiento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bodega` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_bodega` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descuento_bodega` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_riesgo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_riesgo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preaprobacion_riesgo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_cotizacion` date NOT NULL,
  `fecha_reserva` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `fecha_promesa` date NOT NULL,
  `pie` double(8,2) NOT NULL,
  `cuotas_pie` int(11) NOT NULL,
  `pie_cuota_1` double(8,2) NOT NULL,
  `pie_cuota_2` double(8,2) NOT NULL,
  `pie_restante` double(8,2) NOT NULL,
  `pago_contra_promesa` double(8,2) NOT NULL,
  `promesa_pagada` int(11) DEFAULT NULL,
  `pie_pagado` int(11) DEFAULT NULL,
  `gops_pagados` int(11) DEFAULT NULL,
  `cupon_gops` int(11) DEFAULT NULL,
  `escritura` double(8,2) NOT NULL,
  `escritura_pagada` int(11) DEFAULT NULL,
  `chip` double(8,2) DEFAULT NULL,
  `ahorro` double(8,2) DEFAULT NULL,
  `subsidio` int(11) DEFAULT NULL,
  `bono_captación` double(8,2) DEFAULT NULL,
  `bono_integración` double(8,2) DEFAULT NULL,
  `reserva` int(11) DEFAULT NULL,
  `gops` int(11) DEFAULT NULL,
  `num_cuotas_gops` int(11) DEFAULT NULL,
  `gops_cuota_1` double(8,2) DEFAULT NULL,
  `gops_cuota_2` double(8,2) DEFAULT NULL,
  `gop_restante` int(11) DEFAULT NULL,
  `vencimiento_subsidio` date DEFAULT NULL,
  `serie_subsidio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_subsidio` bigint(20) DEFAULT NULL,
  `llamado_subsidio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anio_subsidio` int(11) DEFAULT NULL,
  `banco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupon_unidad_principal` int(11) NOT NULL,
  `cupon_estacionamiento` int(11) NOT NULL,
  `cupon_bodega` int(11) NOT NULL,
  `cupon_ahorro_previo` int(11) NOT NULL,
  `cupon_pago_contra_escritura` double(8,2) NOT NULL,
  `cupon_giftcard` int(11) NOT NULL,
  `rut_conyuge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_conyuge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rent_conyuge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rut_aval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_aval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `renta_aval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rut_codeudor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_codeudor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `renta_codeudor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_credito` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cambio_unidad_tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_desiste` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pis_1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pis_2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pis_3` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pis_4` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pis_5` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`opp`),
  KEY `data_id_proyecto_foreign` (`id_proyecto`),
  KEY `data_id_etapa_foreign` (`id_etapa`),
  CONSTRAINT `data_id_etapa_foreign` FOREIGN KEY (`id_etapa`) REFERENCES `etapas` (`id`),
  CONSTRAINT `data_id_proyecto_foreign` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data`
--

LOCK TABLES `data` WRITE;
/*!40000 ALTER TABLE `data` DISABLE KEYS */;
/*!40000 ALTER TABLE `data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos`
--

DROP TABLE IF EXISTS `datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `id_nd` bigint(20) unsigned NOT NULL,
  `id_datos` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datos_id_nd_foreign` (`id_nd`),
  KEY `datos_id_datos_foreign` (`id_datos`),
  CONSTRAINT `datos_id_datos_foreign` FOREIGN KEY (`id_datos`) REFERENCES `almacen_datos` (`id`),
  CONSTRAINT `datos_id_nd_foreign` FOREIGN KEY (`id_nd`) REFERENCES `nodos_detalle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos`
--

LOCK TABLES `datos` WRITE;
/*!40000 ALTER TABLE `datos` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos_subidos`
--

DROP TABLE IF EXISTS `documentos_subidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos_subidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_archivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_dw` bigint(20) unsigned NOT NULL,
  `id_nd` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentos_subidos_id_dw_foreign` (`id_dw`),
  KEY `documentos_subidos_id_nd_foreign` (`id_nd`),
  CONSTRAINT `documentos_subidos_id_dw_foreign` FOREIGN KEY (`id_dw`) REFERENCES `workflow_detalle` (`id`),
  CONSTRAINT `documentos_subidos_id_nd_foreign` FOREIGN KEY (`id_nd`) REFERENCES `nodos_detalle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos_subidos`
--

LOCK TABLES `documentos_subidos` WRITE;
/*!40000 ALTER TABLE `documentos_subidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos_subidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entidades_financieras`
--

DROP TABLE IF EXISTS `entidades_financieras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidades_financieras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidades_financieras`
--

LOCK TABLES `entidades_financieras` WRITE;
/*!40000 ALTER TABLE `entidades_financieras` DISABLE KEYS */;
INSERT INTO `entidades_financieras` VALUES (1,'Banco De Chile','Banco',1,NULL,NULL,NULL),(2,'Banco Internacional','Banco',1,NULL,NULL,NULL),(3,'Scotiabank Chile','Banco',1,NULL,NULL,NULL),(4,'Banco De Creditos E Inversiones','Banco',1,NULL,NULL,NULL),(5,'Banco BICE','Banco',1,NULL,NULL,NULL),(6,'HSBC Bank (Chile)','Banco',1,NULL,NULL,NULL),(7,'Banco Santander-Chile','Banco',1,NULL,NULL,NULL),(8,'Itaú Corpbanca','Banco',1,NULL,NULL,NULL),(9,'Banco Security','Banco',1,NULL,NULL,NULL),(10,'Banco Falabella','Banco',1,NULL,NULL,NULL),(11,'Banco Ripley','Banco',1,NULL,NULL,NULL),(12,'Banco Consorcio','Banco',1,NULL,NULL,NULL),(13,'Scotiabank Azul (ex BBVA)','Banco',1,NULL,NULL,NULL),(14,'Banco BTG Pactual Chile','Banco',1,NULL,NULL,NULL),(15,'Banco Estado','Banco',1,NULL,NULL,NULL),(16,'Coopeuch','Otro',1,NULL,NULL,NULL),(17,'Caja Los Andes','Otro',1,NULL,NULL,NULL),(18,'JAVE (jefatura De Ahorro Para La Vivienda Del Ejército)','Otro',1,NULL,NULL,NULL),(19,'Mutuario Concreces','Otro',1,NULL,NULL,NULL),(20,'Mutuaria Hipotecaria','Otro',1,NULL,NULL,NULL),(21,'Mutuaria Casanuestra','Otro',1,NULL,NULL,NULL),(22,'Mutuaria MYV','Otro',1,NULL,NULL,NULL),(23,'Unidad Leasing Habitacional','Otro',1,NULL,NULL,NULL),(24,'Mutuaria Hipotecaria','Otro',1,NULL,NULL,NULL),(25,'Notaria Myriam Amigo','Notaria',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `entidades_financieras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'Aprobado'),(2,'Rechazado'),(3,'Pendiente'),(4,'En Proceso'),(5,'Cerrada'),(6,'Listo'),(7,'Desistida'),(8,'Promesada'),(9,'Caducada'),(10,'Cotización'),(11,'Anulada'),(12,'Pre-Reservada'),(13,'Terminada');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapas`
--

DROP TABLE IF EXISTS `etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_recepcion` date DEFAULT NULL,
  `total_unidades` int(11) DEFAULT NULL,
  `total_vulnerables` int(11) DEFAULT NULL,
  `escrituracion_notificacion` int(11) DEFAULT NULL,
  `id_proyecto` bigint(20) unsigned NOT NULL,
  `id_usuario` bigint(20) unsigned DEFAULT NULL,
  `id_region` bigint(20) unsigned DEFAULT NULL,
  `pis_v_1` int(11) DEFAULT NULL,
  `pis_t_1` int(11) DEFAULT NULL,
  `pis_v_2` int(11) DEFAULT NULL,
  `pis_t_2` int(11) DEFAULT NULL,
  `pis_v_3` int(11) DEFAULT NULL,
  `pis_t_3` int(11) DEFAULT NULL,
  `pis_v_4` int(11) DEFAULT NULL,
  `pis_t_4` int(11) DEFAULT NULL,
  `pis_v_5` int(11) DEFAULT NULL,
  `pis_t_5` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etapas_id_proyecto_foreign` (`id_proyecto`),
  KEY `etapas_id_usuario_foreign` (`id_usuario`),
  KEY `etapas_id_region_foreign` (`id_region`),
  CONSTRAINT `etapas_id_proyecto_foreign` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`),
  CONSTRAINT `etapas_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regiones` (`id`),
  CONSTRAINT `etapas_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapas`
--

LOCK TABLES `etapas` WRITE;
/*!40000 ALTER TABLE `etapas` DISABLE KEYS */;
/*!40000 ALTER TABLE `etapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `excepciones`
--

DROP TABLE IF EXISTS `excepciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excepciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_nd` bigint(20) unsigned NOT NULL,
  `id_pregunta` bigint(20) unsigned NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_estado` bigint(20) unsigned NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `excepciones_id_nd_foreign` (`id_nd`),
  KEY `excepciones_id_pregunta_foreign` (`id_pregunta`),
  KEY `excepciones_id_usuario_foreign` (`id_usuario`),
  KEY `excepciones_id_estado_foreign` (`id_estado`),
  CONSTRAINT `excepciones_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  CONSTRAINT `excepciones_id_nd_foreign` FOREIGN KEY (`id_nd`) REFERENCES `nodos_detalle` (`id`),
  CONSTRAINT `excepciones_id_pregunta_foreign` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id`),
  CONSTRAINT `excepciones_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excepciones`
--

LOCK TABLES `excepciones` WRITE;
/*!40000 ALTER TABLE `excepciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `excepciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `excepciones_datos`
--

DROP TABLE IF EXISTS `excepciones_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excepciones_datos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `id_ed` bigint(20) unsigned NOT NULL,
  `id_datos` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `excepciones_datos_id_ed_foreign` (`id_ed`),
  KEY `excepciones_datos_id_datos_foreign` (`id_datos`),
  CONSTRAINT `excepciones_datos_id_datos_foreign` FOREIGN KEY (`id_datos`) REFERENCES `almacen_datos` (`id`),
  CONSTRAINT `excepciones_datos_id_ed_foreign` FOREIGN KEY (`id_ed`) REFERENCES `excepciones_detalle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excepciones_datos`
--

LOCK TABLES `excepciones_datos` WRITE;
/*!40000 ALTER TABLE `excepciones_datos` DISABLE KEYS */;
/*!40000 ALTER TABLE `excepciones_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `excepciones_detalle`
--

DROP TABLE IF EXISTS `excepciones_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excepciones_detalle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_nodo` bigint(20) unsigned NOT NULL,
  `id_excepcion` bigint(20) unsigned NOT NULL,
  `id_estado` bigint(20) unsigned NOT NULL,
  `user_termina` bigint(20) unsigned DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `excepciones_detalle_id_nodo_foreign` (`id_nodo`),
  KEY `excepciones_detalle_id_excepcion_foreign` (`id_excepcion`),
  KEY `excepciones_detalle_id_estado_foreign` (`id_estado`),
  KEY `excepciones_detalle_user_termina_foreign` (`user_termina`),
  CONSTRAINT `excepciones_detalle_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  CONSTRAINT `excepciones_detalle_id_excepcion_foreign` FOREIGN KEY (`id_excepcion`) REFERENCES `excepciones` (`id`),
  CONSTRAINT `excepciones_detalle_id_nodo_foreign` FOREIGN KEY (`id_nodo`) REFERENCES `nodos` (`id`),
  CONSTRAINT `excepciones_detalle_user_termina_foreign` FOREIGN KEY (`user_termina`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excepciones_detalle`
--

LOCK TABLES `excepciones_detalle` WRITE;
/*!40000 ALTER TABLE `excepciones_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `excepciones_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formularios`
--

DROP TABLE IF EXISTS `formularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formularios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etapa` int(11) NOT NULL,
  `num_nodo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formularios`
--

LOCK TABLES `formularios` WRITE;
/*!40000 ALTER TABLE `formularios` DISABLE KEYS */;
INSERT INTO `formularios` VALUES (1,'Vulnerable',1,230),(2,'Medio',1,240),(3,'Privado',1,250),(4,'Privado Supervisor',1,251),(5,'Vulnerable V1',2,340),(6,'Medio V1',2,350),(7,'Medio V1 Finanzas',2,370),(8,'Privado V1',2,360),(9,'Privado V1 Finanzas',2,370),(10,'Vulnerable - Medio contado V2',2,410),(11,'Medio Serviu+ Chip V2',2,420),(12,'Chip Privado V2',2,430),(13,'Check Carpeta V2 Riesgo',2,0),(14,'Check V2 Finanzas Vulnerable Medio Contado',2,460),(15,'Check V2 Finanzas Medio Gestión Propia Gestión MDAI',2,460),(16,'Check V2 Finanzas Privado Contado Gestión Propia Gestión MDAI',2,460),(17,'Check Confeccion carpeta vulnerable medio contado privado',4,500),(18,'Check Nominación y adjudicación medio vulnerable privado',4,510);
/*!40000 ALTER TABLE `formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_01_02_010151_usuarios',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2015_01_24_080208_create_permissions_table',1),(5,'2017_10_17_170735_create_permission_user_table',1),(6,'2019_08_19_000000_create_failed_jobs_table',1),(7,'2019_12_21_194626_tabla_vivesoft',1),(8,'2020_01_02_005928_bitacora_contactos',1),(9,'2020_01_02_005941_nodos',1),(10,'2020_01_02_010000_datos',1),(11,'2020_01_02_010009_nodos_detalle',1),(12,'2020_01_02_010020_documentos_subidos',1),(13,'2020_01_02_010032_entidades_financieras',1),(14,'2020_01_02_010043_estados',1),(15,'2020_01_02_010101_formularios',1),(16,'2020_01_02_010116_preguntas',1),(17,'2020_01_02_010129_respuestas',1),(18,'2020_01_02_010140_notificaciones',1),(19,'2020_01_02_010201_workflow',1),(20,'2020_01_02_010212_almacen_datos',1),(21,'2020_01_02_010223_workflow_detalle',1),(22,'2020_01_12_164151_cargos',1),(23,'2020_01_12_164250_areas',1),(24,'2020_01_22_233404_proyectos',1),(25,'2020_01_22_234021_regiones',1),(26,'2020_02_01_000045_etapas',1),(27,'2020_03_09_223750_create_proyecto_usuario_table',1),(28,'2020_03_27_122250_nodo_column_exclude',1),(29,'2020_03_29_002709_create_workflow_etapas',1),(30,'2020_03_29_002914_relation_nodo_workflow_etapas',1),(31,'2020_03_29_200011_modify_nodos_detalles',1),(32,'2020_03_29_203543_modify_documentos_subidos',1),(33,'2020_04_13_005408_create_excepciones',1),(34,'2020_04_18_194414_create_excepcion_detalle',1),(35,'2020_04_19_214925_create_excepcion_datos',1),(36,'2021_01_02_012804_relations',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodos`
--

DROP TABLE IF EXISTS `nodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_nodo` int(10) unsigned NOT NULL,
  `nombre_nodo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `actividad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `subactividad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `num_nodo_salida` int(11) NOT NULL,
  `etapa` bigint(20) unsigned NOT NULL,
  `exclude` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nodos_num_nodo_unique` (`num_nodo`),
  KEY `nodos_etapa_foreign` (`etapa`),
  CONSTRAINT `nodos_etapa_foreign` FOREIGN KEY (`etapa`) REFERENCES `workflow_etapas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodos`
--

LOCK TABLES `nodos` WRITE;
/*!40000 ALTER TABLE `nodos` DISABLE KEYS */;
INSERT INTO `nodos` VALUES (1,50,'n50','Subir documento','Subir documento',0,8,0),(2,99,'n99','Promesado','Inicio',200,1,1),(3,200,'n200','Envío documentación oficina central','Envío documentación',210,1,0),(4,210,'n210','Recepcion documentación oficina central','Recepción documentación',211,1,0),(5,211,'n211','Recepción documentación oficina central','Asignación de Revisor',220,1,0),(6,220,'n220','Revisión Checklist','Checklist',0,1,0),(7,230,'n230','Revisión Checklist Vulnerable','Checklist Vulnerable',260,1,0),(8,240,'n240','Revisión Checklist Medio','Checklist Medio',260,1,0),(9,250,'n250','Revisión Checklist Privado','Checklist Privado',251,1,0),(10,251,'n251','Revisión Checklist Privado','Poliza Seguro',261,1,0),(11,260,'n260','Visado','Visado Carpeta',270,1,0),(12,261,'n261','Visado','Visado Carpeta',271,1,0),(13,270,'n270','Firma Gerencia','Firma Representante',280,1,0),(14,271,'n271','Firma Gerencia','Firma Representante',281,1,0),(15,280,'n280','Digitaliza Carpeta','Digitaliza Carpeta (V / M)',300,1,0),(16,281,'n281','Digitaliza Carpeta','Digitaliza Carpeta ( P ) ',290,1,0),(17,290,'n290','Revisión Carpeta Notaria','Revisión de Abogado',291,1,0),(18,291,'n291','Revisión Carpeta Notaria','Revisión de Notaria',301,1,0),(19,300,'n300','Digitaliza Promesa','Digitaliza Promesa',310,1,0),(20,301,'n301','Digitaliza Promesa','Digitaliza Promesa y Poliza',321,1,0),(21,310,'n310','Envío Oficina Venta','Envío Promesa',320,1,0),(22,320,'n320','Recepción Oficina Venta','Recepción documentos',330,1,0),(23,321,'n321','Recepción Oficina Venta','Enviado a Cliente',330,1,0),(24,330,'n330','Vigenteo 1 Revisión Checklist','Checklist V1',0,2,0),(25,340,'n340','Revisión Checklist Vulnerable','Checklist Vulnerable V1',381,2,0),(26,350,'n350','Revisión Checklist Medio','Checklist Medio V1',370,2,0),(27,360,'n360','Revisión Checklist Privado','Checklist Privado V1',370,2,0),(28,370,'n370','Revisión Finanzas','Checklist Finanzas ( M / P )',380,2,0),(29,380,'n380','Digitalizar Carpeta','Digitalizar Carpeta',390,2,0),(30,381,'n380','Digitalizar Carpeta','Digitalizar Carpeta',410,2,0),(31,390,'n390','Vigenteo 2','Tipo de crédito',400,2,0),(32,400,'n400','Vigenteo 2 Revisión Checklist','Checklist',0,2,0),(33,410,'n410','Revisión Contado','Checklist V2',460,2,0),(34,420,'n420','Revisión Gestión MDAI','Checklist Medio V2 MDAI',440,2,0),(35,430,'n430','Revisión Gestión MDAI','Checklist Privado V2 MDAI',440,2,0),(36,440,'n440','Revisión Riesgo','Revisión Riesgo',460,2,0),(37,450,'n450','Solicitud Información Banco','Solicitud Información Banco',460,2,0),(38,460,'n460','Revisión Finanzas','Checklist Finanzas',470,2,0),(39,470,'n470','Digitalizar Carpeta','Digitalizar Carpeta',500,2,0),(40,500,'n500','Escrituración','Confección de carpeta',510,4,0),(41,510,'n510','Escrituración','Nominación y Adjudicación',511,4,0),(42,511,'n511','Escrituración','Estado escrituración',512,4,0),(43,512,'n512','Escrituración','Orden de escrituración',0,4,0),(44,520,'n520','Escrituración','Orden de escrituración V/M/P Contado',530,4,0),(45,521,'n521','Escrituración','Orden de escrituración Banco',540,4,0),(46,530,'n530','Escrituración','Borrador Escritura',540,4,0),(47,540,'n540','Escrituración','Notificación Cliente Notaria',550,4,0),(48,550,'n550','Escrituración','Comprobación de Firma',560,4,0),(49,560,'n560','Escrituración','Cierre de copias',570,4,0),(50,570,'n570','Escrituración','Ingreso Conservador Bienes Raíces',571,4,0),(51,571,'n571','Escrituración','Egreso Conservador Bienes Raíces',0,4,0),(52,580,'n580','Escrituración','Egreso CBR VMP Contado',1000,4,0),(53,581,'n581','Escrituración','Egreso CBR MP CHIP',1000,4,0),(54,590,'n590','Escrituración','Entrega de Unidad',1000,4,0),(55,600,'n600','Finanzas','Liquidación de gastos',610,4,0),(56,610,'n610','Finanzas','Pago operación',0,4,0),(57,115,'n115','Cambio Unidad','Solicitud cambio de unidad',116,5,0),(58,116,'n116','Cambio Unidad','Aprobación comercial',128,5,0),(59,117,'n117','Cambio Unidad','Análisis de riesgo',129,5,0),(60,118,'n118','Cambio Unidad','Rechazo cambio de unidad',999,5,0),(61,119,'n119','Cambio Unidad','Generación nueva poliza',120,5,0),(62,120,'n120','Cambio Unidad','Generación de modificación unidad',121,5,0),(63,121,'n121','Cambio Unidad','Firma de cliente',122,5,0),(64,122,'n122','Cambio Unidad','Envío copia oficina central',123,5,0),(65,123,'n123','Cambio Unidad','Recepción documentos oficina central',124,5,0),(66,124,'n124','Cambio Unidad','Firma gerencia',125,5,0),(67,125,'n125','Cambio Unidad','Modifica Stock',126,5,0),(68,126,'n126','Cambio Unidad','Envió copia a SDV',127,5,0),(69,127,'n127','Cambio Unidad','Entrega documentacion a cliente',999,5,0),(70,128,'n128','Cambio Unidad','Análisis / Generar',0,5,0),(71,129,'n129','Cambio Unidad','Informar / Generar',0,5,0),(72,101,'n101','Autorización check','Check autorización',102,6,0),(73,102,'n102','Autorización excepción','Solicitud documentación cliente',103,6,0),(74,103,'n103','Autorización excepción','Envío oficina central',104,6,0),(75,104,'n104','Autorización excepción','Recepción documentación',0,6,0),(76,150,'n150','Desistimiento','Solicitud desistimiento cliente 1',166,7,0),(77,166,'n166','Desistimiento','Solicitud desistimiento cliente 2',151,7,0),(78,151,'n151','Desistimiento','Contactar al cliente',169,7,0),(79,152,'n152','Desistimiento','Aprobación desistimiento',170,7,0),(80,153,'n153','Desistimiento','Resciliación y notificación renuncia',154,7,0),(81,154,'n154','Desistimiento','Ratificación de Finanzas',155,7,0),(82,155,'n155','Desistimiento','Notificación de renuncia y devolución GOPS',156,7,0),(83,156,'n156','Desistimiento','Envío documento Sala de Venta',157,7,0),(84,157,'n157','Desistimiento','Cliente Firma',158,7,0),(85,158,'n158','Desistimiento','Envío copias a oficina central 1',167,7,0),(86,167,'n167','Desistimiento','Envío copias a oficina central 2',159,7,0),(87,159,'n159','Desistimiento','Recepción de documentación',160,7,0),(88,160,'n160','Desistimiento','Firma Gerencia',161,7,0),(89,161,'n161','Desistimiento','Notificación de renuncia y devolución',168,7,0),(90,168,'n168','Desistimiento','Notificación de renuncia y devolución 2',162,7,0),(91,162,'n162','Desistimiento','Revisión de Carpeta',163,7,0),(92,163,'n163','Desistimiento','Devolución documentos',164,7,0),(93,164,'n164','Desistimiento','Envío Documentación cliente',165,7,0),(94,165,'n165','Desistimiento','Entrega documentacion cliente',999,7,0),(95,169,'n169','Desiste /Fin de proceso','Fin de proceso',0,7,1),(96,170,'n170','Ratificacion / Resciliacion','Fin de proceso',0,7,1),(97,950,'n950','Finanzas','Liquidación Gastos Operacionales',0,8,0),(98,960,'n960','Finanzas','Pago Operación',0,8,0),(99,999,'n999','Fin de proceso','Fin de proceso',0,8,1),(100,1000,'n1000','Terminado','Terminado',0,4,1),(101,2000,'n2000','Mantenedores','',0,8,0),(102,2001,'n2001','Cargar planilla','',0,8,0),(103,2002,'n2002','Mantenedor usuarios','',0,8,0),(104,2003,'n2003','Mantenedor Entidades Financieras','',0,8,0),(105,2004,'n2004','Mantenedor clientes','',0,8,0),(106,2005,'n2005','Configurar PIS','',0,8,0);
/*!40000 ALTER TABLE `nodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodos_detalle`
--

DROP TABLE IF EXISTS `nodos_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodos_detalle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_dw` bigint(20) unsigned NOT NULL,
  `id_nodo` bigint(20) unsigned NOT NULL,
  `user_termina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nodos_detalle_id_dw_foreign` (`id_dw`),
  KEY `nodos_detalle_id_nodo_foreign` (`id_nodo`),
  CONSTRAINT `nodos_detalle_id_dw_foreign` FOREIGN KEY (`id_dw`) REFERENCES `workflow_detalle` (`id`),
  CONSTRAINT `nodos_detalle_id_nodo_foreign` FOREIGN KEY (`id_nodo`) REFERENCES `nodos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodos_detalle`
--

LOCK TABLES `nodos_detalle` WRITE;
/*!40000 ALTER TABLE `nodos_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodos_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_lectura` datetime DEFAULT NULL,
  `titulo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `id_dw` bigint(20) unsigned NOT NULL,
  `id_nodo` bigint(20) unsigned DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notificaciones_id_dw_foreign` (`id_dw`),
  KEY `notificaciones_id_nodo_foreign` (`id_nodo`),
  CONSTRAINT `notificaciones_id_dw_foreign` FOREIGN KEY (`id_dw`) REFERENCES `workflow_detalle` (`id`),
  CONSTRAINT `notificaciones_id_nodo_foreign` FOREIGN KEY (`id_nodo`) REFERENCES `nodos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_nodo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permisos_num_nodo_unique` (`num_nodo`),
  CONSTRAINT `permisos_num_nodo_foreign` FOREIGN KEY (`num_nodo`) REFERENCES `nodos` (`num_nodo`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,50),(2,99),(72,101),(73,102),(74,103),(75,104),(57,115),(58,116),(59,117),(60,118),(61,119),(62,120),(63,121),(64,122),(65,123),(66,124),(67,125),(68,126),(69,127),(70,128),(71,129),(76,150),(78,151),(79,152),(80,153),(81,154),(82,155),(83,156),(84,157),(85,158),(87,159),(88,160),(89,161),(91,162),(92,163),(93,164),(94,165),(77,166),(86,167),(90,168),(95,169),(96,170),(3,200),(4,210),(5,211),(6,220),(7,230),(8,240),(9,250),(10,251),(11,260),(12,261),(13,270),(14,271),(15,280),(16,281),(17,290),(18,291),(19,300),(20,301),(21,310),(22,320),(23,321),(24,330),(25,340),(26,350),(27,360),(28,370),(29,380),(30,381),(31,390),(32,400),(33,410),(34,420),(35,430),(36,440),(37,450),(38,460),(39,470),(40,500),(41,510),(42,511),(43,512),(44,520),(45,521),(46,530),(47,540),(48,550),(49,560),(50,570),(51,571),(52,580),(53,581),(54,590),(55,600),(56,610),(97,950),(98,960),(99,999),(100,1000),(101,2000),(102,2001),(103,2002),(104,2003),(105,2004),(106,2005);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos_usuarios`
--

DROP TABLE IF EXISTS `permisos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos_usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_permiso` bigint(20) unsigned NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permisos_usuarios_id_permiso_index` (`id_permiso`),
  KEY `permisos_usuarios_id_usuario_index` (`id_usuario`),
  CONSTRAINT `permisos_usuarios_id_permiso_foreign` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permisos_usuarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos_usuarios`
--

LOCK TABLES `permisos_usuarios` WRITE;
/*!40000 ALTER TABLE `permisos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_pregunta` int(11) NOT NULL,
  `marca_campo` text COLLATE utf8_unicode_ci,
  `configuracion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encabezado_pregunta` text COLLATE utf8_unicode_ci NOT NULL,
  `requerido` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_form` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `preguntas_id_form_foreign` (`id_form`),
  CONSTRAINT `preguntas_id_form_foreign` FOREIGN KEY (`id_form`) REFERENCES `formularios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas`
--

LOCK TABLES `preguntas` WRITE;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` VALUES (1,1,NULL,NULL,NULL,'Fotocopia de Cédula de Identidad VIGENTE por ambos lados (firma y huella)',1,NULL,1),(2,2,NULL,NULL,NULL,'Acreditar Estado Civil (Certificado correspondiente, costo cero)',1,NULL,1),(3,3,NULL,NULL,NULL,'Cotización de unidad con firma de vendedor',1,NULL,1),(4,4,NULL,NULL,NULL,'Reserva (Firma)',1,NULL,1),(5,5,NULL,NULL,NULL,'Promesa de Compra-Venta (Firma y Huella)',1,NULL,1),(6,6,NULL,NULL,NULL,'Subsidio original firmado (DS1TITI o DS49) o Certificado de Reserva/Postulación emitido por Rukan o Comprobante Ingreso RSH',1,NULL,1),(7,7,NULL,NULL,NULL,'Cuenta de ahorro original para la vivienda.',1,NULL,1),(8,8,NULL,NULL,NULL,'Declaración Jurada de Postulación',1,NULL,1),(9,9,NULL,NULL,NULL,'Declaración Jurada de Nucleo Familiar',1,NULL,1),(10,10,NULL,NULL,NULL,'Certificado de Reserva o Postulación emitido por Rukan con firma del cliente o VB con Comprobante de Ingreso de Ingreso de RSH',1,NULL,1),(11,11,NULL,NULL,NULL,'Ficha de Ingreso con VB Gestor Social',1,NULL,1),(12,12,NULL,NULL,NULL,'Carta Compromiso reuniones PIS',1,NULL,1),(13,13,NULL,NULL,NULL,'Certificado de discapacidad (si correspondiese)',0,NULL,1),(14,14,'subsidio','salida',NULL,'Validar Montos de Financiamiento - Subsidio',1,NULL,1),(15,15,'ahorro','salida',NULL,'Validar Montos de Financiamiento - Ahorro',1,NULL,1),(16,16,'bono_captación','salida',NULL,'Validar Montos de Financiamiento - Bono Captación',1,NULL,1),(17,17,'bono_integración','salida',NULL,'Validar Montos de Financiamiento - Bono Integración',1,NULL,1),(18,18,'escritura','salida',NULL,'Validar Montos de Financiamiento - Pago contra Escritura',1,NULL,1),(19,19,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento - Valor Venta Final',1,NULL,1),(20,20,NULL,NULL,NULL,'Certificado de Indígena (si correspondiese emitido por la CONADI)',0,NULL,1),(21,1,NULL,NULL,NULL,'Fotocopia de Cédula de Identidad VIGENTE por ambos lados (firma y huella)',1,NULL,2),(22,2,NULL,NULL,NULL,'Acreditar Estado Civil (Certificado correspondiente, costo cero)',1,NULL,2),(23,3,NULL,NULL,NULL,'Dependiente: contrato de trabajo mínimo 1 año y certificado AFP 12 últimos meses con rut de empleador. // Independiente: Certificado de Inicio de Actividades y dos últimas DAI',1,NULL,2),(24,4,NULL,NULL,NULL,'Dependiente: últimas 3 (renta fija) o 6 (renta variable) liquidaciones de sueldo. // Independiente: últimos 6 meses de boletas de honorarios o 12 últimos PPM (F29)',1,NULL,2),(25,5,NULL,NULL,NULL,'Pre-Aprobación Bancaria (con fecha máxima de 15 días de emisión). Acreditación de recursos para pago de unidad.',1,NULL,2),(26,6,NULL,NULL,NULL,'Cotización de unidad con firma de vendedor',1,NULL,2),(27,7,NULL,NULL,NULL,'Reserva (Firma)',1,NULL,2),(28,8,NULL,NULL,NULL,'Promesa de Compra-Venta (Firma y Huella)',1,NULL,2),(29,9,'subsidio','salida',NULL,'Validar Montos de Financiamiento - Subsidio',1,NULL,2),(30,10,'ahorro','salida',NULL,'Validar Montos de Financiamiento - Ahorro',1,NULL,2),(31,11,'bono_captación','salida',NULL,'Validar Montos de Financiamiento - Bono Captación',1,NULL,2),(32,12,'bono_integración','salida',NULL,'Validar Montos de Financiamiento - Bono Integración',1,NULL,2),(33,13,'escritura','salida',NULL,'Validar Montos de Financiamiento - Pago contra Escritura',1,NULL,2),(34,14,'chip','salida',NULL,'Validar Montos de Financiamiento - Crédito hipotecario',1,NULL,2),(35,15,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento - Valor Venta Final',1,NULL,2),(36,16,'SUMA=cupon_unidad_principal,cupon_estacionamiento,cupon_bodega,cupon_ahorro_previo,cupon_pago_contra_escritura','salida',NULL,'Cupón de descuento UF (Si Aplica)',1,NULL,2),(37,17,NULL,NULL,NULL,'Subsidio original firmado (DS1TITII y TII)',1,NULL,2),(38,18,NULL,NULL,NULL,'Cuenta de ahorro original para la vivienda',1,NULL,2),(39,19,NULL,NULL,NULL,'Declaración Jurada de Postulación',1,NULL,2),(40,20,NULL,NULL,NULL,'Declaración Jurada de Nucleo Familiar',1,NULL,2),(41,21,NULL,NULL,NULL,'Certificado de Reserva o Postulación emitido por Rukan con firma del cliente o VB con Comprobante de Ingreso de Ingreso de RSH',1,NULL,2),(42,22,NULL,NULL,NULL,'Ficha de Ingreso con VB Area Comercial',1,NULL,2),(43,23,NULL,NULL,NULL,'Carta Compromiso reuniones PIS',1,NULL,2),(44,24,NULL,NULL,NULL,'Compromiso de Pago Provisión de Gastos',1,NULL,2),(45,25,NULL,NULL,NULL,'Certificado de discapacidad (si correspondiese).',0,NULL,2),(46,26,NULL,NULL,NULL,'Comprobantes de pagos de reserva o pie (parcial o total)',1,NULL,2),(47,27,NULL,NULL,NULL,'Certificado de Indígena (si correspondiese emitido por la CONADI).',0,NULL,2),(48,28,NULL,'entrada','date','Fecha de Aprobación Vivet:',1,NULL,2),(49,29,NULL,'entrada','text','Resolución:',1,NULL,2),(50,1,NULL,NULL,NULL,'Fotocopia de Cédula de Identidad VIGENTE por ambos lados (firma y huella)',1,NULL,3),(51,2,NULL,NULL,NULL,'Acreditar Estado Civil (Certificado correspondiente, costo cero)',1,NULL,3),(52,3,NULL,NULL,NULL,'Dependiente: contrato de trabajo mínimo 1 año y certificado AFP 12 últimos meses con rut de empleador // Independiente: Certificado de Inicio de Actividades y dos últimas DAI',1,NULL,3),(53,4,NULL,NULL,NULL,'Dependiente: últimas 3 (renta fija) o 6 (renta variable) liquidaciones de sueldo. // Independiente: últimos 6 meses de boletas de honorarios o 12 últimos PPM (F29)',1,NULL,3),(54,5,NULL,NULL,NULL,'Pre-Aprobación Bancaria (con fecha máxima de 15 días de emisión).',1,NULL,3),(55,6,NULL,NULL,NULL,'Cotización de unidad con firma de vendedor',1,NULL,3),(56,7,NULL,NULL,NULL,'Reserva (Firma)',1,NULL,3),(57,8,NULL,NULL,NULL,'Promesa de Compra-Venta (Firma y Huella)',1,NULL,3),(58,9,'pie','salida',NULL,'Validar Montos de Financiamiento con Promesa- Pie',1,NULL,3),(59,10,'pago_contra_promesa','salida',NULL,'Validar Montos de Financiamiento con Promesa- Pago Contra Promesa',1,NULL,3),(60,11,'escritura','salida',NULL,'Validar Montos de Financiamiento con Promesa - Pago Contra Escritura',1,NULL,3),(61,12,'chip','salida',NULL,'Validar Montos de Financiamiento con Promesa - Crédito Hipotecario',1,NULL,3),(62,13,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento con Promesa - Valor Final de Venta',1,NULL,3),(63,14,'SUMA=cupon_unidad_principal,cupon_estacionamiento,cupon_bodega,cupon_ahorro_previo,cupon_pago_contra_escritura','salida',NULL,'Cupón de descuento UF',1,NULL,3),(64,15,NULL,NULL,NULL,'Comprobantes de pagos de reserva/Pago contra promesa (parcial o total)',1,NULL,3),(65,1,NULL,NULL,NULL,'Póliza en Verde No.',1,NULL,4),(66,2,NULL,NULL,NULL,'Montos póliza en verde concuerdan con cotización-reserva y promesa compraventa',1,NULL,4),(67,3,NULL,'entrada','date','Fecha de Aprobación Vivet:',1,NULL,4),(68,4,NULL,'entrada','text','Resolución:',1,NULL,4),(69,1,NULL,NULL,NULL,'Comprobante de Reserva RUKAN',1,NULL,5),(70,2,NULL,NULL,NULL,'Cartón de Subsidio',1,NULL,5),(71,3,'serie_subsidio','salida',NULL,'Revisar Ingreso correcto Datos Subsidio en el Vivet - Serie',1,NULL,5),(72,4,'num_subsidio','salida',NULL,'Revisar Ingreso correcto Datos Subsidio en el Vivet - Numero',1,NULL,5),(73,5,'llamado_subsidio','salida',NULL,'Revisar Ingreso correcto Datos Subsidio en el Vivet - Llamado',1,NULL,5),(74,6,'anio_subsidio','salida',NULL,'Revisar Ingreso correcto Datos Subsidio en el Vivet - Año',1,NULL,5),(75,1,NULL,NULL,NULL,'Certificado de Postulación o Reserva RUKAN',1,NULL,6),(76,2,NULL,NULL,NULL,'Si es DS19 marque SI siempre, de lo contrario valide que esté el Cartón de subsidio',1,NULL,6),(77,3,'ahorro','salida',NULL,'Ahorro para la Vivienda - Ahorro UF',1,NULL,6),(78,4,'cupon_ahorro_previo','salida',NULL,'Ahorro para la Vivienda - Cupón Ahorro Previo UF',1,NULL,6),(79,5,'RESTA=ahorro,cupon_ahorro_previo','salida',NULL,'Ahorro para la Vivienda - Faltante UF',1,NULL,6),(80,6,NULL,'entrada','text','Monto ahorro esperado UF',1,NULL,6),(81,7,NULL,'entrada','text','Monto ahorro actual',1,NULL,6),(82,8,'serie_subsidio','salida',NULL,'Si es DS19 marque SI siempre, de lo contrario valide que estén ingresados correctamente los datos en el Vivet del Cartón - Serie',1,NULL,6),(83,9,'num_subsidio','salida',NULL,'Si es DS19 marque SI siempre, de lo contrario valide que estén ingresados correctamente los datos en el Vivet del Cartón - Numero',1,NULL,6),(84,10,'llamado_subsidio','salida',NULL,'Si es DS19 marque SI siempre, de lo contrario valide que estén ingresados correctamente los datos en el Vivet del Cartón - Llamado',1,NULL,6),(85,11,'anio_subsidio','salida',NULL,'Si es DS19 marque SI siempre, de lo contrario valide que estén ingresados correctamente los datos en el Vivet del Cartón - año',1,NULL,6),(86,12,'banco','salida',NULL,'Validar pre-aprobación fisica está acorde a los datos que se indican - Banco',1,NULL,6),(87,13,'preaprobacion_riesgo','salida',NULL,'Validar pre-aprobación fisica está acorde a los datos que se indican - Monto de pre-aprobación',1,NULL,6),(88,14,'fecha_cierre','salida',NULL,'Validar pre-aprobación fisica esté acorde a los datos que se indican - Fecha de pre-aprobación',1,NULL,6),(89,15,'POR=chip,precio_final_opp','salida',NULL,'Validar pre-aprobación fisica esté acorde a los datos que se indican - % Financiamiento',1,NULL,6),(90,16,'unidad_principal','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Unidad Principal',1,NULL,6),(91,17,'estacionamiento','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Estacionamiento',1,NULL,6),(92,18,'bodega','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Bodega',1,NULL,6),(93,19,'cupon_ahorro_previo','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Ahorro Previo',1,NULL,6),(94,20,'cupon_pago_contra_escritura','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Pago Contra Escritura',1,NULL,6),(95,1,'gops','salida',NULL,'Gastos Operacionales UF',1,NULL,7),(96,2,'gops_pagados','salida',NULL,'Gastos Operacionales Pagados UF',1,NULL,7),(97,3,NULL,'entrada','text','GOP - Número de Cuotas Faltantes',1,NULL,7),(98,4,NULL,'entrada','text','GOP - Número de Cuotas pagadas',1,NULL,7),(99,5,NULL,'entrada','text','GOP - Cuotas Morosas',1,NULL,7),(100,1,'cupon_unidad_principal','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Unidad Principal',1,NULL,8),(101,2,'cupon_estacionamiento','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Estacionamiento',1,NULL,8),(102,3,'cupon_bodega','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Bodega',1,NULL,8),(103,4,'cupon_ahorro_previo','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Ahorro Previo',1,NULL,8),(104,5,'cupon_pago_contra_escritura','salida',NULL,'Validar que cupón fisico esté acorde a los datos que se indican - Pago Contra Escritura',1,NULL,8),(105,6,'banco','salida',NULL,'Validar que pre-aprobación fisica esté acorde a los datos que se indican - Banco',1,NULL,8),(106,7,'preaprobacion_riesgo','salida',NULL,'Validar que pre-aprobación fisica esté acorde a los datos que se indican - Monto de pre-aprobación',1,NULL,8),(107,8,'fecha_cierre','salida',NULL,'Validar que pre-aprobación fisica esté acorde a los datos que se indican - Fecha de pre-aprobación',1,NULL,8),(108,9,'POR=preaprobacion_riesgo,precio_final_opp','salida',NULL,'Validar que pre-aprobación fisica esté acorde a los datos que se indican - % Financiamiento',1,NULL,8),(109,1,'pie','salida',NULL,'Pie - Pie UF',1,NULL,9),(110,2,'pie_pagado','salida',NULL,'Pie - Pie pagado UF',1,NULL,9),(111,3,NULL,'entrada','text','Pie - Número de cuotas faltantes',1,NULL,9),(112,4,NULL,'entrada','text','Pie - Número de cuotas pagadas',1,NULL,9),(113,5,NULL,'entrada','text','Pie - Cuotas morosas',1,NULL,9),(114,6,'gops','salida',NULL,'GOP - UF',1,NULL,9),(115,7,'gops_pagados','salida',NULL,'GOP - pagados UF',1,NULL,9),(116,8,NULL,'entrada','text','GOP - Número de cuotas faltantes',1,NULL,9),(117,9,NULL,'entrada','text','GOP - Número de coutas pagadas',1,NULL,9),(118,10,NULL,'entrada','text','GOP - Cuotas Morosas',1,NULL,9),(119,1,NULL,NULL,NULL,'Fotocopia de Cédula de Identidad VIGENTE a la fecha de escriturar por ambos lados (firma y huella)',1,NULL,10),(120,2,NULL,NULL,NULL,'Acreditar Estado Civil VIGENTE al momento de escriturar',1,NULL,10),(121,3,NULL,NULL,NULL,'Certificado de discapacidad VIGENTE al momento de escriturar',0,NULL,10),(122,4,NULL,NULL,NULL,'Certificado de Indígena (si correspondiese emitido por la CONADI) VIGENTE al momento de escriturar',0,NULL,10),(123,5,'subsidio','salida',NULL,'Validar Montos de Financiamiento - Subsidio',1,NULL,10),(124,6,'ahorro','salida',NULL,'Validar Montos de Financiamiento - Ahorro',1,NULL,10),(125,7,'bono_integración','salida',NULL,'Validar Montos de Financiamiento - Bono Integración',1,NULL,10),(126,8,'bono_captación','salida',NULL,'Validar Montos de Financiamiento - Bono Captación',1,NULL,10),(127,9,'escritura','salida',NULL,'Validar Montos de Financiamiento - Pago Contra escritura',1,NULL,10),(128,10,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento - Valor Final de venta',1,NULL,10),(129,1,NULL,NULL,NULL,'Fotocopia de Cédula de Identidad VIGENTE a la fecha de escriturar por ambos lados (firma y huella)',1,NULL,11),(130,2,NULL,NULL,NULL,'Acreditar Estado Civil VIGENTE al momento de escriturar',1,NULL,11),(131,3,NULL,NULL,NULL,'Certificado de discapacidad VIGENTE al momento de escriturar',0,NULL,11),(132,4,NULL,NULL,NULL,'Certificado de Indígena (si correspondiese emitido por la CONADI) VIGENTE al momento de escriturar',0,NULL,11),(133,5,NULL,'entrada','text','Saldo Libreta de Ahorro',1,NULL,11),(134,6,'subsidio','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Subsidio',1,NULL,11),(135,7,'ahorro','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Ahorro',1,NULL,11),(136,8,'bono_captación','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Bono captación',1,NULL,11),(137,9,'bono_integración','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Bono integración',1,NULL,11),(138,10,'pie','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Pie',1,NULL,11),(139,11,'escritura','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Pago contra Escritura',1,NULL,11),(140,12,'pago_contra_promesa','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Pago contra Promesa',1,NULL,11),(141,13,'chip','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Crédito Hipotecario',1,NULL,11),(142,14,'SUMA=cupon_unidad_principal,cupon_estacionamiento,cupon_bodega,cupon_ahorro_previo,cupon_pago_contra_escritura','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Total cupones',1,NULL,11),(143,15,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Precio Final',1,NULL,11),(144,1,NULL,NULL,NULL,'Dependiente: certificado laboral vigente y certificado AFP 12 últimos meses con rut de empleador // Independiente:Certificado de Inicio de Actividades y dos últimas DAI',1,NULL,12),(145,2,NULL,NULL,NULL,'Dependiente: últimas 6 liquidaciones de sueldo // Independiente: últimos 6 meses de Boletas de Honorarios o 12 últimos PPM (F29 Pagos de IVAS)',1,NULL,12),(146,3,'banco','salida',NULL,'Entidad que entregó Pre-aprobación',1,NULL,12),(147,4,'subsidio','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Subsidio',1,NULL,12),(148,5,'ahorro','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Ahorro',1,NULL,12),(149,6,'bono_captación','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Bono captación',1,NULL,12),(150,7,'bono_integración','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Bono integración',1,NULL,12),(151,8,'pie','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Pie',1,NULL,12),(152,9,'escritura','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Escritura',1,NULL,12),(153,10,'pago_contra_promesa','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Pago contra Promesa',1,NULL,12),(154,11,'chip','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Crédito Hipotecario',1,NULL,12),(155,12,'SUMA=cupon_unidad_principal,cupon_estacionamiento,cupon_bodega,cupon_ahorro_previo,cupon_pago_contra_escritura','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Total cupones',1,NULL,12),(156,13,'precio_final_opp','salida',NULL,'Validar Montos de Financiamiento contra promesa y cliente - Precio Final',1,NULL,12),(157,1,'gops_pagados','salida',NULL,'Gastos Operacionales Pagados UF',1,NULL,14),(158,2,'escritura_pagada','salida',NULL,'Pago contra Escritura Pagado UF',1,NULL,14),(159,3,'gops','salida',NULL,'Gastos Operacionales UF',1,NULL,14),(160,4,'escritura','salida',NULL,'Pago contra Escritura UF',1,NULL,14),(161,5,'pie','salida',NULL,'Pie ',1,NULL,14),(162,1,'chip','salida',NULL,'Crédito Hipotecario UF (Promesa)',1,NULL,15),(163,2,'POR=chip,precio_final_opp','salida',NULL,'% Financiamiento (Promesa)',1,NULL,15),(164,3,NULL,'entrada','text','Aprobación Final crédito hipotecario UF',1,NULL,15),(165,4,NULL,NULL,NULL,'% Financiamiento en Aprobacion Final',1,NULL,15),(166,5,NULL,NULL,NULL,'Monto Crédito Aprobado cumple Monto el Crédito en Promesa',1,NULL,15),(167,6,NULL,NULL,NULL,'% Financiamiento cumple con el porcentaje financiamiento en promesa',1,NULL,15),(168,1,'gops_pagados','salida',NULL,'Gastos Operacionales Pagados UF',1,NULL,16),(169,2,'escritura_pagada','salida',NULL,'Pago contra Escritura UF',1,NULL,16),(170,3,'pago_contra_promesa','salida',NULL,'Pago contra Promesa pagado UF',1,NULL,16),(171,4,'pie_pagado','salida',NULL,'Pie pagado UF',1,NULL,16),(172,5,'gops','salida',NULL,'Gastos Operacionales Pactados UF',1,NULL,16),(173,6,'escritura','salida',NULL,'Pago contra Escritura Pactados UF',1,NULL,16),(174,7,'pie','salida',NULL,'Pie Pactado UF',1,NULL,16),(175,1,NULL,NULL,NULL,'Fotocopia de cédula de identidad del cliente y núcleo familiar declarado en la postulación mayores de 18 años ',1,NULL,17),(176,2,NULL,NULL,NULL,'Copia de comprobante de postulación y/o reserva RUKAN con sus respectivas',1,NULL,17),(177,3,NULL,NULL,NULL,'Declaración jurada de postulación',1,NULL,17),(178,4,NULL,NULL,NULL,'Declaración de núcleo',1,NULL,17),(179,5,NULL,NULL,NULL,'Certificado de matrimonio y/o divorcio (Si corresponde)',1,NULL,17),(180,1,NULL,NULL,NULL,'Carta (Oficio) de la Entidad Desarrolladora (MDA)',1,NULL,18),(181,2,NULL,NULL,NULL,'Copia de resolución de convenio entre la Entidad Desarrolladora y Serviu',1,NULL,18),(182,3,NULL,NULL,NULL,'Copia de modificación de resolución de convenio (Sólo si corresponde)',1,NULL,18),(183,4,NULL,NULL,NULL,'Copia de resolución de prórroga de recepción municipal (sólo si corresponde)',1,NULL,18),(184,5,NULL,NULL,NULL,'Copia de certificado de recepción Municipal Definitiva, de la dirección de obras correspondiente (Loteo urbanización y edificación)',1,NULL,18),(185,6,NULL,NULL,NULL,'Información persona RUKAN (Si es que se habilita el acceso)',1,NULL,18);
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos_usuarios`
--

DROP TABLE IF EXISTS `proyectos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos_usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_proyecto` bigint(20) unsigned DEFAULT NULL,
  `id_usuario` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyectos_usuarios_id_proyecto_index` (`id_proyecto`),
  KEY `proyectos_usuarios_id_usuario_index` (`id_usuario`),
  CONSTRAINT `proyectos_usuarios_id_proyecto_foreign` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `proyectos_usuarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos_usuarios`
--

LOCK TABLES `proyectos_usuarios` WRITE;
/*!40000 ALTER TABLE `proyectos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiones`
--

DROP TABLE IF EXISTS `regiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regiones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiones`
--

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` VALUES (1,'1','Arica y Parinacota'),(2,'2','Tarapacá'),(3,'3','Antofagasta'),(4,'4','Atacama'),(5,'5','Coquimbo'),(6,'6','Valparaíso'),(7,'7','Libertador General Bernardo O\'Higgins'),(8,'8','Maule'),(9,'9','Ñuble'),(10,'10','Biobío'),(11,'11','Araucanía'),(12,'12','De Los Ríos'),(13,'13','De Los Lagos'),(14,'14','Aysén del General Carlos Ibáñez del Campo'),(15,'15','Magallanes y de la Antártica Chilena'),(16,'16','Metropolitana de Santiago');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titular` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeudor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excepcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subsanado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `autoriza_id` bigint(20) unsigned DEFAULT NULL,
  `id_preg` bigint(20) unsigned NOT NULL,
  `id_dw` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `respuestas_id_preg_foreign` (`id_preg`),
  KEY `respuestas_id_dw_foreign` (`id_dw`),
  KEY `respuestas_autoriza_id_foreign` (`autoriza_id`),
  CONSTRAINT `respuestas_autoriza_id_foreign` FOREIGN KEY (`autoriza_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `respuestas_id_dw_foreign` FOREIGN KEY (`id_dw`) REFERENCES `workflow_detalle` (`id`),
  CONSTRAINT `respuestas_id_preg_foreign` FOREIGN KEY (`id_preg`) REFERENCES `preguntas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rut` int(11) NOT NULL,
  `usuario_vivesoft` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `backup` int(11) DEFAULT NULL,
  `representante_legal` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perfil` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vacaciones` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `id_cargo` bigint(20) unsigned NOT NULL,
  `id_area` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_rut_unique` (`rut`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_id_cargo_foreign` (`id_cargo`),
  KEY `usuarios_id_area_foreign` (`id_area`),
  CONSTRAINT `usuarios_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `usuarios_id_cargo_foreign` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','$2y$10$8PG0mFKqmqrVKMFviCWEAeTiKHOaOxdj4lcfiLf/Y0lixdCUe49sa','Admin',NULL,0,NULL,NULL,NULL,'clientepruebasmdai@gmail.com',NULL,NULL,NULL,'0',NULL,NULL,19,5,NULL,NULL,'2020-04-26 21:16:56',NULL),(2,'aalvarez','$2y$10$gySAKhrEAGSUoXtRm.SoQOC3fUbMan3Oihv7E6XF/yQ7aUrvjaD/6','Andrea Carolina','Alvarez de la Rivera Kater',16608070,NULL,NULL,NULL,'aalvarez@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,1,1,NULL,NULL,'2020-04-26 21:16:56',NULL),(3,'ffigueroa','$2y$10$DNtlc7GJ8O0oQARhIfENK.woi2Kx7B3Cgt3eS8gDcaJJ5avNHb0tK','Felipe','Figueroa Avendaño',16363938,NULL,NULL,NULL,'ffigueroa@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,2,2,NULL,NULL,'2020-04-26 21:16:56',NULL),(4,'voropeza','$2y$10$NkVKkXvbjcHgcHGd6.wjMewcSedHvvDrnCi.G3MoULGA5rDLD0C/O','Veruska Karla','Oropeza Montell',26746477,NULL,NULL,NULL,'voropeza@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,3,3,NULL,NULL,'2020-04-26 21:16:56',NULL),(5,'ysaavedra','$2y$10$zfx4aIyw5KasXSIQdlxH7.LtL/h/ybNK4Dr/1cb4adjy.Iue44bRO','Yara Tibisay','Saavedra Ferrer',26083144,NULL,NULL,NULL,'ysaavedra@mdaicl',NULL,NULL,NULL,'0',NULL,NULL,3,3,NULL,NULL,'2020-04-26 21:16:56',NULL),(6,'bsilva','$2y$10$kQSxEjQ1NMCNgAO4l1PCLea.gFRdB3XJUtZZU0BjfvwZvVp6Y3koO','Belkis Carolina','Silva Arteaga',25849481,NULL,NULL,NULL,'bsilva@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,3,3,NULL,NULL,'2020-04-26 21:16:56',NULL),(7,'kpena','$2y$10$N/yQAvnGnS9GXZR9qDhUm.FyBn/Zn2fXuwxSCOKKcqvRkybvaIlXC','Karina Magdalena','Peña Herrera',12464685,'Karina Peña',NULL,NULL,'kpena@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,4,2,NULL,NULL,'2020-04-26 21:16:56',NULL),(8,'dfuentes','$2y$10$ZzbJV4mP8s.GEPAKFfG6seYGEWfxTbzYlRIslTA0e5ItSg7fFri66','Daniela','Fuentes Fuentes',18295787,NULL,NULL,NULL,'dfuentes@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,5,4,NULL,NULL,'2020-04-26 21:16:56',NULL),(9,'mmendoza','$2y$10$eSt3ZBzOs7nv0p4enGAamuAF.8bRdaNLfmrNBFROefLPQCzOSAfEO','María Francisca','Mendoza Fuentes',19169003,'María Francisca Mendoza',NULL,NULL,'mmendoza@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,6,5,NULL,NULL,'2020-04-26 21:16:57',NULL),(10,'gguerra','$2y$10$MynCQd9ZMDXTklZUeONTkufQTkuyXlhy/ZYWBUE602ErE0nIEPnFG','Genesis del Carmen','Guerra Páez',26457560,'Genesis Guerra',NULL,NULL,'gguerra@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,7,2,NULL,NULL,'2020-04-26 21:16:57',NULL),(11,'rpuschel','$2y$10$ArKDqAF9S1S41fn9GGFxg.lBgZ.7VGrN9CwaTO1nWbLrOFtGt4fm.','Rocío del Pilar','Puschel Briones',17553137,'Rocio Puschel',NULL,NULL,'rpuschel@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,7,2,NULL,NULL,'2020-04-26 21:16:57',NULL),(12,'carancibia','$2y$10$b8UkxQILwWaAffQrso338u6PiMQCTXAK1PWMtG4iUsGGQMBeO0C/2','Cristian Andres','Arancibia Valenzuela',12464345,NULL,NULL,NULL,'carancibia@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,8,5,NULL,NULL,'2020-04-26 21:16:57',NULL),(13,'jastudillo','$2y$10$F.Pboghj.K3IoiFo9xpkBet8tbUg9a8r18d7QICJ3cR7v8S5kk4Ca','Jorge Francisco','Astudillo Valdes',17225359,'Jorge Astudillo',NULL,NULL,'jastudillo@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(14,'sdamian','$2y$10$fSCCt80lp5YM7s64tVGPD.NqjYZ8c9tiIlfzVde8zsPPWE4n8ou0a','Soledad Andrea','Damian Varas',17962657,'Soledad Damian',NULL,NULL,'sdamian@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(15,'vgarrido','$2y$10$sodx6gNxmMkwK5J/Xc0FPOULS9Ypm.3TlxC8jWHa1/nqvQvTy8oEu','Violeta Mercedes','Garrido Antillanca',11453823,'Violeta Garrido',NULL,NULL,'vgarrido@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(16,'dlira','$2y$10$gTRst/oJaAPMHG//Rq/gLeAAmYhzRf6zKkRWNVM5rBkTLeVj.s966','David Alejandro','Lira Varas',18317822,'David LIra',NULL,NULL,'dlira@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(17,'dmiranda','$2y$10$fN3xpqN5M/S5PtPIDsAKp.0ouVcqqgyMBIjlAlv1z1WwCl4qOoOfW','Diego Francisco','Miranda Soto',17651652,'Diego Miranda',NULL,NULL,'dmiranda@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(18,'iormazabal','$2y$10$.UdHWT3MxJO43S0.5msgx.K.jX20lyBlefqW5LYerbZ2/wNAAuBya','Isabel del Carmen','Ormazabal Quinteros',13032034,'Isabel Ormazabal',NULL,NULL,'iormazabal@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(19,'mrodriguez','$2y$10$SbKG.soMotWP71bvxxfaPugr5JwSIw4XWSFLMAOXQGIB250nmnv46','Miriam Haidee','Rodriguez Farias',25826409,'Mirian Rodriguez',NULL,NULL,'mrodriguez@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:57',NULL),(20,'lsolis','$2y$10$DePplkk4xZKjs/9Z14BLR.wpvtfsA6umvObQEZAVqLqYSMUiodFRi','Lynette Pamela','Solis Astelli',13428329,'Lynette Solis',NULL,NULL,'lsolis@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,9,6,NULL,NULL,'2020-04-26 21:16:58',NULL),(21,'mdominguez','$2y$10$0CHUPCJXA8IkzSBCfdnXROLAqnIh1aPId4Jwy.OmfhCQJtbLjOK8G','Maria Cecilia','Dominguez Bastian',9313793,NULL,27,1,'mdominguez@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,10,6,NULL,NULL,'2020-04-26 21:16:58',NULL),(22,'dhirsh','$2y$10$yaY05S/7M9FMHBCoBYo7I.tvFT6Yg2qI8ptudVe2KDPo5lR08M/pe','David Felipe','Hirsh Vainstein',8669210,NULL,NULL,1,'dhirsh@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,11,3,NULL,NULL,'2020-04-26 21:16:58',NULL),(23,'ssoto','$2y$10$XB3wVSLuwKxZeWTs27HIe.KANL3NnajxB8RjApU2oiJmOzgnzZO2m','Sandra del Carmen','Soto Lecaros',8825352,NULL,NULL,NULL,'ssoto@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,12,6,NULL,NULL,'2020-04-26 21:16:58',NULL),(24,'mbustamante','$2y$10$cTHvLU/95TAv0esNK0V7kOOSB/dxC/7CSPQxucP1sojP0kg3i9Y5K','Macarena Teresa','Bustamante Valenzuela',17600341,'Macarena Bustamente',NULL,NULL,'mbustamante@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,13,2,NULL,NULL,'2020-04-26 21:16:58',NULL),(25,'jirribarra','$2y$10$79jTEQx8Hk34YUW3PmkLBOYDKAWix1170RVD0H8.8Xs5nPnFdrgdG','Jaime Francisco','Irribarra Espinosa',13904627,'Jaime Irribarra',NULL,NULL,'jirribarra@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,14,2,NULL,NULL,'2020-04-26 21:16:58',NULL),(26,'mriquelme','$2y$10$CrpTNrqcIOSPAsnUtwB1w.a9E0afecwSEsQ3YpEJH4lBWQT6zGJhe','Maria Jose','Riquelme Dominguez',17810418,'María José Riquelme',24,NULL,'mriquelme@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,15,2,NULL,NULL,'2020-04-26 21:16:58',NULL),(27,'sparada','$2y$10$exzE4eZhun3vVq23aIrGf.Bz2cZbUJmtafk7.JWdjx1ViS0xfh5ui','Sandra Patricia','Parada Contreras',9898542,NULL,NULL,NULL,'sparada@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,16,6,NULL,NULL,'2020-04-26 21:16:58',NULL),(28,'mespinoza','$2y$10$cMw1PPDlnLvzhRQd9NF8wOwv6/zoXsaAtPGaoF/mQHGiVy47Je/TC','Marlene Gema','Espinoza Pezzopane',9671821,NULL,NULL,NULL,'mespinoza@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,17,3,NULL,NULL,'2020-04-26 21:16:58',NULL),(29,'adelbino','$2y$10$csVCdfXgEcsaFuIeqJt3v.P8ogfJrRCeD3pCIt1GiHqZ8U1LVyY6K','Ana Carolina','Del Bino Cortes',21880891,'Ana Del Bino',NULL,NULL,'adelbino@mdai.cl',NULL,NULL,NULL,'0',NULL,NULL,18,2,NULL,NULL,'2020-04-26 21:16:58',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `opp` int(11) NOT NULL,
  `rut_cliente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_recepcion_final` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow`
--

LOCK TABLES `workflow` WRITE;
/*!40000 ALTER TABLE `workflow` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_detalle`
--

DROP TABLE IF EXISTS `workflow_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_detalle` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ultimo_estado` int(11) DEFAULT NULL,
  `id_workflow` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workflow_detalle_id_workflow_foreign` (`id_workflow`),
  CONSTRAINT `workflow_detalle_id_workflow_foreign` FOREIGN KEY (`id_workflow`) REFERENCES `workflow` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_detalle`
--

LOCK TABLES `workflow_detalle` WRITE;
/*!40000 ALTER TABLE `workflow_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_etapas`
--

DROP TABLE IF EXISTS `workflow_etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_etapas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_etapas`
--

LOCK TABLES `workflow_etapas` WRITE;
/*!40000 ALTER TABLE `workflow_etapas` DISABLE KEYS */;
INSERT INTO `workflow_etapas` VALUES (1,'Etapa 1'),(2,'Etapa 2'),(3,'Etapa 3'),(4,'Etapa 4'),(5,'Cambio de Unidad'),(6,'Excepciones'),(7,'Desistimiento'),(8,'Otros');
/*!40000 ALTER TABLE `workflow_etapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mdai_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-29  4:13:52
