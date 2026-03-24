CREATE DATABASE IF NOT EXISTS BD_INDUSTRIAL_PARK;
USE BD_INDUSTRIAL_PARK;

CREATE TABLE IF NOT EXISTS EMPRESA(
	EMP_CNPJ VARCHAR(15) PRIMARY KEY,
    EMP_NOME VARCHAR(100) NOT NULL,
    EMP_RUA VARCHAR(100) NOT NULL,
    EMP_NUMERO VARCHAR(5) NOT NULL,
    EMP_CIDADE VARCHAR(100) NOT NULL,
    EMP_STATUS VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS USUARIO(
	USU_CPF VARCHAR(14) PRIMARY KEY,
    USU_NOME VARCHAR(100) NOT NULL,
    USU_DATA_NASCIMENTO DATE NOT NULL,
    USU_EMAIL VARCHAR(100) NOT NULL,
    USU_SENHA VARCHAR(8) NOT NULL,
    FK_EMP_CNPJ VARCHAR(15) NOT NULL,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS PORTEIRO(
	POR_CPF VARCHAR(14) PRIMARY KEY,
    POR_NOME VARCHAR(100) NOT NULL,
    POR_EMAIL VARCHAR(100) NOT NULL,
    POR_DATA_NASCIMENTO DATE NOT NULL,
    POR_SENHA VARCHAR(8) NOT NULL,
    FK_EMP_CNPJ VARCHAR(15) NOT NULL,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SUPERADM(
	SUP_CPF VARCHAR(14) PRIMARY KEY,
    SUP_NOME VARCHAR(100) NOT NULL,
    SUP_EMAIL VARCHAR(100) NOT NULL,
    SUP_SENHA VARCHAR(8) NOT NULL
);

CREATE TABLE IF NOT EXISTS ADMINISTRADOR(
	ADM_CPF VARCHAR(14) PRIMARY KEY,
    ADM_NOME VARCHAR(100) NOT NULL,
    ADM_EMAIL VARCHAR(100) NOT NULL,
    ADM_SENHA VARCHAR(8) NOT NULL,
    FK_EMP_CNPJ VARCHAR(15) NOT NULL,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS VAGAS(
	VAG_CODIGO VARCHAR(100) PRIMARY KEY,
    VAG_SETOR VARCHAR(100) NOT NULL,
    VAG_STATUS VARCHAR(100) NOT NULL,
    VAG_LOCALIZACAO VARCHAR(100) NOT NULL,
    FK_EMP_CNPJ VARCHAR(15) NOT NULL,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SETOR(
	SET_ID INTEGER PRIMARY KEY,
    SET_STATUS VARCHAR(100) NOT NULL,
    FK_VAG_CODIGO VARCHAR(100) NOT NULL,
    FK_EMP_CNPJ VARCHAR(15) NOT NULL,
    FOREIGN KEY (FK_VAG_CODIGO) REFERENCES VAGAS (VAG_CODIGO) ON DELETE CASCADE,
    FOREIGN KEY (FK_EMP_CNPJ) REFERENCES EMPRESA (EMP_CNPJ) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS DADOS(
	DAD_ID INTEGER PRIMARY KEY,
    DAD_MEDIDA VARCHAR(100) NOT NULL,
    DAD_DATA_HORA DATETIME NOT NULL,
    FK_SET_ID INTEGER,
    FOREIGN KEY (FK_SET_ID) REFERENCES SETOR (SET_ID) ON DELETE CASCADE
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

INSERT INTO SUPERADM (SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA) VALUES
('10000000001', 'Admin Master', 'admin1@email.com', '12345678'),
('10000000002', 'Carlos Silva', 'carlos.silva@email.com', '12345687'),
('10000000003', 'Fernanda Souza', 'fernanda.souza@email.com', '12345696'),
('10000000004', 'João Mendes', 'joao.mendes@email.com', '12345669'),
('10000000005', 'Mariana Lima', 'mariana.lima@email.com', '12345654'),
('10000000006', 'Ricardo Alves', 'ricardo.alves@email.com', '12345645'),
('10000000007', 'Patrícia Gomes', 'patricia.gomes@email.com', '12345644'),
('10000000008', 'Lucas Rocha', 'lucas.rocha@email.com', '12345611'),
('10000000009', 'Juliana Costa', 'juliana.costa@email.com', '12345634'),
('10000000010', 'Bruno Pereira', 'bruno.pereira@email.com', '12345642'),
('10000000011', 'Amanda Ribeiro', 'amanda.ribeiro@email.com', '12345623'),
('10000000012', 'Felipe Martins', 'felipe.martins@email.com', '12345625'),
('10000000013', 'Camila Freitas', 'camila.freitas@email.com', '12345646'),
('10000000014', 'Thiago Teixeira', 'thiago.teixeira@email.com', '12345654'),
('10000000015', 'Larissa Duarte', 'larissa.duarte@email.com', '12345611'),
('10000000016', 'Gustavo Fernandes', 'gustavo.fernandes@email.com', '12345600'),
('10000000017', 'Aline Carvalho', 'aline.carvalho@email.com', '12345600'),
('10000000018', 'Rafael Barbosa', 'rafael.barbosa@email.com', '12345601'),
('10000000019', 'Beatriz Azevedo', 'beatriz.azevedo@email.com', '12345613'),
('10000000020', 'Eduardo Lopes', 'eduardo.lopes@email.com', '12345612'),
('10000000021', 'Vanessa Batista', 'vanessa.batista@email.com', '12345617'),
('10000000022', 'Diego Nunes', 'diego.nunes@email.com', '12345671'),
('10000000023', 'Isabela Torres', 'isabela.torres@email.com', '12345680'),
('10000000024', 'Renato Cardoso', 'renato.cardoso@email.com', '12345681'),
('10000000025', 'Paula Oliveira', 'paula.oliveira@email.com', '12345616'),
('10000000026', 'André Santos', 'andre.santos@email.com', '12345650'),
('10000000027', 'Natália Rocha', 'natalia.rocha@email.com', '12345613'),
('10000000028', 'Fábio Moreira', 'fabio.moreira@email.com', '12345637'),
('10000000029', 'Débora Pinto', 'debora.pinto@email.com', '12345661'),
('10000000030', 'Leonardo Vieira', 'leonardo.vieira@email.com', '12345615');

INSERT INTO USUARIO (USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, FK_EMP_CNPJ) VALUES
('12345678901', 'Ana Souza', '1995-03-12', 'ana.souza@email.com', '12345116', '12345678000101'),
('23456789012', 'Bruno Lima', '1990-07-25', 'bruno.lima@email.com', '12345006', '23456789000102'),
('34567890123', 'Carla Mendes', '1988-11-03', 'carla.mendes@email.com', '12345226', '34567890000103'),
('45678901234', 'Daniel Rocha', '1992-05-18', 'daniel.rocha@email.com', '12345336', '45678901000104'),
('56789012345', 'Eduarda Alves', '2000-01-30', 'eduarda.alves@email.com', '12345644', '56789012000105'),
('67890123456', 'Felipe Santos', '1997-09-14', 'felipe.santos@email.com', '12345655', '67890123000106'),
('78901234567', 'Gabriela Costa', '1993-06-22', 'gabriela.costa@email.com', '12345666', '78901234000107'),
('89012345678', 'Henrique Martins', '1985-12-09', 'henrique.martins@email.com', '1234567', '89012345000108'),
('90123456789', 'Isabela Ribeiro', '1998-04-27', 'isabela.ribeiro@email.com', '12345688', '90123456000109'),
('11223344556', 'João Pereira', '1991-08-15', 'joao.pereira@email.com', '12345699', '01234567000110'),
('22334455667', 'Karina Gomes', '1996-02-11', 'karina.gomes@email.com', '12345698', '11223344000111'),
('33445566778', 'Lucas Barbosa', '1989-10-05', 'lucas.barbosa@email.com', '12345697', '22334455000112'),
('44556677889', 'Mariana Freitas', '1994-07-19', 'mariana.freitas@email.com', '12345696', '33445566000113'),
('55667788990', 'Nicolas Teixeira', '2001-03-02', 'nicolas.teixeira@email.com', '12345695', '44556677000114'),
('66778899001', 'Olivia Duarte', '1999-09-29', 'olivia.duarte@email.com', '12345694', '55667788000115'),
('77889900112', 'Paulo Henrique', '1987-11-17', 'paulo.henrique@email.com', '12345632', '66778899000116'),
('88990011223', 'Queila Fernandes', '1992-06-08', 'queila.fernandes@email.com', '12345623', '77889900000117'),
('99001122334', 'Rafael Carvalho', '1995-12-21', 'rafael.carvalho@email.com', '12345621', '88990011000118'),
('10111213141', 'Sara Azevedo', '1993-01-13', 'sara.azevedo@email.com', '12345612', '99001122000119'),
('12131415161', 'Thiago Lopes', '1986-04-04', 'thiago.lopes@email.com', '12345456', '10111213000120'),
('13141516171', 'Ursula Batista', '1997-08-26', 'ursula.batista@email.com', '12345656', '12131415000121'),
('14151617181', 'Victor Hugo', '1990-10-30', 'victor.hugo@email.com', '12345658', '13141516000122'),
('15161718191', 'Wesley Nunes', '1998-05-09', 'wesley.nunes@email.com', '12345657', '14151617000123'),
('16171819201', 'Ximena Torres', '1994-02-28', 'ximena.torres@email.com', '12345694', '15161718000124'),
('17181920211', 'Yasmin Cardoso', '2000-07-07', 'yasmin.cardoso@email.com', '12345614', '16171819000125'),
('18192021221', 'Zeca Oliveira', '1985-03-16', 'zeca.oliveira@email.com', '12345645', '17181920000126'),
('19202122231', 'André Silva', '1991-09-12', 'andre.silva@email.com', '12345616', '18192021000127'),
('20212223241', 'Beatriz Rocha', '1996-11-25', 'beatriz.rocha@email.com', '12345614', '19202122000128'),
('21222324251', 'Carlos Eduardo', '1988-06-14', 'carlos.eduardo@email.com', '12345617', '20212223000129'),
('22232425261', 'Débora Martins', '1999-12-03', 'debora.martins@email.com', '12345610', '21222324000130');

INSERT INTO PORTEIRO (POR_CPF, POR_NOME, POR_EMAIL, POR_DATA_NASCIMENTO, POR_SENHA, FK_EMP_CNPJ) VALUES
('30000000001', 'Pedro Alves', 'pedro.alves@email.com', '1985-02-10', '12345678', '12345678000101'),
('30000000002', 'Lucas Pereira', 'lucas.pereira@email.com', '1990-06-15', '87654321', '23456789000102'),
('30000000003', 'Marcos Silva', 'marcos.silva@email.com', '1988-09-20', '11223344', '34567890000103'),
('30000000004', 'José Santos', 'jose.santos@email.com', '1979-12-05', '44332211', '45678901000104'),
('30000000005', 'Carlos Souza', 'carlos.souza@email.com', '1992-03-18', '55667788', '56789012000105'),
('30000000006', 'André Lima', 'andre.lima@email.com', '1987-07-22', '88776655', '67890123000106'),
('30000000007', 'Rogério Gomes', 'rogerio.gomes@email.com', '1983-11-30', '13572468', '78901234000107'),
('30000000008', 'Paulo Mendes', 'paulo.mendes@email.com', '1995-01-14', '86427531', '89012345000108'),
('30000000009', 'Fernando Rocha', 'fernando.rocha@email.com', '1986-05-27', '10293847', '90123456000109'),
('30000000010', 'Bruno Martins', 'bruno.martins@email.com', '1991-08-09', '56473829', '01234567000110'),
('30000000011', 'Ricardo Costa', 'ricardo.costa@email.com', '1984-04-12', '19283746', '11223344000111'),
('30000000012', 'Daniel Ferreira', 'daniel.ferreira@email.com', '1993-10-03', '64738291', '22334455000112'),
('30000000013', 'Thiago Barbosa', 'thiago.barbosa@email.com', '1989-06-25', '91827364', '33445566000113'),
('30000000014', 'Eduardo Carvalho', 'eduardo.carvalho@email.com', '1996-02-17', '37482910', '44556677000114'),
('30000000015', 'Gustavo Ribeiro', 'gustavo.ribeiro@email.com', '1982-09-11', '56781234', '55667788000115'),
('30000000016', 'Felipe Duarte', 'felipe.duarte@email.com', '1994-12-29', '43218765', '66778899000116'),
('30000000017', 'Leandro Nunes', 'leandro.nunes@email.com', '1987-03-07', '24681357', '77889900000117'),
('30000000018', 'Rafael Teixeira', 'rafael.teixeira@email.com', '1990-07-19', '75318642', '88990011000118'),
('30000000019', 'Diego Fernandes', 'diego.fernandes@email.com', '1985-11-23', '15935748', '99001122000119'),
('30000000020', 'Vinicius Azevedo', 'vinicius.azevedo@email.com', '1992-01-30', '85245612', '10111213000120'),
('30000000021', 'Alexandre Lopes', 'alexandre.lopes@email.com', '1988-05-16', '95175384', '12131415000121'),
('30000000022', 'Márcio Batista', 'marcio.batista@email.com', '1983-08-28', '45612378', '13141516000122'),
('30000000023', 'Cláudio Cardoso', 'claudio.cardoso@email.com', '1991-10-10', '78945612', '14151617000123'),
('30000000024', 'Roberto Oliveira', 'roberto.oliveira@email.com', '1986-06-06', '32165498', '15161718000124'),
('30000000025', 'Fábio Santos', 'fabio.santos@email.com', '1993-04-21', '74185296', '16171819000125'),
('30000000026', 'Jorge Moreira', 'jorge.moreira@email.com', '1980-12-12', '96325874', '17181920000126'),
('30000000027', 'Sérgio Freitas', 'sergio.freitas@email.com', '1989-09-09', '85236974', '18192021000127'),
('30000000028', 'Renato Pinto', 'renato.pinto@email.com', '1995-07-07', '14725836', '19202122000128'),
('30000000029', 'Otávio Vieira', 'otavio.vieira@email.com', '1984-02-02', '36925814', '20212223000129'),
('30000000030', 'Hugo Ramos', 'hugo.ramos@email.com', '1996-11-11', '25814736', '21222324000130');

INSERT INTO ADMINISTRADOR (ADM_CPF, ADM_NOME, ADM_EMAIL, ADM_SENHA, FK_EMP_CNPJ) VALUES
('40000000001', 'Ana Martins', 'ana.martins@email.com', '12345678', '12345678000101'),
('40000000002', 'Bruno Souza', 'bruno.souza@email.com', '87654321', '23456789000102'),
('40000000003', 'Carla Rocha', 'carla.rocha@email.com', '11223344', '34567890000103'),
('40000000004', 'Daniel Lima', 'daniel.lima@email.com', '44332211', '45678901000104'),
('40000000005', 'Eduarda Silva', 'eduarda.silva@email.com', '55667788', '56789012000105'),
('40000000006', 'Felipe Gomes', 'felipe.gomes@email.com', '88776655', '67890123000106'),
('40000000007', 'Gabriela Alves', 'gabriela.alves@email.com', '13572468', '78901234000107'),
('40000000008', 'Henrique Costa', 'henrique.costa@email.com', '86427531', '89012345000108'),
('40000000009', 'Isabela Mendes', 'isabela.mendes@email.com', '10293847', '90123456000109'),
('40000000010', 'João Ferreira', 'joao.ferreira@email.com', '56473829', '01234567000110'),
('40000000011', 'Karina Barbosa', 'karina.barbosa@email.com', '19283746', '11223344000111'),
('40000000012', 'Lucas Ribeiro', 'lucas.ribeiro@email.com', '64738291', '22334455000112'),
('40000000013', 'Mariana Duarte', 'mariana.duarte@email.com', '91827364', '33445566000113'),
('40000000014', 'Nicolas Teixeira', 'nicolas.teixeira@email.com', '37482910', '44556677000114'),
('40000000015', 'Olivia Fernandes', 'olivia.fernandes@email.com', '56781234', '55667788000115'),
('40000000016', 'Paulo Carvalho', 'paulo.carvalho@email.com', '43218765', '66778899000116'),
('40000000017', 'Queila Nunes', 'queila.nunes@email.com', '24681357', '77889900000117'),
('40000000018', 'Rafael Azevedo', 'rafael.azevedo@email.com', '75318642', '88990011000118'),
('40000000019', 'Sara Batista', 'sara.batista@email.com', '15935748', '99001122000119'),
('40000000020', 'Thiago Lopes', 'thiago.lopes@email.com', '85245612', '10111213000120'),
('40000000021', 'Ursula Cardoso', 'ursula.cardoso@email.com', '95175384', '12131415000121'),
('40000000022', 'Victor Oliveira', 'victor.oliveira@email.com', '45612378', '13141516000122'),
('40000000023', 'Wesley Santos', 'wesley.santos@email.com', '78945612', '14151617000123'),
('40000000024', 'Ximena Torres', 'ximena.torres@email.com', '32165498', '15161718000124'),
('40000000025', 'Yasmin Freitas', 'yasmin.freitas@email.com', '74185296', '16171819000125'),
('40000000026', 'Zeca Moreira', 'zeca.moreira@email.com', '96325874', '17181920000126'),
('40000000027', 'André Pinto', 'andre.pinto@email.com', '85236974', '18192021000127'),
('40000000028', 'Beatriz Vieira', 'beatriz.vieira@email.com', '14725836', '19202122000128'),
('40000000029', 'Carlos Eduardo', 'carlos.eduardo@email.com', '36925814', '20212223000129'),
('40000000030', 'Débora Ramos', 'debora.ramos@email.com', '25814736', '21222324000130');

INSERT INTO VAGAS (VAG_CODIGO, VAG_SETOR, VAG_STATUS, VAG_LOCALIZACAO, FK_EMP_CNPJ) VALUES
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

INSERT INTO SENSOR (SEN_ID, SEN_STATUS, FK_VAG_CODIGO, FK_EMP_CNPJ) VALUES
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

INSERT INTO DADOS (DAD_ID, DAD_MEDIDA, DAD_DATA_HORA, FK_SET_ID) VALUES
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

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_CNPJ = '11111111000101';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_NOME LIKE 'Tech%';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_CIDADE = 'São Paulo';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_STATUS = 'ATIVA';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_STATUS = 'INATIVA';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
ORDER BY EMP_NOME ASC;

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
ORDER BY EMP_CIDADE DESC;

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_RUA LIKE '%Avenida%';

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_NUMERO > 100;

SELECT EMP_CNPJ, EMP_NOME, EMP_RUA, EMP_NUMERO, EMP_CIDADE, EMP_STATUS
FROM EMPRESA
WHERE EMP_CIDADE IN ('São Paulo', 'Campinas');

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_NOME LIKE 'João%';

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_EMAIL LIKE '%@gmail.com';

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_EMAIL IS NOT NULL;

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
ORDER BY SUP_NOME ASC;

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
ORDER BY SUP_EMAIL DESC;

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_NOME LIKE '%Silva%';

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_CPF IN ('12345678901', '23456789012');

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE LENGTH(SUP_SENHA) > 5;

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_EMAIL LIKE '%@outlook.com';

SELECT SUP_CPF, SUP_NOME, SUP_EMAIL, SUP_SENHA
FROM SUPERADM
WHERE SUP_CPF = '12345678901';

SELECT USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE USU_CPF = '12345678901';

SELECT USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE NOME LIKE 'Maria%';

SELECT USU_CPF, USU_NOME, USU_DATA_NASCIMENTO, USU_EMAIL, USU_SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE DATA_NASCIMENTO > '2000-01-01';

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE EMAIL LIKE '%@email.com';

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE FK_CNPJ_EMPRESA = '11111111000101';

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
ORDER BY NOME ASC;

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
ORDER BY DATA_NASCIMENTO DESC;

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE NOME LIKE '%Silva%';

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE DATA_NASCIMENTO BETWEEN '1995-01-01' AND '2000-12-31';

SELECT CPF, NOME, DATA_NASCIMENTO, EMAIL, SENHA, FK_CNPJ_EMPRESA
FROM USUARIO
WHERE EMAIL IS NOT NULL;
