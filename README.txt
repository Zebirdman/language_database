Western Sydney Language Database

Side project for recording and managing grammatical changes in a small
database. This project has now been converted into a containerized version
that is easy to build and run on any docker installed host.

The mysql part uses the pre built official image while the web front end
uses a intermediate image built from ubuntu base and installed with apache
php and php-mysql packages.

This project also contains a logging class plog that can be volume mounted
and tailed to show the POST requests and their contents for interest purposes

Author: Ben Futterleib <benjamin.futterleib@gmail.com>
