# Changelog

All Notable changes to `speicher210/fastbill-bundle` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [1.5.0] 2016-05-03

### Changed
- [BC BREAK] Added handler for subscription reactivated. If you extend `AbstractSubscriptionListener` you have to implement `onSubscriptionReactivated` method.

## [1.4.0] 2016-03-29

### Changed
- [BC BREAK] Moved the limit and offset from the request data to the get requests in services.

## [1.3.0] 2016-03-29

### Changed
- [BC BREAK] The article number is now required when checking a coupon (Fastbill API change)

## [1.2.0] 2016-03-21

### Added
- [BC BREAK] Updated to latest API version (check API for BC BREAK info)
- Added support for account hash configuration

## [1.1.1] 2016-02-04

### Added
- Command for listing customers
- Command for resetting the customer
- Command for listing subscriptions

## [1.1.0] 2016-02-03

### Added
- Updated to latest API version

## [1.0.0] 2016-01-18

### Added
- Initial commit
