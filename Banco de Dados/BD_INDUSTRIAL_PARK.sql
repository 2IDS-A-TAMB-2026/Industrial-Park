CREATE DATABASE IF NOT EXISTS BD_TCC_2;
USE BD_TCC_2;

CREATE TABLE IF NOT EXISTS EMPRESA(
	EMP_CNPJ VARCHAR(18) PRIMARY KEY,
    EMP_NOME VARCHAR(100) NOT NULL,
    EMP_RUA VARCHAR(100) NOT NULL,
    EMP_NUMERO VARCHAR(5) NOT NULL,
    EMP_CIDADE VARCHAR(100) NOT NULL,
    EMP_STATUS VARCHAR(100) NOT NULL
);

CREATE TABLE USUARIO (
    USU_CPF VARCHAR(14) PRIMARY KEY,
    USU_NOME VARCHAR(100) NOT NULL,
    USU_EMAIL VARCHAR(100) NOT NULL UNIQUE,
    USU_SENHA VARCHAR(255) NOT NULL,
    USU_DATA_NASCIMENTO DATE NULL,
    USU_TIPO ENUM(
        'SUPERADM',
        'ADMIN',
        'PORTEIRO',
        'USUARIO'
    ) NOT NULL,
    FK_EMP_CNPJ VARCHAR(18) NULL, FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA(EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS VAGAS(
	VAG_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    VAG_SETOR VARCHAR(100) NOT NULL,
    VAG_STATUS VARCHAR(100) NOT NULL,
    VAG_LOCALIZACAO VARCHAR(100) NOT NULL,
    FK_EMP_CNPJ VARCHAR(18) NOT NULL,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SENSOR(
	SEN_ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    SEN_STATUS VARCHAR(100) NOT NULL,usuario
    FK_VAG_ID INTEGER NOT NULL,
    FK_EMP_CNPJ VARCHAR(18) NOT NULL,
    FOREIGN KEY (FK_VAG_ID) REFERENCES VAGAS (VAG_ID) ON DELETE CASCADE,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS DADOS(
	DAD_ID INTEGER PRIMARY KEY,
    DAD_MEDIDA VARCHAR(100) NOT NULL,
    DAD_DATA_HORA DATETIME NOT NULL,
    FK_SEN_ID INTEGER,
    FOREIGN KEY (FK_SEN_ID) REFERENCES SENSOR (SEN_ID) ON DELETE CASCADE
);

INSERT INTO EMPRESA (EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS) VALUES
('12345678000101', 'Tech Solutions Ltda', 'Rua das Flores', 100, 'São Paulo', 'Ativa'),
('23456789000102', 'Alpha Sistemas', 'Av. Paulista', 1500, 'São Paulo', 'Ativa'),
('34567890000103', 'Beta Comércio', 'Rua XV de Novembro', 230, 'Curitiba', 'Inativa'),
('45678901000104', 'Gamma Serviços', 'Rua Central', 450, 'Belo Horizonte', 'Ativa'),
('56789012000105', 'Delta Tecnologia', 'Av. Brasil', 890, 'Rio de Janeiro', 'Ativa'),
('67890123000106', 'Epsilon Ltda', 'Rua A', 50, 'Campinas', 'Ativa'),
('78901234000107', 'Zeta Indústria', 'Rua B', 75, 'Porto Alegre', 'Inativa'),
('89012345000108', 'Eta Logística', 'Av. das Nações', 320, 'Brasília', 'Ativa'),
('90123456000109', 'Theta Consultoria', 'Rua C', 120, 'Salvador', 'Ativa'),
('01234567000110', 'Iota Sistemas', 'Av. D', 980, 'Fortaleza', 'Ativa'),
('11223344000111', 'Kappa Tech', 'Rua E', 60, 'Recife', 'Inativa'),
('22334455000112', 'Lambda Comércio', 'Rua F', 210, 'Curitiba', 'Ativa'),
('33445566000113', 'Mu Serviços', 'Av. G', 700, 'São Paulo', 'Ativa'),
('44556677000114', 'Nu Tecnologia', 'Rua H', 33, 'Campinas', 'Ativa'),
('55667788000115', 'Xi Indústria', 'Rua I', 480, 'Manaus', 'Inativa'),
('66778899000116', 'Omicron Ltda', 'Av. J', 555, 'Belém', 'Ativa'),
('77889900000117', 'Pi Sistemas', 'Rua K', 90, 'Goiânia', 'Ativa'),
('88990011000118', 'Rho Comércio', 'Rua L', 120, 'Florianópolis', 'Ativa'),
('99001122000119', 'Sigma Serviços', 'Av. M', 870, 'São Paulo', 'Ativa'),
('10111213000120', 'Tau Tecnologia', 'Rua N', 15, 'Campinas', 'Ativa'),
('12131415000121', 'Upsilon Ltda', 'Rua O', 220, 'Curitiba', 'Inativa'),
('13141516000122', 'Phi Indústria', 'Av. P', 430, 'Belo Horizonte', 'Ativa'),
('14151617000123', 'Chi Logística', 'Rua Q', 310, 'Rio de Janeiro', 'Ativa'),
('15161718000124', 'Psi Consultoria', 'Av. R', 600, 'Brasília', 'Ativa'),
('16171819000125', 'Omega Sistemas', 'Rua S', 80, 'Salvador', 'Inativa'),
('17181920000126', 'Nova Era Tech', 'Av. T', 999, 'Fortaleza', 'Ativa'),
('18192021000127', 'Global Comércio', 'Rua U', 140, 'Recife', 'Ativa'),
('19202122000128', 'Prime Serviços', 'Rua V', 260, 'Campinas', 'Ativa'),
('20212223000129', 'Vision Tecnologia', 'Av. W', 720, 'São Paulo', 'Ativa'),
('21222324000130', 'Master Indústria', 'Rua X', 55, 'Curitiba', 'Inativa');

INSERT INTO USUARIO (USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, USU_TIPO, FK_EMP_CNPJ) VALUES
('12345678901', 'Ana Souza', '1995-03-12', 'ana.souza@email.com', '12345116', 'ADMIN', '12345678000101'),
('23456789012', 'Bruno Lima', '1990-07-25', 'bruno.lima@email.com', '12345006', 'USUARIO', '23456789000102'),
('34567890123', 'Carla Mendes', '1988-11-03', 'carla.mendes@email.com', '12345226', 'PORTEIRO', '34567890000103'),
('45678901234', 'Daniel Rocha', '1992-05-18', 'daniel.rocha@email.com', '12345336', 'USUARIO', '45678901000104'),
('56789012345', 'Eduarda Alves', '2000-01-30', 'eduarda.alves@email.com', '12345644', 'ADMIN', '56789012000105'),
('67890123456', 'Felipe Santos', '1997-09-14', 'felipe.santos@email.com', '12345655', 'PORTEIRO', '67890123000106'),
('78901234567', 'Gabriela Costa', '1993-06-22', 'gabriela.costa@email.com', '12345666', 'USUARIO', '78901234000107'),
('89012345678', 'Henrique Martins', '1985-12-09', 'henrique.martins@email.com', '1234567','USUARIO', '89012345000108'),
('90123456789', 'Isabela Ribeiro', '1998-04-27', 'isabela.ribeiro@email.com', '12345688', 'ADMIN', '90123456000109'),
('11223344556', 'João Pereira', '1991-08-15', 'joao.pereira@email.com', '12345699', 'USUARIO', '01234567000110'),
('22334455667', 'Karina Gomes', '1996-02-11', 'karina.gomes@email.com', '12345698', 'PORTEIRO', '11223344000111'),
('33445566778', 'Lucas Barbosa', '1989-10-05', 'lucas.barbosa@email.com', '12345697', 'PORTEIRO', '22334455000112'),
('44556677889', 'Mariana Freitas', '1994-07-19', 'mariana.freitas@email.com', '12345696', 'USUARIO', '33445566000113'),
('55667788990', 'Nicolas Teixeira', '2001-03-02', 'nicolas.teixeira@email.com', '12345695', 'USUARIO', '44556677000114'),
('66778899001', 'Olivia Duarte', '1999-09-29', 'olivia.duarte@email.com', '12345694', 'USUARIO', '55667788000115'),
('77889900112', 'Paulo Henrique', '1987-11-17', 'paulo.henrique@email.com', '12345632', 'PORTEIRO', '66778899000116'),
('88990011223', 'Queila Fernandes', '1992-06-08', 'queila.fernandes@email.com', '12345623', 'ADMIN', '77889900000117'),
('99001122334', 'Rafael Carvalho', '1995-12-21', 'rafael.carvalho@email.com', '12345621', 'USUARIO', '88990011000118'),
('10111213141', 'Sara Azevedo', '1993-01-13', 'sara.azevedo@email.com', '12345612', 'USUARIO', '99001122000119'),
('12131415161', 'Thiago Lopes', '1986-04-04', 'thiago.lopes@email.com', '12345456', 'PORTEIRO', '10111213000120'),
('13141516171', 'Ursula Batista', '1997-08-26', 'ursula.batista@email.com', '12345656', 'USUARIO', '12131415000121'),
('14151617181', 'Victor Hugo', '1990-10-30', 'victor.hugo@email.com', '12345658', 'USUARIO', '13141516000122'),
('15161718191', 'Wesley Nunes', '1998-05-09', 'wesley.nunes@email.com', '12345657', 'PORTEIRO', '14151617000123'),
('16171819201', 'Ximena Torres', '1994-02-28', 'ximena.torres@email.com', '12345694', 'USUARIO', '15161718000124'),
('17181920211', 'Yasmin Cardoso', '2000-07-07', 'yasmin.cardoso@email.com', '12345614', 'ADMIN', '16171819000125'),
('18192021221', 'Zeca Oliveira', '1985-03-16', 'zeca.oliveira@email.com', '12345645', 'PORTEIRO', '17181920000126'),
('19202122231', 'André Silva', '1991-09-12', 'andre.silva@email.com', '12345616', 'USUARIO', '18192021000127'),
('20212223241', 'Beatriz Rocha', '1996-11-25', 'beatriz.rocha@email.com', '12345614', 'USUARIO', '19202122000128'),
('21222324251', 'Carlos Eduardo', '1988-06-14', 'carlos.eduardo@email.com', '12345617', 'ADMIN', '20212223000129'),
('22232425261', 'Débora Martins', '1999-12-03', 'debora.martins@email.com', '12345610', 'USUARIO', '21222324000130'),
('44232425261', 'SuperAdm', '2008-09-03', 'superadm@email.com', '123456', 'SUPERADM', '10111213000120');

INSERT INTO VAGAS (VAG_ID, VAG_SETOR, VAG_STATUS, VAG_LOCALIZACAO, FK_EMP_CNPJ) VALUES
(1, 'A', 'Livre', 'Piso 1 - A1', '12345678000101'),
(2, 'A', 'Ocupada', 'Piso 1 - A2', '12345678000101'),
(3, 'A', 'Livre', 'Piso 1 - A3', '23456789000102'),
(4, 'A', 'Ocupada', 'Piso 1 - A4', '23456789000102'),
(5, 'B', 'Livre', 'Piso 2 - B1', '34567890000103'),
(6, 'B', 'Ocupada', 'Piso 2 - B2', '34567890000103'),
(7, 'B', 'Livre', 'Piso 2 - B3', '45678901000104'),
(8, 'B', 'Ocupada', 'Piso 2 - B4', '45678901000104'),
(9, 'C', 'Livre', 'Piso 3 - C1', '56789012000105'),
(10, 'C', 'Ocupada', 'Piso 3 - C2', '56789012000105'),
(11, 'C', 'Livre', 'Piso 3 - C3', '67890123000106'),
(12, 'C', 'Ocupada', 'Piso 3 - C4', '67890123000106'),
(13, 'D', 'Livre', 'Piso 4 - D1', '78901234000107'),
(14, 'D', 'Ocupada', 'Piso 4 - D2', '78901234000107'),
(15, 'D', 'Livre', 'Piso 4 - D3', '89012345000108'),
(16, 'D', 'Ocupada', 'Piso 4 - D4', '89012345000108'),
(17, 'E', 'Livre', 'Piso 5 - E1', '90123456000109'),
(18, 'E', 'Ocupada', 'Piso 5 - E2', '90123456000109'),
(19, 'E', 'Livre', 'Piso 5 - E3', '01234567000110'),
(20, 'E', 'Ocupada', 'Piso 5 - E4', '01234567000110'),
(21, 'F', 'Livre', 'Piso 6 - F1', '11223344000111'),
(22, 'F', 'Ocupada', 'Piso 6 - F2', '11223344000111'),
(23, 'F', 'Livre', 'Piso 6 - F3', '22334455000112'),
(24, 'F', 'Ocupada', 'Piso 6 - F4', '22334455000112'),
(25, 'G', 'Livre', 'Piso 7 - G1', '33445566000113'),
(26, 'G', 'Ocupada', 'Piso 7 - G2', '33445566000113'),
(27, 'G', 'Livre', 'Piso 7 - G3', '44556677000114'),
(28, 'G', 'Ocupada', 'Piso 7 - G4', '44556677000114'),
(29, 'H', 'Livre', 'Piso 8 - H1', '55667788000115'),
(30, 'H', 'Ocupada', 'Piso 8 - H2', '55667788000115');

INSERT INTO SENSOR (SEN_ID, SEN_STATUS, FK_VAG_ID, FK_EMP_CNPJ) VALUES
(1, 'Ativo', 1, '12345678000101'),
(2, 'Inativo', 2, '12345678000101'),
(3, 'Ativo', 3, '23456789000102'),
(4, 'Ativo', 4, '23456789000102'),
(5, 'Inativo', 5, '34567890000103'),
(6, 'Ativo', 6, '34567890000103'),
(7, 'Ativo', 7, '45678901000104'),
(8, 'Inativo', 8, '45678901000104'),
(9, 'Ativo', 9, '56789012000105'),
(10, 'Ativo', 10, '56789012000105'),
(11, 'Inativo', 11, '67890123000106'),
(12, 'Ativo', 12, '67890123000106'),
(13, 'Ativo', 13, '78901234000107'),
(14, 'Inativo', 14, '78901234000107'),
(15, 'Ativo', 15, '89012345000108'),
(16, 'Ativo', 16, '89012345000108'),
(17, 'Inativo', 17, '90123456000109'),
(18, 'Ativo', 18, '90123456000109'),
(19, 'Ativo', 19, '01234567000110'),
(20, 'Inativo', 20, '01234567000110'),
(21, 'Ativo', 21, '11223344000111'),
(22, 'Ativo', 22, '11223344000111'),
(23, 'Inativo', 23, '22334455000112'),
(24, 'Ativo', 24, '22334455000112'),
(25, 'Ativo', 25, '33445566000113'),
(26, 'Inativo', 26, '33445566000113'),
(27, 'Ativo', 27, '44556677000114'),
(28, 'Ativo', 28, '44556677000114'),
(29, 'Inativo', 29, '55667788000115'),
(30, 'Ativo', 30, '55667788000115');

INSERT INTO DADOS (DAD_ID, DAD_MEDIDA, DAD_DATA_HORA, FK_SEN_ID) VALUES
(1, 1, '2026-03-01 08:00:00', 1),
(2, 0, '2026-03-01 08:05:00', 2),
(3, 1, '2026-03-01 08:10:00', 3),
(4, 1, '2026-03-01 08:15:00', 4),
(5, 0, '2026-03-01 08:20:00', 5),
(6, 1, '2026-03-01 08:25:00', 6),
(7, 1, '2026-03-01 08:30:00', 7),
(8, 0, '2026-03-01 08:35:00', 8),
(9, 1, '2026-03-01 08:40:00', 9),
(10, 1, '2026-03-01 08:45:00', 10),
(11, 0, '2026-03-01 08:50:00', 11),
(12, 1, '2026-03-01 08:55:00', 12),
(13, 1, '2026-03-01 09:00:00', 13),
(14, 0, '2026-03-01 09:05:00', 14),
(15, 1, '2026-03-01 09:10:00', 15),
(16, 1, '2026-03-01 09:15:00', 16),
(17, 0, '2026-03-01 09:20:00', 17),
(18, 1, '2026-03-01 09:25:00', 18),
(19, 1, '2026-03-01 09:30:00', 19),
(20, 0, '2026-03-01 09:35:00', 20),
(21, 1, '2026-03-01 09:40:00', 21),
(22, 1, '2026-03-01 09:45:00', 22),
(23, 0, '2026-03-01 09:50:00', 23),
(24, 1, '2026-03-01 09:55:00', 24),
(25, 1, '2026-03-01 10:00:00', 25),
(26, 0, '2026-03-01 10:05:00', 26),
(27, 1, '2026-03-01 10:10:00', 27),
(28, 1, '2026-03-01 10:15:00', 28),
(29, 0, '2026-03-01 10:20:00', 29),
(30, 1, '2026-03-01 10:25:00', 30);

SELECT * FROM USUARIO;

ALTER TABLE USUARIO
ADD TOKEN_RECUPERACAO VARCHAR(255) NULL;

ALTER TABLE USUARIO
ADD COLUMN USU_FOTO VARCHAR(255) NULL;

ALTER TABLE DADOS
MODIFY DAD_ID INT NOT NULL AUTO_INCREMENT;

INSERT INTO USUARIO (USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, USU_TIPO, FK_EMP_CNPJ) VALUES
('12345675241', 'Gabriel', '2000-07-16', 'gabriel.evaristo@superadm.com', '123456', 'SUPERADM', '12345678000101');