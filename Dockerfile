FROM daocloud.io/php:5.6-apache  

MAINTAINER NauxLiu nauxliu@gmail.com

# 安装 PHP 相关的依赖包，如需其他依赖包在此添加
RUN apt-get update \  
    && apt-get install -y \
        libmcrypt-dev \
        libz-dev \
        libpng-dev \
        vim\
        git \
        wget \

    # 官方 PHP 镜像内置命令，安装 PHP 依赖
    && docker-php-ext-install \
        mcrypt \
        mbstring \
        pdo_mysql \
        zip \
        gd \


    # 用完包管理器后安排打扫卫生可以显著的减少镜像大小
    && apt-get clean \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

    # 安装 Composer
    && curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer

# 开启 URL 重写模块
# 配置默认放置 App 的目录
RUN a2enmod rewrite \  
    && mkdir -p /app \
    && rm -fr /var/www/html \
    && ln -s /app/public /var/www/html

WORKDIR /app

# 预先加载 Composer 包依赖，优化 Docker 构建镜像的速度
COPY ./composer.json /app/  
COPY ./composer.lock /app/  
RUN composer install  --no-autoloader --no-scripts  

# 复制代码到 App 目录
COPY . /app

# 执行 Composer 自动加载和相关脚本
# 修改目录权限
RUN cp .env.example .env \
    && composer install \
    && chown -R www-data:www-data /app \
    && chmod -R 0777 /app/storage