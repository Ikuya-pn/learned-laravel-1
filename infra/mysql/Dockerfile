FROM mysql:8.2.0

ENV MYSQL_DATABASE=laravel \
  MYSQL_USER=user \
  MYSQL_PASSWORD=secret \
  MYSQL_ROOT_PASSWORD=secret \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf

RUN mkdir /var/log/mysql
RUN chown mysql:mysql /var/log/mysql
