<?php

namespace Tests\Unit;

use DDS\Entities\Project\Project;
use DDS\Entities\Project\SETool;
use DDS\Repository\ProjectRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function testBasicTest() {
        $projectRepository = new ProjectRepository();

        dd($projectRepository->findAll());
    }
}
