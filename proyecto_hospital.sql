-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2026 a las 09:17:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_hospital`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCitasDelMedico` (IN `p_id_medico` INT)   BEGIN

    SELECT 
        c.id_cita,
        c.id_paciente,
        p.nombre,
        p.telefono,
        p.direccion,
        p.fecha_nacimiento,
        c.fecha,
        c.hora,
        c.estado,
        c.fecha_registro
    FROM citas c
    INNER JOIN pacientes p
        ON c.id_paciente = p.id_paciente
    WHERE c.id_medico = p_id_medico;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPacientesDelMedico` (IN `p_id_medico` INT)   BEGIN

    SELECT DISTINCT
        p.id_paciente,
        p.nombre,
        p.telefono,
        p.direccion,
        p.fecha_nacimiento,
        p.estado
    FROM citas c
    INNER JOIN pacientes p
        ON c.id_paciente = p.id_paciente
    WHERE c.id_medico = p_id_medico;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_medico`, `fecha`, `hora`, `estado`, `fecha_registro`) VALUES
(6, 23, 1, '2026-07-31', '02:13:00', 'Activo', '2026-07-05 00:00:00'),
(7, 4, 3, '2026-07-06', '10:11:00', 'Activo', '2026-07-06 00:00:00'),
(8, 10, 1, '2026-07-17', '23:55:00', 'Activo', '2026-07-12 00:00:00'),
(9, 16, 1, '2026-07-13', '00:13:00', 'Activo', '2026-07-13 00:00:00'),
(10, 17, 1, '2026-07-13', '00:13:00', 'Activo', '2026-07-13 00:00:00'),
(11, 13, 1, '2026-07-13', '00:18:00', 'Activo', '2026-07-13 00:00:00'),
(12, 13, 1, '2026-07-13', '00:18:00', 'Activo', '2026-07-13 00:00:00'),
(13, 13, 1, '2026-07-13', '00:18:00', 'Activo', '2026-07-13 00:00:00'),
(14, 13, 1, '2026-07-13', '00:18:00', 'Activo', '2026-07-13 00:00:00'),
(15, 15, 1, '2026-07-13', '00:20:00', 'Activo', '2026-07-13 00:00:00'),
(18, 4, 1, '2026-07-13', '00:24:00', 'Activo', '2026-07-13 00:00:00'),
(19, 20, 1, '2026-07-13', '00:26:00', 'Activo', '2026-07-13 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `id_consultorio` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id_consultorio`, `numero`, `area`) VALUES
(1, '2', 'Emergencias'),
(2, '3', 'Pediatria'),
(3, '4', 'Medicina General'),
(4, '5', 'Cardiología'),
(5, '6', 'Dermatología'),
(6, '7', 'Ginecología'),
(7, '8', 'Traumatología'),
(8, '9', 'Neurología'),
(9, '10', 'Oftalmología'),
(10, '11', 'Otorrinolaringología'),
(11, '12', 'Psiquiatría'),
(12, '13', 'Urología'),
(13, '14', 'Oncología'),
(14, '15', 'Endocrinología'),
(15, '16', 'Neumología'),
(16, '17', 'Gastroenterología'),
(17, '18', 'Nefrología'),
(18, '19', 'Radiología'),
(19, '20', 'Anestesiología'),
(20, '21', 'Cirugía General'),
(21, '22', 'Laboratorio Clínico'),
(22, '23', 'Rehabilitación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_receta`
--

CREATE TABLE `detalle_receta` (
  `id_detalle` int(11) NOT NULL,
  `id_receta` int(11) DEFAULT NULL,
  `id_medicamento` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_receta`
--

INSERT INTO `detalle_receta` (`id_detalle`, `id_receta`, `id_medicamento`, `cantidad`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre`) VALUES
(1, 'Maxilofacial'),
(2, 'Dentista'),
(3, 'Cardiología'),
(4, 'Pediatría'),
(5, 'Medicina General'),
(6, 'Ginecología'),
(7, 'Traumatología'),
(8, 'Neurología'),
(9, 'Oftalmología'),
(10, 'Dermatología'),
(11, 'Psiquiatría'),
(12, 'Urología'),
(13, 'Otorrinolaringología'),
(14, 'Endocrinología'),
(15, 'Oncología'),
(16, 'Neumología'),
(17, 'Gastroenterología'),
(18, 'Nefrología'),
(19, 'Reumatología'),
(20, 'Anestesiología'),
(21, 'Radiología'),
(22, 'Cirugía General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_m` int(3) NOT NULL,
  `id_paciente` int(3) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_m`, `id_paciente`, `imagen`) VALUES
(1, 1, '\"C:\\xampp\\htdocs\\Proyecto_Hospital\\imagenes_p\\Gemini_Generated_Image_1u949z1u949z1u94.png\"'),
(2, 1, '\"C:\\xampp\\htdocs\\Proyecto_Hospital\\imagenes_p\\Gemini_Generated_Image_8wnjiz8wnjiz8wnj.png\"'),
(3, 2, 'imagenes_p/femur.jpg'),
(4, 20, 'imagenes_p/Fractura de craneo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_medicamento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `existencia` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id_medicamento`, `nombre`, `descripcion`, `existencia`) VALUES
(2, 'Paracetamol', 'Analgésico y antipirético para aliviar dolor y fiebre.', 84),
(3, 'Ibuprofeno', 'Antiinflamatorio no esteroideo para dolor e inflamación.', 60),
(4, 'Amoxicilina', 'Antibiótico de amplio espectro.', 45),
(5, 'Omeprazol', 'Reduce la producción de ácido en el estómago.', 70),
(6, 'Loratadina', 'Antihistamínico para el tratamiento de alergias.', 90),
(7, 'Metformina', 'Medicamento utilizado para controlar la diabetes tipo 2.', 55),
(8, 'Losartán', 'Tratamiento para la hipertensión arterial.', 80),
(9, 'Enalapril', 'Inhibidor de la ECA para presión arterial alta.', 65),
(10, 'Aspirina', 'Analgésico, antipirético y antiinflamatorio.', 100),
(11, 'Diclofenaco', 'Antiinflamatorio para dolor muscular y articular.', 50),
(12, 'Salbutamol', 'Broncodilatador para tratar el asma.', 40),
(13, 'Azitromicina', 'Antibiótico utilizado para diversas infecciones bacterianas.', 35),
(14, 'Clonazepam', 'Medicamento para trastornos de ansiedad y convulsiones.', 25),
(15, 'Insulina', 'Hormona utilizada para controlar la glucosa en sangre.', 30),
(16, 'Captopril', 'Medicamento para la hipertensión y la insuficiencia cardíaca.', 45),
(17, 'Prednisona', 'Corticosteroide para reducir inflamación y reacciones alérgicas.', 60),
(18, 'Aciclovir', 'Antiviral utilizado para tratar infecciones por herpes.', 20),
(19, 'Naproxeno', 'Antiinflamatorio para aliviar dolor e inflamación.', 75),
(20, 'Vitamina C', 'Suplemento vitamínico que fortalece el sistema inmunológico.', 150),
(21, 'Carbonato de calcio', 'Suplemento de calcio y antiácido.', 110),
(22, 'Experimental', 'Este no es un medicamento verdadero', 5),
(23, 'Pepepep', 'wodnwefñndenferjfenrl', 15),
(24, 'wdwe', 'sdsds', 10),
(25, 'wdssdsa', '12312321', 8),
(26, 'Lolol', 'Hola que hace', 0),
(27, 'Nosoe', 'Nose', 0),
(28, 'Paralelo', 'NO se ya estoy arto de que no salga', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  `id_consultorio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `id_usuario`, `nombre`, `id_especialidad`, `id_consultorio`) VALUES
(1, 2, 'Medico_prueba', 3, 2),
(2, 35, 'Angel', 2, 3),
(3, 36, 'Leon', 6, 9),
(4, 37, 'Angelooo', 5, 8),
(5, 42, 'Prueba1', 5, 4),
(6, 44, 'asdw', 3, 5),
(7, 45, 'wefldln', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado` enum('Activo','Baja') DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `telefono`, `direccion`, `fecha_nacimiento`, `estado`) VALUES
(1, 'Angel Silverio Contreras Veliz', '4492312121212', 'Pozobravo', '2005-06-26', 'Activo'),
(2, 'Juan Pérez García', '4491111111', 'Colonia Centro', '1995-03-15', 'Activo'),
(3, 'María López Hernández', '4491111112', 'Fracc. San Marcos', '1998-07-21', 'Activo'),
(4, 'Carlos Ramírez Torres', '4491111113', 'Colonia Gremial', '1987-11-09', 'Activo'),
(5, 'Ana Martínez Ruiz', '4491111114', 'Ojocaliente', '2001-01-30', 'Activo'),
(6, 'Luis González Díaz', '4491111115', 'Villas de Nuestra Señora', '1993-06-18', 'Activo'),
(7, 'Fernanda Sánchez Cruz', '4491111116', 'Colonia del Trabajo', '1999-12-05', 'Activo'),
(8, 'Jorge Herrera Flores', '4491111117', 'Las Américas', '1985-04-12', 'Activo'),
(9, 'Daniela Castillo Vega', '4491111118', 'Morelos', '2002-09-25', 'Activo'),
(10, 'Miguel Ortega Moreno', '4491111119', 'Insurgentes', '1991-08-14', 'Activo'),
(11, 'Sofía Navarro Jiménez', '4491111120', 'Pilar Blanco', '1997-02-28', 'Activo'),
(12, 'Ricardo Mendoza Silva', '4491111121', 'Colonia España', '1989-05-19', 'Activo'),
(13, 'Valeria Rojas Luna', '4491111122', 'Jardines de la Cruz', '2000-10-11', 'Activo'),
(14, 'Eduardo Morales Peña', '4491111123', 'Guadalupe Peralta', '1994-07-08', 'Activo'),
(15, 'Gabriela Reyes Campos', '4491111124', 'Los Pericos', '1996-03-23', 'Activo'),
(16, 'Fernando Cruz Salas', '4491111125', 'Bosques', '1988-12-17', 'Activo'),
(17, 'Patricia Domínguez Soto', '4491111126', 'Santa Anita', '1992-09-06', 'Activo'),
(18, 'Alejandro Fuentes Núñez', '4491111127', 'La Salud', '2003-01-29', 'Activo'),
(19, 'Andrea Vargas Molina', '4491111128', 'Colonia Industrial', '1990-11-20', 'Activo'),
(20, 'Diego Cabrera León', '4491111129', 'Lomas del Ajedrez', '1998-04-04', 'Activo'),
(21, 'Natalia Espinoza Rocha', '4491111130', 'El Dorado', '2001-06-13', 'Activo'),
(22, 'Angel', '449389121', 'Nome acuerdo', '1950-06-02', 'Baja'),
(23, 'Prueba', '4493490838', 'Pozo de ambar 108', '2025-07-26', 'Activo'),
(24, 'jhgfkhf', '121i2121i21', 'Anjdlwdj', '2026-07-06', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_cita`, `fecha`, `estado`) VALUES
(1, 6, '2026-07-09', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Admin'),
(2, 'Medico'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `estado` enum('Activo','Baja') DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `id_rol`, `estado`) VALUES
(1, 'Contreras Veliz', 'Contraseña123', 1, 'Activo'),
(2, 'Cristian emanuel', 'Contraseca1234', 2, 'Activo'),
(3, 'David Diaz', 'Nomelas1234.', 3, 'Activo'),
(4, 'Juan Perez', 'Juan1234', 2, 'Activo'),
(5, 'Maria Lopez', 'Maria1234', 3, 'Activo'),
(6, 'Carlos Ramirez', 'Carlos1234', 2, 'Baja'),
(7, 'Ana Martinez', 'Ana1234', 3, 'Activo'),
(8, 'Luis Gonzalez', 'Luis1234', 2, 'Activo'),
(9, 'Fernanda Sanchez', 'Fer1234', 3, 'Baja'),
(10, 'Jorge Herrera', 'Jorge1234', 2, 'Activo'),
(11, 'Daniela Castillo', 'Dani1234', 3, 'Activo'),
(12, 'Miguel Ortega', 'Miguel1234', 2, 'Baja'),
(13, 'Sofia Navarro', 'Sofia1234', 3, 'Activo'),
(14, 'Ricardo Mendoza', 'Rica1234', 2, 'Activo'),
(15, 'Valeria Rojas', 'Vale1234', 3, 'Baja'),
(16, 'Eduardo Morales', 'Edu1234', 2, 'Activo'),
(17, 'Gabriela Reyes', 'Gaby1234', 3, 'Activo'),
(18, 'Fernando Cruz', 'FerC1234', 2, 'Baja'),
(19, 'Patricia Dominguez', 'Paty1234', 3, 'Activo'),
(20, 'Alejandro Fuentes', 'Alex1234', 2, 'Activo'),
(21, 'Andrea Vargas', 'Andy1234', 3, 'Baja'),
(22, 'Diego Cabrera', 'Diego1234', 2, 'Activo'),
(23, 'Natalia Espinoza', 'Naty1234', 3, 'Activo'),
(24, 'Angel', 'contraseña', 2, 'Activo'),
(25, 'Angel', 'Yonose', 2, 'Activo'),
(26, 'Angel', 'Silverio', 2, 'Activo'),
(27, 'Anegl', 'Angel', 2, 'Activo'),
(28, 'Angelo', 'Cont567', 2, ''),
(29, 'Angel', 'Nose', 2, 'Activo'),
(30, 'Angel', 'Noses', 2, 'Activo'),
(31, 'Angel', '123556', 2, 'Activo'),
(32, 'Angel', 'Silveri', 2, 'Activo'),
(33, 'Angel', 'Nose', 1, 'Activo'),
(34, 'Angek', 'nosw', 2, 'Activo'),
(35, 'Angeñ', 'Nose', 2, 'Activo'),
(36, 'Daniel Leon', 'dadada1212', 2, 'Activo'),
(37, 'pereira', 'Nose', 2, 'Activo'),
(38, 'djcjdk', 'sdkjcns', 1, 'Activo'),
(39, 'q', 'as', 1, 'Activo'),
(41, 'Angelo', 'angelo', 1, 'Activo'),
(42, 'Prueba1', 'Prueba1', 2, 'Activo'),
(43, 'wpdkwpaqdwej', 'djie', 1, 'Activo'),
(44, 'Angelsaidjs', 'asjnchsdk', 2, 'Activo'),
(45, 'Angel', 'Contreras4', 2, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `fk_cita_paciente` (`id_paciente`),
  ADD KEY `fk_cita_medico` (`id_medico`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id_consultorio`);

--
-- Indices de la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_receta` (`id_receta`),
  ADD KEY `fk_detalle_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_m`),
  ADD KEY `fk_imagenes_pacientes` (`id_paciente`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`),
  ADD KEY `fk_medico_usuario` (`id_usuario`),
  ADD KEY `fk_medico_especialidad` (`id_especialidad`),
  ADD KEY `fk_medico_consultorio` (`id_consultorio`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `fk_receta_cita` (`id_cita`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id_consultorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_m` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cita_medico` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cita_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
  ADD CONSTRAINT `fk_detalle_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id_medicamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_receta` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_imagenes_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `fk_medico_consultorio` FOREIGN KEY (`id_consultorio`) REFERENCES `consultorios` (`id_consultorio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medico_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medico_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `fk_receta_cita` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
