CREATE TABLE bsd_api_user (id BIGINT AUTO_INCREMENT, guard_id BIGINT, api_key VARCHAR(35), api_access TINYINT(1) DEFAULT '1' NOT NULL, INDEX guard_id_idx (guard_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE bsd_api_user ADD CONSTRAINT bsd_api_user_guard_id_sf_guard_user_id FOREIGN KEY (guard_id) REFERENCES sf_guard_user(id);
