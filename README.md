# goaccess-monitor

## Info

**Web log analyzer**

GoAccess is an open source real-time web log analyzer and interactive viewer that runs in a terminal in *nix systems or through your browser.

It provides fast and valuable HTTP statistics for system administrators that require a visual server report on the fly.

## Installation

1. Install the dependencies
```sh
sudo apt install -y libncursesw5-dev libgeoip-dev libtokyocabinet-dev build-essential libmaxminddb0 libmaxminddb-dev mmdb-bin
```

2. Install an actual version of the GoAccess
```sh
wget https://tar.goaccess.io/goaccess-1.6.5.tar.gz
tar -xzvf goaccess-1.6.5.tar.gz
cd goaccess-1.6.5/
./configure --enable-utf8 --enable-geoip=mmdb
make
sudo make install
```

Check version  
```sh
goaccess --version
```

3. Edit config file
```sh
goaccess --dcf
sudo nano /usr/local/etc/goaccess/goaccess.conf
```

Uncomment formats

time-format %H:%M:%S  
date-format %d/%b/%Y  
log-format %h %^[%d:%t %^] "%r" %s %b "%R" "%u"

Uncomment closed panels

enable-panel REFERRERS  
enable-panel KEYPHRASES  
enable-panel GEO_LOCATION

4. Change folder owner to allow creating reports
```sh
sudo chown $USER:www-data ./
```

5. Download IP to Location data (current version at [https://db-ip.com](https://db-ip.com))
```sh
wget https://download.db-ip.com/free/dbip-country-lite-2022-11.mmdb.gz
gunzip dbip-country-lite-2022-11.mmdb.gz
```

Cities are currently unavailable in GoAccess Dashboard (may change in the future)
```sh
wget https://download.db-ip.com/free/dbip-city-lite-2022-11.mmdb.gz
gunzip dbip-city-lite-2022-11.mmdb.gz
```

6. Set NGINX password
```sh
sudo htpasswd -c /etc/nginx/.htpasswd LOGIN
```

7. Insert `ga-nginx.conf` into NGINX settings

8. Restart NGINX
```sh
sudo service nginx restart
```
