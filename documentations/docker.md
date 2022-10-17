# Test for Dev

## Banco de Dados

[**Foi criado criado um *docker-compose.iyml* para definir o banco de dado**](../docker-compose.yml). <br>
### Instruções para uso do docker:
Credenciais default já foram aplicadas no projeto. Mas pode ficar a vontade para muda-lá.
Para executar o docker apenas utilzar no terminal o comando:
 ```
 docker-compose up -d
```
Ao executar este comando pela primeira vez o sql na pasta [docker/mysql/001.init.sql](../docker/mysql/001-init.sql) será executado e gerará as tabelas automaticamente no banco de dados.

### Atenção
Para usar o docker é necessário ter ele instalado na máquina.