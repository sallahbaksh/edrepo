# edrepo
### How to spin up a new container

1. Go here http://gitpod.io/#https://github.com/sallahbaksh/edrepo/
2. Go to terminal. Enter
```mysql``` to enter the mysql shell.

3. Run these SQL commands in order (1 at a time): (Try running without the SOURCE command, it drops the DB)
```
CREATE DATABASE edrepo;
USE edrepo;
CREATE USER 'edrepo'@'localhost' IDENTIFIED BY 'edrepo';
SOURCE /workspace/edrepo/lib/backends/pdo/mysql.sql;
GRANT ALL PRIVILEGES ON edrepo.* TO 'edrepo'@'localhost';
```

4. In another terminal, enter:
```cd EdRepo```

```php -S 127.0.0.1:8000```

to serve the contents.

5. Click on Open browser or Open preview, the website should popup (make sure you enable popups).
