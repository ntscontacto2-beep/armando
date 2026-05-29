CREATE DATABASE IF NOT EXISTS tianguis_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tianguis_db;

CREATE TABLE IF NOT EXISTS vendedores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  email VARCHAR(120) UNIQUE,
  telefono VARCHAR(30),
  redes JSON NULL,
  password_hash VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS locales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vendedor_id INT NULL,
  nombre VARCHAR(150) NOT NULL,
  slug VARCHAR(160) UNIQUE NOT NULL,
  categoria VARCHAR(80) NOT NULL,
  ubicacion VARCHAR(180) NOT NULL,
  descripcion TEXT NULL,
  lat DECIMAL(10,7) NULL,
  lng DECIMAL(10,7) NULL,
  visitas INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (vendedor_id) REFERENCES vendedores(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS horarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  local_id INT NOT NULL,
  dia ENUM('Dom','Lun','Mar','Mie','Jue','Vie','Sab') NOT NULL,
  abre TIME NOT NULL,
  cierra TIME NOT NULL,
  FOREIGN KEY (local_id) REFERENCES locales(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS rutas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  descripcion VARCHAR(255),
  geojson JSON NULL
);

-- Datos de ejemplo
INSERT IGNORE INTO vendedores (id,nombre,email,telefono,password_hash)
VALUES
(1,'Don Chava','chava@ejemplo.com','246-000-0000', NULL),
(2,'Doña Mary','mary@ejemplo.com','246-111-1111', NULL);

INSERT IGNORE INTO locales (id,vendedor_id,nombre,slug,categoria,ubicacion,descripcion,lat,lng,visitas)
VALUES
(1,1,'Gorras y Sombreros Chava','gorras-sombreros-chava','Accesorios','Pasillo A-12','Gorras urbanas y sombreros.',19.288500,-98.437900,25),
(2,2,'Ropa Urbana Mary','ropa-urbana-mary','Ropa','Pasillo B-34','Sudaderas, playeras y jeans.',19.288700,-98.437700,40);

INSERT IGNORE INTO horarios (local_id,dia,abre,cierra) VALUES
(1,'Dom','04:00','14:00'),(2,'Dom','04:00','14:00');

INSERT IGNORE INTO rutas (id, nombre, descripcion, geojson) VALUES
(1,'Ruta Centro','Desde el zócalo de San Martín Texmelucan','{\"type\":\"LineString\",\"coordinates\":[[-98.4369,19.2881],[-98.4377,19.2887]]}');
