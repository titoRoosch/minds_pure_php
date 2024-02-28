REQUISITOS

 - Docker
 - Docker-compose

INSTRUÇOES

docker-compose build
docker-compose up -d
docker network create minds_pure_php_app_network


Acessar o banco de dados via phpMyAdmin, Dbeaver, etc

rodar os comandos em sqlTables.sql


REQUESTS:

GET --listagem de usuários
localhost:8000/api/users/
localhost:8000/api/users?user_id=2

localhost:8000/api/address/
localhost:8000/api/address?address_id=2

localhost:8000/api/city/
localhost:8000/api/city?city_id=2

localhost:8000/api/state/
localhost:8000/api/state?state_id=2

PUT --edição de usuários
localhost:8000/api/users/
    params:
    {
        "user_id": 2
        "email": "testeh@hotmail.com.br",
        "name": "teste",
        "password": "123457"
        "address_id": '1',
        "city_id": "1",
        "state_id": "1"
    }

POST -- criação de usuários
localhost:8000/api/users/
    params:
    {
        "email": "testeh@hotmail.com.br",
        "name": "teste",
        "password": "123457"
        "address_id": '1',
        "city_id": "1",
        "state_id": "1"
    }

DELETE -- deleção de usuários
localhost:8000/api/users/?user_id=2
