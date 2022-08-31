<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // all elements
        $elements = [
<<<<<<< HEAD
            'Assets' => 'A', 
            'Liabilities' => 'L', 
            'Owners Equity' => 'OE', 
            'Income' => 'I', 
            'Expense' => 'E'
        ];
        
        // insert 
        foreach ($elements as $name => $symbol) {
            // insert into elements 
            DB::table('elements')->insert([
                'name' => $name,
                'symbol' => $symbol,
                'description' => NULL,
=======
            'assets' => [
                'name' => 'Assets',
                'slug' => 'assets',
                'symbol' => 'A',
                'is_debit' => 1,
                'is_credit' => 0,
                'description' => '',
            ], 
            'Liabilities' => [
                'name' => 'Liabilities',
                'slug' => 'liabilities',
                'symbol' => 'L',
                'is_debit' => 0,
                'is_credit' => 1,
                'description' => '',
            ],
            'Capital' => [
                'name' => 'Capital',
                'slug' => 'capital',
                'symbol' => 'C',
                'is_debit' => 0,
                'is_credit' => 1,
                'description' => '',
            ], 
            'Revenue' => [
                'name' => 'Revenue',
                'slug' => 'revenue',
                'symbol' => 'Re',
                'is_debit' => 0,
                'is_credit' => 1,
                'description' => '',
            ], 
            'Expense' => [
                'name' => 'Expense',
                'slug' => 'expense',
                'symbol' => 'Ex',
                'is_debit' => 1,
                'is_credit' => 0,
                'description' => '',
            ], 
            'Drawings' => [
                'name' => 'Drawings',
                'slug' => 'drawings',
                'symbol' => 'D',
                'is_debit' => 1,
                'is_credit' => 0,
                'description' => '',
            ], 
        ];
        
        // insert 
        foreach ($elements as $element) {
            // insert into elements 
            DB::table('elements')->insert([
                'name' => $element['name'],
                'slug' => $element['slug'],
                'symbol' => $element['symbol'],
                'is_debit' => $element['is_debit'],
                'is_credit' => $element['is_credit'],
                'description' => $element['description'],
>>>>>>> 44b72bece3d4b2e7345094ee01ee2fbafc00ed17
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        
    }
}
