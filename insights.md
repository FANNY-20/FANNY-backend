

[2020-09-14 10:44:45] `/Users/julien/Projects/stop-covid/stop-covid-backend`

                                                                            
          97.9%            94.6%            100 %            93.7%          
                                                                            
                                                                            
          Code           Complexity      Architecture        Style          


Score scale: ◼ 1-49 ◼ 50-79 ◼ 80-100

[CODE] 97.9 pts within 539 lines

Comments ...................................................... 43.8 %
Classes ....................................................... 24.5 %
Functions ...................................................... 3.0 %
Globally ...................................................... 28.8 %

[COMPLEXITY] 94.6 pts with average of 1.16 cyclomatic complexity

[ARCHITECTURE] 100 pts within 46 files

Classes ....................................................... 91.3 %
Interfaces ..................................................... 0.0 %
Globally ....................................................... 8.7 %
Traits ......................................................... 0.0 %

[MISC] 93.7 pts on coding style and 0 security issues encountered

• [Code] Parameter type hint: (SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff)
  app/Domain/Geolocation/Models/Geolocation.php:51: Method \Domain\Geolocation\Models\Geolocation::scopeNewerThan() does not have @param annotation for its traversable parameter $query.
  app/Domain/Geolocation/Models/Geolocation.php:60: Method \Domain\Geolocation\Models\Geolocation::scopeNearTo() does not have @param annotation for its traversable parameter $query.
  app/Domain/Geolocation/Models/Geolocation.php:68: Method \Domain\Geolocation\Models\Geolocation::scopeFarFrom() does not have @param annotation for its traversable parameter $query.
  app/Domain/Geolocation/Models/Geolocation.php:76: Method \Domain\Geolocation\Models\Geolocation::withDistance() does not have @param annotation for its traversable parameter $query.
  app/Domain/Meet/Actions/FetchMeetsForGeolocation.php:83: Method \Domain\Meet\Actions\FetchMeetsForGeolocation::updateMeets() does not have @param annotation for its traversable parameter $meets.

• [Code] Return type hint: (SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff)
  app/Domain/Geolocation/Models/Geolocation.php:51: Method \Domain\Geolocation\Models\Geolocation::scopeNewerThan() does not have @return annotation for its traversable return value.
  app/Domain/Geolocation/Models/Geolocation.php:60: Method \Domain\Geolocation\Models\Geolocation::scopeNearTo() does not have @return annotation for its traversable return value.
  app/Domain/Geolocation/Models/Geolocation.php:68: Method \Domain\Geolocation\Models\Geolocation::scopeFarFrom() does not have @return annotation for its traversable return value.
  app/Domain/Geolocation/Models/Geolocation.php:76: Method \Domain\Geolocation\Models\Geolocation::withDistance() does not have @return annotation for its traversable return value.
  app/Domain/Meet/Actions/FetchMeetsForGeolocation.php:31: Method \Domain\Meet\Actions\FetchMeetsForGeolocation::execute() does not have @return annotation for its traversable return value.
  deploy.php:26: Closure does not have void return type hint.
  deploy.php:30: Closure does not have void return type hint.

• [Style] End file newline: (PHP_CodeSniffer\Standards\PSR2\Sniffs\Files\EndFileNewlineSniff)
  deploy.php:40: Expected 1 blank line at end of file; 2 found

• [Style] Namespace spacing: (SlevomatCodingStandard\Sniffs\Namespaces\NamespaceSpacingSniff)
  deploy.php:2: Expected 1 lines before namespace statement, found 0.

• [Style] Braces: (PhpCsFixer\Fixer\Basic\BracesFixer)
  deploy.php:  
@@ -30 +30 @@
-task('horizon', function(){
+task('horizon', function() {



• [Style] Function declaration: (PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer)
  deploy.php:  
@@ -30 +30 @@
-task('horizon', function(){
+task('horizon', function () {



• [Style] Single blank line at eof: (PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer)
  deploy.php:  
@@ -41 +41,0 @@
-


