<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'year' => 2005, 'isbn' => '9789793062792', 'category' => 'Fiksi'],
            ['title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'year' => 2006, 'isbn' => '9789793062808', 'category' => 'Fiksi'],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'year' => 2014, 'isbn' => '9786023850471', 'category' => 'Fiksi'],
            ['title' => 'Midnight In Chernobyl', 'author' => 'Adam Higginbotham', 'year' => 2019, 'isbn' => '9783596036868', 'category' => 'Fiksi'],

        ];

        foreach ($books as $book) {
            DB::table('books')->insert($book);
        }
    }
}
