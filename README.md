# recipedb - Recipe database with pdf output

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
   mysql> insert into tblUsers (userName,userPassword,userLastname,userFirstname,userIsAdmin) values ('admin','admin','Min','Ad',1);
   ```

Now, if the server is running correctly and the files are on the server, you should see the login page.
