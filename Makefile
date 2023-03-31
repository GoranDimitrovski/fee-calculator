build:
	@docker-compose up --build -d

install:
	@docker-compose exec php composer install

phpunit:
	@docker-compose exec php vendor/bin/phpunit

down:
	@docker-compose down