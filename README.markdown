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

If you have sqlite on your computer, then do the following:

    cp config/databases.yml.dist config/databases.yml
    ./symfony doctrine:build --all --and-load
    chmod 777 /tmp/donate.sqlite

If you'd prefer to use mysql, then simply copy the `databases.yml` file
as above, uncomment out the `dsn` line in front of the mysql string,
then update that string with the correct username and password. You
should then be able to run the `doctrine:build` task as described above.
