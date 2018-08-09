-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 08 août 2018 à 00:45
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` date NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'marc', 'muhammed-inan@outlook.com', 'edddd'),
(3, 'marc', 'yoyo@hotmail.fr', 'edddd');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `creation_date`, `user_id`) VALUES
(4, 'toto', 'salut', '2018-05-16', 2),
(12, 'PHP', '<p><span style=\"color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">Ce programme est extr&ecirc;mement simple et vous n\'avez pas besoin de PHP pour cr&eacute;er une page web comme ceci. Elle ne fait qu\'afficher</span><em style=\"text-rendering: optimizeLegibility; color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">Bonjour le monde</em><span style=\"color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">, gr&acirc;ce &agrave; la fonction&nbsp;</span><span class=\"function\" style=\"color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\"><a class=\"function\" style=\"border-bottom: 1px solid; text-decoration-line: none; color: #336699;\" href=\"http://php.net/manual/fr/function.echo.php\">echo</a></span><span style=\"color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">&nbsp;de PHP. Notez que ce fichier&nbsp;</span><em class=\"emphasis\" style=\"text-rendering: optimizeLegibility; color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">n\'a pas besoin d\'&ecirc;tre ex&eacute;cutable</em><span style=\"color: #333333; font-family: \'Fira Sans\', \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #f2f2f2;\">&nbsp;ou autre, dans aucun cas. Le serveur sait que ce fichier a besoin d\'&ecirc;tre interpr&eacute;t&eacute; par PHP car vous utilisez l\'extension \".php\", et le serveur est configur&eacute; pour les passer &agrave; PHP. Voyez cela comme une page HTML normale qui contient une s&eacute;rie de balises sp&eacute;ciales qui vont vous permettre de r&eacute;aliser beaucoup de choses int&eacute;ressantes.</span></p>', '2018-08-02', 3),
(13, 'html', '<p>code html</p>', '2018-08-02', 3),
(14, 'html', '<p>html 5</p>', '2018-08-06', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(3, 'toto', '$2y$12$ntbXV9Dz1hKdmQ9D.cFvSuMpuPmJxHMq61IAg5vnad/5o.7El8a42', 'muhammed-inan@outlook.com', 'ADMIN'),
(6, 'dupond', '$2y$12$Bb3NEFfBZAJ1.wg2uF8Ydekd5urWKH23IEyebVrobqGBO7NHcJwvS', 'muhammed-inan@outlook.com', 'ADMIN'),
(7, 'fener', '$2y$12$RbK7DWlc0It6iFnoDjrNGeEoqjNgVB.f0rXsCTDRt.iBH0zozzlCG', 'toto@hotmailfr', 'ADMIN'),
(8, 'dupond', '$2y$12$RdI/R8XSKd8NlDt2qX16Wea1sQnqob0qu2yp71UcTILGhVqUizYxy', 'dupond@hotmail.fr', 'ADMIN');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_comments_fk` (`post_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_medias_fk` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_posts_fk` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `posts_comments_fk` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `posts_medias_fk` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
