<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Here we are crawling one of the online bookstores to seed our database.
     *
     * @return void
     */
    public function run()
    {
        for($page=1;$page<=3;$page++) {
            $pageUrl = "https://www.knygos.lt/lt/knygos/zanras/fantastika-ir-fantasy/?psl=" . $page;
            $fetchPage = file_get_contents($pageUrl);

            if (!$fetchPage)
                die("Unable to fetch the bookstore.");

            $booksDetailsHTML = self::explodeBetween("<div class=\"product-photo-icon-container product-photo-icons-rb\">", "</a>", $fetchPage);
            foreach ($booksDetailsHTML as $bookDetailsHTML) {
                $bookUrl = current(self::explodeBetween('<a href="', '"', $bookDetailsHTML));
                //echo 'https://www.knygos.lt/'.$bookUrl.PHP_EOL;
                usleep(200); // Delay crawling to prevent spam-block

                $fetchBookPage = file_get_contents('https://www.knygos.lt/' . $bookUrl);

                if (!$fetchBookPage)
                    die("Unable to fetch the book page.");

                $author = @next(explode('>', current(self::explodeBetween('<a itemprop="author"', '</a>', $fetchBookPage))));
                $year = current(self::explodeBetween('<p class="book_details">Metai: ', '</p>', $fetchBookPage));
                $title = current(self::explodeBetween('<p class="book_details">Originalus pavadinimas: ', '</p>', $fetchBookPage));
                if (empty($title))
                    $title = current(self::explodeBetween('<span itemprop="name">', '</span>', $fetchBookPage));

                if (empty($title) || strlen($title) > 30){
                    continue;
                }

                $genre = 'Fantastika';

                DB::table('books')->insert([
                    'title' => $title,
                    'year' => $year,
                    'author' => $author,
                    'genre' => $genre,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);

            }
        }

    }

    private function explodeBetween($start, $end, $source) {
        $rez = [];
        foreach(explode($start, $source) as $part) { $rez[] = current(explode($end, $part)); unset($rez[0]); }
        return $rez;
    }
}
