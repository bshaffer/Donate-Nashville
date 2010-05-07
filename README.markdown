Donate Nashville
================

Setup
-----

### Pull down the repository

    git clone git@github.com:bshaffer/Donate-Nashville.git
    cd Donate-Nashville
    git submodule init
    git submodule update

### Put the symfony library in your project

The easiest way is to do this is to clone symfony into some directory
on your computer and then create a symbolic link into your project:

    cd /path/to/put/symfony
    git clone http://github.com/vjousse/symfony-1.4.git
    
    cd /path/to/Donate-Nashville
    ln -s /path/to/put/symfony/symfony-1.4 lib/vendor/symfony

### A few more things:

    mkdir log
    mkdir cache
    ./symfony project:permissions

### Setup your database

To set up your mysql database:

    cp config/databases.yml.dist config/databases.yml

Uncomment out the `dsn` line in front of the mysql string,
then update that string with the correct username and password.
Finally, run the Symfony command to build the database.

    ./symfony doctrine:build --all --and-load
