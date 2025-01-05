#!/bin/bash

# Thêm dòng vào /etc/hosts khi container khởi động
echo "127.0.0.1 be.local" >> /etc/hosts

echo "ServerName be.local" >> /etc/apache2/apache2.conf

# Khởi động Apache
apache2-foreground
