FROM nginx:latest

# Копируем конфигурационный файл Nginx
COPY default.conf /etc/nginx/conf.d/default.conf

# Копируем статические файлы
COPY static/ /usr/share/nginx/html/static/

EXPOSE 80
