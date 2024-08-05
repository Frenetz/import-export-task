SERVICES = php nginx mysql

DOCKER_COMPOSE = docker-compose

COMPOSER = docker-compose run --rm php composer

ARTISAN = docker-compose run --rm php php artisan

build:
	@$(DOCKER_COMPOSE) build

up:
	@$(DOCKER_COMPOSE) up -d

down:
	@$(DOCKER_COMPOSE) down

composer-install:
	@$(COMPOSER) install

migrate:
	@$(ARTISAN) migrate

seed:
	@$(ARTISAN) db:seed

test:
	@$(DOCKER_COMPOSE) run --rm php vendor/bin/phpunit

rebuild: build up

clean:
	@$(DOCKER_COMPOSE) down -v --rmi all

.PHONY: build up down composer-install migrate seed test rebuild clean
