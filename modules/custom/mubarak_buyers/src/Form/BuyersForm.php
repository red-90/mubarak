<?php
/**
 * @file
 * Contains \Drupal\mubarak_buyers\Form\BuyersForm.
 */

namespace Drupal\mubarak_buyers\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;


/**
 * Buyers form.
 */
class BuyersForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
  	return 'mubarak_forms_buyers_form';
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

  	$form['fullname'] = array(
      '#type' => 'textfield',
      '#title' => t('Fullname'),
      '#required' => TRUE,
    );

    $form['username'] = array(
      '#type' => 'textfield',
      '#title' => t('Username'),
      '#required' => TRUE,
    );

    $form['password'] = array(
      '#type' => 'password',
      '#title' => t('Password'),
      '#required' => TRUE,
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => t('E-mail'),
    );

    $form['phonenumber'] = array(
      '#type' => 'textfield',
      '#title' => t('Phone number'),
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Add buyer'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
 
      $user = User::create();
      $user->setPassword($form_state->getValue('password'));
      $user->enforceIsNew();
      $user->setEmail($form_state->getValue('email'));
      $user->setUsername($form_state->getValue('username'));
      $user->set('field_phone', $form_state->getValue('phonenumber'));
      $user->set('field_fullname', $form_state->getValue('fullname'));
      $user->set("init", 'mail');
      $user->set("langcode", $language);
      $user->set("preferred_langcode", $language);
      $user->set("preferred_admin_langcode", $language);
      $user->activate();
     
      //Save user account
      $user->save();

      drupal_set_message(t('the buyers has been created'));

  }

}