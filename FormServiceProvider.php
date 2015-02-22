<?php namespace Mraiur\EnhancedForm;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerFormBuilder();

        $this->app->alias('html', 'Mraiur\EnhancedForm\HtmlBuilder');
        $this->app->alias('form', 'Mraiur\EnhancedForm\FormBuilder');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });

        $this->app->bindShared('html', function($app)
        {
            return new HtmlBuilder($app['url']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('html', 'form');
    }

}
