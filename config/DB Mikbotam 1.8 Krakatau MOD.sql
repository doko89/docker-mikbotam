-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Bulan Mei 2019 pada 02.51
-- Versi server: 10.2.23-MariaDB-cll-lve
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pusatme1_demo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mikhbotam_id`
--

CREATE TABLE `mikhbotam_id` (
  `u_id` int(11) NOT NULL,
  `u_user` varchar(50) NOT NULL,
  `u_pass` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `enct` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL DEFAULT '',
  `lastlogin` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mikhbotam_id`
--

INSERT INTO `mikhbotam_id` (`u_id`, `u_user`, `u_pass`, `token`, `enct`, `version`, `lastlogin`, `ip`, `user`, `status`) VALUES
(12102, 'admin', 'admin', '', '', 'Version 1.8 Krakatau - MOD', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `re_customer`
--

CREATE TABLE `re_customer` (
  `No` int(100) NOT NULL,
  `Nama_Pelanggan` varchar(500) DEFAULT NULL,
  `Alamat_Pelanggan` varchar(500) DEFAULT NULL,
  `Kapasitas Pelangan` varchar(500) DEFAULT NULL,
  `CID` varchar(500) DEFAULT NULL,
  `IP_Router` varchar(500) DEFAULT NULL,
  `IP_AcessPoint` varchar(500) DEFAULT NULL,
  `IP_Station` varchar(500) DEFAULT NULL,
  `Loc_POP` varchar(500) DEFAULT NULL,
  `SSID` varchar(500) NOT NULL,
  `FREQUENSI` varchar(500) NOT NULL,
  `Vlan` varchar(500) NOT NULL,
  `Switch` varchar(500) NOT NULL,
  `Routing` varchar(500) NOT NULL,
  `BGP` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `re_operating`
--

CREATE TABLE `re_operating` (
  `No` int(20) NOT NULL,
  `id_user` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama_seller` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_awal` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Type_` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `beli_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `markup_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `format_markup` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `armatika_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `saldo_akhir` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `top_up` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `top_up_fromid` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `bagi_saldo_to_id` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `bagi_saldo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `prefix` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `password_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `exp_voucher` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Router_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `penjualan` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `total_voc_terjual` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Waktu` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Tanggal` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `re_settings`
--

CREATE TABLE `re_settings` (
  `No` int(20) NOT NULL,
  `id_user` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama_seller` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomer_tlp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` varchar(1000) CHARACTER SET latin1 DEFAULT '0',
  `voucher_terjual` varchar(50) CHARACTER SET latin1 DEFAULT '0',
  `jumlah_debit_terjual` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `join` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `other` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `othertho` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `othertree` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `settings` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `markuplast` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `voucherlast` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `typelast` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Waktu` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Tanggal` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_graffic`
--

CREATE TABLE `st_graffic` (
  `No` int(11) NOT NULL,
  `_sum` varchar(500) NOT NULL,
  `_min` varchar(500) NOT NULL,
  `_lastdate` varchar(500) NOT NULL,
  `_lasttime` varchar(500) NOT NULL,
  `_lastmonth` varchar(500) NOT NULL,
  `_lasttpye` varchar(500) NOT NULL,
  `_lastupdate` varchar(500) NOT NULL,
  `_textsettings` text NOT NULL,
  `_setup` varchar(500) NOT NULL,
  `_other` text NOT NULL,
  `_Settings` varchar(500) NOT NULL,
  `_settingsother` text NOT NULL,
  `_jstype` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_mikbotam`
--

CREATE TABLE `st_mikbotam` (
  `No` int(20) NOT NULL,
  `_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token_bot` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username_bot` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nama_bot` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nama_router` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IP_router` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `Username_router` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pass_router` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Port` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `dnsname` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `Owner` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `Id_owner` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `Voucher_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Voucher_nonsaldo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Voucher_userman` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Voucher_hotel` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Voucher_generate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PPP_Manager` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Hotspot_Manager` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Level_Plan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `User_Plan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Manager_Plan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Text_setup` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setingstext` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settingsother` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ether` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autoreflash` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `othertho` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `othertree` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tanggal_diubah` varchar(500) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_monitoring`
--

CREATE TABLE `st_monitoring` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Host` varchar(50) DEFAULT NULL,
  `Lokasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_ppp`
--

CREATE TABLE `st_ppp` (
  `No` int(11) NOT NULL,
  `_type` varchar(500) NOT NULL,
  `_lastdate` varchar(500) NOT NULL,
  `_lastupdate` varchar(500) NOT NULL,
  `_experidmode` varchar(500) NOT NULL,
  `_username` varchar(500) NOT NULL,
  `_pass` varchar(500) NOT NULL,
  `_experiddate` varchar(500) NOT NULL,
  `_settings` text NOT NULL,
  `_settingsother` text NOT NULL,
  `_voucherppp` text NOT NULL,
  `_profileppp` varchar(500) NOT NULL,
  `_curpp` text NOT NULL,
  `_notnow` text NOT NULL,
  `_other` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_reportdata`
--

CREATE TABLE `st_reportdata` (
  `No` int(20) NOT NULL,
  `id_user` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama_user` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaksi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendapatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `Waktu` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Tanggal` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_smsgateway`
--

CREATE TABLE `st_smsgateway` (
  `no` int(11) NOT NULL,
  `_id` varchar(50) DEFAULT NULL,
  `Token` varchar(100) DEFAULT NULL,
  `ipserver` varchar(50) DEFAULT NULL,
  `callbackserver` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `st_voucher`
--

CREATE TABLE `st_voucher` (
  `No` int(11) NOT NULL,
  `_type` varchar(500) NOT NULL,
  `_generate` text NOT NULL,
  `_lastdate` varchar(500) NOT NULL,
  `_settings` varchar(500) NOT NULL,
  `_setingsother` varchar(500) NOT NULL,
  `_voucherhotpot` text NOT NULL,
  `_hotspotuser` varchar(500) NOT NULL,
  `_hospotpass` varchar(500) NOT NULL,
  `_usernamaner` text NOT NULL,
  `_usermanuser` varchar(500) NOT NULL,
  `_usermanpass` varchar(500) NOT NULL,
  `_experide` varchar(500) NOT NULL,
  `_routername` varchar(500) NOT NULL,
  `_user` varchar(500) NOT NULL,
  `_ip` varchar(500) NOT NULL,
  `_setnow` text NOT NULL,
  `_other` text NOT NULL,
  `_updatedate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `re_customer`
--
ALTER TABLE `re_customer`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `re_operating`
--
ALTER TABLE `re_operating`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `re_settings`
--
ALTER TABLE `re_settings`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `st_graffic`
--
ALTER TABLE `st_graffic`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `st_mikbotam`
--
ALTER TABLE `st_mikbotam`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `st_monitoring`
--
ALTER TABLE `st_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `st_ppp`
--
ALTER TABLE `st_ppp`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `st_reportdata`
--
ALTER TABLE `st_reportdata`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `st_voucher`
--
ALTER TABLE `st_voucher`
  ADD PRIMARY KEY (`No`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `re_operating`
--
ALTER TABLE `re_operating`
  MODIFY `No` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `re_settings`
--
ALTER TABLE `re_settings`
  MODIFY `No` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `st_graffic`
--
ALTER TABLE `st_graffic`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `st_mikbotam`
--
ALTER TABLE `st_mikbotam`
  MODIFY `No` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `st_monitoring`
--
ALTER TABLE `st_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `st_ppp`
--
ALTER TABLE `st_ppp`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `st_reportdata`
--
ALTER TABLE `st_reportdata`
  MODIFY `No` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `st_voucher`
--
ALTER TABLE `st_voucher`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
