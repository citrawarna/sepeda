-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Apr 2018 pada 05.19
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepeda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `kd_transaksi` int(11) NOT NULL,
  `id_sepeda` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kembali` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`kd_transaksi`, `id_sepeda`, `jumlah`, `kembali`) VALUES
(3, 1, 1, 'y'),
(3, 2, 1, 'y'),
(3, 3, 1, 'y'),
(4, 4, 1, 'y'),
(4, 4, 1, 'y'),
(4, 4, 1, 'y'),
(5, 3, 1, 'y'),
(6, 3, 1, 'y'),
(6, 2, 1, 'y'),
(7, 6, 1, 'y'),
(7, 6, 1, 'y'),
(7, 5, 1, 'y'),
(7, 5, 1, 'y'),
(7, 7, 1, 'y'),
(7, 7, 1, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(5) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `kitas` varchar(20) NOT NULL,
  `tipe` int(1) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `hapus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama`, `kitas`, `tipe`, `telp`, `status`, `hapus`) VALUES
(1, 'Refo Junior', '15632515351', 1, '083114738768', 1, 'n'),
(2, 'YUI Yoshioka', '156325151', 1, '081222', 1, 'n'),
(3, 'Kadek Roni', '1112233', 2, '088555', 1, 'n'),
(4, 'Zephys', '11112', 1, '083114738768', 1, 'n'),
(5, 'Hapus', '5176848213215', 2, '083114738768', 1, 'y'),
(6, 'Superman', '160030767', 4, '083114738768', 1, 'n'),
(7, 'Violet', '6331032125', 2, '081222', 1, 'n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kd_transaksi` int(5) NOT NULL,
  `id_member` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_pinjam` time NOT NULL,
  `total_sepeda` int(3) NOT NULL,
  `dibawa` int(11) NOT NULL,
  `selesai` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`kd_transaksi`, `id_member`, `tanggal`, `jam_pinjam`, `total_sepeda`, `dibawa`, `selesai`) VALUES
(3, 1, '2018-04-05', '08:49:32', 3, 0, 'y'),
(4, 4, '2018-04-03', '11:57:19', 3, 0, 'y'),
(5, 2, '2018-04-06', '08:24:36', 1, 0, 'y'),
(6, 3, '2018-04-05', '10:58:26', 2, 0, 'y'),
(7, 6, '2018-04-06', '09:59:08', 6, 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `kd_transaksi` int(5) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jam_kembali` time NOT NULL,
  `durasi_pinjam` int(11) NOT NULL,
  `biaya` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`kd_transaksi`, `tanggal_kembali`, `jam_kembali`, `durasi_pinjam`, `biaya`) VALUES
(3, '2018-04-05', '09:14:42', 1, 15000),
(6, '2018-04-05', '11:13:50', 1, 10000),
(4, '2018-04-05', '13:31:30', 2, 30000),
(7, '2018-04-06', '10:51:39', 1, 30000),
(5, '2018-04-06', '11:02:35', 3, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepeda`
--

CREATE TABLE `sepeda` (
  `id_sepeda` int(11) NOT NULL,
  `nama_sepeda` varchar(100) NOT NULL,
  `jumlah_sepeda` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `ready` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sepeda`
--

INSERT INTO `sepeda` (`id_sepeda`, `nama_sepeda`, `jumlah_sepeda`, `dipinjam`, `ready`) VALUES
(1, 'Wim Cycle', 5, 0, 5),
(2, 'Sepeda Gunung', 3, 0, 3),
(3, 'BMX', 2, 0, 2),
(4, 'palsu', 3, 0, 3),
(5, 'Polygon', 10, 0, 10),
(6, 'Sepeda Ontel', 5, 0, 5),
(7, 'Hybrid', 2, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(3) NOT NULL,
  `param` varchar(32) NOT NULL,
  `value` varchar(200) NOT NULL,
  `stat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `param`, `value`, `stat`) VALUES
(1, 'username', 'admin', 1),
(2, 'password', 'admin', 1),
(3, 'harga', '5000', 1),
(4, 'paging', '20', 1),
(6, 'valid_time', '10', 1),
(7, 'token', '0e56978fda4209a6d9e6b1d3e128423ff56ab784', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indexes for table `sepeda`
--
ALTER TABLE `sepeda`
  ADD PRIMARY KEY (`id_sepeda`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `kd_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sepeda`
--
ALTER TABLE `sepeda`
  MODIFY `id_sepeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
