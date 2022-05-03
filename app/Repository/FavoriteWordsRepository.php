<?php

namespace App\Repository;

use App\Models\FavoriteWords;
use Illuminate\Support\Collection;

final class FavoriteWordsRepository extends CoreRepository
{
    protected function getModel(): string
    {
        return FavoriteWords::class;
    }

    public function getUserFavoriteWords(int $userId): Collection
    {
        $columns = [
            'favorite_words.id as f_id',
            'word_id',
            'library_id',
            'word',
            'translation',
            'description',
            'favorite_words.created_at'
        ];

        $result = $this->model()
            ->select($columns)
            ->where('user_id', '=', $userId)
            ->join('words', 'word_id', '=', 'words.id')
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Ч
    */
    public function isUserFavoriteWord(int $id, int $userId): bool
    {
        return $this->model()
            ->select(['id'])
            ->where('id', '=', $id)
            ->where('user_id', '=', $userId)
            ->toBase()
            ->get()
            ->isNotEmpty();
    }
}
