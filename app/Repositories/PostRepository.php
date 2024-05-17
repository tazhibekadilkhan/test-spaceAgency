<?php


namespace App\Repositories;


use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
        $this->sortBy = 'updated_at';
    }

    public function paginated(array $relations = [])
    {
        return $this->model
            ->with($relations)
            ->where('user_id', Auth::id())
            ->when(
                request('category_id'),
                function ($query) {
                    $query->where(
                        'category_id',
                        request('category_id')
                    );
                }
            )
            ->when(
                request('date'),
                function ($query) {
                    $query->whereRaw('date(updated_at) = ?', [Carbon::parse(request('date'))->format('Y-m-d')]);
;
                }
            )
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->paginate);
    }
}
