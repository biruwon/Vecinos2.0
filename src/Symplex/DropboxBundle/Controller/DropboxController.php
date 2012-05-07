<?php

namespace Symplex\DropboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response;
use Symplex\DropboxBundle\Manager\DropBoxManager;

/**
 *
 * @Route("/__dropboxmanager")
 */
class DropboxController extends Controller {
    /**
     * @Route("/init", name="__dropboxmanager_init")
     * @Template()
     */
//    public function initAction() {
//
//        $dbmanager = $this->get('symplex_dropbox.manager');
//
//        if (!$dbmanager->isUserAuthenticated()) {
//            $redirectUrl = $this->generateUrl('__dropboxmanager_validation_back', array(), true);
//            return $dbmanager->AskForAuthentication($redirectUrl);
//        }
//
//
////        return $dbmanager->put('/sd/toto21.txt', '/home/pascal/testmail.sh', 'sandbox');
//        return array('name' => $name);
//    }

    /**
     * @Route("/back", name="__dropboxmanager_validation_back")
     * @Template()
     */
    public function backAction() {
        $dbmanager = $this->get('symplex_dropbox.manager');

        $dbmanager->setToken();

        //on verifie si c'est OK
        if ($dbmanager->isCredential()) {
            $cred = true;
        } else {
            $cred = false;
        }

        $session = $this->getRequest()->getSession();

        $urlcomplete = $session->get('_dropbox_urlcomplete');

        if ($session->has('_dropbox_urlIfOK')) {
            $urlIfOK = $session->get('_dropbox_urlIfOK');
            $session->remove('_dropbox_urlIfOK');
        } else {
            $urlIfOK = '';
        }

        if ($session->has('_dropbox_urlIfNotOK')) {
            $urlIfNotOk = $session->get('_dropbox_urlIfNotOK');
            $session->remove('_dropbox_urlIfNotOK');
        } else {
            $urlIfNotOk = '';
        }

        if ($cred && $urlIfOK != '') {
            return $this->redirect($urlIfOK);
        }

        if (!$cred && $urlIfNotOk != '') {
            return $this->redirect($urlIfNotOk);
        }

        return array('cred' => $cred, 'url' => $urlcomplete);
    }

    /**
     * @Route("/credential", name="__dropboxmanager_ask_credential")
     */
    public function askcredentialAction($url) {
        $response = new Response();
        $response->headers->set('Location', $url);
        return $response;
    }
    
     public function indexAction() {

        $dbmanager = $this->get('symplex_dropbox.manager');

        $urlComplete = $this->getRequest()->getUri();

        /* not mandatory */
        $urlsuccess = $this->generateUrl('success');

        /* not mandatory */
        $urlfailure = $this->generateUrl('failure');



        //put a file
        if ($dbmanager->isCredential()) {
            if (!$dbmanager->put('/sd/toto21.txt', '/home/pascal/testmail.sh', 'sandbox')) {
                throw new \Exception('Cannot put file');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }


        //copy a file
        /*if ($dbmanager->isCredential()) {
            if (!$dbmanager->copy('/sd/toto21.txt', '/sd/toto22.txt', 'sandbox')) {
                throw new \Exception('Cannot copy file');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }

        //move a file
        if ($dbmanager->isCredential()) {
            if (!$dbmanager->move('/sd/toto22.txt', '/sd/totomove.txt', 'sandbox')) {
                throw new \Exception('Cannot move file');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }

        //create a folder
        if ($dbmanager->isCredential()) {
            if (!$dbmanager->createFolder('/sd/newfolder/', 'sandbox')) {
                throw new \Exception('Cannot create folder');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }

        //delete a file
        if ($dbmanager->isCredential()) {
            if (!$dbmanager->delete('/sd/toto21.txt', 'sandbox')) {
                throw new \Exception('Cannot delete file');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }

        if ($dbmanager->isCredential()) {
            if (!$dbmanager->delete('/sd/totomove.txt', 'sandbox')) {
                throw new \Exception('Cannot delete file');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }

        if ($dbmanager->isCredential()) {
            if (!$dbmanager->delete('/sd/newfolder/', 'sandbox')) {
                throw new \Exception('Cannot delete folder');
            }
        } else {
            //redirect to dropbox web //and return to here
            return $dbmanager->AskForAuthentication($urlComplete, $urlsuccess, $urlfailure);
        }*/

        return array('name' => 'toto');
    }


}
