/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 5.7.33 : Database - acreditacion
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`siia_pruebas` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `siia_pruebas`;

/*Table structure for table `administradores` */

DROP TABLE IF EXISTS `administradores`;

CREATE TABLE `administradores` (
  `id_administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Administrador',
  `primerNombreAdministrador` varchar(1000) NOT NULL COMMENT 'Primer Nombre del Adminsitrador',
  `segundoNombreAdministrador` varchar(1000) DEFAULT NULL COMMENT 'Segundo Nombre del Administrador',
  `primerApellidoAdministrador` varchar(1000) NOT NULL COMMENT 'Primer Apellido del Administrador',
  `segundoApellidoAdministrador` varchar(1000) DEFAULT NULL COMMENT 'Segundo Apellido del Administrador',
  `numCedulaCiudadaniaAdministrador` int(11) NOT NULL COMMENT 'Numero de Cedula de Ciudadania del Administrador',
  `direccionCorreoElectronico` varchar(1000) NOT NULL COMMENT 'Direccion de Correo Electronico del Adminsitrador',
  `usuario` varchar(1000) NOT NULL COMMENT 'Nombre de usuario del Administrador',
  `contrasena` varchar(1000) NOT NULL COMMENT 'Contraseña del Administrador',
  `contrasena_rdel` varchar(1000) NOT NULL COMMENT 'Contraseña en Rjindael para Recordar',
  `habilitado` char(1) NOT NULL DEFAULT '0' COMMENT 'Si esta habilitado para ingresar al sistema.',
  `nivel` char(1) NOT NULL DEFAULT '0' COMMENT 'Nivel de Acceso del Administrador',
  `logged_in` char(1) NOT NULL DEFAULT '0' COMMENT 'Si esta en 0 no esta en sesion, si esta en 1 esta en sesion',
  PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB AUTO_INCREMENT=100000016 DEFAULT CHARSET=utf8 COMMENT='Tabla de Administradores';

/*Data for the table `administradores` */

insert  into `administradores`(`id_administrador`,`primerNombreAdministrador`,`segundoNombreAdministrador`,`primerApellidoAdministrador`,`segundoApellidoAdministrador`,`numCedulaCiudadaniaAdministrador`,`direccionCorreoElectronico`,`usuario`,`contrasena`,`contrasena_rdel`,`habilitado`,`nivel`,`logged_in`) values 
(100000000,'Administrador','y Soporte','Tics','Orgsolidarias',0,'soportetics@orgsolidarias.gov.co','Tics','$2a$10$LMoq587n8aNlbWAvg/.9g.uUDOGLaYKIShVRAJxaSzprflvmpmumi','vxFGtj4hthhVbgs0zXWhg55rsoW0bmmlqr5qWmHiVlqsKVfSU0A8tCCs212u4swbavpVaUbgCn6iDLDi/8G3/pnlWqgrHbh0JypvLUiTOw7kuFEti5YcXBRxmuYDuhrh|5ieIoV4FueqmC/n8343KkgAPrLn+VYhIBQ2nteG2ZJg=','0','0','1'),
(100000001,'Marisol','','Viveros','Zambrano',59706547,'mviveros@orgsolidarias.gov.co','mviveros','$2a$10$qMi/vLTq1Z0Ui6WSXTBSHOCr.voctlJljbHVTSKpIcwN1XO3NrknG','sl7YEsaFIn1rP2TSqPmuSQRUpyISbIqb7IE+9DtGwZCjENz7DkwXtJbJc0n9ol7WKu5drdLcOL8Ia5vI79j+CZfyClF/kFD4VNyOXHCkFjJRdKHrF5ZijdKFLMMTxO4K|k4oYFg5mnWjqK9/T4ybGT1Lv4KyjUmT9QioioN0fyuM=','0','3','1'),
(100000002,'Jerson','David','Forero','Barbosa',1030546863,'jforero@orgsolidarias.gov.co','jforero','$2a$10$.brT1PFhXcPtg9UunS8v3uXnmqRw9OARaKPs5ImBMv6Y6ut0TInpa','+WduloW9kga5SRXI0diwOU8vKFnSPoxjBNWIujEPpJ0Ja4RSbDDe+NVP+RP3gMaTyOO/OB9ldF9q+atMhBk5GA8PXYcufo0EAV5bZhsFa+otoufFJTKI/Z9GgzQsveUS|mQsv3GWe4vIL4FJgT8NqzfKVwuvFKA+81kZxFDgOTfk=','0','','0'),
(100000003,'Coordinación','de','Educación','UAEOS',1,'cbonilla@orgsolidarias.gov.co','coordinacion.educacion','$2a$10$MrBvfy1fkR8uuqN0KmiSceXy0IlkAhPsx7uckZTLoLw9q0wrvLJEa','bXO8FMzKg8ykn52TkNVfFxNpshMJ9jRcT1q1fBD5vb6krmXFboVeBBRhi8ykcSqha3Z/QOdECJ8KLt1DM3ERZvwoTfhkwjSuqqvZ8N4EolKBGcNYUyhAO7YMellEko1X|2XCWFWhonQFMD1VKKxjPbT87HJ+2IdHuMy1cb6i9430=','0','','0'),
(100000006,'Administrador','y Soporte','Administrador','',1026279129,'soportetics@orgsolidarias.gov.co','tics2','$2a$10$0hJYkp2J6FvTOdEYhaGyMet3IJlK2WUD3wvqbH2z89V97uyo5lobe','xzpB75zZRcQB3WoLOty8l0dfRGvYNmUfPPAQt8uDR0AAFyWZ4UcKCspCQ3CkuEeYv4aDXmX5VQLNaIlTv8U6RMJU/UlEhYe8Fyn8FNhpnvGbO8JphLkEVvjo+YBVSITD|1Rvas6l8dCYYSn1iZPFcbpeCfSfFMi5bG7AafiocGes=','0','0','0'),
(100000007,'Ingrid','Lorena','Reyes','Gómez',53047474,'ireyes@orgsolidarias.gov.co','ireyes','$2a$10$BYun02Vcj1n/6cLH8TYqB.04JBBms/hSk3Ts14lMLx.yCloAl5dpm','coL3TkUUfLBoEJtJ4yHZfz322eRmibVOl8VZu1t1v5qj7ZZoU3gTZH7/W8JbRmTMvwHvahRAuR1oX43no57DjiRU7Hv+07+MtH9E6WNTEFjLqDxpfWuSdTV0EsdLa2ZC|rX5g+j43oSYfu/6cylovCcPrGUNROakKI4yQcBFE7JQ=','0','1','0'),
(100000008,'Nidia','Yamile','Patiño','Cortes',52499989,'npatino@orgsolidarias.gov.co','npatino','$2a$10$IQppOdkow6i6f8VDi1aQ1eXejGyOemdCmA0u7ypnTx4CYi0eLdK5q','mfG1ffPkeCJNTkl+Hn8wraURuyoDSnGHLuRjoQq7ne0uSQLDAvv14ef9kohGU7JENJXRp3033Be/BsAS025E83Op+WSCDgO5XEjhXOaHIdVRyU5PfwOaovG6BFYExpuh|LiNtt+OF271AM1KXJd+Q5BkexIuMCjPl9W6p80dH9j4=','0','6','0'),
(100000009,'José','Efraín','Cuy','Esteban',88031074,'jcuy@orgsolidarias.gov.co','jcuy','$2a$10$mHncsOCLftcp.YBTEHtSwuT2.pk9W0ANadfHR4VpaKNcd2j2HF3ie','QehIBf5EybasZjYNfgzzVUv5m6rB+oKUtEBMXL86n7wcCiBaMpZT5MFFMM/itLHfZasg21hErfWGW6TfW0uQ5mfxvPCLupVD7pvNlMPW6ZhEVV5LZLMJVG7RPsm7BS1Z|FkhU973wP3MKUJobMMTcdpaVs1KIOYEiK13uQXT8frE=','0','1','1'),
(100000012,'Zairis ','Yirlena','Mendoza','Atencio',1120741433,'zairis.mendoza@uaeos.gov.co','zairis.mendoza','$2a$10$WyoHBMCEbtS6UKJn2AiBdO74M35B1gC8MYCtVeEgvD0i3zC.q4I0a','bal5arOFt32xelquWfqhQALAO/Ym2PogrxNtJ9UpIc5oEVq44MAJ3WjqU0eVNY7PZWQHsNot9XlCYevlZKIrCNSSs/QVvCilQrN5xzBUnOuLa8MfUZe5ZdQ9vyWKeuW1|DwdjKydXMxb9OCbTMlXqWFCgif8EvFgIDtEWeCxAlNQ=','0','2','1'),
(100000013,'Ana','María','Ospina','Sánchez',1097033066,'ana.ospina@uaeos.gov.co','ana.ospina','$2a$10$4F0PRMK9pHZY9sOlp6rPdeEPYWMryXi4T5L59bTcIy2tqum0Sp7Q6','5yUP6XlC6XOYk+IL6UEKDlNEu+jd1qOFcdvWzzY+H8hXU0xYxw0sv6Z9g+MkXS6wHo5bLuz9cZkGOLlNNy5JYaRR6XA4f68SthqaOtDtgzNhzXpQGBIb+h1khn9NOAfN|IwHsihkO/D/6u+aPmAgOxSjGgkETjAMAAUrdHNwJCP8=','0','1','1'),
(100000014,'Magda','','Estrada','',66918837,'magda.estrada@uaeos.gov.co','magda.estrada','$2a$10$JOoOl2EjJjeV5GZZnHutUuRgru3UOvxF9oIDJ4JsvXFQC2OpQnFGS','+OIae/dLZpqxzusWa4Y+ABe6SkTabiR+x7Paj0puOLcWNXHREV5GGa83+2GbwbYnanTpqXJRcqCeyb/VioYCTjGldbmwx046XdVuzjkth9cVY+xZyRBJzYDu3g9Xc59O|nUmo+4EUhg3tnTgmD7yq5EbE0cALnFhmLz75r5aYzyE=','0','1','0'),
(100000015,'Mariela','','Florez','Rodríguez',52430689,'mariela.florez@uaeos.gov.co','mariela.florez','$2a$10$tp63xuzBAD6xcWb5Z0XfCexqbjUOAP4rMdDP/V1T1EEb0DOI7h9a.','0ol0/Faug65jb3iEcihUpHu/9fJ5RL9QgbV0FCz/gYB+bsyBdk3XeecaLyqHJf2Rg3+/POLtUTDmypXgPpypWXdCSorEN0tCra8ZszDwfomjOwdhgWi8xVgw1jdWbWFd|f/OVtgKWWlR+IqnyD31+yAnsr/qXNRMBEhCHs1XrOos=','0','2','1');

/*Table structure for table `antecedentesacademicos` */

DROP TABLE IF EXISTS `antecedentesacademicos`;

CREATE TABLE `antecedentesacademicos` (
  `id_antecedentesAcademicos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla Antecedentes Academicos',
  `descripcionProceso` longtext NOT NULL COMMENT 'Descripción cualitativa de los procesos de formación que ha realizado',
  `justificacion` longtext NOT NULL COMMENT 'Justificacion del Proceso del Antecedente',
  `objetivos` longtext NOT NULL COMMENT 'Objetivo del Proceso del Antecedente',
  `metodologia` longtext NOT NULL COMMENT 'Metodologia del proceso Antecedente Academico',
  `materialDidactico` longtext NOT NULL COMMENT 'Material Didactivo usado para llevar a cabo el Proceso Antecedente Academico',
  `bibliografia` longtext NOT NULL COMMENT 'Bilbiografia del proceso Antecedente Academico',
  `duracionCurso` varchar(1000) NOT NULL COMMENT 'Tiempo en duracion del Curso',
  `organizaciones_id_organizacion` int(11) NOT NULL COMMENT 'FK Id_Organizacion',
  PRIMARY KEY (`id_antecedentesAcademicos`),
  KEY `fk_antecedentesAcademicos_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_antecedentesAcademicos_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='Formulario # 4 de SIA Antecedentes Academicos.';

/*Data for the table `antecedentesacademicos` */

/*Table structure for table `archivos` */

DROP TABLE IF EXISTS `archivos`;

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Archivo',
  `tipo` varchar(1000) NOT NULL COMMENT 'Tipo de Archivo: Carta, Certificacion, Imagen',
  `nombre` varchar(1000) NOT NULL COMMENT 'Nombre del Archivo subido por el cliente',
  `id_formulario` int(11) NOT NULL COMMENT 'id del formulario donde se sube el archivo',
  `organizaciones_id_organizacion` int(11) NOT NULL COMMENT 'FK Id_Organizacion',
  PRIMARY KEY (`id_archivo`),
  KEY `fk_archivos_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_archivos_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1560 DEFAULT CHARSET=utf8 COMMENT='Archivos donde se guardan los archvios subidos por el usuario';

/*Data for the table `archivos` */

/*Table structure for table `archivosdocente` */

DROP TABLE IF EXISTS `archivosdocente`;

CREATE TABLE `archivosdocente` (
  `id_archivosDocente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Archivos Docente',
  `tipo` varchar(1000) NOT NULL COMMENT 'Tipo de Archivo del Docente',
  `nombre` varchar(1000) NOT NULL COMMENT 'Nombre del archivo del Docente',
  `observacionArchivo` varchar(1000) DEFAULT 'Ninguna',
  `docentes_id_docente` int(11) NOT NULL,
  PRIMARY KEY (`id_archivosDocente`),
  KEY `fk_archivosDocente_docentes1_idx` (`docentes_id_docente`),
  CONSTRAINT `fk_archivosDocente_docentes1` FOREIGN KEY (`docentes_id_docente`) REFERENCES `docentes` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2072 DEFAULT CHARSET=utf8 COMMENT='Archivos del docente ';

/*Data for the table `archivosdocente` */

/*Table structure for table `asistentes` */

DROP TABLE IF EXISTS `asistentes`;

CREATE TABLE `asistentes` (
  `id_asistentes` int(11) NOT NULL AUTO_INCREMENT,
  `primerNombreAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Primer Nombre del Asistente',
  `segundoNombreAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Segundo Nombre del Asistente',
  `primerApellidoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Primer Apellido del Asistente',
  `segundoApellidoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Segundo Nombre del Asistente',
  `tipoDocumentoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Tipo de Documento del Asistente',
  `numeroDocumentoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Numero del Documento del Asistente',
  `nombreOrganizacion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Nombre de la Organizacion a la que pertenece el Asistente',
  `numNITOrganizacion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'NIT de la Organizacion a la que pertenece el Asistente',
  `procesoBeneficio` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Proceso del que fue beneficiado el Asistente',
  `fechaFinalizacion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Fecha de Finalizacion del Asistente',
  `departamentoResidencia` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Departamento donde vive el asistente',
  `municipioResidencia` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Minicipio donde vive el asistente',
  `faxAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Fax o Telefono del Asistente',
  `direccionAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Direccion donde vive el asistente',
  `direccionCorreoElectronicoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Direccion de correo electronico del Asistente',
  `edadAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Edad del Asistente',
  `sexoAsistente` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Sexo del Asistente',
  `nivelFormacion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Nivel de Formacion del Asistente',
  `rolOrganizacion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Rol del Asistente en la Organizacion',
  `cabezaFamilia` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Cabeza de Familia?',
  `discapacidad` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Tiene Discapacidad?',
  `indigena` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Indigena?',
  `afro` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Afro?',
  `raizal` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Raizal?',
  `palenquero` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Palenquero ?',
  `romGitano` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Rom o Gitano ?',
  `redUnidos` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Pertenece a la Red Unidos ?',
  `numeroFolioRedUnidos` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Numero del Folio de la Red Unidos',
  `victima` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Pertenece a Victimas ?',
  `numeroRUVVictima` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Numero de RUV en Victimas',
  `reintegro` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Pertenece a Reintegro?',
  `numeroCODAReintegro` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Numero del CODA de Reintegro',
  `LGTBI` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Pertenece a LGTBI ?',
  `prostitucion` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Pertenece a la prostitucion?',
  `privadoLibertad` varchar(1000) COLLATE latin1_bin DEFAULT NULL COMMENT 'Es Privado de la Libertad?',
  `numCertificado` varchar(1000) COLLATE latin1_bin DEFAULT NULL,
  `informeActividades_id_informeActividades` int(11) NOT NULL COMMENT 'FK del Id_informeActividades',
  PRIMARY KEY (`id_asistentes`),
  KEY `fk_asistentes_informeActividades1_idx` (`informeActividades_id_informeActividades`),
  CONSTRAINT `fk_asistentes_informeActividades1` FOREIGN KEY (`informeActividades_id_informeActividades`) REFERENCES `informeactividades` (`id_informeActividades`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Información de los Asistentes del Curso';

/*Data for the table `asistentes` */

/*Table structure for table `bateriaobservaciones` */

DROP TABLE IF EXISTS `bateriaobservaciones`;

CREATE TABLE `bateriaobservaciones` (
  `id_bateriaObservaciones` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1000) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `observacion` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_bateriaObservaciones`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

/*Data for the table `bateriaobservaciones` */

/*Table structure for table `certificaciones` */

DROP TABLE IF EXISTS `certificaciones`;

CREATE TABLE `certificaciones` (
  `id_certificacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Certificacion',
  `numeroCertificado` varchar(45) NOT NULL COMMENT 'Numero Aleatorio del Certificado',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del Certificado',
  `informeActividades_id_informeActividades` int(11) NOT NULL,
  PRIMARY KEY (`id_certificacion`),
  KEY `fk_certificaciones_informeActividades1_idx` (`informeActividades_id_informeActividades`),
  CONSTRAINT `fk_certificaciones_informeActividades1` FOREIGN KEY (`informeActividades_id_informeActividades`) REFERENCES `informeactividades` (`id_informeActividades`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Certificaciones del Sistema para informes de Actividades';

/*Data for the table `certificaciones` */

/*Table structure for table `correosregistro` */

DROP TABLE IF EXISTS `correosregistro`;

CREATE TABLE `correosregistro` (
  `id_correosRegistro` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `de` varchar(45) DEFAULT NULL,
  `para` varchar(45) DEFAULT NULL,
  `cc` varchar(45) DEFAULT NULL,
  `cco` varchar(45) DEFAULT NULL,
  `asunto` text,
  `cuerpo` json DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `adjunto` text,
  `tipo` varchar(255) DEFAULT NULL,
  `error` text,
  PRIMARY KEY (`id_correosRegistro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `correosregistro` */

/*Table structure for table `datosaplicacion` */

DROP TABLE IF EXISTS `datosaplicacion`;

CREATE TABLE `datosaplicacion` (
  `id_datosAplicacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla Datos Aplicacion',
  `urlAplicacion` varchar(1000) NOT NULL COMMENT 'URL donde se encuentra la aplicacion virtual',
  `usuarioAplicacion` varchar(1000) NOT NULL COMMENT 'Nombre de usuario de la aplicacion Virtual',
  `contrasenaAplicacion` varchar(1000) NOT NULL COMMENT 'Contraseña de la aplicacion Virtual de la Organizacion',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_datosAplicacion`),
  KEY `fk_datosAplicacion_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_datosAplicacion_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='Formulario #10 SIA';

/*Data for the table `datosaplicacion` */

/*Table structure for table `datosbasicosprogramas` */

DROP TABLE IF EXISTS `datosbasicosprogramas`;

CREATE TABLE `datosbasicosprogramas` (
  `id_datosBasicosProgramas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla datos basicos programas',
  `objetivos` longtext NOT NULL COMMENT 'Objetivos del Programa',
  `metodologia` longtext NOT NULL COMMENT 'Metodologia del Programa',
  `materialDidactico` longtext NOT NULL COMMENT 'Material Diactivo del Programa',
  `bibliografia` longtext NOT NULL COMMENT 'Bibliografia que usa el programa',
  `duracionCurso` longtext NOT NULL COMMENT 'Duracion del Curso',
  `eticaValoresPrincipios` longtext,
  `solidaridad` longtext,
  `economia` longtext,
  `economiaSolidaria` longtext,
  `asosiatividadEmprendimiento` longtext,
  `organizacionSolidaria` longtext,
  `trabajoEquipo` longtext,
  `educacionSolidaria` longtext,
  `responsabilidadSocial` longtext,
  `medioAmbiente` longtext,
  `contextoEconomicoSocial` longtext,
  `necesidadesSerHumano` longtext,
  `porqueFomentar` longtext,
  `principiosValoresFines` longtext,
  `marcoNormativo` longtext,
  `tiposOrganizacionesEconomiaSolidaria` longtext,
  `antecedentesHistoricos` longtext,
  `caracteristicasEconomicas` longtext,
  `estructuraInterna` longtext,
  `marcoJuridicoAplicable` longtext,
  `fundamentosAdministrativos` longtext,
  `orientacionElaboracionEstatutos` longtext,
  `unidadAdministrativa` longtext,
  `superintendencia` longtext,
  `fondoGarantias` longtext,
  `consejoNacional` longtext,
  `fondoNacional` longtext,
  `mesasRegionales` longtext,
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_datosBasicosProgramas`),
  KEY `fk_datosBasicosProgramas_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_datosBasicosProgramas_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `datosbasicosprogramas` */

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL COMMENT 'Id Tabla Departamento',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del Municipio de Colombia',
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Departamentos de Colombia';

/*Data for the table `departamentos` */

insert  into `departamentos`(`id_departamento`,`nombre`) values 
(1,'Antioquia'),
(2,'Atlantico'),
(3,'D. C. Santa Fe de Bogotá'),
(4,'Bolivar'),
(5,'Boyaca'),
(6,'Caldas'),
(7,'Caqueta'),
(8,'Cauca'),
(9,'Cesar'),
(10,'Cordova'),
(11,'Cundinamarca'),
(12,'Choco'),
(13,'Huila'),
(14,'La Guajira'),
(15,'Magdalena'),
(16,'Meta'),
(17,'Nariño'),
(18,'Norte de Santander'),
(19,'Quindio'),
(20,'Risaralda'),
(21,'Santander'),
(22,'Sucre'),
(23,'Tolima'),
(24,'Valle'),
(25,'Arauca'),
(26,'Casanare'),
(27,'Putumayo'),
(28,'San Andres'),
(29,'Amazonas'),
(30,'Guainia'),
(31,'Guaviare'),
(32,'Vaupes'),
(33,'Vichada');

/*Table structure for table `docentes` */

DROP TABLE IF EXISTS `docentes`;

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Docente',
  `primerNombreDocente` varchar(1000) NOT NULL COMMENT 'Primer Nombre del Docente',
  `segundoNombreDocente` varchar(1000) DEFAULT NULL COMMENT 'Segundo Nombre del Docente',
  `primerApellidoDocente` varchar(1000) NOT NULL COMMENT 'Primer Apellido del Docente',
  `segundoApellidoDocente` varchar(1000) DEFAULT NULL COMMENT 'Segundo Apellido del Docente',
  `numCedulaCiudadaniaDocente` varchar(1000) NOT NULL COMMENT 'Numero de Cedula de Ciudadania del Docente',
  `profesion` varchar(1000) NOT NULL COMMENT 'Profesion del Docente',
  `horaCapacitacion` varchar(1000) NOT NULL COMMENT 'Horas que tiene el Docente Capacitando',
  `valido` char(1) NOT NULL DEFAULT '0' COMMENT 'Si el docente es Valido 1, Si el Docente no es Valido 0',
  `observacion` varchar(1000) DEFAULT NULL,
  `observacionAnterior` varchar(1000) DEFAULT NULL,
  `organizaciones_id_organizacion` int(11) DEFAULT NULL COMMENT 'FK Id_Organizacion',
  PRIMARY KEY (`id_docente`),
  KEY `fk_docentes_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_docentes_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8 COMMENT='Formulario #9 SIA';

/*Data for the table `docentes` */

/*Table structure for table `documentacionlegal` */

DROP TABLE IF EXISTS `documentacionlegal`;

CREATE TABLE `documentacionlegal` (
  `id_documentacionLegal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la tabla Documentacion Legal',
  `registroEducativo` varchar(1000) NOT NULL DEFAULT '0' COMMENT 'Si tiene o No Tiene Registro Educativo',
  `entidadRegistro` varchar(1000) NOT NULL COMMENT 'Entidad quien registro el Registro Educativo',
  `numeroResolucion` varchar(1000) NOT NULL COMMENT 'Numero de la Resolucion del Registro',
  `fechaResolucion` date NOT NULL COMMENT 'Fecha en la que se expide el Resgistro ',
  `departamentoResolucion` varchar(1000) NOT NULL COMMENT 'Departamento donde se expide la resolucion',
  `municipioResolucion` varchar(1000) NOT NULL COMMENT 'Municipio donde se expide la resolucion',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_documentacionLegal`),
  KEY `fk_documentacionLegal_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_documentacionLegal_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='Formulario # 2 de SIA Documentacion Legal.';

/*Data for the table `documentacionlegal` */

/*Table structure for table `encuesta` */

DROP TABLE IF EXISTS `encuesta`;

CREATE TABLE `encuesta` (
  `idencuesta` int(11) NOT NULL AUTO_INCREMENT,
  `general` varchar(255) NOT NULL,
  `evaluador` varchar(255) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`idencuesta`),
  KEY `fk_encuesta_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_encuesta_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `encuesta` */

/*Table structure for table `historial` */

DROP TABLE IF EXISTS `historial`;

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `personeriaJuridica` varchar(1000) NOT NULL,
  `nombresSeriesAsuntos` varchar(1000) NOT NULL,
  `regional` varchar(1000) NOT NULL,
  `fechaExtremaInicial` date NOT NULL,
  `fechaExtremaFinal` date NOT NULL,
  `caja` varchar(1000) DEFAULT NULL,
  `carpeta` varchar(1000) DEFAULT NULL,
  `tomo` varchar(1000) DEFAULT NULL,
  `otros` varchar(1000) DEFAULT NULL,
  `numeroFolios` varchar(1000) DEFAULT NULL,
  `soporte` varchar(1000) DEFAULT NULL,
  `observaciones` longtext,
  `organizaciones_id_organizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_historial`)
) ENGINE=InnoDB AUTO_INCREMENT=683 DEFAULT CHARSET=utf8;

/*Data for the table `historial` */

/*Table structure for table `historialpersonascapacitadas` */

DROP TABLE IF EXISTS `historialpersonascapacitadas`;

CREATE TABLE `historialpersonascapacitadas` (
  `idhistorialPersonasCapacitadas` int(11) NOT NULL,
  `NIT` varchar(255) DEFAULT NULL,
  `nombreOrganizacion` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  `departamentoSede` varchar(45) DEFAULT NULL,
  `semestre` int(1) DEFAULT NULL,
  `año` int(4) DEFAULT NULL,
  `hombres` int(11) DEFAULT NULL,
  `mujeres` int(11) DEFAULT NULL,
  `5-18` int(11) DEFAULT NULL,
  `18-29` int(11) DEFAULT NULL,
  `27-40` int(11) DEFAULT NULL,
  `41-60` int(11) DEFAULT NULL,
  `61` int(11) DEFAULT NULL,
  `noResponde` int(11) DEFAULT NULL,
  PRIMARY KEY (`idhistorialPersonasCapacitadas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `historialpersonascapacitadas` */

/*Table structure for table `historialresoluciones` */

DROP TABLE IF EXISTS `historialresoluciones`;

CREATE TABLE `historialresoluciones` (
  `id_historialResoluciones` int(11) NOT NULL AUTO_INCREMENT,
  `fechaResolucionInicial` date DEFAULT NULL,
  `fechaResolucionFinal` date DEFAULT NULL,
  `añosResolucion` int(11) DEFAULT NULL,
  `resolucion` varchar(1000) DEFAULT NULL,
  `numeroResolucion` varchar(1000) DEFAULT NULL,
  `tipoResolucion` varchar(1000) DEFAULT '-',
  `historial_id_historial` int(11) NOT NULL,
  PRIMARY KEY (`id_historialResoluciones`),
  KEY `fk_historialResoluciones_historial1_idx` (`historial_id_historial`),
  CONSTRAINT `fk_historialResoluciones_historial1` FOREIGN KEY (`historial_id_historial`) REFERENCES `historial` (`id_historial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=694 DEFAULT CHARSET=utf8;

/*Data for the table `historialresoluciones` */

/*Table structure for table `informaciongeneral` */

DROP TABLE IF EXISTS `informaciongeneral`;

CREATE TABLE `informaciongeneral` (
  `id_informacionGeneral` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla informacion general',
  `tipoOrganizacion` varchar(1000) NOT NULL COMMENT 'Tipo organizacion Select Option: Asociación\\nAsociación Mutual\\nCooperativa de Trabajo Asociado\\nCooperativa Especializada\\nCooperativa Integral\\nCooperativa Multiactiva\\nCorporación\\nEmpresa asociativa de trabajo\\nEmpresa Comunitaria\\nEmpresa de servicios en forma de administración pública\\nEmpresa Solidaria de Salud\\nFederación y Confederación\\nFondo de empleados\\nFundación\\nInstitución Universitaria\\nInstituciones auxiliares de Economía Solidaria\\nPrecooperativa',
  `direccionOrganizacion` varchar(1000) NOT NULL COMMENT 'Direccion de la Organizacion',
  `nomDepartamentoUbicacion` varchar(1000) NOT NULL COMMENT 'Nombre del departamento de la organizacion',
  `nomMunicipioNacional` varchar(1000) NOT NULL COMMENT 'Nombre del municipio de la organizacion',
  `fax` varchar(1000) NOT NULL COMMENT 'Numero de Fax - Telefono de la organizacion',
  `extension` varchar(1000) NOT NULL DEFAULT 'No Tiene' COMMENT 'Si tiene alguna extension ',
  `urlOrganizacion` varchar(1000) NOT NULL DEFAULT 'No Tiene' COMMENT 'La pagina web URL de la organizacion',
  `actuacionOrganizacion` varchar(1000) NOT NULL COMMENT 'Actuacion de la Organizacion Select Option: Departamental\\nMunicipal\\nNacional\\nRegional',
  `tipoEducacion` varchar(1000) NOT NULL COMMENT 'Tipo de Educacion de la Organizacion Select Option: Educacion para el trabajo y el desarrollo humano\\nFormal\\nInformal',
  `numCedulaCiudadaniaPersona` varchar(1000) NOT NULL COMMENT 'Numero de Cedula del Representante Legal',
  `presentacionInstitucional` longtext COMMENT 'Presentacion de la Organizacion Texto',
  `objetoSocialEstatutos` longtext COMMENT 'Objeto Social de la Organizacion Texto',
  `mision` longtext COMMENT 'MIsion de la Organizacion Texto',
  `vision` longtext COMMENT 'Vision de la Organizacion Texto',
  `principios` longtext COMMENT 'Principios de la Organizacion Texto',
  `fines` longtext COMMENT 'Fines de la Organizacion Texto',
  `portafolio` longtext COMMENT 'Portafolio de la Organizacion Texto',
  `otros` longtext COMMENT 'Otros Puede ingresar otra cosa dependiendo del caso Texto',
  `fecha` datetime NOT NULL COMMENT 'Fecha en la se que registro la infomacion',
  `organizaciones_id_organizacion` int(11) NOT NULL COMMENT 'FK de la Id_Organizacion',
  PRIMARY KEY (`id_informacionGeneral`),
  KEY `fk_informacionGeneral_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_informacionGeneral_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COMMENT='Formulario # 1 de SIA Informacion General.';

/*Data for the table `informaciongeneral` */

/*Table structure for table `informeactividades` */

DROP TABLE IF EXISTS `informeactividades`;

CREATE TABLE `informeactividades` (
  `id_informeActividades` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCurso` varchar(1000) NOT NULL COMMENT 'Nombre del Curso Impartido',
  `numeroAsistentes` int(11) NOT NULL COMMENT 'Numero de Asistentes al Curso',
  `duracionCurso` int(11) NOT NULL COMMENT 'Duracion del Curso en Horas',
  `tipoCurso` varchar(1000) NOT NULL COMMENT 'Tipo del Curso realizado',
  `numeroMujeres` int(11) NOT NULL COMMENT 'Numero de mujeres',
  `numeroHombres` int(11) NOT NULL COMMENT 'Numero de Hombres',
  `fechaCurso` date NOT NULL COMMENT 'Fecha cuando se realizo el Curso',
  `fechaIngresoCurso` date NOT NULL COMMENT 'Fecha de Guardado del Curso',
  `enUnionCon` varchar(1000) NOT NULL DEFAULT 'Ninguna',
  `intencionalidadCurso` varchar(1000) NOT NULL,
  `cursoGratis` char(1) NOT NULL DEFAULT '0',
  `departamentoCurso` varchar(1000) NOT NULL,
  `municipioCurso` varchar(100) NOT NULL,
  `nombreDocente` varchar(1000) DEFAULT NULL,
  `archivoAsistentes` varchar(1000) DEFAULT NULL,
  `archivoAsistencia` varchar(1000) DEFAULT NULL,
  `docentes_id_docente` int(11) NOT NULL COMMENT 'FK id_docentes',
  `organizaciones_id_organizacion` int(11) NOT NULL,
  PRIMARY KEY (`id_informeActividades`),
  KEY `fk_informeActividades_docentes1_idx` (`docentes_id_docente`),
  KEY `fk_informeActividades_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_informeActividades_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Se guardan los Informes de las Actividades de las Organizaciones.';

/*Data for the table `informeactividades` */

/*Table structure for table `jornadasactualizacion` */

DROP TABLE IF EXISTS `jornadasactualizacion`;

CREATE TABLE `jornadasactualizacion` (
  `id_jornadasActualizacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Jornadas de Actualziacion',
  `numeroPersonas` varchar(1000) DEFAULT '0' COMMENT 'Numero de Personas a las que asistieron',
  `fechaAsistencia` date DEFAULT '1900-01-01' COMMENT 'Fecha de asistencia',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_jornadasActualizacion`),
  KEY `fk_jornadasActualizacion_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_jornadasActualizacion_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='Formulario #5 de SIA';

/*Data for the table `jornadasactualizacion` */

/*Table structure for table `municipios` */

DROP TABLE IF EXISTS `municipios`;

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL COMMENT 'Id Tabla Municipio',
  `nombreMunicipio` varchar(45) NOT NULL COMMENT 'Nombre del Municipio de Colombia',
  `departamentos_id_departamento` int(11) NOT NULL COMMENT 'Fk Id_Departamento',
  PRIMARY KEY (`id_municipio`),
  KEY `fk_municipios_departamentos1_idx` (`departamentos_id_departamento`),
  CONSTRAINT `fk_municipios_departamentos1` FOREIGN KEY (`departamentos_id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de Municipios de Colombia';

/*Data for the table `municipios` */

insert  into `municipios`(`id_municipio`,`nombreMunicipio`,`departamentos_id_departamento`) values 
(1,'EL ENCANTO',1),
(2,'LA CHORRERA',1),
(3,'LA PEDRERA',1),
(4,'LA VICTORIA',1),
(5,'LETICIA',1),
(6,'MIRITI',1),
(7,'PUERTO ALEGRIA',1),
(8,'PUERTO ARICA',1),
(9,'PUERTO NARIÑO',1),
(10,'PUERTO SANTANDER',1),
(11,'TURAPACA',1),
(12,'ABEJORRAL',2),
(13,'ABRIAQUI',2),
(14,'ALEJANDRIA',2),
(15,'AMAGA',2),
(16,'AMALFI',2),
(17,'ANDES',2),
(18,'ANGELOPOLIS',2),
(19,'ANGOSTURA',2),
(20,'ANORI',2),
(21,'ANTIOQUIA',2),
(22,'ANZA',2),
(23,'APARTADO',2),
(24,'ARBOLETES',2),
(25,'ARGELIA',2),
(26,'ARMENIA',2),
(27,'BARBOSA',2),
(28,'BELLO',2),
(29,'BELMIRA',2),
(30,'BETANIA',2),
(31,'BETULIA',2),
(32,'BOLIVAR',2),
(33,'BRICEÑO',2),
(34,'BURITICA',2),
(35,'CACERES',2),
(36,'CAICEDO',2),
(37,'CALDAS',2),
(38,'CAMPAMENTO',2),
(39,'CANASGORDAS',2),
(40,'CARACOLI',2),
(41,'CARAMANTA',2),
(42,'CAREPA',2),
(43,'CARMEN DE VIBORAL',2),
(44,'CAROLINA DEL PRINCIPE',2),
(45,'CAUCASIA',2),
(46,'CHIGORODO',2),
(47,'CISNEROS',2),
(48,'COCORNA',2),
(49,'CONCEPCION',2),
(50,'CONCORDIA',2),
(51,'COPACABANA',2),
(52,'DABEIBA',2),
(53,'DONMATIAS',2),
(54,'EBEJICO',2),
(55,'EL BAGRE',2),
(56,'EL PENOL',2),
(57,'EL RETIRO',2),
(58,'ENTRERRIOS',2),
(59,'ENVIGADO',2),
(60,'FREDONIA',2),
(61,'FRONTINO',2),
(62,'GIRALDO',2),
(63,'GIRARDOTA',2),
(64,'GOMEZ PLATA',2),
(65,'GRANADA',2),
(66,'GUADALUPE',2),
(67,'GUARNE',2),
(68,'GUATAQUE',2),
(69,'HELICONIA',2),
(70,'HISPANIA',2),
(71,'ITAGUI',2),
(72,'ITUANGO',2),
(73,'JARDIN',2),
(74,'JERICO',2),
(75,'LA CEJA',2),
(76,'LA ESTRELLA',2),
(77,'LA PINTADA',2),
(78,'LA UNION',2),
(79,'LIBORINA',2),
(80,'MACEO',2),
(81,'MARINILLA',2),
(82,'MEDELLIN',2),
(83,'MONTEBELLO',2),
(84,'MURINDO',2),
(85,'MUTATA',2),
(86,'NARINO',2),
(87,'NECHI',2),
(88,'NECOCLI',2),
(89,'OLAYA',2),
(90,'PEQUE',2),
(91,'PUEBLORRICO',2),
(92,'PUERTO BERRIO',2),
(93,'PUERTO NARE',2),
(94,'PUERTO TRIUNFO',2),
(95,'REMEDIOS',2),
(96,'RIONEGRO',2),
(97,'SABANALARGA',2),
(98,'SABANETA',2),
(99,'SALGAR',2),
(100,'SAN ANDRES DE CUERQUIA',2),
(101,'SAN CARLOS',2),
(102,'SAN FRANCISCO',2),
(103,'SAN JERONIMO',2),
(104,'SAN JOSE DE LA MONTAÑA',2),
(105,'SAN JUAN DE URABA',2),
(106,'SAN LUIS',2),
(107,'SAN PEDRO DE LOS MILAGROS',2),
(108,'SAN PEDRO DE URABA',2),
(109,'SAN RAFAEL',2),
(110,'SAN ROQUE',2),
(111,'SAN VICENTE',2),
(112,'SANTA BARBARA',2),
(113,'SANTA ROSA DE OSOS',2),
(114,'SANTO DOMINGO',2),
(115,'SANTUARIO',2),
(116,'SEGOVIA',2),
(117,'SONSON',2),
(118,'SOPETRAN',2),
(119,'TAMESIS',2),
(120,'TARAZA',2),
(121,'TARSO',2),
(122,'TITIRIBI',2),
(123,'TOLEDO',2),
(124,'TURBO',2),
(125,'URAMITA',2),
(126,'URRAO',2),
(127,'VALDIVIA',2),
(128,'VALPARAISO',2),
(129,'VEGACHI',2),
(130,'VENECIA',2),
(131,'VIGIA DEL FUERTE',2),
(132,'YALI',2),
(133,'YARUMAL',2),
(134,'YOLOMBO',2),
(135,'YONDO',2),
(136,'ZARAGOZA',2),
(137,'ARAUCA',3),
(138,'ARAUQUITA',3),
(139,'CRAVO NORTE',3),
(140,'FORTUL',3),
(141,'PUERTO RONDON',3),
(142,'SARAVENA',3),
(143,'TAME',3),
(144,'BARANOA',4),
(145,'BARRANQUILLA',4),
(146,'CAMPO DE LA CRUZ',4),
(147,'CANDELARIA',4),
(148,'GALAPA',4),
(149,'JUAN DE ACOSTA',4),
(150,'LURUACO',4),
(151,'MALAMBO',4),
(152,'MANATI',4),
(153,'PALMAR DE VARELA',4),
(154,'PIOJO',4),
(155,'POLO NUEVO',4),
(156,'PONEDERA',4),
(157,'PUERTO COLOMBIA',4),
(158,'REPELON',4),
(159,'SABANAGRANDE',4),
(160,'SABANALARGA',4),
(161,'SANTA LUCIA',4),
(162,'SANTO TOMAS',4),
(163,'SOLEDAD',4),
(164,'SUAN',4),
(165,'TUBARA',4),
(166,'USIACURI',4),
(167,'ACHI',5),
(168,'ALTOS DEL ROSARIO',5),
(169,'ARENAL',5),
(170,'ARJONA',5),
(171,'ARROYOHONDO',5),
(172,'BARRANCO DE LOBA',5),
(173,'BRAZUELO DE PAPAYAL',5),
(174,'CALAMAR',5),
(175,'CANTAGALLO',5),
(176,'CARTAGENA DE INDIAS',5),
(177,'CICUCO',5),
(178,'CLEMENCIA',5),
(179,'CORDOBA',5),
(180,'EL CARMEN DE BOLIVAR',5),
(181,'EL GUAMO',5),
(182,'EL PENION',5),
(183,'HATILLO DE LOBA',5),
(184,'MAGANGUE',5),
(185,'MAHATES',5),
(186,'MARGARITA',5),
(187,'MARIA LA BAJA',5),
(188,'MONTECRISTO',5),
(189,'MORALES',5),
(190,'MORALES',5),
(191,'NOROSI',5),
(192,'PINILLOS',5),
(193,'REGIDOR',5),
(194,'RIO VIEJO',5),
(195,'SAN CRISTOBAL',5),
(196,'SAN ESTANISLAO',5),
(197,'SAN FERNANDO',5),
(198,'SAN JACINTO',5),
(199,'SAN JACINTO DEL CAUCA',5),
(200,'SAN JUAN DE NEPOMUCENO',5),
(201,'SAN MARTIN DE LOBA',5),
(202,'SAN PABLO',5),
(203,'SAN PABLO NORTE',5),
(204,'SANTA CATALINA',5),
(205,'SANTA CRUZ DE MOMPOX',5),
(206,'SANTA ROSA',5),
(207,'SANTA ROSA DEL SUR',5),
(208,'SIMITI',5),
(209,'SOPLAVIENTO',5),
(210,'TALAIGUA NUEVO',5),
(211,'TUQUISIO',5),
(212,'TURBACO',5),
(213,'TURBANA',5),
(214,'VILLANUEVA',5),
(215,'ZAMBRANO',5),
(216,'AQUITANIA',6),
(217,'ARCABUCO',6),
(218,'BELÉN',6),
(219,'BERBEO',6),
(220,'BETÉITIVA',6),
(221,'BOAVITA',6),
(222,'BOYACÁ',6),
(223,'BRICEÑO',6),
(224,'BUENAVISTA',6),
(225,'BUSBANZÁ',6),
(226,'CALDAS',6),
(227,'CAMPO HERMOSO',6),
(228,'CERINZA',6),
(229,'CHINAVITA',6),
(230,'CHIQUINQUIRÁ',6),
(231,'CHÍQUIZA',6),
(232,'CHISCAS',6),
(233,'CHITA',6),
(234,'CHITARAQUE',6),
(235,'CHIVATÁ',6),
(236,'CIÉNEGA',6),
(237,'CÓMBITA',6),
(238,'COPER',6),
(239,'CORRALES',6),
(240,'COVARACHÍA',6),
(241,'CUBARA',6),
(242,'CUCAITA',6),
(243,'CUITIVA',6),
(244,'DUITAMA',6),
(245,'EL COCUY',6),
(246,'EL ESPINO',6),
(247,'FIRAVITOBA',6),
(248,'FLORESTA',6),
(249,'GACHANTIVÁ',6),
(250,'GÁMEZA',6),
(251,'GARAGOA',6),
(252,'GUACAMAYAS',6),
(253,'GÜICÁN',6),
(254,'IZA',6),
(255,'JENESANO',6),
(256,'JERICÓ',6),
(257,'LA UVITA',6),
(258,'LA VICTORIA',6),
(259,'LABRANZA GRANDE',6),
(260,'MACANAL',6),
(261,'MARIPÍ',6),
(262,'MIRAFLORES',6),
(263,'MONGUA',6),
(264,'MONGUÍ',6),
(265,'MONIQUIRÁ',6),
(266,'MOTAVITA',6),
(267,'MUZO',6),
(268,'NOBSA',6),
(269,'NUEVO COLÓN',6),
(270,'OICATÁ',6),
(271,'OTANCHE',6),
(272,'PACHAVITA',6),
(273,'PÁEZ',6),
(274,'PAIPA',6),
(275,'PAJARITO',6),
(276,'PANQUEBA',6),
(277,'PAUNA',6),
(278,'PAYA',6),
(279,'PAZ DE RÍO',6),
(280,'PESCA',6),
(281,'PISBA',6),
(282,'PUERTO BOYACA',6),
(283,'QUÍPAMA',6),
(284,'RAMIRIQUÍ',6),
(285,'RÁQUIRA',6),
(286,'RONDÓN',6),
(287,'SABOYÁ',6),
(288,'SÁCHICA',6),
(289,'SAMACÁ',6),
(290,'SAN EDUARDO',6),
(291,'SAN JOSÉ DE PARE',6),
(292,'SAN LUÍS DE GACENO',6),
(293,'SAN MATEO',6),
(294,'SAN MIGUEL DE SEMA',6),
(295,'SAN PABLO DE BORBUR',6),
(296,'SANTA MARÍA',6),
(297,'SANTA ROSA DE VITERBO',6),
(298,'SANTA SOFÍA',6),
(299,'SANTANA',6),
(300,'SATIVANORTE',6),
(301,'SATIVASUR',6),
(302,'SIACHOQUE',6),
(303,'SOATÁ',6),
(304,'SOCHA',6),
(305,'SOCOTÁ',6),
(306,'SOGAMOSO',6),
(307,'SORA',6),
(308,'SORACÁ',6),
(309,'SOTAQUIRÁ',6),
(310,'SUSACÓN',6),
(311,'SUTARMACHÁN',6),
(312,'TASCO',6),
(313,'TIBANÁ',6),
(314,'TIBASOSA',6),
(315,'TINJACÁ',6),
(316,'TIPACOQUE',6),
(317,'TOCA',6),
(318,'TOGÜÍ',6),
(319,'TÓPAGA',6),
(320,'TOTA',6),
(321,'TUNJA',6),
(322,'TUNUNGUÁ',6),
(323,'TURMEQUÉ',6),
(324,'TUTA',6),
(325,'TUTAZÁ',6),
(326,'UMBITA',6),
(327,'VENTA QUEMADA',6),
(328,'VILLA DE LEYVA',6),
(329,'VIRACACHÁ',6),
(330,'ZETAQUIRA',6),
(331,'AGUADAS',7),
(332,'ANSERMA',7),
(333,'ARANZAZU',7),
(334,'BELALCAZAR',7),
(335,'CHINCHINÁ',7),
(336,'FILADELFIA',7),
(337,'LA DORADA',7),
(338,'LA MERCED',7),
(339,'MANIZALES',7),
(340,'MANZANARES',7),
(341,'MARMATO',7),
(342,'MARQUETALIA',7),
(343,'MARULANDA',7),
(344,'NEIRA',7),
(345,'NORCASIA',7),
(346,'PACORA',7),
(347,'PALESTINA',7),
(348,'PENSILVANIA',7),
(349,'RIOSUCIO',7),
(350,'RISARALDA',7),
(351,'SALAMINA',7),
(352,'SAMANA',7),
(353,'SAN JOSE',7),
(354,'SUPÍA',7),
(355,'VICTORIA',7),
(356,'VILLAMARÍA',7),
(357,'VITERBO',7),
(358,'ALBANIA',8),
(359,'BELÉN ANDAQUIES',8),
(360,'CARTAGENA DEL CHAIRA',8),
(361,'CURILLO',8),
(362,'EL DONCELLO',8),
(363,'EL PAUJIL',8),
(364,'FLORENCIA',8),
(365,'LA MONTAÑITA',8),
(366,'MILÁN',8),
(367,'MORELIA',8),
(368,'PUERTO RICO',8),
(369,'SAN  VICENTE DEL CAGUAN',8),
(370,'SAN JOSÉ DE FRAGUA',8),
(371,'SOLANO',8),
(372,'SOLITA',8),
(373,'VALPARAÍSO',8),
(374,'AGUAZUL',9),
(375,'CHAMEZA',9),
(376,'HATO COROZAL',9),
(377,'LA SALINA',9),
(378,'MANÍ',9),
(379,'MONTERREY',9),
(380,'NUNCHIA',9),
(381,'OROCUE',9),
(382,'PAZ DE ARIPORO',9),
(383,'PORE',9),
(384,'RECETOR',9),
(385,'SABANA LARGA',9),
(386,'SACAMA',9),
(387,'SAN LUIS DE PALENQUE',9),
(388,'TAMARA',9),
(389,'TAURAMENA',9),
(390,'TRINIDAD',9),
(391,'VILLANUEVA',9),
(392,'YOPAL',9),
(393,'ALMAGUER',10),
(394,'ARGELIA',10),
(395,'BALBOA',10),
(396,'BOLÍVAR',10),
(397,'BUENOS AIRES',10),
(398,'CAJIBIO',10),
(399,'CALDONO',10),
(400,'CALOTO',10),
(401,'CORINTO',10),
(402,'EL TAMBO',10),
(403,'FLORENCIA',10),
(404,'GUAPI',10),
(405,'INZA',10),
(406,'JAMBALÓ',10),
(407,'LA SIERRA',10),
(408,'LA VEGA',10),
(409,'LÓPEZ',10),
(410,'MERCADERES',10),
(411,'MIRANDA',10),
(412,'MORALES',10),
(413,'PADILLA',10),
(414,'PÁEZ',10),
(415,'PATIA (EL BORDO)',10),
(416,'PIAMONTE',10),
(417,'PIENDAMO',10),
(418,'POPAYÁN',10),
(419,'PUERTO TEJADA',10),
(420,'PURACE',10),
(421,'ROSAS',10),
(422,'SAN SEBASTIÁN',10),
(423,'SANTA ROSA',10),
(424,'SANTANDER DE QUILICHAO',10),
(425,'SILVIA',10),
(426,'SOTARA',10),
(427,'SUÁREZ',10),
(428,'SUCRE',10),
(429,'TIMBÍO',10),
(430,'TIMBIQUÍ',10),
(431,'TORIBIO',10),
(432,'TOTORO',10),
(433,'VILLA RICA',10),
(434,'AGUACHICA',11),
(435,'AGUSTÍN CODAZZI',11),
(436,'ASTREA',11),
(437,'BECERRIL',11),
(438,'BOSCONIA',11),
(439,'CHIMICHAGUA',11),
(440,'CHIRIGUANÁ',11),
(441,'CURUMANÍ',11),
(442,'EL COPEY',11),
(443,'EL PASO',11),
(444,'GAMARRA',11),
(445,'GONZÁLEZ',11),
(446,'LA GLORIA',11),
(447,'LA JAGUA IBIRICO',11),
(448,'MANAURE BALCÓN DEL CESAR',11),
(449,'PAILITAS',11),
(450,'PELAYA',11),
(451,'PUEBLO BELLO',11),
(452,'RÍO DE ORO',11),
(453,'ROBLES (LA PAZ)',11),
(454,'SAN ALBERTO',11),
(455,'SAN DIEGO',11),
(456,'SAN MARTÍN',11),
(457,'TAMALAMEQUE',11),
(458,'VALLEDUPAR',11),
(459,'ACANDI',12),
(460,'ALTO BAUDO (PIE DE PATO)',12),
(461,'ATRATO',12),
(462,'BAGADO',12),
(463,'BAHIA SOLANO (MUTIS)',12),
(464,'BAJO BAUDO (PIZARRO)',12),
(465,'BOJAYA (BELLAVISTA)',12),
(466,'CANTON DE SAN PABLO',12),
(467,'CARMEN DEL DARIEN',12),
(468,'CERTEGUI',12),
(469,'CONDOTO',12),
(470,'EL CARMEN',12),
(471,'ISTMINA',12),
(472,'JURADO',12),
(473,'LITORAL DEL SAN JUAN',12),
(474,'LLORO',12),
(475,'MEDIO ATRATO',12),
(476,'MEDIO BAUDO (BOCA DE PEPE)',12),
(477,'MEDIO SAN JUAN',12),
(478,'NOVITA',12),
(479,'NUQUI',12),
(480,'QUIBDO',12),
(481,'RIO IRO',12),
(482,'RIO QUITO',12),
(483,'RIOSUCIO',12),
(484,'SAN JOSE DEL PALMAR',12),
(485,'SIPI',12),
(486,'TADO',12),
(487,'UNGUIA',12),
(488,'UNIÓN PANAMERICANA',12),
(489,'AYAPEL',13),
(490,'BUENAVISTA',13),
(491,'CANALETE',13),
(492,'CERETÉ',13),
(493,'CHIMA',13),
(494,'CHINÚ',13),
(495,'CIENAGA DE ORO',13),
(496,'COTORRA',13),
(497,'LA APARTADA',13),
(498,'LORICA',13),
(499,'LOS CÓRDOBAS',13),
(500,'MOMIL',13),
(501,'MONTELÍBANO',13),
(502,'MONTERÍA',13),
(503,'MOÑITOS',13),
(504,'PLANETA RICA',13),
(505,'PUEBLO NUEVO',13),
(506,'PUERTO ESCONDIDO',13),
(507,'PUERTO LIBERTADOR',13),
(508,'PURÍSIMA',13),
(509,'SAHAGÚN',13),
(510,'SAN ANDRÉS SOTAVENTO',13),
(511,'SAN ANTERO',13),
(512,'SAN BERNARDO VIENTO',13),
(513,'SAN CARLOS',13),
(514,'SAN PELAYO',13),
(515,'TIERRALTA',13),
(516,'VALENCIA',13),
(517,'AGUA DE DIOS',14),
(518,'ALBAN',14),
(519,'ANAPOIMA',14),
(520,'ANOLAIMA',14),
(521,'ARBELAEZ',14),
(522,'BELTRÁN',14),
(523,'BITUIMA',14),
(524,'BOGOTÁ DC',14),
(525,'BOJACÁ',14),
(526,'CABRERA',14),
(527,'CACHIPAY',14),
(528,'CAJICÁ',14),
(529,'CAPARRAPÍ',14),
(530,'CAQUEZA',14),
(531,'CARMEN DE CARUPA',14),
(532,'CHAGUANÍ',14),
(533,'CHIA',14),
(534,'CHIPAQUE',14),
(535,'CHOACHÍ',14),
(536,'CHOCONTÁ',14),
(537,'COGUA',14),
(538,'COTA',14),
(539,'CUCUNUBÁ',14),
(540,'EL COLEGIO',14),
(541,'EL PEÑÓN',14),
(542,'EL ROSAL1',14),
(543,'FACATATIVA',14),
(544,'FÓMEQUE',14),
(545,'FOSCA',14),
(546,'FUNZA',14),
(547,'FÚQUENE',14),
(548,'FUSAGASUGA',14),
(549,'GACHALÁ',14),
(550,'GACHANCIPÁ',14),
(551,'GACHETA',14),
(552,'GAMA',14),
(553,'GIRARDOT',14),
(554,'GRANADA2',14),
(555,'GUACHETÁ',14),
(556,'GUADUAS',14),
(557,'GUASCA',14),
(558,'GUATAQUÍ',14),
(559,'GUATAVITA',14),
(560,'GUAYABAL DE SIQUIMA',14),
(561,'GUAYABETAL',14),
(562,'GUTIÉRREZ',14),
(563,'JERUSALÉN',14),
(564,'JUNÍN',14),
(565,'LA CALERA',14),
(566,'LA MESA',14),
(567,'LA PALMA',14),
(568,'LA PEÑA',14),
(569,'LA VEGA',14),
(570,'LENGUAZAQUE',14),
(571,'MACHETÁ',14),
(572,'MADRID',14),
(573,'MANTA',14),
(574,'MEDINA',14),
(575,'MOSQUERA',14),
(576,'NARIÑO',14),
(577,'NEMOCÓN',14),
(578,'NILO',14),
(579,'NIMAIMA',14),
(580,'NOCAIMA',14),
(581,'OSPINA PÉREZ',14),
(582,'PACHO',14),
(583,'PAIME',14),
(584,'PANDI',14),
(585,'PARATEBUENO',14),
(586,'PASCA',14),
(587,'PUERTO SALGAR',14),
(588,'PULÍ',14),
(589,'QUEBRADANEGRA',14),
(590,'QUETAME',14),
(591,'QUIPILE',14),
(592,'RAFAEL REYES',14),
(593,'RICAURTE',14),
(594,'SAN  ANTONIO DEL  TEQUENDAMA',14),
(595,'SAN BERNARDO',14),
(596,'SAN CAYETANO',14),
(597,'SAN FRANCISCO',14),
(598,'SAN JUAN DE RIOSECO',14),
(599,'SASAIMA',14),
(600,'SESQUILÉ',14),
(601,'SIBATÉ',14),
(602,'SILVANIA',14),
(603,'SIMIJACA',14),
(604,'SOACHA',14),
(605,'SOPO',14),
(606,'SUBACHOQUE',14),
(607,'SUESCA',14),
(608,'SUPATÁ',14),
(609,'SUSA',14),
(610,'SUTATAUSA',14),
(611,'TABIO',14),
(612,'TAUSA',14),
(613,'TENA',14),
(614,'TENJO',14),
(615,'TIBACUY',14),
(616,'TIBIRITA',14),
(617,'TOCAIMA',14),
(618,'TOCANCIPÁ',14),
(619,'TOPAIPÍ',14),
(620,'UBALÁ',14),
(621,'UBAQUE',14),
(622,'UBATÉ',14),
(623,'UNE',14),
(624,'UTICA',14),
(625,'VERGARA',14),
(626,'VIANI',14),
(627,'VILLA GOMEZ',14),
(628,'VILLA PINZÓN',14),
(629,'VILLETA',14),
(630,'VIOTA',14),
(631,'YACOPÍ',14),
(632,'ZIPACÓN',14),
(633,'ZIPAQUIRÁ',14),
(634,'BARRANCO MINAS',15),
(635,'CACAHUAL',15),
(636,'INÍRIDA',15),
(637,'LA GUADALUPE',15),
(638,'MAPIRIPANA',15),
(639,'MORICHAL',15),
(640,'PANA PANA',15),
(641,'PUERTO COLOMBIA',15),
(642,'SAN FELIPE',15),
(643,'CALAMAR',16),
(644,'EL RETORNO',16),
(645,'MIRAFLOREZ',16),
(646,'SAN JOSÉ DEL GUAVIARE',16),
(647,'ACEVEDO',17),
(648,'AGRADO',17),
(649,'AIPE',17),
(650,'ALGECIRAS',17),
(651,'ALTAMIRA',17),
(652,'BARAYA',17),
(653,'CAMPO ALEGRE',17),
(654,'COLOMBIA',17),
(655,'ELIAS',17),
(656,'GARZÓN',17),
(657,'GIGANTE',17),
(658,'GUADALUPE',17),
(659,'HOBO',17),
(660,'IQUIRA',17),
(661,'ISNOS',17),
(662,'LA ARGENTINA',17),
(663,'LA PLATA',17),
(664,'NATAGA',17),
(665,'NEIVA',17),
(666,'OPORAPA',17),
(667,'PAICOL',17),
(668,'PALERMO',17),
(669,'PALESTINA',17),
(670,'PITAL',17),
(671,'PITALITO',17),
(672,'RIVERA',17),
(673,'SALADO BLANCO',17),
(674,'SAN AGUSTÍN',17),
(675,'SANTA MARIA',17),
(676,'SUAZA',17),
(677,'TARQUI',17),
(678,'TELLO',17),
(679,'TERUEL',17),
(680,'TESALIA',17),
(681,'TIMANA',17),
(682,'VILLAVIEJA',17),
(683,'YAGUARA',17),
(684,'ALBANIA',18),
(685,'BARRANCAS',18),
(686,'DIBULLA',18),
(687,'DISTRACCIÓN',18),
(688,'EL MOLINO',18),
(689,'FONSECA',18),
(690,'HATO NUEVO',18),
(691,'LA JAGUA DEL PILAR',18),
(692,'MAICAO',18),
(693,'MANAURE',18),
(694,'RIOHACHA',18),
(695,'SAN JUAN DEL CESAR',18),
(696,'URIBIA',18),
(697,'URUMITA',18),
(698,'VILLANUEVA',18),
(699,'ALGARROBO',19),
(700,'ARACATACA',19),
(701,'ARIGUANI',19),
(702,'CERRO SAN ANTONIO',19),
(703,'CHIVOLO',19),
(704,'CIENAGA',19),
(705,'CONCORDIA',19),
(706,'EL BANCO',19),
(707,'EL PIÑON',19),
(708,'EL RETEN',19),
(709,'FUNDACION',19),
(710,'GUAMAL',19),
(711,'NUEVA GRANADA',19),
(712,'PEDRAZA',19),
(713,'PIJIÑO DEL CARMEN',19),
(714,'PIVIJAY',19),
(715,'PLATO',19),
(716,'PUEBLO VIEJO',19),
(717,'REMOLINO',19),
(718,'SABANAS DE SAN ANGEL',19),
(719,'SALAMINA',19),
(720,'SAN SEBASTIAN DE BUENAVISTA',19),
(721,'SAN ZENON',19),
(722,'SANTA ANA',19),
(723,'SANTA BARBARA DE PINTO',19),
(724,'SANTA MARTA',19),
(725,'SITIONUEVO',19),
(726,'TENERIFE',19),
(727,'ZAPAYAN',19),
(728,'ZONA BANANERA',19),
(729,'ACACIAS',20),
(730,'BARRANCA DE UPIA',20),
(731,'CABUYARO',20),
(732,'CASTILLA LA NUEVA',20),
(733,'CUBARRAL',20),
(734,'CUMARAL',20),
(735,'EL CALVARIO',20),
(736,'EL CASTILLO',20),
(737,'EL DORADO',20),
(738,'FUENTE DE ORO',20),
(739,'GRANADA',20),
(740,'GUAMAL',20),
(741,'LA MACARENA',20),
(742,'LA URIBE',20),
(743,'LEJANÍAS',20),
(744,'MAPIRIPÁN',20),
(745,'MESETAS',20),
(746,'PUERTO CONCORDIA',20),
(747,'PUERTO GAITÁN',20),
(748,'PUERTO LLERAS',20),
(749,'PUERTO LÓPEZ',20),
(750,'PUERTO RICO',20),
(751,'RESTREPO',20),
(752,'SAN  JUAN DE ARAMA',20),
(753,'SAN CARLOS GUAROA',20),
(754,'SAN JUANITO',20),
(755,'SAN MARTÍN',20),
(756,'VILLAVICENCIO',20),
(757,'VISTA HERMOSA',20),
(758,'ALBAN',21),
(759,'ALDAÑA',21),
(760,'ANCUYA',21),
(761,'ARBOLEDA',21),
(762,'BARBACOAS',21),
(763,'BELEN',21),
(764,'BUESACO',21),
(765,'CHACHAGUI',21),
(766,'COLON (GENOVA)',21),
(767,'CONSACA',21),
(768,'CONTADERO',21),
(769,'CORDOBA',21),
(770,'CUASPUD',21),
(771,'CUMBAL',21),
(772,'CUMBITARA',21),
(773,'EL CHARCO',21),
(774,'EL PEÑOL',21),
(775,'EL ROSARIO',21),
(776,'EL TABLÓN',21),
(777,'EL TAMBO',21),
(778,'FUNES',21),
(779,'GUACHUCAL',21),
(780,'GUAITARILLA',21),
(781,'GUALMATAN',21),
(782,'ILES',21),
(783,'IMUES',21),
(784,'IPIALES',21),
(785,'LA CRUZ',21),
(786,'LA FLORIDA',21),
(787,'LA LLANADA',21),
(788,'LA TOLA',21),
(789,'LA UNION',21),
(790,'LEIVA',21),
(791,'LINARES',21),
(792,'LOS ANDES',21),
(793,'MAGUI',21),
(794,'MALLAMA',21),
(795,'MOSQUEZA',21),
(796,'NARIÑO',21),
(797,'OLAYA HERRERA',21),
(798,'OSPINA',21),
(799,'PASTO',21),
(800,'PIZARRO',21),
(801,'POLICARPA',21),
(802,'POTOSI',21),
(803,'PROVIDENCIA',21),
(804,'PUERRES',21),
(805,'PUPIALES',21),
(806,'RICAURTE',21),
(807,'ROBERTO PAYAN',21),
(808,'SAMANIEGO',21),
(809,'SAN BERNARDO',21),
(810,'SAN LORENZO',21),
(811,'SAN PABLO',21),
(812,'SAN PEDRO DE CARTAGO',21),
(813,'SANDONA',21),
(814,'SANTA BARBARA',21),
(815,'SANTACRUZ',21),
(816,'SAPUYES',21),
(817,'TAMINANGO',21),
(818,'TANGUA',21),
(819,'TUMACO',21),
(820,'TUQUERRES',21),
(821,'YACUANQUER',21),
(822,'ABREGO',22),
(823,'ARBOLEDAS',22),
(824,'BOCHALEMA',22),
(825,'BUCARASICA',22),
(826,'CÁCHIRA',22),
(827,'CÁCOTA',22),
(828,'CHINÁCOTA',22),
(829,'CHITAGÁ',22),
(830,'CONVENCIÓN',22),
(831,'CÚCUTA',22),
(832,'CUCUTILLA',22),
(833,'DURANIA',22),
(834,'EL CARMEN',22),
(835,'EL TARRA',22),
(836,'EL ZULIA',22),
(837,'GRAMALOTE',22),
(838,'HACARI',22),
(839,'HERRÁN',22),
(840,'LA ESPERANZA',22),
(841,'LA PLAYA',22),
(842,'LABATECA',22),
(843,'LOS PATIOS',22),
(844,'LOURDES',22),
(845,'MUTISCUA',22),
(846,'OCAÑA',22),
(847,'PAMPLONA',22),
(848,'PAMPLONITA',22),
(849,'PUERTO SANTANDER',22),
(850,'RAGONVALIA',22),
(851,'SALAZAR',22),
(852,'SAN CALIXTO',22),
(853,'SAN CAYETANO',22),
(854,'SANTIAGO',22),
(855,'SARDINATA',22),
(856,'SILOS',22),
(857,'TEORAMA',22),
(858,'TIBÚ',22),
(859,'TOLEDO',22),
(860,'VILLA CARO',22),
(861,'VILLA DEL ROSARIO',22),
(862,'COLÓN',23),
(863,'MOCOA',23),
(864,'ORITO',23),
(865,'PUERTO ASÍS',23),
(866,'PUERTO CAYCEDO',23),
(867,'PUERTO GUZMÁN',23),
(868,'PUERTO LEGUÍZAMO',23),
(869,'SAN FRANCISCO',23),
(870,'SAN MIGUEL',23),
(871,'SANTIAGO',23),
(872,'SIBUNDOY',23),
(873,'VALLE DEL GUAMUEZ',23),
(874,'VILLAGARZÓN',23),
(875,'ARMENIA',24),
(876,'BUENAVISTA',24),
(877,'CALARCÁ',24),
(878,'CIRCASIA',24),
(879,'CÓRDOBA',24),
(880,'FILANDIA',24),
(881,'GÉNOVA',24),
(882,'LA TEBAIDA',24),
(883,'MONTENEGRO',24),
(884,'PIJAO',24),
(885,'QUIMBAYA',24),
(886,'SALENTO',24),
(887,'APIA',25),
(888,'BALBOA',25),
(889,'BELÉN DE UMBRÍA',25),
(890,'DOS QUEBRADAS',25),
(891,'GUATICA',25),
(892,'LA CELIA',25),
(893,'LA VIRGINIA',25),
(894,'MARSELLA',25),
(895,'MISTRATO',25),
(896,'PEREIRA',25),
(897,'PUEBLO RICO',25),
(898,'QUINCHÍA',25),
(899,'SANTA ROSA DE CABAL',25),
(900,'SANTUARIO',25),
(901,'PROVIDENCIA',26),
(902,'SAN ANDRES',26),
(903,'SANTA CATALINA',26),
(904,'AGUADA',27),
(905,'ALBANIA',27),
(906,'ARATOCA',27),
(907,'BARBOSA',27),
(908,'BARICHARA',27),
(909,'BARRANCABERMEJA',27),
(910,'BETULIA',27),
(911,'BOLÍVAR',27),
(912,'BUCARAMANGA',27),
(913,'CABRERA',27),
(914,'CALIFORNIA',27),
(915,'CAPITANEJO',27),
(916,'CARCASI',27),
(917,'CEPITA',27),
(918,'CERRITO',27),
(919,'CHARALÁ',27),
(920,'CHARTA',27),
(921,'CHIMA',27),
(922,'CHIPATÁ',27),
(923,'CIMITARRA',27),
(924,'CONCEPCIÓN',27),
(925,'CONFINES',27),
(926,'CONTRATACIÓN',27),
(927,'COROMORO',27),
(928,'CURITÍ',27),
(929,'EL CARMEN',27),
(930,'EL GUACAMAYO',27),
(931,'EL PEÑÓN',27),
(932,'EL PLAYÓN',27),
(933,'ENCINO',27),
(934,'ENCISO',27),
(935,'FLORIÁN',27),
(936,'FLORIDABLANCA',27),
(937,'GALÁN',27),
(938,'GAMBITA',27),
(939,'GIRÓN',27),
(940,'GUACA',27),
(941,'GUADALUPE',27),
(942,'GUAPOTA',27),
(943,'GUAVATÁ',27),
(944,'GUEPSA',27),
(945,'HATO',27),
(946,'JESÚS MARIA',27),
(947,'JORDÁN',27),
(948,'LA BELLEZA',27),
(949,'LA PAZ',27),
(950,'LANDAZURI',27),
(951,'LEBRIJA',27),
(952,'LOS SANTOS',27),
(953,'MACARAVITA',27),
(954,'MÁLAGA',27),
(955,'MATANZA',27),
(956,'MOGOTES',27),
(957,'MOLAGAVITA',27),
(958,'OCAMONTE',27),
(959,'OIBA',27),
(960,'ONZAGA',27),
(961,'PALMAR',27),
(962,'PALMAS DEL SOCORRO',27),
(963,'PÁRAMO',27),
(964,'PIEDECUESTA',27),
(965,'PINCHOTE',27),
(966,'PUENTE NACIONAL',27),
(967,'PUERTO PARRA',27),
(968,'PUERTO WILCHES',27),
(969,'RIONEGRO',27),
(970,'SABANA DE TORRES',27),
(971,'SAN ANDRÉS',27),
(972,'SAN BENITO',27),
(973,'SAN GIL',27),
(974,'SAN JOAQUÍN',27),
(975,'SAN JOSÉ DE MIRANDA',27),
(976,'SAN MIGUEL',27),
(977,'SAN VICENTE DE CHUCURÍ',27),
(978,'SANTA BÁRBARA',27),
(979,'SANTA HELENA',27),
(980,'SIMACOTA',27),
(981,'SOCORRO',27),
(982,'SUAITA',27),
(983,'SUCRE',27),
(984,'SURATA',27),
(985,'TONA',27),
(986,'VALLE SAN JOSÉ',27),
(987,'VÉLEZ',27),
(988,'VETAS',27),
(989,'VILLANUEVA',27),
(990,'ZAPATOCA',27),
(991,'BUENAVISTA',28),
(992,'CAIMITO',28),
(993,'CHALÁN',28),
(994,'COLOSO',28),
(995,'COROZAL',28),
(996,'EL ROBLE',28),
(997,'GALERAS',28),
(998,'GUARANDA',28),
(999,'LA UNIÓN',28),
(1000,'LOS PALMITOS',28),
(1001,'MAJAGUAL',28),
(1002,'MORROA',28),
(1003,'OVEJAS',28),
(1004,'PALMITO',28),
(1005,'SAMPUES',28),
(1006,'SAN BENITO ABAD',28),
(1007,'SAN JUAN DE BETULIA',28),
(1008,'SAN MARCOS',28),
(1009,'SAN ONOFRE',28),
(1010,'SAN PEDRO',28),
(1011,'SINCÉ',28),
(1012,'SINCELEJO',28),
(1013,'SUCRE',28),
(1014,'TOLÚ',28),
(1015,'TOLUVIEJO',28),
(1016,'ALPUJARRA',29),
(1017,'ALVARADO',29),
(1018,'AMBALEMA',29),
(1019,'ANZOATEGUI',29),
(1020,'ARMERO (GUAYABAL)',29),
(1021,'ATACO',29),
(1022,'CAJAMARCA',29),
(1023,'CARMEN DE APICALÁ',29),
(1024,'CASABIANCA',29),
(1025,'CHAPARRAL',29),
(1026,'COELLO',29),
(1027,'COYAIMA',29),
(1028,'CUNDAY',29),
(1029,'DOLORES',29),
(1030,'ESPINAL',29),
(1031,'FALÁN',29),
(1032,'FLANDES',29),
(1033,'FRESNO',29),
(1034,'GUAMO',29),
(1035,'HERVEO',29),
(1036,'HONDA',29),
(1037,'IBAGUÉ',29),
(1038,'ICONONZO',29),
(1039,'LÉRIDA',29),
(1040,'LÍBANO',29),
(1041,'MARIQUITA',29),
(1042,'MELGAR',29),
(1043,'MURILLO',29),
(1044,'NATAGAIMA',29),
(1045,'ORTEGA',29),
(1046,'PALOCABILDO',29),
(1047,'PIEDRAS PLANADAS',29),
(1048,'PRADO',29),
(1049,'PURIFICACIÓN',29),
(1050,'RIOBLANCO',29),
(1051,'RONCESVALLES',29),
(1052,'ROVIRA',29),
(1053,'SALDAÑA',29),
(1054,'SAN ANTONIO',29),
(1055,'SAN LUIS',29),
(1056,'SANTA ISABEL',29),
(1057,'SUÁREZ',29),
(1058,'VALLE DE SAN JUAN',29),
(1059,'VENADILLO',29),
(1060,'VILLAHERMOSA',29),
(1061,'VILLARRICA',29),
(1062,'ALCALÁ',30),
(1063,'ANDALUCÍA',30),
(1064,'ANSERMA NUEVO',30),
(1065,'ARGELIA',30),
(1066,'BOLÍVAR',30),
(1067,'BUENAVENTURA',30),
(1068,'BUGA',30),
(1069,'BUGALAGRANDE',30),
(1070,'CAICEDONIA',30),
(1071,'CALI',30),
(1072,'CALIMA (DARIEN)',30),
(1073,'CANDELARIA',30),
(1074,'CARTAGO',30),
(1075,'DAGUA',30),
(1076,'EL AGUILA',30),
(1077,'EL CAIRO',30),
(1078,'EL CERRITO',30),
(1079,'EL DOVIO',30),
(1080,'FLORIDA',30),
(1081,'GINEBRA GUACARI',30),
(1082,'JAMUNDÍ',30),
(1083,'LA CUMBRE',30),
(1084,'LA UNIÓN',30),
(1085,'LA VICTORIA',30),
(1086,'OBANDO',30),
(1087,'PALMIRA',30),
(1088,'PRADERA',30),
(1089,'RESTREPO',30),
(1090,'RIO FRÍO',30),
(1091,'ROLDANILLO',30),
(1092,'SAN PEDRO',30),
(1093,'SEVILLA',30),
(1094,'TORO',30),
(1095,'TRUJILLO',30),
(1096,'TULÚA',30),
(1097,'ULLOA',30),
(1098,'VERSALLES',30),
(1099,'VIJES',30),
(1100,'YOTOCO',30),
(1101,'YUMBO',30),
(1102,'ZARZAL',30),
(1103,'CARURÚ',31),
(1104,'MITÚ',31),
(1105,'PACOA',31),
(1106,'PAPUNAUA',31),
(1107,'TARAIRA',31),
(1108,'YAVARATÉ',31),
(1109,'CUMARIBO',32),
(1110,'LA PRIMAVERA',32),
(1111,'PUERTO CARREÑO',32),
(1112,'SANTA ROSALIA',32);

/*Table structure for table `nits_db` */

DROP TABLE IF EXISTS `nits_db`;

CREATE TABLE `nits_db` (
  `idnits_db` int(11) NOT NULL AUTO_INCREMENT,
  `numNIT` varchar(1000) DEFAULT NULL,
  `nombreOrganizacion` varchar(1000) DEFAULT NULL,
  `numeroResolucion` varchar(1000) DEFAULT NULL,
  `fechaFinalizacion` date DEFAULT NULL,
  PRIMARY KEY (`idnits_db`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

/*Data for the table `nits_db` */

/*Table structure for table `notificaciones` */

DROP TABLE IF EXISTS `notificaciones`;

CREATE TABLE `notificaciones` (
  `id_notificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `tituloNotificacion` varchar(1000) NOT NULL COMMENT 'Titulo de la Notificacion',
  `descripcionNotificacion` varchar(1000) NOT NULL COMMENT 'Descripcion de la Notificacion',
  `fechaNotificacion` datetime NOT NULL COMMENT 'Fecha de guardado de la Notificacion',
  `quienEnvia` varchar(1000) NOT NULL COMMENT 'Quien envia la notificacion',
  `quienRecibe` varchar(1000) NOT NULL COMMENT 'Quien Recibe la notificacion',
  `isRead` char(1) NOT NULL COMMENT 'Si se leyo la notificacion es 0, Si no se leyo 1',
  `tipoUsuario` varchar(1000) DEFAULT NULL COMMENT 'Tipo de Usuario a Enviar',
  PRIMARY KEY (`id_notificaciones`)
) ENGINE=InnoDB AUTO_INCREMENT=829 DEFAULT CHARSET=utf8 COMMENT='Las notificaciones internas de la aplicación';

/*Data for the table `notificaciones` */

/*Table structure for table `observaciones` */

DROP TABLE IF EXISTS `observaciones`;

CREATE TABLE `observaciones` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Observaciones',
  `idForm` longtext COMMENT 'Id del Formulario',
  `keyForm` varchar(1000) DEFAULT NULL COMMENT 'Key del Formulario',
  `valueForm` varchar(1000) DEFAULT NULL COMMENT 'Value del Formulario',
  `observacion` longtext COMMENT 'Observacion del Formulario',
  `fechaObservacion` datetime DEFAULT NULL COMMENT 'Fecha de la Observacion',
  `numeroRevision` varchar(1000) DEFAULT NULL COMMENT 'Numero de la Revision',
  `idSolicitud` varchar(45) DEFAULT NULL,
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_observacion`),
  KEY `fk_observaciones_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_observaciones_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=utf8 COMMENT='Observaciones que se hacen a los Formularios que el usuario diligencio';

/*Data for the table `observaciones` */

/*Table structure for table `observacionesdocente` */

DROP TABLE IF EXISTS `observacionesdocente`;

CREATE TABLE `observacionesdocente` (
  `id_observacionesDocente` int(11) NOT NULL AUTO_INCREMENT,
  `observacionesDocente` longtext,
  `fechaObservacion` datetime DEFAULT NULL,
  `docentes_id_docente` int(11) NOT NULL,
  PRIMARY KEY (`id_observacionesDocente`),
  KEY `fk_observacionesDocente_docentes1_idx` (`docentes_id_docente`),
  CONSTRAINT `fk_observacionesDocente_docentes1` FOREIGN KEY (`docentes_id_docente`) REFERENCES `docentes` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `observacionesdocente` */

/*Table structure for table `opciones` */

DROP TABLE IF EXISTS `opciones`;

CREATE TABLE `opciones` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Opciones',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la Opcion: Imagen Texto ',
  `valor` longtext NOT NULL COMMENT 'Valor que se le da al Nombre',
  PRIMARY KEY (`id_opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Opciones del Sistema de Sia';

/*Data for the table `opciones` */

insert  into `opciones`(`id_opcion`,`nombre`,`valor`) values 
(1,'titulo',''),
(2,'logo','assets/img/uaeos-logo.png'),
(3,'super','TRUE'),
(4,'logo_app','assets/img/siia_logo.png');

/*Table structure for table `organizaciones` */

DROP TABLE IF EXISTS `organizaciones`;

CREATE TABLE `organizaciones` (
  `id_organizacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Registro de la Organizacion',
  `nombreOrganizacion` varchar(1000) NOT NULL COMMENT 'Nombre de la Organizacion',
  `numNIT` varchar(1000) NOT NULL COMMENT 'Numero NIT de la Organizacion',
  `sigla` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Sigla de la organizacion',
  `primerNombreRepLegal` varchar(1000) NOT NULL COMMENT 'Primer Nombre del Representante Legal',
  `segundoNombreRepLegal` varchar(1000) DEFAULT 'No Tiene' COMMENT 'Segundo Nombre del Representante Legal',
  `primerApellidoRepLegal` varchar(1000) NOT NULL COMMENT 'Primer Apellido del Representante Legal',
  `segundoApellidoRepLegal` varchar(1000) DEFAULT 'No Tiene' COMMENT 'Segundo Apellido del Representante Legal',
  `direccionCorreoElectronicoOrganizacion` varchar(1000) NOT NULL COMMENT 'Direccion de Correo Electronico de Contacto de la organizacion',
  `direccionCorreoElectronicoRepLegal` varchar(1000) NOT NULL COMMENT 'Direccion de Correo Electronico de Contacto del representante legal',
  `primerNombrePersona` varchar(1000) DEFAULT NULL COMMENT 'Primer Nombre de la persona que Ingreso la informacion',
  `primerApellidoPersona` varchar(1000) DEFAULT NULL COMMENT 'Primer Apellido de la persona que ingreso la informacion',
  `imagenOrganizacion` varchar(1000) DEFAULT 'default.png' COMMENT 'Logo / Imagen de la organizacion',
  `firmaRepLegal` varchar(1000) DEFAULT 'default.png',
  `contrasena_firma` varchar(1000) DEFAULT NULL,
  `camaraComercio` varchar(1000) DEFAULT 'default.pdf',
  `firmaCert` varchar(1000) DEFAULT 'default.png',
  `personaCert` varchar(1000) DEFAULT 'Nombre Persona',
  `cargoCert` varchar(1000) DEFAULT 'Representante Legal',
  `asignada` varchar(1000) DEFAULT 'SIN ASIGNAR',
  `estado` varchar(45) DEFAULT NULL,
  `usuarios_id_usuario` int(11) DEFAULT NULL COMMENT 'Id usuario de la tabla de usuarios',
  PRIMARY KEY (`id_organizacion`,`numNIT`),
  KEY `fk_registro_usuarios_idx` (`usuarios_id_usuario`),
  CONSTRAINT `fk_registro_usuarios` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=572 DEFAULT CHARSET=utf8 COMMENT='Primer registro de las organizaciones';

/*Data for the table `organizaciones` */

/*Table structure for table `organizacioneshistorial` */

DROP TABLE IF EXISTS `organizacioneshistorial`;

CREATE TABLE `organizacioneshistorial` (
  `id_organizacionHistorial` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Registro de la Organizacion',
  `nombreOrganizacion` varchar(1000) NOT NULL COMMENT 'Nombre de la Organizacion',
  `numNIT` varchar(1000) NOT NULL COMMENT 'Numero NIT de la Organizacion',
  `sigla` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Sigla de la organizacion',
  `primerNombreRepLegal` varchar(1000) NOT NULL COMMENT 'Primer Nombre del Representante Legal',
  `segundoNombreRepLegal` varchar(1000) DEFAULT 'No Tiene' COMMENT 'Segundo Nombre del Representante Legal',
  `primerApellidoRepLegal` varchar(1000) NOT NULL COMMENT 'Primer Apellido del Representante Legal',
  `segundoApellidoRepLegal` varchar(1000) DEFAULT 'No Tiene' COMMENT 'Segundo Apellido del Representante Legal',
  `direccionCorreoElectronicoOrganizacion` varchar(1000) NOT NULL COMMENT 'Direccion de Correo Electronico de Contacto de la organizacion',
  `direccionCorreoElectronicoRepLegal` varchar(1000) NOT NULL COMMENT 'Direccion de Correo Electronico de Contacto del representante legal',
  PRIMARY KEY (`id_organizacionHistorial`)
) ENGINE=InnoDB AUTO_INCREMENT=729 DEFAULT CHARSET=utf8 COMMENT='Primer registro de las organizaciones';

/*Data for the table `organizacioneshistorial` */

/*Table structure for table `planmejoramiento` */

DROP TABLE IF EXISTS `planmejoramiento`;

CREATE TABLE `planmejoramiento` (
  `id_planMejoramiento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionMejora` longtext NOT NULL,
  `fechaMejora` date NOT NULL,
  `cumple` char(1) NOT NULL,
  `observaciones` longtext,
  `visitas_id_visitas` int(11) NOT NULL,
  `organizaciones_id_organizacion` int(11) NOT NULL,
  PRIMARY KEY (`id_planMejoramiento`),
  KEY `fk_planMejoramiento_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_planMejoramiento_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `planmejoramiento` */

/*Table structure for table `programasavalar` */

DROP TABLE IF EXISTS `programasavalar`;

CREATE TABLE `programasavalar` (
  `id_programasAvalar` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Programas a Avalar',
  `nombrePrograma` longtext NOT NULL COMMENT 'Nombre del Programa a Avalar',
  `objetivos` longtext NOT NULL COMMENT 'Obejtivos del Programa a Avalar',
  `metodologia` longtext NOT NULL COMMENT 'Metodologia del Programa a Avalar',
  `contenidosPlanteados` longtext NOT NULL COMMENT 'Contenido Planteado al Programa a Avalar',
  `materialDidactico` longtext NOT NULL COMMENT 'Material Didactico que usa el Programa',
  `bibliografia` longtext NOT NULL COMMENT 'Bibliografia que usa el Programa a Avalar',
  `intensidadHoraria` longtext NOT NULL COMMENT 'Intesidad horaria que tiene el Programa a Avalar',
  `evaluacion` longtext NOT NULL COMMENT 'Como se evalua el Programa a Avalar',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_programasAvalar`),
  KEY `fk_programasAvalar_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_programasAvalar_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='Formulario #8 SIA';

/*Data for the table `programasavalar` */

/*Table structure for table `programasavaleconomia` */

DROP TABLE IF EXISTS `programasavaleconomia`;

CREATE TABLE `programasavaleconomia` (
  `id_programasAvalEconomia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Programas Aval Economia Solidaria',
  `objetivos` longtext NOT NULL COMMENT 'Objetivos del Programa',
  `metodologia` longtext NOT NULL COMMENT 'Metodologia del Programa',
  `materialDidactico` longtext NOT NULL COMMENT 'Material Didactivo que usa el Programa',
  `bibliografia` longtext NOT NULL COMMENT 'Bibliografia del Programa',
  `duracionCurso` longtext NOT NULL COMMENT 'Duracion del curso Programa',
  `antecedentesAspectos` longtext,
  `diferencias` longtext,
  `regulacionJuridica` longtext,
  `desarrolloSocioempresarial` longtext,
  `legislacionTributaria` longtext,
  `administracionTrabajo` longtext,
  `regimenesTrabajo` longtext,
  `manejoSeguridad` longtext,
  `inspeccionVigilancia` longtext,
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_programasAvalEconomia`),
  KEY `fk_programasAvalEconomia_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_programasAvalEconomia_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Formulario #7 SIA';

/*Data for the table `programasavaleconomia` */

/*Table structure for table `registroeducativoprogramas` */

DROP TABLE IF EXISTS `registroeducativoprogramas`;

CREATE TABLE `registroeducativoprogramas` (
  `id_registroEducativoPro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla Registro educativo',
  `tipoEducacion` varchar(1000) NOT NULL COMMENT 'Tipo de educacion Select  Option: Educacion para el trabajo y el desarrollo humano\\nFormal\\nInformal',
  `fechaResolucion` date NOT NULL COMMENT 'Fecha en la que se expide la resolucion',
  `numeroResolucion` int(11) NOT NULL COMMENT 'Numero de la resolucion',
  `nombrePrograma` varchar(1000) NOT NULL COMMENT 'Nombre del Programa Texto',
  `objetoResolucion` longtext NOT NULL COMMENT 'Objeto de la Resolucion',
  `entidadResolucion` varchar(1000) NOT NULL COMMENT 'Entidad que expidio la resolucion Select Option: Ministerio De Educación\\nSecretaria De Educación Departamental\\nSecretaria De Educación Municipal',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_registroEducativoPro`),
  KEY `fk_registroEducativoProgramas_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_registroEducativoProgramas_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Formulario # 3 de SIA Registro Educativo de Programas.';

/*Data for the table `registroeducativoprogramas` */

/*Table structure for table `registrotelefonico` */

DROP TABLE IF EXISTS `registrotelefonico`;

CREATE TABLE `registrotelefonico` (
  `id_registroTelefonico` int(11) NOT NULL AUTO_INCREMENT,
  `telefonicoNombre` longtext,
  `telefonicoApellidos` longtext,
  `telefonicoCedula` longtext,
  `telefonicoNit` longtext,
  `telefonicoTipoPersona` longtext,
  `telefonicoGenero` longtext,
  `telefonicoMunicipio` longtext,
  `telefonicoDepartamento` longtext,
  `telefonicoNumeroContacto` longtext,
  `telefonicoCorreoContacto` longtext,
  `telefonicoNombreOrganizacion` longtext,
  `telefonicoTipoOrganizacion` longtext,
  `telefonicoTemaConsulta` longtext,
  `telefonicoDescripcionConsulta` longtext,
  `telefonicoTipoSolicitud` longtext,
  `telefonicoCanalRecepcion` longtext,
  `telefonicoCanalRespuesta` longtext,
  `telefonicoFecha` longtext,
  `telefonicoDuracion` longtext,
  `telefonicoHora` longtext,
  PRIMARY KEY (`id_registroTelefonico`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `registrotelefonico` */

/*Table structure for table `resoluciones` */

DROP TABLE IF EXISTS `resoluciones`;

CREATE TABLE `resoluciones` (
  `id_resoluciones` int(11) NOT NULL AUTO_INCREMENT,
  `fechaResolucionInicial` date DEFAULT NULL,
  `fechaResolucionFinal` date DEFAULT NULL,
  `añosResolucion` int(11) DEFAULT NULL,
  `resolucion` varchar(1000) DEFAULT NULL,
  `numeroResolucion` varchar(1000) DEFAULT NULL,
  `cursoAprobado` varchar(1000) DEFAULT NULL,
  `modalidadAprobada` varchar(1000) DEFAULT NULL,
  `organizaciones_id_organizacion` int(11) DEFAULT NULL,
  `organizaciones_id_organizacion1` int(11) NOT NULL,
  `organizaciones_numNIT` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_resoluciones`),
  KEY `fk_resoluciones_organizaciones1_idx` (`organizaciones_id_organizacion1`,`organizaciones_numNIT`),
  CONSTRAINT `fk_resoluciones_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion1`, `organizaciones_numNIT`) REFERENCES `organizaciones` (`id_organizacion`, `numNIT`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

/*Data for the table `resoluciones` */

/*Table structure for table `seguimiento` */

DROP TABLE IF EXISTS `seguimiento`;

CREATE TABLE `seguimiento` (
  `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT,
  `certificadoExistencia` char(1) NOT NULL,
  `matriculaMercantil` char(1) NOT NULL,
  `actividadesEducacion` char(1) NOT NULL,
  `domicilio` char(1) NOT NULL,
  `datosRepLegal` char(1) NOT NULL,
  `fechaVigenciaCertificado` char(1) NOT NULL,
  `metodologiaAcreditada` char(1) NOT NULL,
  `materialDidactico` char(1) NOT NULL,
  `contenidosEducativo` char(1) NOT NULL,
  `socializacionConceptos` char(1) NOT NULL,
  `contextoSocioEconomico` char(1) NOT NULL,
  `tiposOrganizacionesSolidarias` char(1) NOT NULL,
  `entesControlyApoyo` char(1) NOT NULL,
  `avalCursos` char(1) NOT NULL,
  `contenidosProgramas` char(1) NOT NULL,
  `otrosProgramas` char(1) NOT NULL,
  `actualizacionDatosUnidad` char(1) NOT NULL,
  `suministroInformacionVisitas` char(1) NOT NULL,
  `entregaInformesActividades` char(1) NOT NULL,
  `docentesHabilitados` char(1) NOT NULL,
  `archivoHistoricoEducacion` char(1) NOT NULL,
  `cursosSolidaridadEducativa` char(1) NOT NULL,
  `subcontratacionTerceros` char(1) NOT NULL,
  `cotejoCertificacionesCurso` char(1) NOT NULL,
  `actualizacionHojaVidaDocentes` char(1) NOT NULL,
  `hallazgos` longtext NOT NULL,
  `visitas_id_visitas` int(11) NOT NULL,
  PRIMARY KEY (`id_seguimiento`),
  KEY `fk_seguimiento_visitas1_idx` (`visitas_id_visitas`),
  CONSTRAINT `fk_seguimiento_visitas1` FOREIGN KEY (`visitas_id_visitas`) REFERENCES `visitas` (`id_visitas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `seguimiento` */

/*Table structure for table `seguimientosimple` */

DROP TABLE IF EXISTS `seguimientosimple`;

CREATE TABLE `seguimientosimple` (
  `id_seguimientoSimple` int(11) NOT NULL AUTO_INCREMENT,
  `fechaSeguimiento` date NOT NULL,
  `descripcionSeguimiento` varchar(1000) NOT NULL,
  `respuestaSeguimiento` varchar(1000) DEFAULT NULL,
  `cumpleSeguimiento` char(1) NOT NULL DEFAULT '0',
  `nombreOrganizacion` varchar(1000) NOT NULL,
  `organizaciones_id_organizacion` int(11) NOT NULL,
  PRIMARY KEY (`id_seguimientoSimple`),
  KEY `fk_seguimientoSimple_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_seguimientoSimple_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `seguimientosimple` */

/*Table structure for table `session_log` */

DROP TABLE IF EXISTS `session_log`;

CREATE TABLE `session_log` (
  `id_session_log` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id se Session Log',
  `nombre_usuario` varchar(1000) DEFAULT NULL COMMENT 'Nombre del usuario en log',
  `usuario_id` int(11) DEFAULT NULL COMMENT 'Id del usuario en log',
  `accion` varchar(1000) DEFAULT NULL COMMENT 'Accion que realizo el usuario',
  `fecha` datetime DEFAULT NULL COMMENT 'Cuando realizo la accion',
  `usuario_ip` varchar(1000) DEFAULT NULL COMMENT 'Ip del usuario',
  `usuario_ip_proxy` varchar(1000) DEFAULT NULL COMMENT 'Ip del usuario si usa proxy',
  `user_agent` varchar(1000) DEFAULT NULL COMMENT 'Agente de donde esta haciendo las acciones',
  PRIMARY KEY (`id_session_log`)
) ENGINE=InnoDB AUTO_INCREMENT=8041 DEFAULT CHARSET=utf8;

/*Data for the table `session_log` */

/*Table structure for table `solicitudes` */

DROP TABLE IF EXISTS `solicitudes`;

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Solicitudes',
  `fechaInicio` datetime NOT NULL COMMENT 'Fecha en la que hizo la Solicitud',
  `fechaFin` datetime DEFAULT NULL,
  `fechaUltimaRevision` datetime DEFAULT NULL,
  `numeroRevisiones` int(11) NOT NULL DEFAULT '0' COMMENT 'Numero de las revisiones de la solicitud',
  `estado` varchar(45) NOT NULL,
  `organizaciones_id_organizacion` int(11) NOT NULL,
  `organizaciones_numNIT` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `fk_solicitudes_organizaciones1_idx` (`organizaciones_id_organizacion`,`organizaciones_numNIT`),
  CONSTRAINT `fk_solicitudes_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`, `organizaciones_numNIT`) REFERENCES `organizaciones` (`id_organizacion`, `numNIT`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8 COMMENT='Tabla de numero de solicitudes';

/*Data for the table `solicitudes` */

/*Table structure for table `tiposcursoinformes` */

DROP TABLE IF EXISTS `tiposcursoinformes`;

CREATE TABLE `tiposcursoinformes` (
  `id_tiposCursoInformes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_tiposCursoInformes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tiposcursoinformes` */

/*Table structure for table `tiposolicitud` */

DROP TABLE IF EXISTS `tiposolicitud`;

CREATE TABLE `tiposolicitud` (
  `id_tipoSolicitud` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id tabla tipo solicitud',
  `tipoSolicitud` varchar(1000) NOT NULL COMMENT 'Tipo de Solicitud Radio Button: Acreditacion Primera Vez, Renovacion de acreditacion, Actualziacion de Datos',
  `motivoSolicitud` varchar(1000) NOT NULL COMMENT 'Motivo Solicitud Radio Button: Acreditación Curso Basico de Economia Solidaria.\\nAcreditación, Aval de Trabajo Asociado.\\nAcreditación, Aval a otros Programas.\\nAcreditación, Aval de Trabajo Asociado, Aval a otros Programas. (Todas)\\n ',
  `modalidadSolicitud` varchar(1000) NOT NULL COMMENT 'Modalidad Solicitud Radio Button: Virtual\\nPresencial\\nVirtual y Presencial',
  `idSolicitud` varchar(1000) NOT NULL COMMENT 'Id unico de la Solicitud Creada',
  `solicitudes_id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id_tipoSolicitud`),
  KEY `fk_tipoSolicitud_solicitudes1_idx` (`solicitudes_id_solicitud`),
  CONSTRAINT `fk_tipoSolicitud_solicitudes1` FOREIGN KEY (`solicitudes_id_solicitud`) REFERENCES `solicitudes` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COMMENT='Tipo de la Solicitud del Usuario';

/*Data for the table `tiposolicitud` */

/*Table structure for table `token` */

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Token del usuario',
  `token` varchar(1000) NOT NULL COMMENT 'String del token',
  `verificado` char(1) NOT NULL DEFAULT '0' COMMENT '0 Si no esta verificado, 1 si esta verificado',
  `usuario_token` varchar(1000) NOT NULL COMMENT 'Usuario del Token',
  `fechaActivacion` date DEFAULT NULL,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;

/*Data for the table `token` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Usuario',
  `usuario` varchar(1000) NOT NULL COMMENT 'Usuario que inicia sesion en la aplicacion',
  `contrasena` varchar(1000) NOT NULL COMMENT 'Contraseña con que se valida el login',
  `contrasena_rdel` varchar(1000) NOT NULL COMMENT 'Contraseña en Rijndael para recordar.',
  `logged_in` char(1) DEFAULT '0' COMMENT 'Si esta en 0 no esta en sesion, si esta en 1 esta en sesion',
  `token_id_token` int(11) DEFAULT NULL COMMENT 'Id de la tabla Token',
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_token1_idx` (`token_id_token`),
  CONSTRAINT `fk_usuarios_token1` FOREIGN KEY (`token_id_token`) REFERENCES `token` (`id_token`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

/*Table structure for table `visitas` */

DROP TABLE IF EXISTS `visitas`;

CREATE TABLE `visitas` (
  `id_visitas` int(11) NOT NULL AUTO_INCREMENT,
  `nombreOrganizacionVisita` varchar(1000) NOT NULL,
  `fechaVisita` date NOT NULL,
  `horaVisita` varchar(1000) NOT NULL,
  `usuarioVisita` varchar(1000) NOT NULL,
  `terminada` char(1) NOT NULL DEFAULT '0',
  `organizaciones_id_organizacion` int(11) NOT NULL,
  PRIMARY KEY (`id_visitas`),
  KEY `fk_visitas_organizaciones1_idx` (`organizaciones_id_organizacion`),
  CONSTRAINT `fk_visitas_organizaciones1` FOREIGN KEY (`organizaciones_id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `visitas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
