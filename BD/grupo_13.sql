SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `estado` (
  `idEstado` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `estado` (`idEstado`, `nombre`) VALUES
(1, 'pendiente'),
(2, 'en-presupuesto');

CREATE TABLE `incidente` (
  `idIncidente` int(10) NOT NULL,
  `descripcion` text NOT NULL,
  `idTipoIncidente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `objetoIncidente` (
  `idObjeto`int(10) NOT NULL,
  `idIncidente` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tipoincidente` (
  `nombre` varchar(15) NOT NULL,
  `idTipoIncidente` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tipoincidente` (`nombre`, `idTipoIncidente`) VALUES
('casa', 1),
('vehiculo', 2),
('objeto-mueble', 3);

CREATE TABLE `usuario` (
  `idUsuario` int(5) NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `dni` int(8) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `contrasena`, `nombre`, `apellido`, `dni`, `mail`) VALUES
(1, 'mlopez', 'bpm', 'maria', 'lopez', 38951674, 'mlopez@gmail.com'),
(2, 'mgomez', 'bpm', 'mateo', 'gomez', 37694301, 'mgomez@gmail.com'),
(3, 'jrodriguez', 'bpm', 'juan', 'rodriguez', 36950167, 'jrodriguez@gmail.com'),
(4, 'wgarcia', 'bpm', 'walter', 'garcia', 33694178, 'wgarcia64@gmail.com');

ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

ALTER TABLE `incidente`
  ADD PRIMARY KEY (`idIncidente`),
  ADD KEY `idTipoIncidente` (`idTipoIncidente`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `id_estado` (`idEstado`);

ALTER TABLE `tipoincidente`
  ADD PRIMARY KEY (`idTipoIncidente`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

ALTER TABLE `estado`
  MODIFY `idEstado` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `incidente`
  MODIFY `idIncidente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tipoincidente`
  MODIFY `idTipoIncidente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `incidente`
  ADD CONSTRAINT `incidente_ibfk_1` FOREIGN KEY (`idTipoIncidente`) REFERENCES `tipoincidente` (`idTipoIncidente`),
  ADD CONSTRAINT `incidente_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `incidente_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`);
COMMIT;
