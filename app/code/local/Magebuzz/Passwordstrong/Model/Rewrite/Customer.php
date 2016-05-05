<?php
class Magebuzz_Passwordstrong_Model_Rewrite_Customer extends Mage_Customer_Model_Customer{
  public function validate(){
    $errors = array();

    $password = $this->getPassword();
    $firstName = $this->getFirstname();
    $lastName = $this->getLastname();
    if (strlen($password) && !Zend_Validate::is($password, 'StringLength', array('8'))) {
      $errors[] = Mage::helper('customer')->__('The minimum password length is %s', 8);
    }

    if(strpos($password, $firstName) === false && strpos($password, $lastName) === false){

    }else{
      $errors[] = Mage::helper('customer')->__("The password must don't contain lastname or firstname");
    }

    if(preg_match('/(.)\1\1+/', $password) != 0){
      $errors[] = Mage::helper('customer')->__("The password must don't repeat or use consecutive numbers or letters");
    }

    if (empty($errors) || $password == '') {
      return parent::validate();
    }
    return $errors;
  }
}