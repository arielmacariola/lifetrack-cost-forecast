This app helps to forecast cost for the application infrastracture monthly usage

# Pre-requisite

1. Git installed in your local machine
2. Docker Compose or Docker for windows/mac installed in your local machine

Workaround:
If you don't have Docker installed but you have apache and php setup in your mahine instead, you may copy the files in the directory `webroot` and paste it in the root of your apache directory.

# How to run the app?

1. Clone this repository in your local machine
   git clone https://github.com/arielmacariola/lifetrack-cost-forecast.git
2. Get inside the directory `lifetrack-cost-forecast`
   cd lifetrack-cost-forecast
3. Run docker-compose
   docker-compose up
4. In your browser go to
   http://0.0.0.0:8000/

# Classic LAMP environment built on Docker-compose

- CentOS 6
- Apache 2.2
- MySQL 5.6
- PHP 5.6
