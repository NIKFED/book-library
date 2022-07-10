<?php

namespace App\Console\Commands;

use App\Helpers\JsonBookParser;
use App\Helpers\Placeholders\AuthorBookPlaceholder;
use App\Helpers\Placeholders\AuthorPlaceholder;
use App\Helpers\Placeholders\BookCategoryPlaceholder;
use App\Helpers\Placeholders\BookPlaceholder;
use App\Helpers\Placeholders\CategoryPlaceholder;
use App\Helpers\Placeholders\StatusPlaceholder;
use Illuminate\Console\Command;

class ImportBookWithParsing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import book with parse book.json';

    public function handle()
    {
        $data = file_get_contents(base_path('data/books.json'));
        $books = json_decode($data, true);

        $parser = new JsonBookParser();
        foreach ($books as $book) {
            $parser->parse($book);


            $statusFields = $parser->getStatusFields();
            $statusPlaceholder = new StatusPlaceholder($statusFields);
            $statusPlaceholder->CFS();


            $bookFields = $parser->getBookFields();
            if (!isset($bookFields['isbn'])) {
                $this->info('The ' . $bookFields['title'] . ' book did not have isbn');
                continue;
            }
            $bookFields['book_status_id'] = $statusPlaceholder->getInstanceId();
            $bookPlaceholder = new BookPlaceholder($bookFields);
            $bookPlaceholder->CFS();


            $bookCategoriesFields = [];
            $categoriesFields = $parser->getCategoryFields();
            foreach ($categoriesFields['categories'] as $categoryFields) {
                $categoryPlaceholder = new CategoryPlaceholder(['category' => $categoryFields]);
                $categoryPlaceholder->CFS();

                $bookCategoriesFields[] = [
                    'book_id' => $bookPlaceholder->getInstanceId(),
                    'category_id' => $categoryPlaceholder->getInstanceId(),
                ];
            }
            foreach ($bookCategoriesFields as $bookCategoryFields) {
                $bookCategoryPlaceholder = new BookCategoryPlaceholder($bookCategoryFields);
                $bookCategoryPlaceholder->CFS();
            }


            $bookAuthorsFields = [];
            $authorsFields = $parser->getAuthorFields();
            foreach ($authorsFields['authors'] as $authorFields) {
                $authorPlaceholder = new AuthorPlaceholder(['author' => $authorFields]);
                $authorPlaceholder->CFS();

                $bookAuthorsFields[] = [
                    'book_id' => $bookPlaceholder->getInstanceId(),
                    'author_id' => $authorPlaceholder->getInstanceId(),
                ];
            }
            foreach ($bookAuthorsFields as $bookAuthorFields) {
                $authorBookPlaceholder = new AuthorBookPlaceholder($bookAuthorFields);
                $authorBookPlaceholder->CFS();
            }
        }

        return;
    }
}
