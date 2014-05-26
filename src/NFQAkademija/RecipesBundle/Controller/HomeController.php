<?php

namespace NFQAkademija\RecipesBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/*
require_once("C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookJavaScriptLoginHelper.php");
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookSession.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookRequest.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookResponse.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookSDKException.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookRequestException.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookAuthorizationException.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/GraphObject.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookCurlHttpClient.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookHttpable.php' );
require_once( 'C:/XAMPP/WEBSITE/BBD/vendor/facebook/php-sdk-v4/src/Facebook/FacebookCanvasLoginHelper.php' );
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookHttpable;
use Facebook\FacebookCanvasLoginHelper;
*/


class HomeController extends Controller
{


    public function indexAction()
    {
        /*
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $bla = "not";
        FacebookSession::setDefaultApplication('1411099562488324', 'af52183a641ddd35949899d6108721e2');
        $helper = new FacebookJavaScriptLoginHelper();

        try {
            $session = $helper->getSession();
            $bla = "try";
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
            $bla = "error1";
        } catch(\Exception $ex) {
            // When validation fails or other local issues
            $bla = "error2";
        }

        if (isset( $session )) {
            $bla = "yes";
        }
        */

        return $this->render('NFQAkademijaRecipesBundle:Home:index.html.twig', array(
            //'bla' => $bla,
        ));
    }
}

