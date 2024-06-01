#!/usr/bin/env zsh

docker compose down --remove-orphans
docker volume rm container_resourcespace_db
docker image rm container_resourcespace-server
rm -rf src
if [ ! -f "apache/ssl/localhost.crt" ]; then
  openssl req -x509 -out apache/ssl/localhost.crt -keyout apache/ssl/localhost.key \
    -newkey rsa:2048 -nodes -sha256 \
    -subj '/CN=localhost' -extensions EXT -config <( \
     printf "[dn]\nCN=localhost\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:localhost\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")
fi
if [ -d "dumps/rs" ]; then
  svn update dumps/rs
  # You can add more commands to be executed if the folder exists
else
  svn co https://svn.resourcespace.com/svn/rs/releases/10.3 ./dumps/rs
fi
if [ ! -f ".env.local" ]; then
  cp .env .env.local
fi
cp -r dumps/rs src
cp dumps/config.php ./src/include/config.php
docker compose build
docker compose --env-file .env.local up -d server

echo "Success!"