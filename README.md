TYPO3 Fluid
===========

This is the standalone version of the Fluid template rendering project TYPO3 Fluid. It comes to you courtesy of the
TYPO3 community.

Contains only a subset of the full feature set found in the TYPO3 Fluid versions being used in TYPO3 CMS and TYPO3 Flow.

## Example

Execute the "Example.php" file - via CLI or web.

Related files are all located under the "Example" directory.

## Status

### Working:

- Basic template rendering
- Layout and partial usage
- Basic variable usage
- Fluid Template Caching as PHP
- Custom ViewHelpers and namespace mapping

### Not working:

- Widgets, AJAX and standard
- ControllerContexts (need to be made more generic and not depending on TS)
- ConfigurationManager which means {settings} do not yet work and there are no ways to override Widget templates
- Localization-related features

## Symfony2 integration

TYPO3 Fluid can be used as a rendering engine in the Symfony2 PHP framework. The sources contain definitions for a Symfony2
Bundle which can be installed, configured and triggered by using the name "fluid" as engine suffix for templates.

```yaml
# Source: app/config/config.yml
framework:
    templating:      { engines: ['php', 'fluid', 'twig'] }

fluid:
    cache:
        dir: %kernel.root_dir%/cache/%kernel.environment%/fluid
    view:
        templateRootPath: @AcmeDemoBundle/Resources/Templates/
        partialRootPath: @AcmeDemoBundle/Resources/Partials/
        layoutRootPath: @AcmeDemoBundle/Resources/Layouts/
```

	### Danger note

	The paths are not yet supported and still use the Symfony2-native TemplateReference which means that until further notice,
	your template files must be located in @MyBundleName/Resources/views/ - once a custom TemplateRefence has been implemented
	which also supports the additional paths and lookup logic of Fluid, this warning will be removed and the paths will then
	work as expected. That will, however, constitute a __breaking change__ in that you will need to either adapt your
	templateRootPath or simply rename the `views` Resource folder into `Templates` to follow the usual Fluid naming convention.

The `fluid` configuration scope can be overridden by your Bundle. Note that the Fluid templating engine has additional paths
compared to the Twig engine; rather than _extending_ a template from a view, Fluid works by rendering an entire template as
standalone or parts of a template (approximately same concept as Twig `blocks`) - optionally by using a Layout.

Terminology equivalents:

* `block` compares to `Partial` and `section` - in Fluid you can use `section` in any template and render `Partial` from any
  template or `Layout`.
* `extend` approximates using a `Layout` - which if used contains the instructions to render `section`s from the action template.
* `helper` compares to `ViewHelper` but do not need to be individually registered as is required in Twig; can be provided by any
  Bundle installed in Symfony2.

```php
<?php
// Source: app/AppKernel.php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
class AppKernel extends Kernel {
    public function registerBundles() {
        $bundles = array(
            // ...
			new \TYPO3\Fluid\FluidBundle(),
			// ...
        );
        // ...
        return $bundles;
    }

}
```

There's nothing special about how to register the Bundle - it works the same as every other Bundle.

```php
<?php
// Source: @AcmeDemoBundle/Controller/GizmoController.php
namespace Acme\DemoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class AcmeController extends Controller {
    public function indexAction() {
        return $this->render('AcmeDemoBundle:Gizmo:index.html.fluid');
    }
}
```

The @Template annotation is also supported and even allows passing template variables in exactly the same way. The `.fluid`
extension (the engine identifier) is required in templates rendered by the Fluid engine. You can easily mix-and-match templates
from each templating system, if for example your Bundle overrides a Twig based Bundle's templates but itself renders its own
templates using Fluid.