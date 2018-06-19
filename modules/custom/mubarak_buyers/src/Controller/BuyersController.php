<?php

namespace Drupal\mubarak_buyers\Controller;

use Drupal\Core\Controller\ControllerBase;

class BuyersController extends ControllerBase
{
	
	public function content() {
	    
	    $entity = \Drupal::entityTypeManager()->getStorage('user')->create(array());
		$formObject = \Drupal::entityTypeManager()
		  ->getFormObject('user', 'register')
		  ->setEntity($entity);
		$form = \Drupal::formBuilder()->getForm($formObject);
		$form_rendered = \Drupal::service('renderer')->render($form);
		return $form_rendered;
  }
}