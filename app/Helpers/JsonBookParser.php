<?php

namespace App\Helpers;


use Carbon\Carbon;

class JsonBookParser
{
    private array $commonFields = [];

    private array $bookKeys = [
        'title',
        'isbn',
        'page_count',
        'thumbnail_url',
        'short_description',
        'long_description',
        'published_date',
    ];

    private array $statusKeys = [
        'status',
    ];

    private array $categoryKeys = [
        'categories',
    ];

    private array $authorKeys = [
        'authors',
    ];

    public function parse(array $convertible): void
    {
        $this->arrayBookFieldConverter($convertible);
    }

    /** Парсит формат полей книги
     *
     * Формат "pageCount" -> "page_count"
     *
     * @param array $convertible
     * @return void
     */
    private function arrayBookFieldConverter(array $convertible): void
    {
        $this->commonFields = $convertible;
        foreach ($convertible as $key => $field) {
            if ($key === 'publishedDate') {
                $parseDate = Carbon::parse($this->commonFields[$key]['$date'])->format('Y-m-d H:m:s');;
                $this->commonFields['published_date'] = $parseDate;
            } elseif (strtolower($key) !== $key) {
                $convertedString = '';
                preg_match('/[A-Z]/', $key, $matches, PREG_OFFSET_CAPTURE);
                foreach ($matches as $match) {
                    $convertedString = str_replace($match[0], '_' . strtolower($match[0]), $key);
                }
                $this->commonFields[$convertedString] = $field;
                unset($this->commonFields[$key]);
            }
        }
    }

    /** Возвращает поля для заполнения сущности Book
     * @return array
     */
    public function getBookFields(): array
    {
        return $this->getFieldsByKeysArray($this->bookKeys);
    }

    /** Возвращает поля для заполнения сущности Status
     * @return array
     */
    public function getStatusFields(): array
    {
        return $this->getFieldsByKeysArray($this->statusKeys);
    }

    /** Возвращает поля для заполнения сущности Category и BookCategory
     * @return array
     */
    public function getCategoryFields(): array
    {
        return $this->getFieldsByKeysArray($this->categoryKeys);
    }

    /** Возвращает поля для заполнения сущности User и AuthorBooks
     * @return array
     */
    public function getAuthorFields(): array
    {
        return $this->getFieldsByKeysArray($this->authorKeys);
    }

    private function getFieldsByKeysArray(array $keysArray): array
    {
        $fields = [];
        foreach ($keysArray as $value) {
            if (isset($this->commonFields[$value])) {
                $fields[$value] = $this->commonFields[$value];
            }
        }
        return $fields;
    }
}