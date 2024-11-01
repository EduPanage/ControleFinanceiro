CREATE DATABASE ControleFinanceiro;
USE ControleFinanceiro;

CREATE TABLE Usuario(

    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(70) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(30) NOT NULL
);

CREATE TABLE Transacoes(

    id_transacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    valor DECIMAL (10, 2) NOT NULL,
    tipo ENUM ('entrada', 'saida') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
);