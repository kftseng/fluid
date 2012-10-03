TYPO3 Fluid
=====

This is the standalone version of the Fluid template rendering project TYPO3 Fluid. It comes to you courtesy of the
TYPO3 community.

Contains only a subset of the full feature set found in the TYPO3 Fluid versions being used in TYPO3 CMS and TYPO3 Flow.

Example
=====

Execute the "Example.php" file - via CLI or web.

Related files are all located under the "Example" directory.

Status
=====

Working:

- Basic template rendering
- Layout and partial usage
- Basic variable usage
- Fluid Template Caching as PHP
- Custom ViewHelpers and namespace mapping

Not working:

- Widgets, AJAX and standard
- ControllerContexts (need to be made more generic and not depending on TS)
- ConfigurationManager which means {settings} do not yet work and there are no ways to override Widget templates
- Localization-related features