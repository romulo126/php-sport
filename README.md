# Requisitos
1 - Docker
2 - docker-composer

## Documentação Postman da api para importar no Postman

- `./php-sport.postman_collection.json`

# Automatico
## 1. Clone aplicação:

```bash
git clone git@github.com:romulo126/php-sport.git && cd php-sport
```
### 2. Permição de execução no sh:

```bash
chmod +x start.sh
```
### 3. Start :
```bash
./start.sh
```

# Manual
## 1. clone aplicação:
```bash
git clone git@github.com:romulo126/php-sport.git && cd php-sport
```
## 2. Criar docker network:
```bash
docker network inspect player_test_api
```

## 3. Start docker
```bash
docker-compose up -d --build
```

## 4.Composer install
```bash
docker exec play-api composer install
```

## 5.Copiando o  .env.example
```bash
docker exec play-api cp .env.example .env
```

## 6.Inserir API_KEY_BALLDONTLIE
No arquivo .env insira o token BALLDONTLIE

## 7. Generete Key
```bash
docker exec play-api php artisan key:generate
```

## 8. Rodando testes
```bash
docker exec play-api php artisan test
```

## 9. Rodando migrate
```bash
docker exec play-api php artisan migrate
```
## 10. Rodando seed usars
```bash
docker exec play-api php artisan db:seed --class=UsersSeeder
```
## 11. Rodando seed Teams
```bash
docker exec play-api php artisan db:seed --class=TeamsSeeder
```
## 12. Rodando seed Players
```bash
docker exec play-api php artisan db:seed --class=PlayersSeeder
```
## 13. Rodando seed Games
```bash
docker exec play-api php artisan db:seed --class=GamesSeeder
```

## 14. Dados para teste User
- Tipo: ADMIN
- Email: mario@nintendo.com
- Senha: mario
-
- Tipo: Normal
- Email: luigi@nintendo.com
- Senha: luigi
-
- Rota: 127.0.0.1:8000/api