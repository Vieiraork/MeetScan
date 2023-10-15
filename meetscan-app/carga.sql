CREATE TABLE IF NOT EXISTS parametro (
    cd_parametro INT NOT NULL COMMENT 'Código do parâmetro',
    vl_parametro VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar o valor do parâmetro',
    ds_descricao VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar a descrição breve do parâmetro',
    dt_registro DATETIME COMMENT 'Responsável por armazenar a data de registro',
    PRIMARY KEY (cd_parametro)
);

CREATE TABLE IF NOT EXISTS perfil (
    cd_perfil INT NOT NULL COMMENT 'Código do perfil',
    ds_perfil VARCHAR(250) COMMENT 'Responsável por armazenar a descrição do perfil',
    ds_leitura VARCHAR(1) COMMENT 'Responsável por armazenar a permissão de leitura. 1 - permitida, 0 - não permitida',
    ds_escrita VARCHAR(1) COMMENT 'Responsável por armazenar a permissão de criação. 1 - permitida, 0 - não permitida',
    ds_exclusao VARCHAR(1) COMMENT 'Responsável por armazenar a permissao de exclusão. 1 - permitida, 0 - não permitida',
    ds_edicao VARCHAR(1) COMMENT 'Responsável por armazenar a permissao de edição. 1 - permitida, 0 - não permitida',
    PRIMARY key (cd_perfil)
);

CREATE TABLE IF NOT EXISTS usuarios (
	id_usuario INT AUTO_INCREMENT COMMENT 'ID do usuário controlado pelo banco',
    no_usuario VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar o nome do usuário',
    ds_email VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar o e-mail do usuário',
    ds_senha VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar a senha encriptada do usuário',
    st_status VARCHAR(1) NOT NULL COMMENT 'Responsável pora armazenar o status do usuário. A - ativo, I - inativo',
    ds_token VARCHAR(250) COMMENT 'Responsável por armazenar o token do usuário',
    dt_registro DATETIME COMMENT 'Responsável por armazenar a data de registro',
    dt_alteracao DATETIME COMMENT 'Responsável por armazenar a data de alteração do usuário',
    cd_perfil INT NOT NULL COMMENT 'Código do perfil',
    PRIMARY KEY (id_usuario),
    UNIQUE KEY (ds_email),
    FOREIGN KEY (cd_perfil) REFERENCES perfil(cd_perfil)
);

CREATE TABLE IF NOT EXISTS controle_acessos (
    id_controle INT AUTO_INCREMENT COMMENT 'ID do controle de acessos controlado pelo banco',
    ds_acao VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar a descrição da ação',
    dt_registro DATETIME NOT NULL COMMENT 'Responsável por armazenar a data de registro',
    id_usuario INT NOT NULL COMMENT 'Responsável por armazenar a identificação do usuário realizou interação',
    PRIMARY KEY (id_controle),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS anexos (
	id_anexo INT AUTO_INCREMENT COMMENT 'ID dos anexos controlado pelo banco de dados',
    ds_arquivo VARCHAR(250) NULL COMMENT 'Responsável por armazenar a descrição do arquivo',
    ds_link VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar o caminho do arquivo',
    dt_registro DATETIME COMMENT 'Responsável por armazenar a data de registro',
    id_usuario INT NOT NULL COMMENT 'Responsável por armazenar a identificação do usuário',
    PRIMARY KEY (id_anexo),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS auditoria (
    id_auditoria INT AUTO_INCREMENT COMMENT 'ID da auditoria controlado pelo banco de dados',
    ds_acao VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar a descrição da ação feita pelo usuário',
    dt_registro DATETIME COMMENT 'Responsável por armazenar a data de registro',
    id_usuario INT NOT NULL COMMENT 'Responsável por armazenar a identificação do usuário',
    PRIMARY KEY (id_auditoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS codigo_acesso (
    id_codigo_acesso INT AUTO_INCREMENT COMMENT 'ID do código de acesso controlado pelo banco de dados',
    ds_codigo_acesso VARCHAR(250) NOT NULL COMMENT 'Responsável por armazenar o código rfid',
    dt_registro DATETIME COMMENT 'Responsável por armazenar a data de registro',
    dt_alteracao DATETIME COMMENT 'Responsável por armazenar a data de alteração',
    id_usuario INT NOT NULL COMMENT 'Responsável por armazenar a identificação do usuário',
    PRIMARY KEY(id_codigo_acesso),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);