### Current README Content
```markdown
# project-php-apache-load-balancer
```

## About

This repository contains a project setup using PHP and Apache in a load-balanced environment.

## Prerequisites

- Docker
- Docker Compose

## Getting Started

1. **Clone the repository:**
   ```sh
   git clone https://github.com/rodrigomanara/project-php-apache-load-balancer.git
   cd project-php-apache-load-balancer
   ```

2. **Build and start the containers:**
   ```sh
   docker-compose up --build
   ```

3. **Access the application:**
   - Visit `http://localhost` in your web browser.

## Services

### PHP-FPM
- **Containers:** `php_fpm_1`, `php_fpm_2`
- **Dockerfile:** `./php/Dockerfile`
- **Volumes:**
  - `./www:/var/www/html`
  - `./php/php.ini:/usr/local/etc/php/conf.d/custom.ini:ro`
  - `./php/www.conf:/usr/local/etc/php-fpm.d/www.conf:ro`
- **Environment Variables:**
  - `REDIS_HOST=redis`
- **Depends on:** `db`, `redis`

### Apache
- **Containers:** `apache_1`, `apache_2`
- **Dockerfile:** `./apache2/Dockerfile`
- **Volumes:**
  - `./apache2/apache-config.conf:/etc/apache2/sites-available/000-default.conf:ro`
  - `./www:/var/www/html`
- **Depends on:** `php_fpm_1`, `php_fpm_2`
- **Environment Variables:**
  - `APACHEPHP: php_fpm_1/php_fpm_2`

### Load Balancer
- **Container:** `haproxy_lb`
- **Image:** `haproxy:latest`
- **Ports:** `80:80`
- **Volumes:**
  - `./haproxy/haproxy.cfg:/usr/local/etc/haproxy/haproxy.cfg:ro`
- **Depends on:** `apache_1`, `apache_2`

### Database
- **Container:** `database`
- **Image:** `mysql:8.0`
- **Environment Variables:**
  - `MYSQL_DATABASE=app`
  - `MYSQL_USER=user`
  - `MYSQL_PASSWORD=password`
  - `MYSQL_ROOT_PASSWORD=password`
- **Ports:** `3306:3306`
- **Volumes:**
  - `./mysql:/var/lib/mysql`

### Elasticsearch
- **Container:** `elasticsearch`
- **Image:** `docker.elastic.co/elasticsearch/elasticsearch:8.4.3`
- **Environment Variables:**
  - `discovery.type=single-node`
  - `xpack.security.enabled=false`
  - `ES_JAVA_OPTS=-Xms1g -Xmx1g`
  - `Des.max-open-files=true`
- **Ports:** `9200:9200`, `9300:9300`
- **Volumes:**
  - `./data:/usr/share/elasticsearch/data`
- **Limits:** `memory: 5g`

### Redis
- **Container:** `redis_session`
- **Image:** `redis:latest`
- **Ports:** `6379:6379`

## Networks
- `app-network`
- `system-network`
- `session-network`

## Volumes
- `sql_data`

## Additional Information

- Ensure Docker and Docker Compose are installed on your machine.
- Modify the `docker-compose.yml` file to fit your specific needs.
- Refer to the official Docker documentation for more details on how to use Docker and Docker Compose.
```

Would you like to proceed with this update?
