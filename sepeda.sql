-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Apr 2018 pada 09.32
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
(3, 1, 1, 'n'),
(3, 2, 1, 'n'),
(3, 3, 1, 'n'),
(4, 4, 1, 'n'),
(4, 4, 1, 'n'),
(4, 4, 1, 'n');

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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama`, `kitas`, `tipe`, `telp`, `status`) VALUES
(1, 'Refo Junior', '15632515351', 1, '083114738768', 0),
(2, 'YUI Yoshioka', '156325151', 1, '081222', 1),
(3, 'Kadek Roni', '1112233', 2, '088555', 1),
(4, 'Zephys', '11112', 1, '083114738768', 0);

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
(3, 1, '2018-04-03', '09:49:32', 3, 3, 'n'),
(4, 4, '2018-04-03', '11:57:19', 3, 3, 'n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `kd_transaksi` int(5) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jam_kembali` time NOT NULL,
  `biaya` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`kd_transaksi`, `tanggal_kembali`, `jam_kembali`, `biaya`) VALUES
(0, '0000-00-00', '00:00:00', 0),
(0, '0000-00-00', '00:00:00', 0);

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
(1, 'Wim Cycle', 5, 1, 4),
(2, 'Sepeda Gunung', 3, 1, 2),
(3, 'BMX', 2, 1, 1),
(4, 'palsu', 3, 3, 0);

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
(7, 'token', '49872a5f20b484ead2e9e4c5be9a04c8c355f3a0', 1);

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
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `kd_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sepeda`
--
ALTER TABLE `sepeda`
  MODIFY `id_sepeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
