# FeexpayPhp

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Feexpay``` ```LOUGBEGNON``` ```https://feexpay.me``` ```contact@feexpay.me``` ```Feexpay``` ```FeexpayPhp``` ```Php sdk of Feexpay - Online payment solution by credit card and mobile money``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.


## Feexpay SDK PHP Project - User Guide

This guide explains how to use the Feexpay PHP SDK to easily integrate mobile and card payment methods into your PHP or Laravel application. Follow these steps to get started:

### Installation

1. Install a local server like Xampp or Wamp etc ...

2. Install Composer if not already done.

3. Check that Composer is installed by running the following command:
   ```
   composer --version
   ```

### Usage in a Simple PHP Environment

1. Create your PHP project.

2. Download the Git repository by opening your terminal and running the following command:
   ```
   git clone https://github.com/foxinnovs/feexpay-sdk-php.git
   ```

3. Create a PHP file, for example, `index.php`.

4. Use the SDK methods in your PHP file:

   ```php
   <?php
   include 'src/FeexpayClass.php'; 

   $skeleton = new Feexpay\FeexpayPhp\FeexpayClass("shop's id", "token key API", "callback_url", "mode (LIVE, SANDBOX)");

   // Using the mobile network payment method (MTN, MOOV)
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

5. You can also integrate a payment button in your PHP page:

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

1. In a Laravel project, run the following command to install the Feexpay package:
   ```
   composer require feexpay/feexpay-php
   ```

2. Create a route in your `web.php` file:
   ```php
   Route::controller(YourController::class)->group(function () {
       Route::get('feexpay', 'feexpay')->name('feexpay');
   });
   ```

3. Create a controller, for example, `YourController.php`, and use the Feexpay SDK inside this controller to handle payments:

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

4. Integrate the Feexpay button in a view, for example, `welcome.blade.php`:
   ```php
   <div id='button_payee'></div>
   ```

5. You can now access the URL defined in the route to perform payments using Feexpay.

# FeexpayPhp

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Feexpay``` ```LOUGBEGNON``` ```https://feexpay.me``` ```contact@feexpay.me``` ```Feexpay``` ```FeexpayPhp``` ```Php sdk of Feexpay - Online payment solution by credit card and mobile money``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

Make sure to adapt values like "shop's id", "token key API", addresses, amounts, and other details according to your own configuration and needs.
