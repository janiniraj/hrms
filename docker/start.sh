#!/bin/bash
service nginx start
service php5-fpm start
service mysql start

if [ -d "/usr/share/nginx/www/" ]; then
    echo 'Already Installed'
else
    echo 'Installing HRMS'
    cd /usr/share/nginx
    curl -s https://api.github.com/repos/gamonoid/hrms/releases/latest | jq -r ".assets[] | select(.name) | .browser_download_url" | grep '.zip' | xargs wget
    ls | grep 'zip' | xargs unzip
    mv `ls -d */ | grep hrms | head -1` www/
    rm *.zip

    echo 'Your MySQL root password : hrmspwd'

    echo "Following will be needed during installation"
    echo "--------------------------------------------"
    echo 'HRMS Database : hrmsdb'
    echo 'HRMS User : hrmsuser'
    echo 'HRMS User Password : hrmsuserpwd'
    echo 'HRMS Database host : localhost'

    echo 'Please visit your docker installation url to begin installation.'

fi


/bin/bash