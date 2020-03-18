apt update
apt install wget less subversion git vim mariadb-server mariadb-client -y
mkdir eric && cd eric
wget -O phpunit https://phar.phpunit.de/phpunit-7.phar
chmod +x phpunit
export PATH=$PATH:/var/www/html/eric/
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar 
chmod +x wp-cli.phar 
mv wp-cli.phar /usr/local/bin/wp
cd ..
cp -R my-test-plugin ../wp-content/plugins/my-test-plugin
wp --allow-root scaffold plugin-tests my-test-plugin