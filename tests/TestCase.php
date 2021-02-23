<?php
namespace Tests;
include __DIR__.'/mock.php';
include __DIR__.'/mockSession.php';
include __DIR__.'/mockView.php';
global $logged;
$logged = false;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
