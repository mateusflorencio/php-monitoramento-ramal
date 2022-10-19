CREATE TABLE ramais (
  ramal VARCHAR(150) NOT NULL UNIQUE,
  username VARCHAR(150) NOT NULL,
  status VARCHAR(150) DEFAULT 'indisponivel',
  agente VARCHAR(150) NOT NULL,
  historico INT DEFAULT 0,
  PRIMARY KEY(ramal)
);