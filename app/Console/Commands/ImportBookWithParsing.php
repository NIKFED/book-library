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
    protected $signature = 'import:book {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import book with parse book.json';

    public function handle()
    {
        $url = $this->option('url');
        if (!$url) {
            $url = 'https://gitlab.com/prog-positron/test-app-vacancy/-/raw/master/books.json';
        }
        $data = file_get_contents($url);
        $books = json_decode($data, true);

        $parser = new JsonBookParser();
        foreach ($books as $book) {
            $parser->parse($book);


            $statusFields = $parser->getStatusFields();
            $statusPlaceholder = new StatusPlaceholder($statusFields);
            $statusPlaceholder->CFS();


            $bookFields = $parser->getBookFields();
            if (!isset($bookFields['isbn'])) {
                $this->info('The "' . $bookFields['title'] . '" book does not have isbn');
                continue;
            }
            if (isset($bookFields['thumbnail_url']) && !file_exists('public/img/books/' . basename($bookFields['thumbnail_url']))) {
                $filePath = 'public/img/books/' . basename($bookFields['thumbnail_url']);
                try {
                    file_put_contents($filePath, file_get_contents($bookFields['thumbnail_url']));
                    $bookFields['thumbnail_url'] = $filePath;
                } catch (\Exception) {
                    $this->info('The "' . $bookFields['title'] . '" book: file upload error');
                }
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
            if (empty($bookCategoriesFields)) {
                $categoryPlaceholder = new CategoryPlaceholder(['category' => 'Novelty']);
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
