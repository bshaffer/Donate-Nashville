CREATE TABLE material_resource (id BIGINT AUTO_INCREMENT, owner_id INT NOT NULL, transaction_type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT, show_contact_info TINYINT(1) DEFAULT '1', is_satisfied TINYINT(1) DEFAULT '0', address_1 VARCHAR(255), address_2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), zip VARCHAR(100), phone_1 VARCHAR(100), phone_2 VARCHAR(100), email VARCHAR(100), quantity BIGINT DEFAULT 1, latitude DOUBLE(16, 10), longitude DOUBLE(16, 10), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE resource (id BIGINT AUTO_INCREMENT, owner_id INT NOT NULL, transaction_type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT, show_contact_info TINYINT(1) DEFAULT '1', is_satisfied TINYINT(1) DEFAULT '0', address_1 VARCHAR(255), address_2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), zip VARCHAR(100), phone_1 VARCHAR(100), phone_2 VARCHAR(100), email VARCHAR(100), latitude DOUBLE(16, 10), longitude DOUBLE(16, 10), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE resource_participant (id BIGINT AUTO_INCREMENT, participant_id INT NOT NULL, resource_id INT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE stuff_resource (id BIGINT AUTO_INCREMENT, owner_id INT NOT NULL, transaction_type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT, show_contact_info TINYINT(1) DEFAULT '1', is_satisfied TINYINT(1) DEFAULT '0', address_1 VARCHAR(255), address_2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), zip VARCHAR(100), phone_1 VARCHAR(100), phone_2 VARCHAR(100), email VARCHAR(100), quantity BIGINT DEFAULT 1, latitude DOUBLE(16, 10), longitude DOUBLE(16, 10), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE time_resource (id BIGINT AUTO_INCREMENT, owner_id INT NOT NULL, transaction_type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT, show_contact_info TINYINT(1) DEFAULT '1', is_satisfied TINYINT(1) DEFAULT '0', address_1 VARCHAR(255), address_2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), zip VARCHAR(100), phone_1 VARCHAR(100), phone_2 VARCHAR(100), email VARCHAR(100), start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, num_volunteers BIGINT, latitude DOUBLE(16, 10), longitude DOUBLE(16, 10), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_fb_connect_guard_user (id BIGINT AUTO_INCREMENT, user_id INT NOT NULL, facebook_id BIGINT, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, address_1 VARCHAR(255), address_2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), zip VARCHAR(100), phone_1 VARCHAR(100), phone_2 VARCHAR(100), email VARCHAR(100), account_type VARCHAR(255) DEFAULT 'individual' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, latitude DOUBLE(16, 10), longitude DOUBLE(16, 10), INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE material_resource ADD CONSTRAINT material_resource_owner_id_sf_guard_user_id FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE resource ADD CONSTRAINT resource_owner_id_sf_guard_user_id FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE stuff_resource ADD CONSTRAINT stuff_resource_owner_id_sf_guard_user_id FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE time_resource ADD CONSTRAINT time_resource_owner_id_sf_guard_user_id FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_fb_connect_guard_user ADD CONSTRAINT sf_fb_connect_guard_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
