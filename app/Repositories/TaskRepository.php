<?php


namespace App\Repositories;


use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
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
                request('status_id'),
                function ($query) {
                    $query->where(
                        'status_id',
                        request('status_id')
                    );
                }
            )
            ->when(
                request('priority_id'),
                function ($query) {
                    $query->where(
                        'priority_id',
                        request('priority_id')
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
