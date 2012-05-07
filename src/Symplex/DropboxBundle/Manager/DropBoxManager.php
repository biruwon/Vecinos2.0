<?php

namespace Symplex\DropboxBundle\Manager;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DropBoxManager {

    private $consumerKey;
    private $consumerSecret;
    private $oauthClass;
    private $oauth;
    private $dropbox;
    private $oauthCache;
    private $tokens;
    private $session;
    private $request;
    private $router;
    private $httpkernel;

    public function __construct(\Symfony\Component\HttpFoundation\Session $session, \Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Routing\Router $router, \Symfony\Bundle\FrameworkBundle\HttpKernel $httpkernel, $consumerKey, $consumerSecret) {
        $this->session = $session;
        $this->request = $request;
        $this->router = $router;
        $this->httpkernel = $httpkernel;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;

        $this->oauthClass = 'Dropbox_OAuth_PHP';

        $this->oauthCache = '/tmp/oauth.cache';

        require __DIR__ . '/../Lib/Dropbox-PHP/src/Dropbox/autoload.php';

        $this->oauth = new $this->oauthClass($this->consumerKey, $this->consumerSecret);
        $this->dropbox = new \Dropbox_API($this->oauth);
    }

    public function isUserAuthenticated() {
        if (!file_exists($this->oauthCache)) {
            return false;
        } else {
            return true;
        }
    }

    public function AskForAuthentication($urlComplete = '', $urlIfOK = '', $urlIfNotOK = '') {
        $urlRedirect = $this->router->generate('__dropboxmanager_validation_back', array(), true);

        $this->tokens = $this->oauth->getRequestToken();

        $this->session->set('oauth_tokens', $this->tokens);

        $this->session->set('_dropbox_urlcomplete', $urlComplete);

        if ($urlIfOK != '') {
            $this->session->set('_dropbox_urlIfOK', $urlIfOK);
        }

        if ($urlIfNotOK != '') {
            $this->session->set('_dropbox_urlIfNotOK', $urlIfNotOK);
        }

        return $this->httpkernel->forward('symplex_dropbox.controller:askcredentialAction', array('url' => $this->oauth->getAuthorizeUrl($urlRedirect)));
    }

    public function setToken() {
        $this->tokens = $this->session->get('oauth_tokens');
        $this->oauth->setToken($this->tokens);

        $this->tokens = $this->oauth->getAccessToken();
        $this->oauth->setToken($this->tokens);

        file_put_contents($this->oauthCache, serialize(
                        array(
                            'tokens' => $this->tokens,
                            'class' => $this->oauthClass,
                            'consumer' => array('key' => $this->consumerKey, 'secret' => $this->consumerSecret)
                        )
                ));
    }

    public function put($pathdest, $pathorig, $root = null) {
        if ($this->isCredential()) {
            try {
                return $this->dropbox->putFile($pathdest, $pathorig, $root);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($path, $root = null) {
        if ($this->isCredential()) {
            try {
                return $response = $this->dropbox->delete($path, $root);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function move($from, $to, $root = null) {
        if ($this->isCredential()) {
            try {
                return $response = $this->dropbox->move($from, $to, $root);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function copy($from, $to, $root = null) {
        if ($this->isCredential()) {
            try {
                return $response = $this->dropbox->copy($from, $to, $root);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function createFolder($path, $root = null) {
        if ($this->isCredential()) {
            try {
                return $response = $this->dropbox->createFolder($path, $root);
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    private function setup() {
        if ($this->isUserAuthenticated()) {

            $setup = unserialize(file_get_contents($this->oauthCache));

            $this->oauthClass = $setup['class'];

            $this->oauth = new $this->oauthClass($setup['consumer']['key'], $setup['consumer']['secret']);

            $this->oauth->setToken($setup['tokens']);

            $this->dropbox = new \Dropbox_API($this->oauth);

            return true;
        } else {
            return false;
        }
    }

    public function isCredential() {
        if ($this->isUserAuthenticated()) {
            if ($this->setup()) {
                try {
                    $this->dropbox->getAccountInfo();
                    return true;
                } catch (\Exception $exc) {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

}
