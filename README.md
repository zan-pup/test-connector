# Sample Connector

Sample connector to showcase how connectors works.

[Documentation](https://cde.staging.productsup.com/docs/developers/guide/index.html)

## Todo

 * [ ] Import / export / export delta command
 * [ ] Container API client generation with jane
 * [ ] Tests
 * [ ] Cover all the usecases of container api
 * [ ] Describe logging best practices
 * [ ] Setup dockerfile

## Notes
[Container API usecases](https://cde.staging.productsup.com/docs/developers/guide/index.html)

## Project setup

### Symfony create project

```
# initial project creation
docker run --rm --interactive --tty -v $PWD:/app composer create-project symfony/skeleton:"6.2.*" .

# for local development
docker run --rm --interactive --tty -v $PWD:/app composer install
```

### Dockerfile

## Container API

Container API is the API that will be available to the connector when it will be run in Productsup platform. It will enable connector to read or write the data, log messages, store files and more.

Documentaion: https://cde.staging.productsup.com/docs/developers/guide/index.html

### Open API file for Container API
* Fetch Open API file from CDE api
```
https://cde.productsup.com/docs/api/#/ContainerApi/show_container_api_versions
https://cde.productsup.com/docs/api/#/ContainerApi/show_container_api_version_docs
```

* Save the output ot the file `container-api-spec.json`

* Add janephp to the project

```
# OpenAPI 3
docker run --rm --interactive --tty -v $PWD:/app composer require --dev jane-php/open-api-3
docker run --rm --interactive --tty -v $PWD:/app composer require jane-php/open-api-runtime
```

* Generate the Container API client
```
docker run --rm --interactive --tty -v $PWD:/app -w /app php:8.1-cli php bin/generate-container-api-client
```