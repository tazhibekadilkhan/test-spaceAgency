<?php


namespace App\Repositories;


use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
        $this->paginate = 50;
    }

    public function paginated(array $relations = []) {
        return $this->model
            ->with($relations)
            ->when(
                request('post_id'),
                function ($query) {
                    $query->where(
                        'post_id',
                        request('post_id')
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
