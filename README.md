# Introducción

Vistas de administrador basadas en el template [AdminLte](https://adminlte.io/themes/AdminLTE/index2.html) para integrar un con Symfony.

# 1. Instalación

Instalar el bundle mediante composer:

```
composer require goleadsit/adminbundle "~1.0"
```

o

```js
// composer.json

"repositories": [
    {
      "type": "vcs",
      "url": "git@bitbucket.org:goleadsit/adminbundle.git"
    }
 ],
 "require": {
 	"goleadsit/adminbundle": "~1.0"
 }
```
# 2. Habilitar el Bundle

**Symfony 3**

```php
// app/AppKernel.php

<?php

public function registerBundles() {
	$bundles = array(
		// ...
		new Goleadsit\AdminBundle\GoleadsitAdminBundle(),
	);
}
```

**Symfony 4**

```php
// config/bundles.php

<?php

return [
    // ...
    Goleadsit\AdminBundle\GoleadsitAdminBundle::class => ['all' => true],
];
```

Después de habilitar el bundle hay que instalar los assets necesarios mediante el comando.
```php
bin\console assets:install
```

# 3. Guía de uso
Para empezar a utilizar el bundle solo es necesario extender la plantilla base.

<a name="plantilla-base"></a>

```twig
{% extends '@GoleadsitAdmin/base.html.twig' %}
```

## 3.1. Bloques
- **base_title**: Etiqueta `<title></title>`
- **base_stylesheets**: Bloque principal de estilos, en este se deberían cargar todas las dependencias externas.
- **base_custom_stylesheets**: En este bloque se añaden los estilos propios.
- **base_fonts**: Links de fuentes de la página (Google fonts).
- **base_header**: Es este bloque se incluyen Título y subtítulo. [*1](#alert1)
- **base_flashes**:  Es el bloque encargado de mostrar los mensajes flash.
- **base_body**:  Es el bloque principal donde se incluirá el contenido.
- **base_javascripts**: Bloque principal de scripts, en este se deberían cargar todas las dependencias externas.
- **base_custom_javascripts**: En este bloque se incluyen los scripts propios.

\* Cada uno de estos bloques pueden sobrescribirse desde cualquier template que extienda de la [plantilla base](#plantilla-base).

<a name="#alert1"></a>

*1: Si en cualquier template que extienda de la [plantilla base](#plantilla-base) definimos las variables `headerTitle`, `headerSubtitle` o `headerButton` estas se incorporarán en **base_header** como Título, subtítulo y un botón.

Estas variables pueden enviarse desde un controlador o definirse en el template.

```php
// Variables

string headerTitle;
string headerSubtitle;
array headerButton = [
    'path' => '',
    'icon' => '',
    'text' => ''
];
```

<a name="p032"></a>

## 3.2. Mensajes, Notificaciones, Tasks

Es necesario habilitar estas opciones desde la configuración, por defecto no están habilitadas.

```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
    navbar:
        messages: true
        notifications: true
        tasks: true
```

Lo siguiente es crear un Service Provider, que será el encargado de devolver los mensajes, notificaciones o tasks, este debe extender de:

* `Goleadsit\AdminBundle\Service\AbstractMessagesProvider` #Mensajes

* `Goleadsit\AdminBundle\Service\AbstractNotificationsProvider` #Notificaciones

* `Goleadsit\AdminBundle\Service\AbstractTasksProvider` #Tasks

o bien implementar las siguientes interfaces:

* `Goleadsit\AdminBundle\Service\MessagesProviderInterface` #Mensajes

* `Goleadsit\AdminBundle\Service\NotificationsProviderInterface` #Notificaciones

* `Goleadsit\AdminBundle\Service\TasksProviderInterface` #Tasks

------

***Ejemplo para activar Mensajes:***

1. Creamos el Service provider

```php
<?php

namespace App\Service;

use Goleadsit\AdminBundle\Model\MessageModel;
use Goleadsit\AdminBundle\Service\MessagesProviderInterface;

class MessagesProvider implements MessagesProviderInterface {

	public function getMessages(): ?array {
		
		return [
			new MessageModel('Subject', 'Name')
		];
	}
}
```

2. Lo configuramos como service

```yaml
# Symfony 3 app/config/services.yml
# Symfony 4 config/services.yaml

services:    
	app.messages_provider: 
		class: App\Services\MessagesProvider
```

3. Y en la configuración del bundle bajo la sección providers:

```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
	providers:
		messages: App\Service\MessagesProvider
```


## 3.3. Usuarios

Los usuarios son parecidos a [Mensajes, Notificaciones y Tasks](#p032).

Hay que crear un Service provider que extienda:

* `Goleadsit\AdminBundle\Service\AbstractUserProvider`

o implemente:

* `Goleadsit\AdminBundle\Service\UserProviderInterface`

Configurar esta clase como servicio en services.yml y establecerla dentro de providers

```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
	providers:
		user: App\Service\UserProvider
```

Y por último en la configuración del bundle
```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
	user_profile_path: profile # Path para acceder a la página de perfil de usuario
	user_logout_path: logout # Path para logout
	sidebar:
		has_user: true # Para que aparezca en el sidebar
```

## 3.4. Menú

Dentro de esta opción podemos configurar los enlaces que se incluirán en el sidebar, se pueden configurar tantos elementos como se quiera.

Para ello hay que incluir un nuevo elemento bajo la opción menu en la configuración del bundle.

```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
     menu:
     	# Nombre para definir esta ruta (no se toma en cuenta)
        name:
        	# Etiqueta que se mostrará en el sidebar (Obligatoria)
            label: ~
            
            # En esta opción se podrá poner una ruta http(s)://..., mailto:..., o bien una ruta declarada en nuestros controladores (anotaciones) o archivos de rutas (yml, xml), por defecto esta opción será '#'
            route: '#'
            
            # Icono que aparecerá al lado del label (font-awesome 4.7)
            icon: 'fa-circle-o'
            
            options:
            	# Esta opción pondrá la clase active en el elemento de menú
                is_active: false
                
                # Si esta opción es true se pondrá como nombre de una sección del menú
                is_header: false
                
            # Se utiliza para establecer enlaces bajo un elemento, la configuración que se utilizará bajo esta opción es igual a la descrita. Solo existen dos niveles de childs y la opción is_header está deshabilitada en este punto
            childs:
               
```

## 3.5. Más opciones

```yaml
# symfony 3 app/config/config.yml
# symfony 4 config/packages/goleadsit_admin.yaml

goleadsit_admin:
    # Etiqueta <title></title> que aparecerá por defecto para todas las páginas
    title: GoleadsIt 

    # Esquema de colores del administrador. Valores disponibles: skin-blue, skin-blue-light, skin-yellow, skin-yellow-light, skin-green, skin-green-light, skin-purple, skin-purple-light, skin-red, skin-red-light, skin-black, skin-black-light
    skin: skin-blue

    # Nombre de la ruta asociada a la página de perfil de usuario, si no está definida esta opción no aparece
    user_profile_path: null

    # Nombre de la ruta asociada al logout de usuario, si no está definida esta opción no aparece
    user_logout_path: null
    navbar:
    	# Deja la barra de navegación fija en la página
        is_fixed: true

        # Nombre del path donde redirige al hacer click sobre el logo
        logo_path: homepage

        # String HTML para mostrar el nombre (Logo) cuando el navbar no está expandido
        logo_mini: '<b>G</b>LI'

        # String HTML para  mostrar el nombre (Logo) cuando el navbar está expandido
        logo_lg: '<b>GoLeads</b>It'
    sidebar:
    	# Expande el sidebar
        is_collapsed: false
        
        # Pone o quita el icono del usuario del sidebar
        has_user: true
```

# 4. Configuración completa
```yaml
goleadsit_admin:
    title: 'GoleadsIt'
    skin: 'skin-blue'
    user_profile_path: null
    user_logout_path: null
    navbar:
        is_fixed: true
        logo_path: 'homepage'
        logo_mini: '<b>G</b>LI'
    	logo_lg: '<b>GoLeads</b>It'
        messages: false
        notifications: false
        tasks: false
    sidebar:
        is_collapsed: false
        has_user: true
    menu:
        name:
        	label: ~
            route: '#'
            icon: 'fa-circle-o'
            options:
            	is_active: false
                is_header: false
            childs:
            	name:
                    label: ~
                    route: '#'
                    icon: 'fa-circle-o'
                    options:
                        is_active: false
                    childs:
                        name:
                            label: ~
                            route: '#'
                            icon: 'fa-circle-o'
                            options:
                                is_active: false
    providers:
        messages: null
        notifications: null
        tasks: null
        user: null
```
