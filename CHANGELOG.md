# Changelog

All Notable changes to `BugNotifier` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## Unreleased

### Added
- Slack driver.
- Bitbucket driver.
- Github driver.
- More detailed notifications.
- Command to gerenerate custom Driver classes based on stubs.
- Better tests

## v2.0.4 - 2016-10-29

### Added
- Date on the message body

## v2.0.3 - 2016-10-21

### Added
- Multiple e-mail addresses for the MailDriver.

## v2.0.2 - 2016-10-15

### Added
- Possibility to create custom drivers

### Changed
- Changed the structure of the config file.

## v1.0.2 - 2016-10-14

### Changed
- Updated the list of exceptions ignored.
- Update composer dev dependencies.

## v1.0.1 - 2016-09-26

### Fixed
- Ignoring 404 exceptions by default.
- Fixed type hint of the driver argument on the sendNotification of the class BugNotifier.

## v1.0.0 - 2016-09-23

### Added
- E-mail driver.
