# Use a imagem oficial do PHP com Apache como base
FROM php:8.2-apache

# Atualiza os pacotes e instala as dependências necessárias
RUN apt-get update \
    && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && a2enmod rewrite

# Copia o arquivo de configuração do VirtualHost do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copia o arquivo de configuração do Apache personalizado
COPY httpd.conf /etc/apache2/httpd.conf

# Copia o arquivo .htaccess para o diretório de trabalho dentro do contêiner
COPY .htaccess /var/www/html/.htaccess

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia o código fonte para o diretório de trabalho
COPY . .

# Define as permissões adequadas para o diretório
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80 para acesso HTTP
EXPOSE 80

# Comando padrão para iniciar o servidor Apache em segundo plano
CMD ["apache2-foreground"]
