# test technique deezer

## Prerequisite
* PHP 7.0
* php pdo + pdo_mysql mod
* php json mod

## Installation
* Change config in config .php
* Launch

## Resources 
* User : contains all routes related to users
* Song : contains all routes related to song
* Favorite : contains all routes related to user's favorites songs

## Routes
* User 
* * get : Implicit road to get information about a list or one user
* * put : Implicit road Unavailable
* * post : Implicit road Unavailable
* * delete : Implicit road Unavailable
* * getFavoriteSong : Explicit road to get a list of user's favorite song
* Song
* * get : Implicit road to get information about a list or one song
* * put : Implicit road Unavailable
* * post : Implicit road Unavailable
* * delete : Implicit road Unavailable
* Favorite
* * get : Implicit road Unavailable
* * post : Implicit road to add a new favorite song to a user
* * put : Implicit road Unavailable
* * delete : Implicit road to delete a favorite song from a user's list