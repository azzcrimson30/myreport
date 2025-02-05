<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table
        DB::table('report_formats')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert new data
        DB::table('report_formats')->insert([
            ['name' => 'PDF', 'format' => 'pdf'],
            ['name' => 'Excel', 'format' => 'xlsx'],
            ['name' => 'Word', 'format' => 'docx']
        ]);
    }
}
