# recipedb - Recipe database with pdf output

## Requirements

LAMP-Server with PHP version > 5.5

## Setup database on local server

On a system with apache web server, php and MySQL, the following steps need to be performed to use the here provided code:

1. **Enter mysql prompt**

   Enter the mysql prompt as root user

   ```
   bash> mysql -u root -p
   ```

   If your root account doesn't have a password, you can skip the `-p`.

2. **Create database**
   
   ```
   mysql> create database recipedb
   ```

   With the database created, enter it using

   ```
   mysql> use recipedb
   ```

3. **Create tables from dump**

   ```
   mysql> source recipedb_dump
   ```

4. **Create recipeuser**

   The mysql user *recipeuser* is used during development for the database access from the php scripts.
   Create user for localhost:

   ```
   mysql> create user 'recipeuser'@'localhost' identified by 'recipeuser';
   ```

   Grant all rights on our database:

   ```
   mysql> grant all privileges on recipedb.* to 'recipeuser'@'localhost' with grant option;
   ```

   Do the same for any other server:

   ```
   mysql> create user 'recipeuser'@'%' identified by 'recipeuser';
   mysql> grant all privileges on recipedb.* to 'recipeuser'@'%' with grant option;
   ```

5. **Add user to tblUsers**

   ```
   mysql> insert into tblUsers (userName,userPassword,userLastname,userFirstname,userIsAdmin) values ('admin','$2y$10$MKE/AF2yt/3wv7zFpkZlMOsbqYOsVEbQ51vRHQz.NFRW9BpB534Q.','Min','Ad',1);
   ```
   
   The cryptic second value is the hashed version of the password (which is `admin`).

6. **Login**

   Login on the page (e.g. `localhost/recipedb/`) using username and password `admin`.

Now, everything should work and it is easy to see, where things need to be done.
