# PHP Locker
> PHP PID Locker Composer Project.

[![GitHub](https://img.shields.io/github/license/sgtcoder/PHP-Locker.svg)](https://opensource.org/licenses/GPL-3.0)
[![GitHub last commit](https://img.shields.io/github/last-commit/sgtcoder/PHP-Locker.svg)](https://github.com/sgtcoder/PHP-Locker/commits/master)
[![GitHub tag](https://img.shields.io/github/tag/sgtcoder/PHP-Locker.svg)](https://github.com/sgtcoder/PHP-Locker/tags)

## Overview
After working with PHP Redis Locker, Mutex Locker, and other lockers; I have realized that there is no ideal locker that did what I needed it to do for my projects.

This is when I decided to implement my own PHP Locker based on several different concepts from other locker tools. This Locker tool is very simple to use and to include in on your project. It is a file-based PID locker.

## Installation
This project assumes that you have general knowledge of a LAMP stack environment.
- Add this repository to your composer.json (since it's not in packagist.org)
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/sgtcoder/php-locker.git"
    }
]
```
- Run `composer install sgtcoder/php-locker`

## Setup
```
// Create Lock Test
$Lock = new \Locker\Lock('lock_test');

// Try to acquire lock
if($Lock->lock()){
    // Do Code
    echo 'test';

    // Unlock
    $Lock->unlock();
}else{
    // Could not acquire lock
}

// Check to see if locked without acquiring
$Lock->isLocked())
```

## Future
- Implement proper pid id inside of pid file

## Meta
Michael J Brancato – [@sgtcoder](https://github.com/sgtcoder) – mike@sgtcoder.com

Distributed under the GNU GENERAL PUBLIC LICENSE Version 3. See ``LICENSE`` for more information.

[https://github.com/sgtcoder/PHP-Locker](https://github.com/sgtcoder/PHP-Locker)

## Contributing

1. Fork it (<https://github.com/sgtcoder/PHP-Locker/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

## Questions
If you have any questions or feedback, please email me at mike@sgtcoder.com
