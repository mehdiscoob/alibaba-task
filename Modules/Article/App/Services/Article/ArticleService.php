<?php

namespace Modules\Article\App\Services\Article;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Repositories\Article\ArticleRepositoryInterface;

class ArticleService implements ArticleServiceInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    protected $articleRepository;


    /**
     * ArticleService constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     *
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * Get articles as pagination.
     *
     * @param array $data
     * @return Paginator
     */
    public function getArticlePaginate(?array $data): Paginator
    {
        if (!isset($data['perPage'])) {
            $data['perPage'] = 20;
        }
        return $this->articleRepository->paginator($data['perPage']);
    }

    /**
     * Create a new Article with the provided data.
     *
     * @param array $data The data for the new Article.
     *
     * @return Article The created Article instance.
     *
     * @throws \Exception If there is an error while creating the Article.
     */
    public function create(array $data): Article
    {
        $data["user_id"]=Auth::id();
        return $this->articleRepository->create($data);
    }

    /**
     * Find an Article by its ID.
     *
     * @param int $id The ID of the Article to find.
     *
     * @return Article|null The found Article instance or null if not found.
     */
    public function findById(int $id): ?Article
    {
        return $this->articleRepository->find($id);
    }

    /**
     * Update an article in the repository.
     *
     * @param int $id The ID of the article to update.
     * @param array $data The data to update the article with.
     *
     * @return bool True if the update was successful, false otherwise.
     */
    public function update(int $id, array $data): bool
    {
        return $this->articleRepository->update($id, $data);
    }

    public function deleteById(int $id):bool
    {
        return $this->articleRepository->deleteById($id);
    }
}
