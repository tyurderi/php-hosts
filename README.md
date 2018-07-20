# PHP Hosts Manager

A very simple and minimalistic hosts file manager.

With this library you can create, edit and delete hosts in your `/etc/hosts` file.

### Documentation
See [GitHub Wiki](https://github.com/tyurderi/php-hosts/wiki).

### Requirements
- Linux, Windows or macOS
- PHP5.6

### Installation
```bash
$ composer require tyurderi/hosts
```

### Basic Usage
```php
require_once __DIR__ . '/vendor/autoload.php';

$editor = new tyurderi\Hosts\Editor();

// Create a new host entry
$host = $editor->push('127.0.0.1', 'example.com');

// Edit an existing host entry
$host = $editor->find('example.com');
echo $host->ip, PHP_EOL;      // => 127.0.0.1
echo $host->hosts, PHP_EOL;   // => example.com
echo $host->ignored, PHP_EOL; // => false
echo $host->empty, PHP_EOL;   // => false

$host->ip = '127.0.0.2';

$host->remove();

$editor->write();
```


## License
Copyright (c) 2018 tyurderi  
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:  
  
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.