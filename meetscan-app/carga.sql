CREATE TABLE IF NOT EXISTS usuarios (
	id_usuario INT AUTO_INCREMENT,
    no_usuario VARCHAR(255) NOT NULL,
    ds_email VARCHAR(255) NOT NULL UNIQUE,
    ds_senha VARCHAR(255) NOT NULL,
    st_status VARCHAR(1) NOT NULL,
    ds_token VARCHAR(255),
    dt_registro DATETIME,
    dt_alteracao DATETIME,
    PRIMARY KEY (id_usuario)
);

CREATE TABLE IF NOT EXISTS controle_acessos (
    id_controle INT AUTO_INCREMENT,
    ds_acao VARCHAR(255) NOT NULL,
    dt_registro DATETIME NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_controle),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS anexos (
	id_anexo INT AUTO_INCREMENT,
    ds_arquivo VARCHAR(255) NOT NULL,
    dt_registro DATETIME,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_anexo),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS auditoria (
    id_auditoria INT AUTO_INCREMENT,
    ds_acao VARCHAR(255) NOT NULL,
    dt_registro DATETIME,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_auditoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS parametro (
    cd_parametro INT NOT NULL,
    ds_parametro VARCHAR(255) NOT NULL,
    ds_explicacao VARCHAR(255) NOT NULL,
    dt_registro DATETIME,
    PRIMARY KEY (cd_parametro)
);