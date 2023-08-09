# FeexpayPhp

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Feexpay``` ```LOUGBEGNON``` ```https://feexpay.me``` ```contact@feexpay.me``` ```Feexpay``` ```FeexpayPhp``` ```Php sdk of Feexpay - Online payment solution by credit card and mobile money``` with the appropriate values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md), and [composer.json](composer.json) files. You can run `$ php prefill.php` in the command line to replace these values automatically. Don't forget to delete the `prefill.php` file after making these replacements.

This is where you should provide a brief description of your project. Try to keep it concise, just a paragraph or two, and perhaps mention any key features or aspects that set your project apart.

## Feexpay SDK PHP Project - User Guide

This guide explains how to use the Feexpay PHP SDK to effortlessly integrate mobile and card payment methods into your PHP or Laravel application. Follow these steps to get started:

### Installation

1. Set up a local server environment, such as Xampp or Wamp.

2. Install Composer if you haven't already.

3. Confirm that Composer is installed by running the following command:
   ```
   composer --version
   ```

### Usage in a Simple PHP Environment

1. Create your PHP project.

2. Download the Git repository by opening your terminal and executing this command:
   ```
   git clone https://github.com/foxinnovs/feexpay-sdk-php.git
   ```

3. Craft a PHP file, for instance, `index.php`.

4. Employ the SDK methods in your PHP file:

   ```php
   <?php
   include 'src/FeexpayClass.php'; 

   $skeleton = new Feexpay\FeexpayPhp\FeexpayClass("shop's id", "token key API", "callback_url", "mode (LIVE, SANDBOX)");

   // Utilizing the mobile network payment method (MTN, MOOV)
   $response = $skeleton->paiementLocal("amount", "phone_number", "network (MTN, MOOV)", "Jon Doe", "jondoe@gmail.com");
   $status = $skeleton->getPaiementStatus($response);
   var_dump($status);

   // Using the card payment method (VISA, MASTERCARD)
   $responseCard = $skeleton->paiementCard("amount", "phoneNumber(66000000)", "typeCard (VISA, MASTERCARD)", "Jon", "Doe", "jondoe@gmail.com", "country(Benin)", "address(Cotonou)", "district(Littoral)", "currency(XOF, USD, EUR)");
   $redirectUrl = $responseCard["url"];
   header("Location: $redirectUrl");
   exit();
   ?>
   ```

5. You can also integrate a payment button into your PHP page:

   ```php
   <?php
   include 'src/FeexpayClass.php'; 
   $price = 50;
   $id = "shop's id";
   $token = "token key API";
   $callback_url = 'https://www.google.com';
   $mode = 'LIVE';
   $feexpayclass = new Feexpay\FeexpayPhp\FeexpayClass($id, $token, $callback_url, $mode);
   $result = $feexpayclass->init($price, "button_payee");
   ?>
   <div id='button_payee'></div>
   ```

### Usage with Laravel

1. In a Laravel project, install the Feexpay package by executing the following command:
   ```
   composer require feexpay/feexpay-php
   ```

2. Set up a route in your `web.php` file:
   ```php
   Route::controller(YourController::class)->group(function () {
       Route::get('feexpay', 'feexpay')->name('feexpay');
   });
   ```

3. Create a controller, e.g., `YourController.php`, and incorporate the Feexpay SDK within it to handle payments:

   ```php
   <?php

   namespace App\Http\Controllers;
   use Feexpay\FeexpayPhp\FeexpayClass;
   use Illuminate\Http\Request;

   class YourController extends Controller
   {
       public function feexpay()
       {
           $skeleton = new FeexpayClass("shop's id", "token key API", "callback_url", "mode (LIVE, SANDBOX)");
           $responseCard = $skeleton->paiementCard("amount", "phoneNumber(66000000)", "typeCard (VISA, MASTERCARD)", "Jon", "Doe", "jondoe@gmail.com", "country(Benin)", "address(Cotonou)", "district(Littoral)", "currency(XOF, USD, EUR)");
           $redirectUrl = $responseCard["url"];
           return redirect()->away($redirectUrl);
       }
   }
   ```

4. Embed the Feexpay button within a view, such as `welcome.blade.php`:
   ```php
   <div id='button_payee'></div>
   ```

5. You can now access the URL defined in the route to initiate payments using Feexpay.

Make sure to customize values like "shop's id", "token key API", addresses, amounts, and other details according to your own setup and requirements.
