# Documentación API REST para el Proyecto WebService

---

### Por: Richard Francisco Vaca Garcia, 2do CFGS DAW

---

## Introducción
He desarrollado esta API REST como parte de mi proyecto para DWES07, utilizando tecnologías como AJAX, jQuery, PHP, HTML, CSS, y JavaScript. Esta API facilita la gestión de categorías y productos, permitiendo realizar operaciones CRUD de manera eficiente y segura.

---

## Configuración Inicial y Detalles de Entorno
Para garantizar una comunicación efectiva entre el cliente y el servidor, he configurado la API para aceptar solicitudes CORS desde cualquier origen. Esto se logra mediante headers específicos en PHP que permiten métodos GET y POST, asegurando así que las solicitudes AJAX desde el frontend funcionen sin problemas.

Además, he utilizado PDO para la conexión a la base de datos, configurando la codificación de caracteres a UTF-8 para soportar adecuadamente múltiples idiomas y caracteres especiales. Esto mejora la seguridad y eficiencia de la API.

---

## Endpoints de la API

### Categorías

#### 1. Obtener Todas las Categorías
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=GetAll`
- **Método:** GET
- **Descripción:** Devuelve todas las categorías disponibles.

#### 2. Obtener Categoría por ID
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=GetId`
- **Método:** POST
- **Body (raw JSON):**
```json
{
    "cat_id" : 1
}
```
- **Descripción:** Devuelve una categoría específica por su ID.

#### 3. Añadir Nueva Categoría
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Insert`
- **Método:** POST
- **Body (raw JSON):**
```json
{
    "cat_nom" : "Envio desde Postman2",
    "cat_obs" : "Envio Obs Postman2"
}
```
- **Descripción:** Permite añadir una nueva categoría.

#### 4. Actualizar Categoría
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Update`
- **Método:** POST
- **Body (raw JSON):**
```json
{
    "cat_id" : "4",
    "cat_nom" : "Actualizacion",
    "cat_obs" : "Actualizacion Obs"
}
```
- **Descripción:** Actualiza los datos de una categoría existente.

#### 5. Eliminar Categoría
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria.php?op=Delete`
- **Método:** POST
- **Body (raw JSON):**
```json
{
    "cat_id" : "9"
}
```
- **Descripción:** Elimina una categoría existente.

---

### Productos

#### 1. Añadir Nuevo Producto
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=InsertProducto`
- **Método:** POST
- **Body (raw JSON):**
```json
{
  "cat_id": 1, 
  "prod_nom": "Nuevo TV 4K",
  "prod_desc": "Descripción del TV 4K",
  "prod_precio": 999.99
}
```
- **Descripción:** Permite añadir un nuevo producto a una categoría específica.

#### 2. Actualizar Producto
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=UpdateProducto`
- **Método:** POST
- **Body (raw JSON):**
```json
{
  "prod_id": 1, 
  "cat_id": 1,
  "prod_nom": "TV 4K actualizada",
  "prod_desc": "Descripción del TV 4K",
  "prod_precio": 800
}
```
- **Descripción:** Actualiza los datos de un producto existente.

#### 3. Eliminar Producto
- **URL:** `http://localhost/PERSONAL_WebServicePostman/controller/categoria_controller.php?op=DeleteProducto`
- **Método:** POST
- **Body (raw JSON):**
```json
{
  "prod_id": 1
}
```
- **Descripción:** Elimina un producto existente.

---

## Uso de AJAX y jQuery
En este proyecto, he implementado un panel de control en el frontend que utiliza AJAX y jQuery para interactuar con la API de manera asincrónica. Esto permite realizar operaciones como añadir, editar, y eliminar categorías y productos sin necesidad de recargar la página. Esta interacción no solo mejora la eficiencia sino también la experiencia del usuario, al proporcionar una retroalimentación inmediata y mantener el estado actual de la aplicación sin interrupciones.

Utilicé llamadas AJAX específicas para cada acción CRUD, utilizando la sintaxis concisa de jQuery. Por ejemplo, al añadir un nuevo producto, un formulario en el panel de control captura los datos del usuario y los envía a la API mientras el usuario continúa su trabajo sin esperar una carga de página.

Esta integración de AJAX y jQuery demuestra el compromiso del proyecto con las prácticas modernas de desarrollo web, ofreciendo un caso práctico de cómo estas tecnologías pueden trabajar juntas para mejorar significativamente la interactividad y la usabilidad de las aplicaciones web.

---

## Dificultades Durante el Desarrollo

Durante el desarrollo de esta API, enfrenté varios retos que, aunque al principio parecían obstáculos insuperables, me ofrecieron una gran oportunidad de aprendizaje.

El primero fue entender y configurar correctamente las solicitudes CORS. Al principio, me encontraba con múltiples errores que no lograba identificar, hasta que descubrí el concepto de CORS y cómo configurar mi API para aceptar solicitudes desde cualquier origen. Esto fue crucial para permitir que el frontend interactuara sin problemas con el backend.

Otro desafío significativo fue implementar un panel de control en el frontend que utilizara AJAX y jQuery para comunicarse de manera asincrónica con la API. Mis conocimientos iniciales se limitaban a probar la funcionalidad de la API exclusivamente a través de Postman y XAMPP, por lo que adentrarme en el mundo de AJAX y jQuery representó una curva de aprendizaje empinada.

Por último, mi experiencia previa con PDO y la configuración de la codificación de caracteres a UTF-8 era limitada. Me vi en la necesidad de consultar diversas fuentes de información, desde foros en línea hasta video tutoriales, para comprender cómo utilizar correctamente PDO para la conexión a la base de datos y asegurar una correcta manipulación de los caracteres.

Cada uno de estos desafíos me ha enseñado valiosas lecciones sobre el desarrollo de APIs REST, el manejo de solicitudes CORS, la interacción asincrónica con el backend y la importancia de una conexión segura y eficiente a la base de datos. Estoy agradecido por las dificultades encontradas, ya que cada una me ha permitido crecer como desarrollador.

Estoy abierto a cualquier feedback que pueda ayudarme a mejorar la implementación o la documentación de la API.

---

## Conclusión
La realización de esta API REST representó un desafío significativo, partiendo de una base de conocimientos que necesitaba ampliación sustancial. La falta de familiaridad previa con ciertos aspectos técnicos me obligó a emprender un extenso proceso de autoformación, recurriendo a numerosos tutoriales en vídeo y fuentes en línea para comprender y aplicar correctamente los conceptos necesarios. Este esfuerzo no solo refleja mi compromiso con el proyecto sino también el valor de la perseverancia y la autodidacta en el campo del desarrollo de software. 

Quedo a la espera de comentarios y sugerencias para continuar mejorando tanto en este proyecto como en mi desarrollo profesional futuro.

---

## Glosario
- **API:** Interfaz de Programación de Aplicaciones, un conjunto de definiciones y protocolos para construir e integrar el software de aplicaciones.
- **API REST:** Estilo arquitectónico de diseño de redes que se basa en principios REST (Transferencia de Estado Representacional) para comunicación entre cliente y servidor.
- **WebService:** Servicio disponible en Internet o red interna que permite la comunicación entre aplicaciones a través de estándares web.
- **CRUD:** Acrónimo de Crear, Leer, Actualizar, y Eliminar; las cuatro operaciones básicas de almacenamiento persistente.
- **AJAX:** Técnica de desarrollo web para crear aplicaciones interactivas que pueden enviar y recibir datos de un servidor de manera asíncrona sin interferir con la presentación y el comportamiento de la página.
- **jQuery:** Biblioteca de JavaScript rápida, pequeña y rica en funciones que facilita el manejo de eventos, animaciones, y peticiones AJAX.
- **Solicitudes CORS:** Mecanismo que utiliza cabeceras HTTP para permitir que un servidor indique cualquier otro origen (dominio, esquema, o puerto) que tenga permiso para acceder a sus recursos.
- **Métodos GET y POST:** GET solicita datos de un recurso especificado, mientras que POST envía datos para ser procesados a un recurso especificado.
- **PDO:** Objeto de Datos de PHP, una extensión que define una interfaz consistente para acceder a bases de datos en PHP.
- **UTF-8:** Codificación de caracteres Unicode que incluye todos los caracteres humanos, siendo la forma más común de codificación de texto en la web.
- **Endpoints de la API:** Puntos de conexión o URLs específicas donde se pueden solicitar diferentes servicios de una API.
- **Panel de control en el frontend:** Interfaz gráfica que permite a los usuarios interactuar con la aplicación y realizar tareas específicas.
- **Interacción asincrónica con la API:** Comunicación que se realiza sin esperar una respuesta inmediata, permitiendo que la aplicación web continúe funcionando mientras espera la respuesta.
- **PHP, HTML, CSS, y JavaScript:** Lenguajes de programación y marcado utilizados para el desarrollo web. PHP se usa en el servidor, mientras que HTML, CSS, y JavaScript se utilizan en el cliente (navegador).

---
---
