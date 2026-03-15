FROM php:8.5-cli

RUN apt-get update && apt-get install -y git unzip

ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID appgroup && useradd -u $UID -g appgroup -m appuser

WORKDIR /app
RUN mkdir -p /app && chown appuser:appgroup /app

USER appuser

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]