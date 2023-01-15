<?php

namespace App;

use App\Cart\Item;
use App\Cart\ShoppingCart;
use App\Order\Order;
use App\Invoice\TextInvoice;
use App\Invoice\PDFInvoice;
use App\Customer\Customer;
use App\Payments\CashOnDelivery;
use App\Payments\CreditCardPayment;
use App\Payments\PaypalPayment;

class Application
{
    public static function run()
    {
        $akko5075s = new Item('Akko', 'Akko 5075S' , 3799);
        $keyboard = new Item('KBD', 'Akko CS Jelly Pink(Linears)' , 2000);

        $shopping_cart = new ShoppingCart();
        $shopping_cart->addItem($akko5075s, 5);
        $shopping_cart->addItem($keyboard, 2);
        $customer = new Customer('Nathaniel T. Allapitan', 'Telabastagan', 'allapitan.nathaniel@auf.edu.ph');
        $order = new Order($customer, $shopping_cart);

        $invoice = new PDFInvoice();
        $order->setInvoiceGenerator($invoice);
        $invoice->generate($order);

        $payment = new PaypalPayment('allapitan.paypal@gmail.com', 'nathpassword');
        $order->setPaymentMethod($payment);
        $order->payInvoice();
    }
}