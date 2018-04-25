<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

//    $project = new \DDS\Entities\Project\Project();
//    $project->setDescription("Desenvolvimento de um monitorador de conversas do Slack");
//
//    $labinov = new \DDS\Entities\Site\Site();
//    $labinov->setBirth(new DateTime())
//            ->setGeocoors("-23.1869889, -50.6586831")
//            ->setTimezone(new DateTimeZone('America/Sao_Paulo'))
//            ->setDescription("Laboratório de inovação - UTFPR")
//            ->setProject($project);
//
//    $fabricio = new \DDS\Entities\Site\Collaborator();
//    $fabricio->setName("Fabricio Oliveira")
//             ->setEmail("fabricio.jhonata@gmail.com")
//             ->setSite($labinov);
//
//
//    $graduacaoES = new \DDS\Entities\Site\Site();
//    $graduacaoES->setBirth(new DateTime())
//        ->setGeocoors("-23.1882211, -50.6522172")
//        ->setTimezone(new DateTimeZone('America/Sao_Paulo'))
//        ->setDescription("Graduandos de engenharia de software")
//        ->setProject($project);
//
//    $tiago = new \DDS\Entities\Site\Collaborator();
//    $tiago->setName("Tiago Pagotto");
//    $tiago->setEmail("pagotto@alunos.utfpr.edu.br")
//         ->setSite($graduacaoES);
//
//    $slack = new \DDS\Entities\Project\SETool();
//    $slack->setName("Slack");
//
//    $channel = new \DDS\Entities\Communication\Channel();
//    $channel->addHost($fabricio)
//         ->addHost($tiago)
//         ->setType(\DDS\Entities\Communication\Types::DIRECT);
//
//    $menssage = new \DDS\Entities\Communication\Menssage();
//    $menssage->setSource($fabricio)
//             ->setSETool($slack)
//             ->setDestination($channel)
//             ->setDatetime(new DateTime())
//             ->setContent(new \DDS\Entities\Communication\Content\Content('Olá mundo', \DDS\Entities\Communication\Content\Types::TEXT));
//
//    $unit = new \DDS\Entities\Communication\CommunicationUnit();
//    $unit->addMenssage($menssage);
//
//    $graduacaoES->addCommunicationUnit($unit);
//
//    EntityManager::persist($project);
//    EntityManager::flush();
    /**
     * @var $project \DDS\Entities\Project\Project
     */
     $project = EntityManager::getRepository(\DDS\Entities\Project\Project::class)->findOneBy([
         'id'=>1
     ]);

     return [];
});
