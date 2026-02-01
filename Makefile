default: env prepare up key-generate npm-install
	@echo "--> create the minio bucket on http://localhost:9000 before run the migrations for:"
	@echo "--> Your environment is ready to use! Access http://localhost and enjoy it!"

.PHONY: env
env:
	@echo "--> Copying .env.example to .env file"
	@cp --update=none .env.example .env

.PHONY: prepare
prepare:
	@echo "--> Installing composer dependencies..."
	@sudo rm -rf vendor/
	@sh ./bin/prepare.sh

.PHONY: up
up:
	@echo "--> Starting all docker containers..."
	@./vendor/bin/sail up -d

.PHONY: key-generate
key-generate:
	@echo "--> Generating new laravel key..."
	@./vendor/bin/sail art key:generate

.PHONY: npm-install
npm-install:
	@echo "--> Installing NPM dependencies..."
	@sudo rm -rf node_modules/
	@./vendor/bin/sail npm install