<?php

namespace  Modules\Article\App\Repositories\Article;


use Modules\Article\App\Models\Article;

interface ArticleRepositoryInterface
{

    /**
     * Paginate the articles.
     *
     * @param int $per_page The number of articles per page. Default is 50.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginator();

    /**
     * Find an Article by ID.
     *
     * @param int $id
     * @return Article|null
     */
    public function find(int $id);


    /**
     * Create a new Article.
     *
     * @param array $data
     * @return Article
     */
    public function create(array $data):Article;

    /**
     * Update an Article by ID.
     *
     * @param int $id
     * @param array $data
     * @return Article|null
     */
    public function update(int $id, array $data);


    /**
     * Delete an Article by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id):bool;
}
