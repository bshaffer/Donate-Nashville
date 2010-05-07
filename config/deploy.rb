set :stages, %w(production)
require 'capistrano/ext/multistage'

set :symfony_version, 'RELEASE_1_4_4'
set :app_symlinks, %w{uploads}

# =============================================================================
# CAPISTRANO OPTIONS
# =============================================================================
set :keep_releases, 3
set :deploy_via, :remote_cache

# =============================================================================
# OVERWRITE TASKS
# =============================================================================
namespace :deploy do
  desc 'Overwrite the start task to set the permissions on the project.'
  task :start do
    run "php #{release_path}/symfony project:permissions"
    run "php #{release_path}/symfony doctrine:build --all --and-load --no-confirmation"
  end
  
  desc 'Overwrite the restart task because we dont need it.'
  task :restart do ; end
  
  desc 'Overwrite the stop task because we dont need it.'
  task :stop do ; end
  
  desc 'Customize migrate task to work with symfony.'
  task :migrate do
    run "php #{release_path}/symfony doctrine:migrate --env='prod'"
  end
  
  desc 'Symlink static directories.'
  task :create_dirs do
    if app_symlinks
      app_symlinks.each do |link|
        run "mkdir -p #{shared_path}/system/#{link}"
        run "ln -nfs #{shared_path}/system/#{link} #{release_path}/web/#{link}"
      end
    end
  end
  
  desc 'Customize the finalize_update task to work with symfony.'
  task :finalize_update, :except => { :no_release => true } do
    run "chmod -R g+w #{latest_release}" if fetch(:group_writable, true)

    run <<-CMD
      rm -rf #{latest_release}/log #{latest_release}/web/system #{latest_release}/cache &&
      mkdir -p #{shared_path}/cache &&
      ln -s #{shared_path}/log #{latest_release}/log &&
      ln -s #{shared_path}/system #{latest_release}/web/system &&
      ln -s #{shared_path}/cache #{latest_release}/cache
    CMD

    if fetch(:normalize_asset_timestamps, true)
      stamp = Time.now.utc.strftime("%Y%m%d%H%M.%S")
      asset_paths = %w(css images js).map { |p| "#{latest_release}/web/#{p}" }.join(" ")
      run "find #{asset_paths} -exec touch -t #{stamp} {} ';'; true", :env => { "TZ" => "UTC" }
    end
  end
end

namespace :symlink do
  desc "Symlink the database"
  task :db do
    run "ln -nfs #{shared_path}/system/databases.yml #{release_path}/config/databases.yml"
  end
  
  desc 'Symlink the symfony library.'
  task :symfony do
    run "ln -nfs #{symfony_lib}/#{symfony_version} #{release_path}/lib/vendor/symfony"
  end
end

namespace :symfony do
  desc 'Task to clear the cache on deploy.'
  task :clear_cache do
    run "php #{release_path}/symfony cache:clear"
  end
end

after 'deploy:finalize_update', 'symlink:symfony', 'deploy:create_dirs', 'symfony:clear_cache'
after 'deploy:symlink', 'symlink:db'
