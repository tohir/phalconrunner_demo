<?php

use \PhalconRunner\AppConfig as AppConfig;

class AppRun extends \PhalconRunner\PhalconRunner
{
    protected function init()
    {
        $this->template->setTemplateDir(APPLICATION_PATH.'/templates/');
        
        $this->setPageTemplate(AppConfig::get('templates', 'page'));
        $this->setLayoutTemplate(AppConfig::get('templates', 'layout'));
        
        $this->template->persistTemplateVar('persistedVar', 'I go on every page');
        
        $this->registerRoutes(array(
            array('/',                      'whatsup',  'home', 'get|post|put|delete|patch'),
            array('/year/{year:[0-9]+}',    FALSE,      'year'),
            array('/redirect',              FALSE,      'redirect'),
        ));
    }

    
    public function accesscheck_whatsup()
    {
        echo 'Intercepted by: accesscheck_whatsup';
    }

    
    protected function home_get() {return 'home_get';}
    protected function home_post() {return 'home_post';}
    protected function home_put() {return 'home_put';}
    protected function home_delete() {return 'home_delete';}
    protected function home_patch() {return 'home_patch';}
    
    protected function year_get($year)
    {
        return $this->template->loadTemplate('content/year.tpl', array('year'=>$year));
    }
    
    protected function redirect_get()
    {
        $this->redirect('/year/2000?redirect');
    }
    
    
    
}
