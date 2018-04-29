@echo off
docker-compose stop
FOR /f "tokens=*" %%i IN ('docker ps -aq') DO docker rm -f %%i