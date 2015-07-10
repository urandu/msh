-- Create impact user
CREATE USER 'msh'@'localhost' IDENTIFIED BY 'msh>otero12345625lll>?>>';
-- Grant permissions to impact user
GRANT INSERT ON msh_db.* TO 'msh'@'localhost';
GRANT DELETE ON msh_db.* TO 'msh'@'localhost';
GRANT UPDATE ON msh_db.* TO 'msh'@'localhost';
GRANT SELECT ON msh_db.* TO 'msh'@'localhost';
-- Reload permissions 
FLUSH PRIVILEGES;

