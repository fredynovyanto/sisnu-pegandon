-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2021 pada 09.48
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisnu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_agt` int(11) NOT NULL,
  `nama_agt` varchar(100) NOT NULL,
  `kelamin_agt` varchar(100) NOT NULL,
  `tmp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_agt`, `nama_agt`, `kelamin_agt`, `tmp_lahir`, `tgl_lahir`, `rt`, `rw`, `status`, `pekerjaan`, `telp`) VALUES
(1, 'Saeful Anwar', 'Laki-Laki', 'Kendal', '12-05-1988', 1, 1, 'Sudah Menikah', 'Pedagang', '0838484993384'),
(3, 'Sarah Mulyani', 'Perempuan', 'Kudus', '1998-06-17', 1, 2, 'Belum Menikah', 'Perawat', '088293445332');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_total_post` int(11) NOT NULL,
  `total_post_views` int(11) NOT NULL,
  `category_status` varchar(11) NOT NULL DEFAULT 'Published',
  `created_on` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_total_post`, `total_post_views`, `category_status`, `created_on`, `created_by`) VALUES
(2, 'Acara Tahunan', 6, 0, 'Published', '2021-01-01', 'Fredy Novyanto'),
(9, 'Rutinan', 2, 0, 'Published', 'Wed, 07-Apr-2021 / 14:34:48 pm', 'Fredy Novyanto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_post_id` int(11) NOT NULL,
  `com_detail` text NOT NULL,
  `com_user_id` int(11) NOT NULL,
  `com_nickname` varchar(255) NOT NULL,
  `com_date` varchar(255) NOT NULL,
  `com_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `com_state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`com_id`, `com_post_id`, `com_detail`, `com_user_id`, `com_nickname`, `com_date`, `com_status`, `com_state`) VALUES
(19, 9, 'Mantap min...', 3, 'Fred', 'Thu, 08-Apr-2021 / 11:44:08 am', 'approved', 1),
(20, 14, 'wow', 3, 'Fred', 'Thu, 27-May-2021 / 12:10:55 pm', 'approved', 1),
(21, 9, 'cek', 4, 'cena', 'Thu, 27-May-2021 / 12:28:49 pm', 'approved', 1),
(23, 13, 'good', 4, 'cena', 'Thu, 27-May-2021 / 12:42:40 pm', 'approved', 1),
(24, 17, 'tes', 3, 'Fred', 'Tue, 08-Jun-2021 / 19:31:44 pm', 'approved', 1),
(25, 9, 'aa', 3, 'Fred', 'Tue, 08-Jun-2021 / 20:48:39 pm', 'unapproved', 0),
(26, 9, 'ss', 3, 'Fred', 'Tue, 08-Jun-2021 / 20:50:22 pm', 'unapproved', 0),
(27, 9, 'aabb', 11, 'adit', 'Tue, 08-Jun-2021 / 20:57:30 pm', 'unapproved', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `msg_username` varchar(255) NOT NULL,
  `msg_email` varchar(255) NOT NULL,
  `msg_detail` text NOT NULL,
  `msg_date` varchar(255) NOT NULL,
  `msg_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `msg_state` int(11) NOT NULL DEFAULT '0',
  `msg_reply` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_username`, `msg_email`, `msg_detail`, `msg_date`, `msg_status`, `msg_state`, `msg_reply`) VALUES
(1, 'John Cena', 'johncena@gmail.com', 'tess', 'Thu, 17-Jun-2021 / 21:54:21 pm', 'Processed', 1, 'hii');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_detail` text NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_image` text NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'Published',
  `post_author` varchar(255) NOT NULL,
  `post_views` int(11) NOT NULL DEFAULT '0',
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_detail`, `post_category_id`, `post_image`, `post_date`, `post_status`, `post_author`, `post_views`, `post_comment_count`, `post_tags`) VALUES
(9, 'Peringatan Isra Miraj 2021', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 2, 'Isra miraj 2021-01.jpg', 'Thu, 01-Apr-2021 / 09:45:37 am', 'Published', 'Fredy Novyanto', 57, 5, 'isra miraj, nu, ipnu, ippnu'),
(10, 'Hari Pahlawan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 2, 'Hari Pahlawan-01.jpg', 'Thu, 01-Apr-2021 / 09:52:21 am', 'Published', 'Fredy Novyanto', 0, 0, 'hari pahlawan, nu, ipnu, ippnu'),
(11, 'Hari Santri 2020', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 2, 'Hari Santri-01.jpg', 'Thu, 01-Apr-2021 / 10:02:16 am', 'Published', 'Fredy Novyanto', 1, 0, 'hari santri 2020, nu, ipnu, ippnu'),
(12, 'Harlah IPNU 2021', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 2, 'Harlah IPNU 2021-01-01.jpg', 'Thu, 01-Apr-2021 / 10:04:06 am', 'Published', 'Fredy Novyanto', 0, 0, 'harlah ipnu 2021, nu, ipnu, ippnu, harlah'),
(13, 'Maulid Nabi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 2, 'Maulid nabi-01.jpg', 'Thu, 01-Apr-2021 / 10:05:21 am', 'Published', 'Fredy Novyanto', 8, 1, 'maulid nabi, Muhammad SAW, nu, ipnu, ippnu'),
(14, 'Rutinan Akbar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium in lectus eu interdum. Duis id felis lobortis, pharetra enim in, dictum lorem. Nunc vestibulum aliquam purus, vitae malesuada elit interdum vitae. Cras cursus, massa nec dictum sollicitudin, risus turpis consequat odio, a tempus turpis dolor a purus. In tempus massa sed quam semper, sit amet sagittis ante condimentum. Maecenas faucibus tincidunt mauris mattis convallis. Pellentesque pretium pretium arcu eu volutpat. Nullam tincidunt finibus tempor. Cras vitae elit vel felis blandit porttitor id a diam. Nam vitae vestibulum lacus. Nam mollis libero et faucibus porttitor. Donec rhoncus fermentum nisl aliquam.', 9, 'rutinan-01.jpg', 'Thu, 01-Apr-2021 / 10:07:20 am', 'Published', 'Fredy Novyanto', 11, 1, 'rutinan, akbar, ipnu, ippnu'),
(17, 'Outbond at Juwero Hills', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sapien rhoncus sapien fringilla sodales sit amet eget risus. Mauris porta semper sem quis tristique. Vestibulum tortor mauris, vulputate at magna eget, laoreet viverra lectus. Duis ornare dictum ultricies. Suspendisse consectetur neque a velit ultrices ultricies. Curabitur lobortis rhoncus metus, vitae lobortis leo dignissim eget. Curabitur id hendrerit ligula, eget dictum erat. Nulla facilisi. Aliquam ante metus, placerat porta nisi sit amet, lacinia viverra elit. Aenean dapibus eu risus id commodo. Donec eu mollis dui. Nam tristique efficitur malesuada. Phasellus vel iaculis quam. Sed quis libero tincidunt orci faucibus facilisis.', 2, 'WhatsApp Image 2020-12-27 at 10.44.45.jpeg', 'Tue, 06-Apr-2021 / 14:01:29 pm', 'Published', 'Fredy Novyanto', 17, 1, 'outbond, juwero hills, ipnu, ippnu'),
(19, 'coba', 'coba', 9, 'WhatsApp Image 2020-09-18 at 18.42.58.jpeg', 'Thu, 17-Jun-2021 / 22:00:04 pm', 'Published', 'Fredy Novyanto', 1, 0, 'coba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `test`
--

INSERT INTO `test` (`id`, `nama`) VALUES
(1, 'ComeFred'),
(2, 'James');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_nickname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_photo` text NOT NULL,
  `registered_on` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'Subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_nickname`, `user_email`, `user_password`, `user_photo`, `registered_on`, `user_role`) VALUES
(3, 'Fredy Novyanto', 'Fred', 'comefred@gmail.com', '$2y$10$PuvDZKNzu3A49j3D0p4BBOPPJfbQKTl/lc7u9dnfTn4VfWP23M6em', 'LOGOKU-01.png', 'January, 21', 'Admin'),
(4, 'John Cena', 'cena', 'johncena@gmail.com', '$2y$10$PKte5h7wUUYux1kK08Kglux7V5zVu9XZj4I9Gr1WRsgG6u9Eo3HkG', 'user.jpg', 'January, 21', 'Subscriber'),
(6, 'Erik Baily', 'ebaily', 'baily@gmail.com', '$2y$10$sBwgcmo9IG0loh/DiP4Q7OY41X8J3z.X0Yc6oyRK5i8dHixsxQz7a', 'baily.jpg', 'Jan 1, 21', 'Subscriber'),
(9, 'Istikhomah', 'isti', 'isti@gmail.com', '$2y$10$0C1DWuUoxl1BJIPSw4uc0O9wndJ2TuVz9lDuiX1iBVgUPI975bQFy', 'dinda.jpg', 'Jan 1, 21', 'Subscriber'),
(10, 'adit', 'adit', 'adit@gmail.com', '$2y$10$TznbQuWqK./9XOQdv7bjoueHdAzoMdpv.dEXfNXAjgtKhCDYhqaiu', '1.jpg', 'Jun 6, 21', 'Admin'),
(11, 'adit adit', 'adit', 'adit1@gmail.com', '$2y$10$lKDF6/tvenf2Dq5jfZ0kqebYDszsfYVfaSyzKmSL1JdRSW4hhI322', 'user.jpg', 'Jun 6, 21', 'Subscriber'),
(12, 'coba lagi', 'coba', 'coba@gmail.com', '$2y$10$zXPa4W5Jut5ZzDXIaLogd.CLvWmEcJTgwRjGrRHHAajeD1CUy83VK', 'user.jpg', 'Jun 6, 21', 'Subscriber');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_agt`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indeks untuk tabel `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_agt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
