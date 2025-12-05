<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['code'=>'accounting','name'=>'Accounting','description'=>'Finance, Journals, Reports'],
            ['code'=>'sales','name'=>'Sales','description'=>'Quotations, Orders, Invoices'],
            ['code'=>'purchase','name'=>'Purchase','description'=>'Suppliers, POs, Bills'],
            ['code'=>'inventory','name'=>'Inventory','description'=>'Stock, Warehouses, Moves'],
            ['code'=>'documents','name'=>'Documents','description'=>'Files, Approvals, Archive'],
            ['code'=>'pos','name'=>'POS','description'=>'Retail, Cashier, Sessions'],
            ['code'=>'crm','name'=>'CRM','description'=>'Leads, Customers, Pipelines'],
        ];

        foreach ($modules as $m) {
            Module::updateOrCreate(['code'=>$m['code']], $m);
        }
    }
}
