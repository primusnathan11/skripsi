<?php

namespace App\Providers;

use App\Repositories\Donation\DonationRepository;
use App\Repositories\Donation\DonationRepositoryImplement;
use Illuminate\Support\ServiceProvider;
use App\Services\Project\ProjectService;
use App\Repositories\Tree\TreeRepository;
use App\Repositories\Project\ProjectRepository;
use App\Services\Transaction\TransactionService;
use App\Repositories\UserTree\UserTreeRepository;
use App\Services\Project\ProjectServiceImplement;
use App\Repositories\Tree\TreeRepositoryImplement;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Project\ProjectRepositoryImplement;
use App\Services\Transaction\TransactionServiceImplement;
use App\Repositories\UserTree\UserTreeRepositoryImplement;
use App\Repositories\Transaction\TransactionRepositoryImplement;
use App\Repositories\UserCarbonOffset\UserCarbonOffsetRepository;
use App\Repositories\UserCarbonOffset\UserCarbonOffsetRepositoryImplement;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // service
        $this->app->bind(TransactionService::class, TransactionServiceImplement::class);
        $this->app->bind(ProjectService::class, ProjectServiceImplement::class);

        // repository
        $this->app->bind(TransactionRepository::class, TransactionRepositoryImplement::class);
        $this->app->bind(TreeRepository::class, TreeRepositoryImplement::class);
        $this->app->bind(UserCarbonOffsetRepository::class, UserCarbonOffsetRepositoryImplement::class);
        $this->app->bind(UserTreeRepository::class, UserTreeRepositoryImplement::class);
        $this->app->bind(ProjectRepository::class, ProjectRepositoryImplement::class);
        $this->app->bind(DonationRepository::class, DonationRepositoryImplement::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('getOrFail', function () {
            return tap($this->get(), fn ($results)  => throw_unless($results->count(), new ModelNotFoundException()));
        });
    }
}
