.DEFAULT_GOAL:=help

.PHONY: help

help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ CI Tools

.PHONY: php-cs-fixer
php-cs-fixer: ## Run PHP-CS-FIXER
	php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php

.PHONY: php-cs-fixer-dry
php-cs-fixer-dry: ## Run PHP-CS-FIXER with --dry-run
	php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php --dry-run

.PHONY: psalm
psalm: ## Run Psalm
	php tools/psalm/vendor/bin/psalm --no-cache -c ./psalm.xml --root=./ $(arg)

