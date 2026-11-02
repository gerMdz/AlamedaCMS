# Walkthrough: Migración a Symfony 7.4 LTS y PHP 8.4

## Resumen de Cambios Realizados

Se completó la actualización de **AlamedaCMS** desde **Symfony 6.4 / PHP 8.2** a **Symfony 7.4.21 LTS / PHP 8.4.26**.

---

### 1. Eliminación de `FOSCKEditorBundle` y Limpieza de Configuración
* Se actualizó [BroteType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/BroteType.php) para usar `TextareaType` con la clase `.tinymce-editor`.
* Se eliminaron los imports sin uso de `FOS\CKEditorBundle\Form\Type\CKEditorType` en [EntradaType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/EntradaType.php), [EntradaComplexType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/EntradaComplexType.php), [PrincipalType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/PrincipalType.php), [StepOneType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/Step/Entrada/StepOneType.php), [StepTwoType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/Step/Section/StepTwoType.php) y [StepThreeType.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/Step/Section/StepThreeType.php).
* Se desregistró `FOSCKEditorBundle` de [bundles.php](file:///home/gerardo/Projects/AlamedaCMS/config/bundles.php) y se quitó el tema de formulario de CKEditor en [twig.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/packages/twig.yaml).
* Se eliminaron los archivos obsoletos `config/packages/fos_ckeditor.yaml`, `templates/resources/views/Form/ckeditor_widget.html.twig`, `friendsofsymfony.ckeditor-bundle.updates-for-deleted-files.patch`, `config/packages/security_checker.yaml`, `config/packages/twig_extemsions.yaml`, `config/routes/dev/framework.yaml`, `config/packages/test/framework.yaml` y `config/packages/test/twig.yaml`.
* Se actualizaron [security.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/packages/security.yaml), [framework.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/packages/framework.yaml), [routes.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/routes.yaml), [routes/framework.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/routes/framework.yaml) y [routes/web_profiler.yaml](file:///home/gerardo/Projects/AlamedaCMS/config/routes/web_profiler.yaml) al formato de Symfony 7.4.

---

### 2. Adaptación de Código a Symfony 7.4 y PHP 8.4
* **Seguridad:**
  * Se migró [ApiTokenAuthenticator.php](file:///home/gerardo/Projects/AlamedaCMS/src/Security/ApiTokenAuthenticator.php) de `AbstractGuardAuthenticator` a `AbstractAuthenticator` (`SelfValidatingPassport` + `UserBadge`).
  * Se actualizaron las firmas de `supports()` y `voteOnAttribute()` en [EntradaVoter.php](file:///home/gerardo/Projects/AlamedaCMS/src/Security/Voter/EntradaVoter.php) y [SectionVoter.php](file:///home/gerardo/Projects/AlamedaCMS/src/Security/Voter/SectionVoter.php) (incluyendo el parámetro opcional `?Vote $vote = null` de Symfony 7.3+).
* **Validadores y Comandos:**
  * Se convirtió [UniqueUser.php](file:///home/gerardo/Projects/AlamedaCMS/src/Validator/UniqueUser.php) en atributo nativo `#[\Attribute]` y se actualizó su uso en [UserRegistrationFormModel.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/Model/UserRegistrationFormModel.php) y [UniqueUserValidator.php](file:///home/gerardo/Projects/AlamedaCMS/src/Validator/UniqueUserValidator.php).
  * Se agregaron los tipos de retorno `: void` en [AddUserCommand.php](file:///home/gerardo/Projects/AlamedaCMS/src/Command/AddUserCommand.php) y [EntradaStatsCommand.php](file:///home/gerardo/Projects/AlamedaCMS/src/Command/EntradaStatsCommand.php).
* **Formularios, Transformadores y Entidades/Repositorios:**
  * Se agregaron los tipos de retorno `: void` en todos los `FormType` y `TextareaSizeExtension`, y `: mixed` en [EmailToUserTransformer.php](file:///home/gerardo/Projects/AlamedaCMS/src/Form/DataTransformer/EmailToUserTransformer.php).
  * Se corrigieron todas las declaraciones de parámetros implícitamente anulables (`?Type $param = null`) requeridas por PHP 8.4 en controladores, entidades y repositorios.
* **Twig:**
  * Se corrigió la llamada a macro `{{links.index_link()}}` en [base_beta.html.twig](file:///home/gerardo/Projects/AlamedaCMS/templates/base_beta.html.twig#L125).

---

### 3. Dependencias Actualizadas ([composer.json](file:///home/gerardo/Projects/AlamedaCMS/composer.json))
* **Symfony:** `v6.4.43` → `v7.4.21` (LTS con mantenimiento hasta noviembre de 2029)
* **PHP:** `>=8.4` (`8.4.26` en plataforma)
* **Bundles y herramientas actualizadas:**
  * `symfony/flex`: `v2.11.0`
  * `symfony/webpack-encore-bundle`: `2.4.2`
  * `symfony/stimulus-bundle`: `v3.6.0`
  * `knplabs/knp-paginator-bundle`: `v6.11.0`
  * `knplabs/knp-time-bundle`: `2.5.0`
  * `endroid/qr-code-bundle`: `6.1.0`
  * `ramsey/uuid-doctrine`: `2.1.0`
  * `liip/imagine-bundle`: `2.18.1`
  * `phpoffice/phpspreadsheet`: `4.5.0`
  * `dama/doctrine-test-bundle`: `v8.7.0`
  * `doctrine/doctrine-fixtures-bundle`: `4.3.1`
  * `phpunit/phpunit`: `11.5.57`
  * `rector/rector`: `2.7.0` ([rector.php](file:///home/gerardo/Projects/AlamedaCMS/rector.php) actualizado a la API de Rector 2.x)

---

## Resultados de Validación

| Verificación | Comando | Resultado |
| :--- | :--- | :--- |
| **Composer** | `composer validate` | `[OK] ./composer.json is valid` |
| **Versión Symfony / PHP** | `php bin/console about` | **Symfony 7.4.21 LTS** / **PHP 8.4.26** |
| **Linter YAML** | `php bin/console lint:yaml config` | `[OK] All 35 YAML files contain valid syntax.` |
| **Linter Contenedor (`dev`, `test`, `prod`)** | `php bin/console lint:container` | `[OK] The container was linted successfully` en los 3 entornos |
| **Linter Twig** | `php bin/console lint:twig templates` | `[OK] All 376 Twig files contain valid syntax.` |
| **Deprecaciones en `App\`** | `php bin/console debug:container --deprecations` | **0 deprecaciones** en código propio (`App\`) y configuración |
