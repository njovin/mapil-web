# Server Requirements
apt-get install libpcre3-dev python-pip php5-psql php-pear php5-dev  postgresql mongo pkg-config libssl-dev php5-mongo
pecl install mongo
pecl install mongodb

add to php.ini:

# /etc/php5/fpm/php.ini
# /etc/php5/cli/php.ini
extension=mongo.so
extension=mongodb.so

# let's encrypt
./letsencrypt-auto certonly -a webroot --webroot-path=/sites/mapil.co/web/current/public -d mapil.co

sudo dd if=/dev/zero of=/swapfile bs=1024 count=1024288
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
pip install -U pyopenssl ndg-httpsclient pyasn1
# might need to do an npm install initially while swap is on
sudo swapoff /swapfile

ON SMTP server: 
vi /etc/sudoers/pm2
ADD 
njovin ALL=NOPASSWD: /usr/local/bin/pm2 restart 0