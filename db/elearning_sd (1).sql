-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2021 pada 18.47
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_sd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_jawaban`
--

CREATE TABLE `file_jawaban` (
  `id_jawab` int(11) NOT NULL,
  `id_guru` int(4) NOT NULL,
  `id` int(4) NOT NULL,
  `file_tugas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_jawaban`
--

INSERT INTO `file_jawaban` (`id_jawab`, `id_guru`, `id`, `file_tugas`) VALUES
(285, 27, 6, 'iso.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(4) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `nign` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`, `nign`, `password`, `role_id`, `image`, `alamat`, `email`) VALUES
(27, 'Davita', '123456789', '$2y$10$OG1qi5vAbmWWV7Lv0pKcROdPtExYnhuJ.QK.i7X5u6AYKJUTcVnLe', 2, 'asdas11.png', 'perumahan karunia indah block c no 16', 'seirin.fight232@gmail.com'),
(28, 'user test', '5675668678678', '$2y$10$7HIv7u/ftmyMHmeRE7eop.CeZhgoVvlI6AmlJ0GxA9b2C1p.BRyP6', 2, 'default.jpg', 'perumahan karunia indah block c no 17', 'guru@gmail.com'),
(29, 'aizen', '13423423423422', '$2y$10$jppEsbBvG0noDTDDiOMiheWUfVYKFH1uBOX4lql7ofbGtZJkSOBl.', 2, 'default.jpg', 'perumahan karunia indah block c no 17', 'guru2@gmail.com'),
(30, 'rimuru', '111111111111', '$2y$10$aqndARrPseIBDz/4ib.ePOYmBqWGrJzABegHVelOvLhjRqxWKR49a', 2, 'default.jpg', 'jura tempest', 'guru3@gmail.com'),
(31, 'naruto', '34234224234', '$2y$10$s3Jv9di.Eu9beKhRyR83ieT4zO0H35j030greyqzvPVyVRR5VESiS', 2, 'default.jpg', 'konoha', 'naruto@gmail.com'),
(32, 'Velgrynd', '12343211234', '$2y$10$l30uBB.Ij1iiXcXySWtP2uBvRvGoYJO8rqb4uOV302dUOxY/oDf/S', 2, 'default.jpg', 'kekaisaran timur', 'velgrynd@gmail.com'),
(33, 'hasan', '5342545365454', '$2y$10$Ahu9uIGlac7sjIbKj5OZqupEmPITQWSa2l.OpLvrZoB3Tz6xGIEG.', 2, 'default.jpg', 'punggut', 'fdsf@hgfh.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(117) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `id_guru` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_tipe`, `id_guru`) VALUES
(26, 'Kelas 1A', 1, 27),
(27, 'Kelas 1B', 1, 29),
(28, 'Kelas 2A', 2, 28),
(29, 'Kelas 2B', 2, 30),
(30, 'Kelas 1C', 1, 32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(128) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `deskripsi`, `id_kelas`) VALUES
(16, 'Matematika', 'Pelajaran ini merupakan bla bla bla', 26),
(17, 'IPA', 'Pelajaran ini merupakan bla bla bla', 26),
(18, 'Matematika', 'Pelajaran ini merupakan bla bla bla', 27),
(19, 'IPA', 'Pelajaran ini merupakan bla bla bla', 27),
(20, 'Matematika', 'Pelajaran ini merupakan bla bla bla', 30),
(21, 'Matematika', 'Pelajaran ini merupakan bla bla bla', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `file_pdf` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `deskripsi_materi` varchar(255) NOT NULL,
  `id_guru` int(4) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `judul_materi`, `file_pdf`, `video`, `deskripsi_materi`, `id_guru`, `id_mapel`, `id_kelas`, `id_pertemuan`) VALUES
(42, 'Perkenalan', 'Soal.pdf', '217449625_5750906518284085_1297379801338826217_n.mp4', 'Pelajaran ini merupakan bla bla bla', 27, 16, 26, 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `deskripsi_umum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `no_pertemuan` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertemuan`
--

INSERT INTO `pertemuan` (`id_pertemuan`, `no_pertemuan`, `id_mapel`, `id_kelas`) VALUES
(23, 1, 16, 26),
(24, 2, 16, 26),
(25, 1, 18, 27),
(26, 2, 18, 27),
(28, 1, 21, 29),
(29, 2, 21, 29),
(30, 3, 21, 29),
(31, 1, 17, 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(4) NOT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `nisn` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nama_siswa`, `nisn`, `password`, `role_id`, `image`, `alamat`) VALUES
(5, 'siswa 1', '2342342', '$2y$10$VFO9YD47zu/QpPMAu3SNFObX0NC0Sr//I158/vhppEWB.iKsFeUXO', 3, 'Deni_Maulana_s_-_TI_17_A.jpg', 'perumahan karunia indah block c no 17'),
(6, 'aizen', '5643456', '$2y$10$Emren2T7pE9muZfiveb24OX2YE1iquzCWDwTn7uBP4sCY7GqhjCii', 3, 'default.jpg', 'perumahan karunia indah block c no 17'),
(7, 'hasan', '234234234234', '$2y$10$TyRsaWq6NTpAD4eCqJh28.4dGrS9qXocyBHd1ZlQY5OSgPVA/Sb8y', 3, 'default.jpg', 'jalan maju mudur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_pilgan`
--

CREATE TABLE `soal_pilgan` (
  `id_soal` int(11) NOT NULL,
  `id_guru` int(4) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `file` text NOT NULL,
  `soal` text NOT NULL,
  `opsi_a` text NOT NULL,
  `opsi_b` text NOT NULL,
  `opsi_c` text NOT NULL,
  `opsi_d` text NOT NULL,
  `kunci_jawaban` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_pilgan`
--

INSERT INTO `soal_pilgan` (`id_soal`, `id_guru`, `id_kelas`, `id_mapel`, `id_materi`, `id_pertemuan`, `bobot`, `file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `kunci_jawaban`) VALUES
(15, 27, 26, 16, 31, 23, 1, '', '1+1', '1', '2', '3', '4', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id` int(4) NOT NULL,
  `id_guru` int(4) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `jawaban` varchar(128) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id`, `id_guru`, `id_soal`, `id_pertemuan`, `id_mapel`, `jawaban`, `skor`) VALUES
(109, 6, 27, 12, 23, 16, 'A', 1),
(110, 6, 27, 13, 23, 16, 'A', 1),
(111, 6, 27, 14, 23, 16, 'A', 0),
(112, 6, 27, 15, 23, 16, 'B', 1),
(113, 6, 27, 15, 23, 16, 'A', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id` int(4) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `id_guru` int(4) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `benar` varchar(128) NOT NULL,
  `salah` varchar(100) NOT NULL,
  `nilai` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id`, `id_pertemuan`, `id_guru`, `id_mapel`, `benar`, `salah`, `nilai`) VALUES
(7, 6, 23, 27, 16, '1', '1', '50'),
(8, 6, 23, 27, 16, '1', '1', '50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kelas`
--

CREATE TABLE `tipe_kelas` (
  `id_tipe` int(11) NOT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe_kelas`
--

INSERT INTO `tipe_kelas` (`id_tipe`, `nomor`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `soal` text NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `soal`, `id_kelas`, `id_mapel`, `id_pertemuan`, `id_materi`) VALUES
(11, 'fgchfcfgcf', 26, 16, 23, 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `image`, `role_id`, `is_active`) VALUES
(6, 'aizen', 'seirin.fight232@gmail.com', '$2y$10$8pfb0VE/zSfg.J6NPjnf6eX8e99SY4Tl6W4Y/4R0SIlLgQLWRSGqi', 'default.jpg', 1, 1),
(7, 'deni maulana', 'admin1@gmail.com', '$2y$10$wAsjAX455MZEHCda0aKtIuN4ze4Fk1HNwyai5EF7JjqDAMfCE3O1y', 'default.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'operator'),
(2, 'guru'),
(3, 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `file_jawaban`
--
ALTER TABLE `file_jawaban`
  ADD PRIMARY KEY (`id_jawab`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `FK_guru` (`id_guru`),
  ADD KEY `FK_tipekelas` (`id_tipe`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `FK_mapelkelas` (`id_kelas`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `FK_materikelas` (`id_kelas`),
  ADD KEY `FK_materipertemuan` (`id_pertemuan`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`),
  ADD KEY `FK_pertemuanmapel` (`id_mapel`),
  ADD KEY `FK_pertemuankelas` (`id_kelas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `soal_pilgan`
--
ALTER TABLE `soal_pilgan`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `tipe_kelas`
--
ALTER TABLE `tipe_kelas`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `file_jawaban`
--
ALTER TABLE `file_jawaban`
  MODIFY `id_jawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `soal_pilgan`
--
ALTER TABLE `soal_pilgan`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tipe_kelas`
--
ALTER TABLE `tipe_kelas`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `FK_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `FK_tipekelas` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_kelas` (`id_tipe`);

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `FK_mapelkelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `FK_materikelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `FK_materipertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `pertemuan` (`id_pertemuan`);

--
-- Ketidakleluasaan untuk tabel `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD CONSTRAINT `FK_pertemuankelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `FK_pertemuanmapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
