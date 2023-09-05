<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceControllerTest extends WebTestCase
{
   
    public function testGetInvoices()
    {
        $client = static::createClient();
        $client->request('GET', '/invoices');
        dd( $client->getResponse() );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
      
        // Implement assertions to check the response content
    }
}
