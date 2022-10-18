CREATE TABLE ramais (
  ramal VARCHAR(150) NOT NULL UNIQUE,
  numero VARCHAR(150) NOT NULL,
  online BOOLEAN DEFAULT FALSE,
  status VARCHAR(150) DEFAULT 'indisponivel',
  agente VARCHAR(150) NOT NULL,
  historico INT DEFAULT 0,
  PRIMARY KEY(ramal)
);