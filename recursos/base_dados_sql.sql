USE loja_api;

CREATE TABLE clientes(
	id_cliente INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50) DEFAULT NULL,
	email VARCHAR(50) DEFAULT NULL,
	telefone VARCHAR(50) DEFAULT NULL,
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
	delated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(id_cliente)
);

CREATE TABLE produtos(
	id_produto INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50) DEFAULT NULL,
	quantidade INT DEFAULT 0,
	created_at DATETIME DEFAULT NULL,
	updated_at DATETIME DEFAULT NULL,
	delated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(id_produto)
);

INSERT INTO clientes (nome, email, telefone, created_at) VALUES ('Rafael', 'rafael.ssilva03@gmail.com', '11989504363', '2023-06-01 10:00:00');
INSERT INTO clientes (nome, email, telefone, created_at) VALUES ('Lucas', 'lucas@gmail.com', '11979505362', '2023-06-01 10:00:00');
INSERT INTO clientes (nome, email, telefone, created_at) VALUES ('Ricardo', 'ricardo@gmail.com', '11958812363', '2023-06-01 10:00:00');
INSERT INTO clientes (nome, email, telefone, created_at) VALUES ('Hamilton', 'hamilton@gmail.com', '11949801323', '2023-06-01 10:00:00');
INSERT INTO clientes (nome, email, telefone, created_at) VALUES ('Guilherme', 'guilherme@gmail.com', '11949524361', '2023-06-01 10:00:00');

INSERT INTO produtos (nome, quantidade, created_at) VALUES ('Monitor', 10, '2023-06-01');
INSERT INTO produtos (nome, quantidade, created_at) VALUES ('Teclado', 8, '2023-06-01');
INSERT INTO produtos (nome, quantidade, created_at) VALUES ('Mouse', 1, '2023-06-01');
INSERT INTO produtos (nome, quantidade, created_at) VALUES ('Kindle', 5, '2023-06-01');
INSERT INTO produtos (nome, quantidade, created_at) VALUES ('Notebook', 12, '2023-06-01');



