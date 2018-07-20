<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Creates a new instance of the editor.
 *
 * In the constructor it sets the default /etc/hosts-filename for the current system.
 *
 * In window it is:    C:\\Windows\\System32\\drivers\\etc\\hosts
 * In any other it is: /etc/hosts
 */
$editor = new tyurderi\Hosts\Editor();

/**
 * Tries to add a new host entry into the list.
 *
 * When the host already exists it won't be touched and is just returned.
 * Otherwise it will be added to the current collection.
 */
$host = $editor->push('127.0.0.1', 'example.com');

/**
 * Looks for a host with the given hostname.
 *
 * If none found it returns null. Otherwise the given host.
 * It also returns the first matching result - if more hosts matching the query it currently simply ignores the other.
 */
$host = $editor->find('example.com');

/**
 * The ip the host is targeting to
 */
echo $host->ip, PHP_EOL;        // => 127.0.0.1

/**
 * This is an array of the hosts in the entry
 */
echo $host->hosts[0], PHP_EOL;  // => 'example.com'

/**
 * Whether the entry is ignored or not. Ignored hosts are prepended by the #-char.
 */
echo $host->ignored, PHP_EOL;   // => false

/**
 * Empty hosts are just empty or probably invalid lines in the host file
 */
echo $host->empty, PHP_EOL;     // => false

/**
 * Mark the host for removing. This can't be undone.
 */
$host->remove();

/**
 * Write the host collection to the hosts file. Hosts which are marked as removed are excluded for writing.
 */
$editor->write();