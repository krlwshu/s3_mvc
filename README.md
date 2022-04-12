# Engineer Appraisal System - Installation instructions

## Summary:
CodeIgniter 4 (PHP MVC for app)
MySQL (Database)

## Clone repo to install codebase
gh repo clone krlwshu/s3_mvc

## Install dependencies

run the following from the project root: ```compose install```

## Set up DB

- DB name is configured in app\Config\Database.php, running on localhost, port 3306 
- Modify this to your preference and update the mysqldump import command accordingly
- Auth: root, no password for prototype purposes

Locate Db.sql from codebase root and import into MySQL database instance

mysql -u root -p db_name  < DbFile.sql

## Run Apache Spark (dependency)
From root, run: ```php spark serve```

## Launch app

http://localhost:8080 (depending on your port config)

### Example accounts:
- steve@test.com (PM role)
- sarah@test.com (Engineer)
- All credentials are ```Test1234```

