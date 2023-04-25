<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('id', "%{$value}%")
                        ->orWhere('type', 'LIKE', "%{$value}%")
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(((new User())->where('type', '!=', 'admin')))
        ->defaultSort('id')
        ->allowedSorts(['name', 'email', 'id', 'type'])
        ->allowedFilters(['name', 'email', 'id', $globalSearch])
        ->paginate(8)
        ->withQueryString();

        return Inertia::render('Users/Index', ['users' => $users])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: true, sortable: true);
            $table->column('name', 'Nome', searchable: true, sortable: true);
            $table->column('email', 'Email', searchable: true, sortable: true);
            $table->column('phone', 'Telefone', searchable: false, sortable: false);
            $table->column('actions', 'Ações', searchable: false, sortable: false);
        });
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', ['user' => new UserResource($user)]);
    }
}
