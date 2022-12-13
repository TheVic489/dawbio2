CREATE DATABASE IF NOT EXISTS `bankdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `bankdb`;


DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `DNI` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `NAME` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ACCOUNT_TYPE` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `AMOUNT` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `CLIENT_TYPE` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ENTRY_DATE` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;



INSERT INTO `clients` (`DNI`, `NAME`, `ACCOUNT_TYPE`, `AMOUNT`, `CLIENT_TYPE`, `ENTRY_DATE`) VALUES
('24690911C', 'Raulito 213123Abai', 'Investement account', '160.200 €', 'Normal client', '2019-10-12'),
('32548795T', 'Alvin Miller 32312', 'Personal account', '6.000 €', 'Normal client', '8/26/2022'),
('37698459X', 'Jose Miguel Peñ31231a', 'Saving account', '50000 €', 'Poor client', '2012-01-12'),
('38667838P', 'Lucia Barroso Lopez', 'Investement account', '80.458 €', 'Normal client', '2020-10-12'),
('47133424F', 'Raúl Flores Montepinar', 'Investement account', '250.000 €', 'Very rich client', '1999-11-08'),
('54698086S', 'María Isabel Comas la Fuente', 'Personal account', '400.000 €', 'Very rich client', '2008-12-22'),
('82079480R', 'Antonio Rivas Delgado', 'Investement account', '250.000 €', 'Very rich client', '2020-01-26'),
('91785308J', 'Juanito Castro García', 'Fixed deposit account', '1.500 €', 'Poor client', '2021-10-31'),
('96276562B', 'Clara Jiménez Gomez', 'Individual savings account', '2.574 €', 'Poor client', '2018-11-22'),
('99308975N', 'Berta Romero ', 'Savings account', '13.870 €', 'Normal client', '2005-05-25');

-
ALTER TABLE `clients`
  ADD PRIMARY KEY (`DNI`);
COMMIT;