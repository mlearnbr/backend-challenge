FROM herickc/php-fpm-nginx:latest
USER root
COPY ./Server/postRunScriptDevMode.sh /entrypoint.sh
COPY ./Server/crontab.txt /crontab.txt
RUN /usr/bin/crontab /crontab.txt
USER nobody

# Let supervisord start nginx & php-fpm
ENTRYPOINT ["sh", "/entrypoint.sh", "Challenge"]
# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
