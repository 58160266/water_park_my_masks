#!/bin/sh
docker-compose stop
docker rm $(docker ps -a -q)