<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Invoice;
use App\Entity\InvoiceLine;
use App\Form\InvoiceType;
use Doctrine\Persistence\ManagerRegistry;

class InvoiceController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}
    
    
    public function index(): Response
    {
        $invoices = $this->doctrine->getRepository(Invoice::class)->findAll();

        return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
            'form' => $this->createForm(InvoiceType::class)->createView(), // Create the form for adding invoices
            'invoices'=>$invoices,
        ]);
    }

   
    #[Route("/invoice/add", name:"add_invoice", methods:"POST")]
    public function addInvoice(Request $request)
    {
        // Create a new Invoice instance
        $invoice = new Invoice();

        // Create a form for the Invoice entity
        $invoiceForm = $this->createForm(InvoiceType::class, $invoice);
        $invoiceForm->handleRequest($request);

        if ($invoiceForm->isSubmitted() && $invoiceForm->isValid()) {
            // If the Invoice form is valid, save the Invoice entity to the database
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($invoice);
            $entityManager->flush();

            // Get the Invoice lines data from the request
            $requestData = json_decode($request->getContent(), true);
            $invoiceLinesData = $requestData['invoice_lines'];
            dd( $invoiceLinesData  );
            foreach ($invoiceLinesData as $lineData) {
                // Create a new InvoiceLine instance
                $invoiceLine = new InvoiceLine();

                // Create a form for the InvoiceLine entity
                $invoiceLineForm = $this->createForm(InvoiceLineType::class, $invoiceLine);
                $invoiceLineForm->submit($lineData);

                if ($invoiceLineForm->isSubmitted() && $invoiceLineForm->isValid()) {
                    // If the InvoiceLine form is valid, associate it with the Invoice and save to the database
                    $invoiceLine->setInvoice($invoice);
                    $entityManager->persist($invoiceLine);
                } else {
                    // Handle validation errors for InvoiceLine, e.g., log or return error response
                }
            }

            $entityManager->flush();

            // Return a success response
            return $this->json(['message' => 'Invoice and Invoice lines added successfully'], Response::HTTP_CREATED);
        } else {
            // Handle validation errors for Invoice, e.g., log or return error response
            return $this->json(['message' => 'Validation failed'], Response::HTTP_BAD_REQUEST);
        }
    }


 
}
