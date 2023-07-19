<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Aplicación para la gestión de procesos de la FISME
![Img](https://github.com/SakNoelCode/Imagenes_Proyectos/blob/master/homeProject.png)


## Ejecutar en local
1. Clone o descargue el proyecto en una carpeta en local 

1. Abra el proyecto en su editor de código favorito

1. Ejecute una terminal en la carpeta raíz de su proyecto

1. Ejecute los siguientes comandos en la terminal para la instalación de paquetes **(Debe ejecutarlos en orden)**
```bash
composer install
```
```bash
npm install
```

5. En el directorio raíz encontrará el arhivo **.env.example**, dupliquelo, al archivo duplicado cambiar de nombre como **.env**, este archivo se debe modificar según las configuraciones de nuestro proyecto **(base de datos, etc)**
```bash
DB_DATABASE=nombreBasedeDatos
```

7. Ejecutar el comando en la terminal para crear la **key**
```bash
php artisan key:generate 
```

8. Correr la migraciones del proyecto
```bash
php artisan migrate
```

9. Compilar archivos
```bash
npm run dev
```

10. Ejecute el proyecto
```bash
php artisan serve
```

## Guía de contribución
La siguiente guía proporciona información valiosa sobre como puedes contribuir al proyecto.
- Lee las directrices de contribución antes de enviar cualquier cambio.
- Sé respetuoso con otros contribuidores y usuarios del proyecto.
- Contribuye con código de alta calidad que cumpla con las convenciones de estilo del proyecto.
- Comunícate de manera clara y efectiva con el equipo del proyecto.
- Haz cambios pequeños y realiza pruebas antes de enviar cambios.
- Respeta las decisiones del equipo del proyecto si su contribución es rechazada.

### 🌀 Clonar y forkear el repositorio

- Primero, clona el repositorio en tu máquina local usando el siguiente comando en tu terminal:
```bash
git clone https://github.com/SakNoelCode/FismeProject.git
```

- Si ún no lo has hecho, forkea el repositorio en tu cuenta de GitHub para tener tu propia copia del proyecto.

### 🔍 Revisar la ruta del proyecto

- Antes de comenzar a trabajar en una nueva función o corrección, es importante revisar la ruta del proyecto para asegurarte de estar trabajando en la rama correcta y el archivo correcto.

### 📝 Elegir una tarea

- Este paso se podría resumir como la nueva caracerística que deseas añadir al proyecto, piensa en un nombre y continúa.

### 📂 Crear una rama

- Crea una nueva rama desde la rama principal (main o master) utilizando un nombre descriptivo que indique el problema que estás solucionando. Por ejemplo:
```bash
git checkout -b mi-nueva-funcion
```

- El ejemplo anterior es un comando de **git**, crea una nueva rama y te lleva a ese espacio de trabajo

### 💻 Realizar cambios y hacer commit

- Haz los cambios necesarios en la rama que creaste ,crea un commit utilizando la convención de commit convencional para asegurarte de que se entienda claramente lo que estás haciendo. Los prefijos comunes son `feat`, `fix`, `doc`, `style`, `refactor`, `test` y `chore`.
```bash
git commit -m "feat: agregar nueva función de búsqueda"
```

- El comando anterior crea una confirmación en tu rama, para continuar, debes moverte a tu rama main con el siguiente comando
```bash
git checkout main
```

- Revisa que tu repositorio en remoto este sincronizado, si es así, ejecuta el siguiente comando
```bash
git pull origin nombre-rama
```

- Ese comando combina dos pasos en uno: primero trae los cambios remotos y luego los fusiona en la rama actual.  Donde **origin** es el nombre del repositorio remoto y **nombre-rama** es el nombre de la rama que deseas fusionar en la rama principal (main).

### 📤 Hacer push a tu proyecto

- Haz push de tu repositorio local a tu repositorio forkeado en GitHub

```bash
git push origin main
```

### 🤝 Enviar un Pull Request

- Envía un Pull Request a la rama `main` del repositorio original con tu nuevos cambios. Asegúrate de proporcionar una descripción clara y detallada de los cambios que has realizado.

### 🕵️‍♂️ Esperar la revisión y aprobación

- El equipo del proyecto revisará y discutirá tus cambios. Si el cambio es aceptado se crea de manera automática un nuevo commit en el proyecto principal, luego de eso deberás sincronizar los cambios en tu repositorio forkeado.

🎉 ¡Gracias por tu contribución al proyecto!


## Notas
Nada aquí por ahora
