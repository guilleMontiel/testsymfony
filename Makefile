.PHONY: init-dev

DOCKER_COMPOSE ?= docker-compose

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

init-dev:	
	$(DOCKER_COMPOSE) run --rm symfonyweb composer install --prefer-dist
	$(DOCKER_COMPOSE) run --rm symfonyweb php bin/console doctrine:migrations:migrate
	$(DOCKER_COMPOSE) run --rm symfonyweb bash -ci 'yarn install'

composer-install:
	$(DOCKER_COMPOSE) run --rm apache composer install --prefer-dist

