HRMS
===========
[![Build Status](https://travis-ci.org/gamonoid/hrms.svg?branch=master)](https://travis-ci.org/gamonoid/hrms)

HRMS is a [HRM software](https://hrms.com) which enable companies of all sizes to [manage HR activities](https://hrms.com)
properly. 

Useful Links
-------------
 * HRMS Opensource Blog: [http://hrms.org](http://hrms.org)
 * HRMS Cloud Hosting: [https://hrms.com](https://hrms.com)
 * HRMS Documentation (Opensource and Commercial): [http://blog.hrms.com](http://blog.hrms.com)
 * HRMS Blog: [https://hrms.com/blog](http://hrms.com/blog)
 * Purchase HRMS Pro: [https://hrms.com/modules.php](https://hrms.com/modules.php)
 * Report Issues: [https://github.com/gamonoid/hrms/issues](https://github.com/gamonoid/hrms/issues)
 * Feature Requests: [https://bitbucket.org/thilina/hrms-opensource/issues](https://bitbucket.org/thilina/hrms-opensource/issues)
 * Community Support: [http://stackoverflow.com/search?q=hrms](http://stackoverflow.com/search?q=hrms)

Installation
------------
 * Download the latest release https://github.com/gamonoid/hrms/releases/latest

 * Copy the downloaded file to the path you want to install HRMS in your server and extract.

 * Create a mysql DB for and user. Grant all on HRMS DB to new DB user.

 * Visit HRMS installation path in your browser.

 * During the installation form, fill in details appropriately.

 * Once the application is installed use the username = admin and password = admin to login to your system.

 Note: Please rename or delete the install folder (<HRMS root>/app/install) since it could pose a security threat to your HRMS instance.

Manual Installation
-------------------

[](https://thilinah.gitbooks.io/hrms-guide/content/manual-installation.html)

Upgrade from Previous Versions to Latest Version
------------------------------------------------

Refer: [http://blog.hrms.com/docs/upgrade/](http://blog.hrms.com/docs/upgrade/)

Setup HRMS Development Environment
------------------------------------

HRMS development environment is packaged as a Vagrant box. I includes php7, nginx, phpunit and other
software required for running hrms

Preparing development VM with Vagrant
-------------------------------------

- Clone hrms from https://github.com/gamonoid/hrms.git or download the source

- Install Vagrant [https://www.vagrantup.com/downloads.html](https://www.vagrantup.com/downloads.html)

- Install Vagrant host updater plugin [https://github.com/cogitatio/vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater)


- Run vagrant up in hrms root directory (this will download hrms vagrant image which is  ~1 GB)

```
~ $ vagrant up
```

- Run vagrant ssh to login to the Virtual machine

```
~ $ vagrant ssh
```

- Install ant build in your VM

```
~ $ sudo apt-get install ant
```

- Build Icehrm (your hrms root directory is mapped to /vagrant/ directory in VM)

```
~ $ cd /vagrant
~ $ ant buildlocal
```

- Execute table creation scripts
```
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrmsdb.sql
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrms_master_data.sql
~ $ mysql -udev -pdev dev < /vagrant/core-ext/scripts/hrms_sample_data.sql
```

- Navigate to [](http://clients.app.dev/dev) to load hrms from VM. (user:admin/pass:admin)

- Unit testing

```
~ $ cd /vagrant
~ $ phpunit
```


