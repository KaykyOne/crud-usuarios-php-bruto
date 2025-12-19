CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

drop table usuarios

INSERT INTO usuarios (nome, email, telefone) VALUES
('João Silva', 'joao@email.com', '(11) 99999-1111'),
('Maria Santos', 'maria@email.com', '(11) 99999-2222'),
('Pedro Oliveira', 'pedro@email.com', '(11) 99999-3333');