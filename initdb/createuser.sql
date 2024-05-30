CREATE DATABASE resourcespace;
CREATE USER 'readwrite'@'%' IDENTIFIED BY 'pass';
GRANT ALL PRIVILEGES ON resourcespace.* To 'readwrite'@'%';
CREATE USER 'read'@'%' IDENTIFIED BY 'pass';
GRANT SELECT ON resourcespace.* To 'read'@'%';
FLUSH PRIVILEGES;