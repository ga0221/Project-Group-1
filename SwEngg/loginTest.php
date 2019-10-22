<?php

require_once('login.php');

class login extends PHPUnit_Framework_TestCase
{
  public function setUp(){ }
  public function tearDown(){ }

  public function testLoginIsValid()
  {
    // test to ensure that the loginPage is working
    $connObj = new login();
    $_POST['username'] = 'sravani95@gmail.com';
	$_POST['password'] = 'gaya3';
    $this->assertTrue($connObj->connectToServer($_POST['username'],$_POST['password']) !== false);
  }
}
?>