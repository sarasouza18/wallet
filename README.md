# wallet

Passo a passo

Clone Repositório

git clone https://github.com/sarasouza18/wallet.git

cd wallet/

Remova o versionamento (opcional)

rm -rf .git/

Crie o Arquivo .env

cp .env.example .env

Atualize as variáveis de ambiente do arquivo .env

APP_NAME="Wallet"
APP_URL=http://localhost:8981

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=wallet
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

Suba os containers do projeto

docker-compose up -d

Acesse o container app com o bash

docker-compose exec app bash

Instale as dependências do projeto

composer install

Gere a key do projeto Laravel

php artisan key:generate

Acesse o projeto http://localhost:8981
