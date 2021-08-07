<?php

namespace Tests\Unit;

use App\Entities\Vacancy;
use App\Http\Requests\VacancyRequest;
use App\Repositories\VacancyRepository;
use App\Services\VacancyService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Auth\Factory;
use stdClass;
use Illuminate\Contracts\Events\Dispatcher;

class VacancyServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->vacancyRepository = Mockery::mock(VacancyRepository::class);
        $this->vacancyService = new VacancyService($this->vacancyRepository);

        //Request
        $this->request = Mockery::mock(VacancyRequest::class);

        //User
        $this->factory = Mockery::mock(Factory::class);

        app()->instance(Factory::class, $this->factory);

        $user = new stdClass();

        $user->id = 1;

        $this->factory->shouldReceive("user")->andReturn($user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->vacancyRepository->shouldReceive("all")->andReturn(new Collection());
        $this->assertInstanceOf(Collection::class, $this->vacancyService->index());
    }

    public function testStore()
    {
        $params = [
            "title"         => "Programador",
            "description"   => "Programador muito top",
            "wage"          => 5000,
            "category_id"   => 1,
        ];


        $this->vacancyRepository->shouldReceive("create")->andReturn(new Vacancy());

        $this->request->shouldReceive("all")->andReturn($params);

        $this->event = Mockery::mock(Dispatcher::class);

        $this->event->shouldReceive('dispatch')->andReturn(null);

        app()->instance("events", $this->event);

        $this->assertInstanceOf(Vacancy::class, $this->vacancyService->store($this->request));
    }

    public function testUpdate()
    {
        $vacancy = new Vacancy();
        $vacancy->id = 2;
        $vacancy->title = "Programador Pleno";
        $vacancy->description = "Programador muito top";
        $vacancy->wage = 1000;
        $vacancy->category_id = 1;
        $vacancy->user_id = 1;

        $params = [
            "title"         => "Programador",
            "description"   => "Programador muito top",
            "wage"          => 5000,
            "category_id"   => 1,
            "user_id"       => 1

        ];

        $this->request->shouldReceive("all")->andReturn($params);

        $this->vacancyRepository->shouldReceive("find")->andReturn($vacancy);

        $this->vacancyRepository->shouldReceive("update")->andReturn(new Vacancy());

        $this->assertInstanceOf(Vacancy::class, $this->vacancyService->update($this->request, $vacancy->id));
    }

    public function testShow()
    {
        $vacancy = new Vacancy();
        $vacancy->id = 2;
        $vacancy->title = "Programador Pleno";
        $vacancy->description = "Programador muito top";
        $vacancy->wage = 1000;
        $vacancy->category_id = 1;
        $vacancy->user_id = 1;

        $this->vacancyRepository->shouldReceive("find")->andReturn($vacancy);

        $this->vacancyRepository->shouldReceive("delete")->andReturn(true);

        $this->assertIsBool($this->vacancyService->destroy($vacancy->id));
    }
}
