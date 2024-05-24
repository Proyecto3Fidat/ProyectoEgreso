#!/bin/bash

# Variables
echo "Ingrese el nombre del commit:"
read COMMIT_MESSAGE
BRANCH="main"  # Nombre de la rama a la que quieres empujar los cambios


# Agregar todos los cambios
git add .

# Hacer commit con el mensaje especificado
git commit -m "$COMMIT_MESSAGE"

# Empujar los cambios a la rama especificada en el repositorio remoto
git push origin $BRANCH

# Mensaje de éxito
echo "Cambios subidos exitosamente a la rama $BRANCH en el repositorio remoto ProyectoEgreso."
