<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{

    public function index();

    // Get reviewInvoices Doctor
    public function reviewInvoices();

    // Get completedInvoices Doctor
    public function completedInvoices();

    public function show($id);

    // View Laboratories
    public function showLaboratorie($id);
}
