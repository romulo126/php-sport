#!/bin/bash

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo "Criando Network"

docker network inspect player_test_api >/dev/null 2>&1 || docker network create player_test_api

echo "Iniciando os containers com docker-compose..."
docker-compose up -d --build

echo "Instalando dependências com composer..."
docker exec play-api composer install

echo "Renomeando .env.example para .env..."
docker exec play-api cp .env.example .env

read -p "Digite a API_KEY_BALLDONTLIE: " API_KEY

echo "Atualizando a API_KEY_BALLDONTLIE no .env..."
docker exec play-api sed -i "s/^API_KEY_BALLDONTLIE=.*/API_KEY_BALLDONTLIE=$API_KEY/" .env

echo "Gerando chave da aplicação..."
docker exec play-api php artisan key:generate

echo -e "Aguardando o banco de dados subir...\n"


until docker exec play-db mysqladmin ping -u root -pmysql_change_me --silent; do

    echo "Aguardando o banco de dados..."

    sleep 2

done

echo -e "Banco de dados está acessível. Prosseguindo...\n"

echo -e "${GREEN}Iniciando teste...${NC}\n"
docker exec play-api php artisan test
echo -e "${GREEN}Teste finalizado...${NC}\n"

echo -e "${BLUE}Rodando migrate...${NC}\n"
docker exec play-api php artisan migrate
echo -e "${BLUE}Migrate finalizado...${NC}\n"

echo -e "${YELLOW}Populando o banco...${NC}\n"
docker exec play-api php artisan db:seed --class=UsersSeeder
docker exec play-api php artisan db:seed --class=TeamsSeeder
docker exec play-api php artisan db:seed --class=PlayersSeeder
docker exec play-api php artisan db:seed --class=GamesSeeder
echo -e "${YELLOW}Banco Populado...${NC}\n"

echo -e "${GREEN}Dados de usuário para teste:${NC}\n"
echo -e "####################################"
echo -e "Tipo: Admin\nEmail: mario@nintendo.com\nSenha: mario\n"
echo -e "####################################"
echo -e "Tipo: Normal\nEmail: luigi@nintendo.com\nSenha: luigi\n"
echo -e "####################################"
echo -e "Rota: 127.0.0.1:8000/api\n"
echo -e "${GREEN}####################################${NC}"
