#!/bin/bash

# Aviso para los usuarios administradores
echo "AVISO: Si eres un usuario administrador, por favor ingrese a este script como 'root'"
sleep 3

while true; do
    clear
    sshd_active=$(systemctl is-active sshd)

    # Menú principal
    echo "------------- Menú Principal -------------"
    echo "[1] Crear usuarios/grupos"
    echo "[2] Gestión de logs"
    echo "[3] Docker"
    echo "[4] Respaldo"
    if [[ $sshd_active == active ]]; then
        echo -e "[5] Desactivar SSH \e[1;32m■ activo \e[0m"
    else
        echo -e "[5] Activar SSH \e[1;31m■ inactivo \e[0m"
    fi
    echo "[6] Firewall"
    echo "[7] Mostrar usuarios y grupos creados"
    echo "[8] Ver en qué grupo está un usuario"
    echo "[9] Borrar usuario"
    echo "[10] Borrar grupo"
    echo "[0] Salir"
    echo "-----------------------------------------"

    read -p "Ingrese una opción: " op

    case $op in
        1)
            read -p "Ingrese el nombre del usuario: " nomUser
            if id "$nomUser" &>/dev/null; then
                echo "El usuario $nomUser ya existe."
            else
                read -p "¿Desea elegir un grupo? Y/N | " groupDef
                if [[ "${groupDef^^}" == "Y" ]]; then
                    read -p "Elija el nombre del grupo: " nomGroup
                    if getent group "$nomGroup" &>/dev/null; then
                        echo "Grupo $nomGroup encontrado. Creando usuario $nomUser..."
                        useradd -m -g $nomGroup $nomUser
                        if [ $? -eq 0 ]; then
                            echo "Usuario $nomUser creado y asignado al grupo $nomGroup correctamente."
                            echo "Ingrese la contraseña para el usuario $nomUser:"
                            passwd $nomUser
                            echo ""
                            echo "Grupo del usuario $nomUser después de agregarlo:"
                            groups $nomUser
                        else
                            echo "Error al crear el usuario $nomUser."
                        fi
                    else
                        echo "El grupo $nomGroup no existe. Creándolo..."
                        groupadd $nomGroup
                        if [ $? -eq 0 ]; then
                            echo "Grupo $nomGroup creado correctamente."
                            useradd -m -g $nomGroup $nomUser
                            if [ $? -eq 0 ]; then
                                echo "Usuario $nomUser creado y asignado al grupo $nomGroup correctamente."
                                echo "Ingrese la contraseña para el usuario $nomUser:"
                                passwd $nomUser
                                echo ""
                                echo "Grupo del usuario $nomUser después de agregarlo:"
                                groups $nomUser
                            else
                                echo "Error al crear el usuario $nomUser."
                            fi
                        else
                            echo "Error al crear el grupo $nomGroup."
                        fi
                    fi
                else
                    echo "Creando usuario sin grupo específico..."
                    useradd -m $nomUser
                    if [ $? -eq 0 ]; then
                        echo "Usuario $nomUser creado correctamente."
                        echo "Ingrese la contraseña para el usuario $nomUser:"
                        passwd $nomUser
                        echo ""
                        echo "Grupo del usuario $nomUser después de agregarlo:"
                        groups $nomUser
                    else
                        echo "Error al crear el usuario $nomUser."
                    fi
                fi
            fi
            read -p "Presione [Enter] para continuar..."
            ;;
        2)
            ./logs.sh
            ;;  
        3)  
            ./docker.sh
            ;;
        4)
            ./menu_backup.sh
            ;;
        5)
            if [[ $sshd_active == active ]]; then
                systemctl stop sshd
                echo "SSH desactivado."
            else
                systemctl start sshd
                echo "SSH activado."
            fi
            read -p "Presione [Enter] para continuar..."
            ;;
        6)
            ./menu_firewall.sh 
            ;;
        7)
            echo "Usuarios en el sistema:"
            awk -F: '{print $1}' /etc/passwd
            echo "Grupos en el sistema:"
            awk -F: '{print $1}' /etc/group
            read -p "Presione [Enter] para continuar..."
            ;;
        8)
            read -p "Ingrese el nombre del usuario: " userName
            if id "$userName" &>/dev/null; then
                echo "Grupos en los que se encuentra el usuario $userName:"
                groups $userName
            else
                echo "El usuario $userName no existe."
            fi
            read -p "Presione [Enter] para continuar..."
            ;;
        9)
            read -p "Ingrese el nombre del usuario a borrar: " userToDelete
            if id "$userToDelete" &>/dev/null; then
                userdel -r $userToDelete
                if [ $? -eq 0 ]; then
                    echo "Usuario $userToDelete eliminado correctamente."
                else
                    echo "Error al eliminar el usuario $userToDelete."
                fi
            else
                echo "El usuario $userToDelete no existe."
            fi
            read -p "Presione [Enter] para continuar..."
            ;;
        10)
            read -p "Ingrese el nombre del grupo a borrar: " groupToDelete
            if getent group "$groupToDelete" &>/dev/null; then
                groupdel $groupToDelete
                if [ $? -eq 0 ]; then
                    echo "Grupo $groupToDelete eliminado correctamente."
                else
                    echo "Error al eliminar el grupo $groupToDelete."
                fi
            else
                echo "El grupo $groupToDelete no existe."
            fi
            read -p "Presione [Enter] para continuar..."
            ;;
        0)
            echo "Saliendo del programa..."
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, ingrese una opción válida."
            ;;
    esac
done
