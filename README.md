BehatSandbox
========================

Basic implementations with Majora Skeleton

3 suites for the post entity:
 - post_dal_domain (to test internal domain)
 - post_api_controller (to test api)
 - post_api_domain (to test sdk)

1 feature in Lv\Acme\Bundle\ApiBundle\Features

4 contexts:
 - PostContext : basic actions for every suite
 - PostApiContext : context to test the api
 - PostDomainContext : context to test the dal and api domains
 - PostRouterContext : just to configure majora router, perhaps not needed, obviously must be refacto as an extension if needed.

