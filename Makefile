PHP=docker compose run --rm php

install:
	$(PHP) composer install

test:
	$(PHP) vendor/bin/phpunit

analyse:
	$(PHP) vendor/bin/phpstan analyse

build:
	docker compose build

sh:
	$(PHP) sh
