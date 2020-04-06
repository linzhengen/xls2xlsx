.PHONY: help
help: ## Print help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: docker-push
docker-push: ## Build container and push
	time docker build --file ./Dockerfile --no-cache --tag seion/xls2xlsx .
	docker login
	docker push seion/xls2xlsx
