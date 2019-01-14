-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2018 pada 10.33
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `synopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `image`, `synopsis`) VALUES
(1, 'Nota Hidup', 'Ilham Wahabi GX', 'http://pngimg.com/uploads/book/book_PNG2113.png', 'Buku yang penuh dengan harapan dan pencerahan.'),
(2, 'buku apa', 'si eta', 'http://3.bp.blogspot.com/-hZhqHcfBKSg/TpxKA-8ffKI/AAAAAAAACY4/4pfiHDHr-58/s1600/a.jpg', 'bkjvndfv  nvbjdfv a ajvadmdmvmdmvmmvdmvdmmdvdvvdvndndv');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL,
  `jumlah` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `book_id`, `rating`, `comment`, `jumlah`, `time`) VALUES
(1, 1, 1, 5, 'Nice', 2, '2018-10-26 13:26:47'),
(2, 2, 2, -1, '', 3, '2018-10-22 08:48:29'),
(26, 10, 1, 0, '', 1, '2018-10-26 15:30:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `address`, `phone`, `image`, `token`) VALUES
(1, 'abi', 'ilham wahabi', 'abi@gmail.com', '$2y$10$Ms9HJSRNY2Facguw.zIdU.wGT5HoHEg1bsCVbOmzqpxpeD902z1B6', 'di suajjfdbvldfjvcbnc jvnkf, jv', '082361876116', '../images/9.jpg', ''),
(2, 'hamdi1', 'hamdi', 'hamdi@gmail.com', '$2y$10$Ms9HJSRNY2Facguw.zIdU.wGT5HoHEg1bsCVbOmzqpxpeD902z1B6', 'idbhaljb nma  coinvj jddsnnd', '082361876117', '../images/querybaru.png', ''),
(3, 'upi1', 'upi', 'upi@gmail.com', '$2y$10$Ms9HJSRNY2Facguw.zIdU.wGT5HoHEg1bsCVbOmzqpxpeD902z1B6', 'dhjsa hbnndd nd  ejfecnnce  c en cen cen c', '082361876118', '../images/querybaru.png', ''),
(4, 'hamdi2', 'Hamdi A Z', 'hamdi@hamdi.com', '$2y$10$Ms9HJSRNY2Facguw.zIdU.wGT5HoHEg1bsCVbOmzqpxpeD902z1B6', 'Jl. Cisitu Baru Dalam no. 73 A', '082361876115', '../images/querybaru.png', ''),
(9, 'ilhamwahabigx', 'Ilham Wahabi GX', 'wahabiputra@gmail.com', '$2y$10$87FbnYle3Ps2FapG2pQKOu/O6DdLHtg4YeVPq8OUazayGvg9noou.', 'Sadang Luhur 12 Sekeloa, Coblong', '081224263696', '../assets/images/9.jpg', ''),
(10, 'ilhamwahabi', 'Ilham Wahabi', 'wahabi@gmail.com', '$2y$10$MuY/mnWn3VCOeyiDQgBlce6kJ9oKSeQifgRK5NB9y5yq1.n0aCN7G', 'Sadang Luhur 12\r\nSekeloa, Coblong', '081224263696', '../assets/images/10.jpeg', ''),
(27, 'gx', 'gx', 'gx@gmail.com', '$2y$10$hzCWBtTmsGo2Q1L2R0rRZ.v4nc56yknjzKPihRUJtKq5t8tubfXYq', 'gx', '081224263696', '', ''),
(28, 'bro', 'bro', 'bro@gmail.com', '$2y$10$US491bbqpS6xiDdgLqaNHOUDfH6lvkFWTKzXWmPOZ.jFp.u6yNcqu', 'asd', '81224263696', '', ''),
(29, 'asd', 'asd', 'asd@gmail.com', '$2y$10$rWAmoZDlZl/8sXhxmCW2aOkU3inw9Y9yOmPdrDtpnOfjlYod4Rt7W', 'asdf', '81224263696', '', ''),
(30, 'zxc', 'zxc', 'zxc@mail.com', '$2y$10$mGrnDF7cov3hemxpym2q0eCgWzPusLBHVBhQarbTsI5jH0zjiKf4K', 'zxc', '81224263696', '', ''),
(31, 'kimbel', 'kimbek', 'kimbek@gmail.com', '$2y$10$n0wZyLbNX9k4nluxMj0SfO4kgHUWR3kvQJY8gP6HauCPKZnpkRAH6', 'kimbek', '81224263696', '', ''),
(32, 'a', 'a', 'a@mail.com', '$2y$10$dZaQTB42wtDqDwtM.1Uiu.UdjBezRGNvUJpeoPqbg0kKP6yl6aIBC', 'a', '81224263696', '', ''),
(34, 'anj', 'anj', 'anj@gmail.com', '$2y$10$n4reSIy.KKM57UlwBSqOWOnLwIXQ5Ny44mSOXacdsQEf/K6bL.VXi', 'Sadang Luhur 12\r\nSekeloa, Coblong', '81224263696', '', ''),
(35, 'ok', 'ok', 'ok@ok.com', '$2y$10$7y4oAnE7uflzggHM60iFU.fSf.x6visoYv8OFrcE3n8APrpwWfbDu', 'ok', '81224263696', '', ''),
(36, 'hg', 'hg', 'hg@mail.com', '$2y$10$Xf0Li4Jlf4fZZDqxmNwdduMr5I5/eWdUruF/rhh.G6iUlxEWMlYW6', 'hg', '81224263696', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
