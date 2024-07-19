# SkyLocal

Este proyecto permite usar tu propio almacenamiento local como un "Servidor" que te da la opcion de subir los recursos que necesites 
y luego acceder a ellos mediante una url. Util para cuando necesites simular que diferentes usuarios suban sus recursos a tu APP sin tener 
que contratar un hosting o firebase por ejemplo, cabe recalcar que por el momento es solo para pruebas y no para pasar a produccion.
Por el momento solo funciona para imagenes pero la idea es que soporte cualquier tipo de recurso que pueda ser almacenado en archivos locales, si quieres
aportar en su desarrollo sientete libre de hacer los ***pull request*** con tus propuestas.

## Índice

- [Instalación](#instalación)
- [Uso](#uso)
- [autores](#autores)

## Instalación

### Requisitos Previos

- [Tener instalado y configurado ***xampp*** de manera local](https://www.apachefriends.org/download.html)
- Tener configurado ***apache*** para que reconozca los archivos .htaccess

### Pasos

1.- Navega hasta la carpeta htdocs :

   `
   cd c:/xampp/htdocs`

   o si estas en linux :
	
   `
   cd /opt/lampp/htdocs`

2. Clonar el repositorio :
   
`
   git clone https://github.com/Litardo-Jardy/SkyLocal.git`

## Uso

### Guia

- Verifica que los servicios del ***xampp*** se encuentren en ejecucion
  
  En linux:

  `
  cd /opt/lampp || sudo ./xampp status`

  o si estas en window solo abre la interfaz grafica del xampp.

- La peticion a la ***api*** se debera hacer por metodo ***post*** donde el body necesitara de 3 valores:
  
   1.- **Imagen**: Recurso en formato de imagen.
   2.- **Folder**: Directorio donde se almacenaran los recurso (Si el directorio no existe se creara uno con el nombre especificado).
   3.- **id**: Identificador de la imagen (Debe ser un valor entero).

- La peticion retornara siempre un json con dos valores:
   1.- **true** / **false**: Valor boolean que sera **true** si la el recurso fue procesado con exito y **false** si no lo fue.
   2.- **url** / **error mensage**: Un string que hara referencia a la url del recurso en nuestro "Servidor"
       o un mensaje de error si el recurso no fue procesado con exito (Se puede controlar por medio el valor booleando para no generar errores a la hora de compilar).

## Autores
- **Litardo-Jardy** - *Principal contribuidor* - [@Jardy](https://github.com/Litardo-Jardy)
- **kevin villacrez** - *Colaborador* - [@artylleriman](https://github.com/artylleriman)
 
