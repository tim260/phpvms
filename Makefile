#
#
# Create the phpvms database if needed:
# docker exec phpvms /usr/bin/mysql -uroot -e 'CREATE DATABASE phpvms'

CURR_PATH=$(shell pwd)

.PHONY: all
all: build

.PHONY:  build
build:
	composer install --no-interaction
	php artisan optimize
	php artisan config:cache
	@make db

.PHONY: install
install: db
	echo ""

.PHONY: clean
clean:
	@php artisan cache:clear
	@php artisan optimize
	@php artisan route:clear
	@php artisan config:clear
	@rm -f database/*.sqlite

.PHONY: reset
reset: clean
	@sqlite3 database/testing.sqlite ""
	@php artisan migrate:refresh --seed

.PHONY: db
db:
	sqlite3 database/testing.sqlite ""
	php artisan migrate:refresh --seed

.PHONY: unittest-db
unittest-db:
	-@rm -f database/unittest.sqlite
	sqlite3 database/unittest.sqlite ""
	php artisan migrate:refresh --env unittest

.PHONY: tests
tests: test

.PHONY: test
test:
	@echo "" > storage/logs/laravel.log
	@chmod 0777 storage/logs/*
	@vendor/bin/phpunit --testdox tests
	@cat storage/logs/laravel.log

.PHONY: schema
schema:
	#php artisan infyom:scaffold Aircraft --fieldsFile=database/schema/aircraft.json
	echo ""

.PHONY: docker
docker:
	@mkdir -p $(CURR_PATH)/tmp/mysql

	-docker rm -f phpvms
	docker build -t phpvms .
	docker run --name=phpvms \
       -v $(CURR_PATH):/var/www/ \
       -v $(CURR_PATH)/tmp/mysql:/var/lib/mysql \
       -p 8080:80 \
       phpvms

.PHONY: docker-clean
docker-clean:
	-docker stop phpvms
	-docker rm -rf phpvms
	-rm core/local.config.php
	-rm -rf tmp/mysql
