<?php
namespace App\Controller\Api;

use App\Entity\Artisan;
use App\Handlers\ArtisanPhotoHandler;
use App\Repository\ArtisanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class GeolocationFind extends AbstractController
{

    #[Route('/geolocation', name: 'geolocation_data', methods: ['GET'])]
    public function index(ArtisanRepository $artisanRepository): Response
    {
            $data = [
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/d0488f8218514bf2/174379875167f041df47797.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "OUATTARA",
                    "first_name" => "NOGOLOURGO JONAS",
                    "subscription_date" => "2025-04-04",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "KONA01-16-25083368YG",
                    "id_number" => "C 0109 0076 08",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/804d2de15b9e4a1b/174414322867f5837c4ac3e.png' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "XWCVVXWC",
                    "first_name" => "WXCVXCVW",
                    "subscription_date" => "2025-04-08",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "SDFQSDFQSD",
                    "id_number" => "QSDFQDSFQDSFQSD",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/4ab0d52847344a5c/174440118967f97325b3ee5.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOUASSI",
                    "first_name" => "KANGA GERMAIN",
                    "subscription_date" => "2025-04-11",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "KOUL01-20-44050363Y",
                    "id_number" => "C 0109 0076 98",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/0a90179b46f84021/174440202367f97667dd313.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DABLE",
                    "first_name" => "KOUKOUA NADEGE",
                    "subscription_date" => "2025-04-11",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "UOJD08786757",
                    "id_number" => "C008767667675",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/b8d56ab00ffe425c/174446961767fa7e71c0e58.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DABLE",
                    "first_name" => "KOUKOUA NADEGE",
                    "subscription_date" => "2025-04-12",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "DOJD08786757",
                    "id_number" => "C008767667678",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/3dc21fdc09064862/174467724567fda97d35e8f.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DOUBA",
                    "first_name" => "SEME YVONNE",
                    "subscription_date" => "2025-04-15",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "DOUD08786757",
                    "id_number" => "C008767667575",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/87a982e949c74645/174471657967fe4323b20ef.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DIALLO",
                    "first_name" => "OUSMANE",
                    "subscription_date" => "2025-04-15",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "DING02-16-1302541KK",
                    "id_number" => "C0112187437",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/05417cbb195d4dc3/174472509367fe646547607.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "TAN",
                    "first_name" => "KALOWIEU KOUYA PATERNE",
                    "subscription_date" => "2025-04-15",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "TANK01-16-25083368YT",
                    "id_number" => "C008767661675",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/65625d4eead942da/174472988867fe772014ca5.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOFFI",
                    "first_name" => "KONAN BRUNO",
                    "subscription_date" => "2025-04-15",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "FOFFI01-16-25083368YT",
                    "id_number" => "C108767661675",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/defb75eb39e5458a/174622222268153c8ee3016.png' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "TEST",
                    "first_name" => "TEST DGHD",
                    "subscription_date" => "2025-05-02",
                    "subscription_expire_date" => "2025-12-31",
                    "driving_license_number" => "DFQSDSFQDQSFDQS",
                    "id_number" => "5467979AZAEAREA",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/b483199ee59f4b45/1700648632655dd6b8eb6b1.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KONAN",
                    "first_name" => "YAO  TCHIRESSOI GEORGINO",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KONA01-16-25083368YT",
                    "id_number" => "CI003047227",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/ad9e17e5e3974524/1700651074655de0420ba2e.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "MANGOUA",
                    "first_name" => "KONAN KOUAME NOEL",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "MANG02-16-1302541KK",
                    "id_number" => "C0112187037",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/ecb8405a7cca47a2/1700654217655dec89c3f87.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "MADOU",
                    "first_name" => "JOSUE STEVEN",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "MADO-01-15-25036013JS",
                    "id_number" => "C0113390917",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/00bd9dbf792f4ee8/1700656331655df4cb10b94.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KONAN",
                    "first_name" => "KOUAKOU STANISLAS",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KONA01-16-25066344K",
                    "id_number" => "CI003751992",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/20fc00448ba94efd/1700658094655dfbaeb2fe6.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KAMBOU",
                    "first_name" => "DOMONSSOULOUDJOU",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KAMB01-23-44083187D",
                    "id_number" => "BF384001001007186250",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/cfd200a212494fa5/1700667837655e21bd9d1ee.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "SOUMAHORO",
                    "first_name" => "OUEDEU",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "SOUM01-15-00077070O",
                    "id_number" => "CI005522535",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/dc84f8562e954a24/1700673896655e3968468c0.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KAMBIRE",
                    "first_name" => "DIKOURE RICHARD",
                    "subscription_date" => "2023-11-22",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KAMB01-14-00046926DR",
                    "id_number" => "CI004204053",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/277c0263f27a47d0/1700733939655f23f3ead27.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "AMON",
                    "first_name" => "KOUAKOU PATRICE",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "AMON01-15-00099199KP",
                    "id_number" => "CI001440904",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/a5db24b70962432c/1700735284655f2934193dd.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "ASSO",
                    "first_name" => "NOMEL D'AQUIN",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "ASSO01-19-40012467ND",
                    "id_number" => "CI004646942",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/36571d22ed8f4242/1700741854655f42debe6d8.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "GNAGRA",
                    "first_name" => "GBAKRE EDMOND",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "GNAG01-15-25012719GE",
                    "id_number" => "CI005296530",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/467cbf3a27d14455/1700745751655f52176d970.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOUAKOU",
                    "first_name" => "KOUAME KAN YANNICK ARMAND",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOUA01-16-25077157KK",
                    "id_number" => "CI004004278",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/c02d3de0f71f439c/1700747792655f5a1085a50.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOFFI",
                    "first_name" => "SYLVAIN ELOI SIMPLICE",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOFF01-15-24044160SE",
                    "id_number" => "CI004454814",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/45e3caa0391144ec/1700750958655f666eb91c3.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOUADIO",
                    "first_name" => "YAO CHRISTIAN",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOUA01-17-44006579YC",
                    "id_number" => "CI002353521",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/8f4c4426c23d41da/1700756901655f7da57fe23.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOUAKOU",
                    "first_name" => "KOUASSI ALEXE BORIS",
                    "subscription_date" => "2023-11-23",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOUA02-18-13053770KA",
                    "id_number" => "C0110657226",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/37ebed83c277494d/17008359096560b2456807f.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOUASSI",
                    "first_name" => "KANGA GERMAIN",
                    "subscription_date" => "2023-11-24",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOUA01-17-25112918KG",
                    "id_number" => "CI000622134",

                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/a9296c00fa5b4717/17010827346564766e63e2b.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "BAMBA",
                    "first_name" => "SIRIKI",
                    "subscription_date" => "2023-11-27",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "BAMB01-14-00035566S",
                    "id_number" => "CI001669301",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/4a98e715cf6c4434/170108418565647c196617c.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "TRAORE",
                    "first_name" => "BANGALY",
                    "subscription_date" => "2023-11-27",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "TRAO01-19-44039849B",
                    "id_number" => "CI001222976",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/903cc631fe5243b6/17010868796564869f5c506.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "ZAHI",
                    "first_name" => "DIEANE-FABRICE",
                    "subscription_date" => "2023-11-27",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "ZAHI01-21-40019433D",
                    "id_number" => "CI000907379",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/35b670dd2bab4ff4/17011706856565cdfd18856.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "BAH",
                    "first_name" => "ABDOUL-RAHAMANE",
                    "subscription_date" => "2023-11-28",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "BAH01-14-00024868AR",
                    "id_number" => "097665",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/b9c195bac9284d3a/17011812306565f72e256ab.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KONDOMBO",
                    "first_name" => "CHECK NABIGA ISSIAKA",
                    "subscription_date" => "2023-11-28",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOND01-16-00165205CN",
                    "id_number" => "BF384001001007231779",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/9a21ac27cefe430b/170127652465676b6c07b3d.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "ADOU",
                    "first_name" => "AMAGOUA PAUL",
                    "subscription_date" => "2023-11-29",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "ADOU01-16-25080040A",
                    "id_number" => "4002393496",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/55d6ab9a47924d67/1701336504656855b89f441.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DABIRE",
                    "first_name" => "DONLIETE",
                    "subscription_date" => "2023-11-30",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "DABI01-14-24005855D",
                    "id_number" => "CI000964095",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/b7cc2246909b4ac1/170134026165686465c0b71.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KOFFI",
                    "first_name" => "YAO DRAMANE",
                    "subscription_date" => "2023-11-30",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KOFFI01-17-24124302YD",
                    "id_number" => "CI002212847",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/ed69d09c92ab48bc/170135426965689b1de9c32.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "FASSINOU",
                    "first_name" => "CYRILLE JESUGNON",
                    "subscription_date" => "2023-11-30",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "FASS01-17-24111954C",
                    "id_number" => "1025/17",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/1e849bafdf7a44fa/17013598576568b0f15d09f.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "BREDOUMOU",
                    "first_name" => "AGNIMOU KEVIN",
                    "subscription_date" => "2023-11-30",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "BREDO01-21-30149167AK",
                    "id_number" => "CI001050324",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/7efaeec5293a46b5/1701507162656af05a6b76b.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "KONATE",
                    "first_name" => "MAMADOU",
                    "subscription_date" => "2023-12-02",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "KONA01-16-25053204M",
                    "id_number" => "C 0110234210",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/566ed23dd6254816/1701536435656b62b3dedba.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "ADOU",
                    "first_name" => "ADOU-AMERL",
                    "subscription_date" => "2023-12-02",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "ADOU01-18-24145927A",
                    "id_number" => "CI002398689",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/cec439a9c3ff4e99/1701683046656d9f66e0a0b.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DIAKITE",
                    "first_name" => "MAMADOU LAMINE",
                    "subscription_date" => "2023-12-04",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "DIA01-18-00223413ML",
                    "id_number" => "CI000909806",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/43ef70656a5642fd/1701686241656dabe13f200.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "ZINSOU",
                    "first_name" => "BI LEZIE ADOLF",
                    "subscription_date" => "2023-12-04",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "ZINS01-16-30043356B",
                    "id_number" => "CI001675349",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/8fe60ffa2fc54eda/1701691593656dc0c91cff9.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "HOUNNOUSSA",
                    "first_name" => "DONOUVOH PROSPER",
                    "subscription_date" => "2023-12-04",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "HOUN01-15-24050918DP",
                    "id_number" => "C01002271122",

                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/0dc4497e56b74066/1701777074656f0eb29d377.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DOH",
                    "first_name" => "SAHOUIN MOMBLECA DONATIEN",
                    "subscription_date" => "2023-12-05",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "DOH01-18-25144142SM",
                    "id_number" => "CI005614123",

                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/92c84c1cb2664bff/171085554865f9957cd6270.png' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "DOUMBIA",
                    "first_name" => "MOUSSA OLIVIER",
                    "subscription_date" => "2023-12-05",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "DOUM01-15-00073126MO",
                    "id_number" => "CI003010951",

                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/8f85e643295943ae/1701778060656f128c9dab2.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "LOKA",
                    "first_name" => "BOLY MISCHAEL",
                    "subscription_date" => "2023-12-05",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "LOKA09-17-21026676BM",
                    "id_number" => "CI003013880",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/c1e23cc011cf4db6/1702384844657854cc914f3.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "OUATTARA",
                    "first_name" => "SORY",
                    "subscription_date" => "2023-12-05",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "OUAT01-14-00008637S",
                    "id_number" => "CI001699824",
                ],
                [
                    "photo" => "<div class='avatar-md img-fluid rounded-circle'><img src='/artisans/cb9f089cc75741d2/1701779301656f1765af389.jpg' alt='' class='img-fluid d-block rounded-circle'></div>",
                    "last_name" => "GASSO",
                    "first_name" => "DJEDJE BOLLOU YANNICK",
                    "subscription_date" => "2023-12-05",
                    "subscription_expire_date" => "2024-12-31",
                    "driving_license_number" => "GASS01-20-25195402DY",
                    "id_number" => "CI000625832",

                ]
            ];


        $payload = [];
        $lat = "5.336330575873639";
        $long = "-4.019100398813355";
        foreach ($data as $d){
            $val = generateNearbyCoordinates($lat, $long, $d);
        }
        return $this->json($data);
    }

    private function generateNearbyCoordinates($centerLat, $centerLon, $radiusKm = 5.0) {
        // Convert radius from kilometers to degrees
        $radiusInDegrees = $radiusKm / 111.0;

        // Generate two random numbers
        $u = mt_rand() / mt_getrandmax();
        $v = mt_rand() / mt_getrandmax();

        // Convert polar coordinates to Cartesian
        $w = $radiusInDegrees * sqrt($u);
        $t = 2 * M_PI * $v;
        $x = $w * cos($t);
        $y = $w * sin($t);

        // Adjust longitude scaling based on latitude
        $newLat = $centerLat + $y;
        $newLon = $centerLon + $x / cos(deg2rad($centerLat));

        return [$newLat, $newLon];
    }
}