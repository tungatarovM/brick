restart: down up

docker-up:
		docker-compose up -d

up: docker-up

down:
		docker-compose down
build:
		docker-compose build
ps:
		docker-compose ps
test:
		@docker-compose exec php-cli vendor/bin/phpunit --colors=always
bash:
		docker-compose exec php-cli bash
db:
		docker-compose exec pgsql bash
migrate:
		docker-compose exec php-cli php artisan migrate

# create symlink inside container
artisan-symlink:
		docker-compose exec php-cli php artisan storage:link

# Asset commands
node:
		docker-compose exec node
npm-i:
		docker-compose exec node npm install
npm-build:
		docker-compose exec node npm run build
npm-dev:
		docker-compose exec node npm run dev
npm-watch:
		docker-compose exec node npm run watch
npm-hot:
		docker-compose exec node npm run hot
