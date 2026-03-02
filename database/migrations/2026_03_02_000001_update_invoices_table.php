<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Add missing columns
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade')->after('id');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('cascade')->after('patient_id');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('cascade')->after('doctor_id');
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('set null')->after('section_id');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null')->after('group_id');
            
            $table->date('invoice_date')->nullable()->after('invoice_status');
            $table->string('invoice_type')->default('single')->after('invoice_date');
            $table->decimal('price', 10, 2)->default(0)->after('invoice_type');
            $table->decimal('discount_value', 10, 2)->default(0)->after('price');
            $table->decimal('tax_rate', 5, 2)->default(0)->after('discount_value');
            $table->decimal('tax_value', 10, 2)->default(0)->after('tax_rate');
            $table->decimal('total_with_tax', 10, 2)->default(0)->after('tax_value');
            $table->decimal('amount_paid', 10, 2)->default(0)->after('total_with_tax');
            $table->decimal('remaining_amount', 10, 2)->default(0)->after('amount_paid');
            $table->text('notes')->nullable()->after('remaining_amount');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['section_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['service_id']);
            
            $table->dropColumn([
                'patient_id',
                'doctor_id', 
                'section_id',
                'group_id',
                'service_id',
                'invoice_date',
                'invoice_type',
                'price',
                'discount_value',
                'tax_rate',
                'tax_value',
                'total_with_tax',
                'amount_paid',
                'remaining_amount',
                'notes',
            ]);
        });
    }
};
