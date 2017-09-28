# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

## 1.0.5 - 2017-09-28
### Added
-	Added parameter `$default_on_404` to clinet calls to disable default on 404.

## 1.0.4 - 2017-04-05
### Changed
-	Handle error descriptions in exceptions if returned from API.

## 1.0.3 - 2017-03-30
### Added
-	`getFields` method in `Iconneqt` class for GET /fields call.
-	`getFieldCount` method in `Iconneqt` class for GET /fields/count call.
-	`getField` method in `Iconneqt` class for GET /fields/{field} call.
-	`Field` resource class for the `getField*` methods.

## 1.0.2 - 2016-11-04
### Added
-	`putListSubscriber` in `Iconneqt` class for PUT /list/{list}subscriber call.
-	`setSubscriber` in `MailingList` class to create or update a subscriber.
-	"Overwrite" checkbox in "form" example to test PUT /list/{list}subscriber.