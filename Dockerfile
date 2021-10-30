FROM php:8.1.0RC4-cli-alpine3.14
RUN apk add bash

WORKDIR /app
ENTRYPOINT ["tail", "-F", "unreal"]

