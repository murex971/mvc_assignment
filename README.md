# mvc_assignment

## How to run

1. `git clone https://github.com/murex971/mvc_assignment.git`
2. `cd mvc_assignment`
3. Change the paths in `mvcproj.sdslabs.local.conf` pointing to the `public` folder of this project
4. `sudo cp ~/mvc.sdslabs.local.conf /etc/apache2/sites-available/`
5. Add `mvc.sdslabs.local` entry to your `/etc/hosts`
6. `sudo a2ensite mvc.sdslabs.local.conf`
7. `sudo service apache2 restart`
8. Open [http://mvc.sdslabs.local](http://mvc.sdslabs.local) in your browser
