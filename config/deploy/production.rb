set :application, "donatenashvill.org"
set :domain, "beta.donatenashville.org"
set :server_path, "/var/www"
set :deploy_to, "#{server_path}/#{application}"

set :scm, :git
set :repository, "git@github.com:bshaffer/Donate-Nashville.git"

set :symfony_lib, "/usr/local/lib/symfony"

set :user, 'donatenash'
set :use_sudo, false