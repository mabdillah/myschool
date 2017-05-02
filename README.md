MYSCHOOL
============================

MySchool direka untuk menyediakan kemudahan pengurusan maklumat murid kepada pentadbir dan guru di sekolah. 

Sistem ini mengandungi beberapa modul iaitu Maklumat Pelajar dan Guru, Kelas, Sesi, Pemarkahan, Yuran, Laporan dan access user.

Login: admin 
Password: 123456

STRUKTUR DIREKTORI
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



KEPERLUAN
------------

Keperluan minimun untuk sistem ini adalah PHP 5.4.0.


PEMASANGAN
------------
Pasang xampp / wamp sebagai web server.

Extract fail arkib yang dimuat turun ke direktori di bawah Web Root.


KONFIGURASI
-------------

### Database

Ubah fail `config/db.php` dengan konfigurasi mysql, contoh:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Import database (myschool/database/myschool.sql) di mysql.

Anda boleh mengakses aplikasi ini melalui URL berikut:
~~~
http://localhost/myschool/
~~~

PASSWORD
--------
Login: admin
Password: 123456
# My project's README
