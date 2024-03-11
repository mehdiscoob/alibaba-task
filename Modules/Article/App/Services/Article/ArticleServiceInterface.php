<?php

namespace  Modules\Article\App\Services\Article;



use Illuminate\Contracts\Pagination\Paginator;
use Modules\Article\App\Models\Article;

interface ArticleServiceInterface
{

    /**
     * Get articles as pagination.
     *
     * @param array $data
     * @return Paginator
     */
    public function getArticlePaginate(?array $data): Paginator;

    /**
     * Create a new Article with the provided data.
     *
     * @param array $data The data for the new Article.
     *
     * @return Article The created Article instance.
     *
     * @throws \Exception If there is an error while creating the Article.
     */
    public function create(array $data): Article;


    /**
     * Find an Article by its ID.
     *
     * @param int $id The ID of the Article to find.
     *
     * @return Article|null The found Article instance or null if not found.
     */
    public function findById(int $id): ?Article;


    /**
     * Update an existing Article with new data.
     *
     * @param int $id The ID of the Article to update.
     * @param array $data The updated data for the Article.
     * @return bool True if the update is successful, false otherwise.
     */
    public function update(int $id, array $data): bool;
}
