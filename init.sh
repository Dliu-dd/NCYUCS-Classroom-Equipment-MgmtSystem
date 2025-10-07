#!/bin/bash

docker exec -i db mariadb -u root -proot LAMP < init.sql
