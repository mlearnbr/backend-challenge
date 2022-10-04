COMMANDS := composer app node
ifneq (filter $(COMMANDS),$(firstword $(MAKECMDGOALS)))
COMMANDS_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(COMMANDS_ARGS):;@:)
endif

.PHONY: composer
composer:
	mkdir -p ~/.cache/composer/files ~/.cache/composer/repo
	docker run --rm -it -u $(shell id -u):$(shell id -g) -v ~/.cache/composer/:/tmp/cache/ -v $(shell pwd):/app composer $(COMMANDS_ARGS) --ignore-platform-reqs

.PHONY: dump-autoload
dump-autoload:
	mkdir -p ~/.cache/composer/files ~/.cache/composer/repo
	docker run --rm -it -u $(shell id -u):$(shell id -g) -v ~/.cache/composer/:/tmp/cache/ -v $(shell pwd):/app composer dump-autoload

.PHONY: app
app:
	docker-compose exec app $(COMMANDS_ARGS)

.PHONY: node
node:
	docker-compose exec node $(COMMANDS_ARGS)

.PHONY: webserver
webserver:
	docker-compose exec webserver sh

.PHONY: database
database:
	docker-compose exec database bash

.PHONY: app-logs
app-logs:
	docker-compose logs app

.PHONY: node-logs
node-logs:
	docker-compose logs node

.PHONY: webserver-logs
webserver-logs:
	docker-compose logs webserver

.PHONY: database-logs
logs:
	docker-compose logs database

.PHONY: start
start:
	docker-compose start

.PHONY: stop
stop:
	docker-compose stop

.PHONY: restart
restart:
	docker-compose restart

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: key-generate
key-generate:
	docker-compose exec app php artisan key:generate
