-- ===============================
-- 1. Buat database dan gunakan
-- ===============================
CREATE DATABASE IF NOT EXISTS project
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

USE project;

-- ===============================
-- 2. Matikan pengecekan foreign key agar DROP berjalan lancar
-- ===============================
SET FOREIGN_KEY_CHECKS = 0;

-- ===============================
-- 3. Hapus view dan tabel jika sudah ada
-- ===============================
DROP VIEW IF EXISTS vperangkingan;
DROP TABLE IF EXISTS perangkingan;
DROP TABLE IF EXISTS pendaftaran;
DROP TABLE IF EXISTS siswa;
DROP TABLE IF EXISTS users;

-- ===============================
-- 4. Aktifkan kembali pengecekan foreign key
-- ===============================
SET FOREIGN_KEY_CHECKS = 1;

-- ===============================
-- 5. Tabel siswa (master data siswa)
-- ===============================
CREATE TABLE IF NOT EXISTS siswa (
  nis VARCHAR(10) NOT NULL,
  nama_siswa VARCHAR(100),
  alamat VARCHAR(255),
  telp VARCHAR(15),
  PRIMARY KEY (nis)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- ===============================
-- 6. Tabel pendaftaran
-- ===============================
CREATE TABLE IF NOT EXISTS pendaftaran (
  iddaftar INT NOT NULL AUTO_INCREMENT,
  tgldaftar DATE,
  tahun YEAR,
  nis VARCHAR(10),
  pendapatan_ortu INT,
  rata_nilai DECIMAL(4,2),
  jml_saudara INT,
  PRIMARY KEY (iddaftar),
  CONSTRAINT fk_pendaftaran_siswa
    FOREIGN KEY (nis)
    REFERENCES siswa (nis)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- ===============================
-- 7. Tabel perangkingan
-- ===============================
CREATE TABLE IF NOT EXISTS perangkingan (
  idperangkingan INT NOT NULL AUTO_INCREMENT,
  iddaftar INT,
  n_pendapatan DECIMAL(4,3),
  n_rata_nilai DECIMAL(4,3),
  n_saudara DECIMAL(4,3),
  preferensi DECIMAL(4,3),
  PRIMARY KEY (idperangkingan),
  CONSTRAINT fk_perangkingan_pendaftaran
    FOREIGN KEY (iddaftar)
    REFERENCES pendaftaran (iddaftar)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- ===============================
-- 8. Tabel users (login / manajemen pengguna)
-- ===============================
CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  level VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- ===============================
-- 9. View vperangkingan
-- ===============================
CREATE OR REPLACE VIEW vperangkingan AS
SELECT
  p.idperangkingan AS idperangkingan,
  d.iddaftar AS iddaftar,
  d.tgldaftar AS tanggal_daftar,
  d.tahun AS tahun,
  d.nis AS nis,
  s.nama_siswa AS nama_siswa,
  p.n_pendapatan AS n_pendapatan,
  p.n_rata_nilai AS n_rata_nilai,
  p.n_saudara AS n_saudara,
  p.preferensi AS preferensi
FROM
  perangkingan p
  JOIN pendaftaran d ON p.iddaftar = d.iddaftar
  JOIN siswa s ON d.nis = s.nis;

-- ===============================
-- 10. Tambahkan index untuk performa (opsional)
-- ===============================
CREATE INDEX idx_pendaftaran_nis ON pendaftaran(nis);
CREATE INDEX idx_perangkingan_iddaftar ON perangkingan(iddaftar);

-- ===============================
-- 11. Insert data awal ke tabel users
-- ===============================
INSERT INTO users (level, username, password) VALUES
('Super Admin', 'superadmin', MD5('superadmin')),
('Sub Admin', 'subadmin', MD5('subadmin')),
('Pimpinan', 'pimpinan', MD5('pimpinan'));
