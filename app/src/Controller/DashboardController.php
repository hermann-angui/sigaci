<?php

namespace App\Controller;

use App\Controller\Admin\Enrolement;
use App\Controller\Admin\EnrolementService;
use App\Controller\Admin\StatutEnrolement;
use App\Entity\Artisan;
use App\Entity\Child;
use App\Form\ArtisanRegistrationType;
use App\Helper\ActivityLogger;
use App\Helper\DataTableHelper;
use App\Repository\ArtisanRepository;
use App\Repository\VillesRepository;
use App\Service\Artisan\ArtisanService;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('')]
class DashboardController extends AbstractController
{
    #[Route('', name: 'app_dashboard', methods: ['GET'])]
    public function index(Request $request): Response
    {
       return $this->render('dashboard/index.html.twig');
    }

    #[Route('/home', name: 'app_dashboard_a', methods: ['GET'])]
    public function home(Request $request): Response
    {
        return $this->render('theme_b/index.html.twig');
    }

    #[Route('/maps', name: 'app_map', methods: ['GET'])]
    public function mapGeo(Request $request): Response
    {

        return $this->render('artisans/maps.html.twig');
    }

    #[Route('/datatable', name: 'artisan_datatable', methods: ['GET'])]
    public function ListArtisanDT(Request $request, Connection $connection)
    {
        date_default_timezone_set("Africa/Abidjan");
        $params = $request->query->all();
        $paramDB = $connection->getParams();
        $table = 'artisan';
        $primaryKey = 'id';
        $columns = [
            [
                'db' => 'photo',
                'dt' => 'photo',
                'formatter' => function( $d, $row) {
                    $imageUrl = $row['reference'] . "/" . $d;
                    $content = "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/$imageUrl' alt='' class='img-fluid d-block rounded-circle'></div>";
                    return $content;
                }
            ],
            [
                'db' => 'last_name',
                'dt' => 'last_name',
            ],
            [
                'db' => 'first_name',
                'dt' => 'first_name',
            ],
            [
                'db' => 'subscription_date',
                'dt' => 'subscription_date'
            ],
            [
                'db' => 'subscription_expire_date',
                'dt' => 'subscription_expire_date'
            ],
            [
                'db' => 'driving_license_number',
                'dt' => 'driving_license_number'
            ],
            [
                'db' => 'id_number',
                'dt' => 'id_number'
            ],
            [
                'db'        => 'id',
                'dt'        => '',
                'formatter' => function($d, $row) {
                    $id = $row['id'];
                    $content =  "<div class='d-flex gap-2 flex-wrap'>
                                    <div class='btn-group'>
                                        <button class='btn btn-info dropdown-toggle btn-sm' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            <small></small><i class='mdi mdi-menu'></i>
                                        </button>
                                        <div class='dropdown-menu' style=''>
                                            <a class='dropdown-item' href='/artisan/$id'><i class='mdi mdi-eye'></i> Fiche Artisan</a>
                                            <a class='dropdown-item' href='/artisan/$id/edit'><i class='mdi mdi-pen'></i> Editer</a>";
                    $content.= "</div></div></div> ";
                    return $content;
                }
            ],
            [
                'db' => 'reference',
                'dt' => 'reference'
            ],
        ];

        $sql_details = array(
            'user' => $paramDB['user'],
            'pass' => $paramDB['password'],
            'db'   => $paramDB['dbname'],
            'host' => $paramDB['host']
        );

        $whereResult = '';
        if(!empty($params['driving_license_number'])) {
            $whereResult .= " driving_license_number LIKE '%". $params['driving_license_number']. "%' AND";
        }
        if(!empty($params['last_name'])) {
            $whereResult .= " last_name LIKE '%". $params['last_name']. "%' AND";
        }
        if(!empty($params['id_number'])) {
            $whereResult .= " id_number	LIKE '%". $params['id_number'] . "%' AND";
        }

    //  $whereResult.= " status='VALIDATED'";
        $whereResult = substr_replace($whereResult,'',-strlen(' AND'));
        $response = DataTableHelper::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult);

        return new JsonResponse($response);
    }

}
